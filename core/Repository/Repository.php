<?php
namespace Core\Repository;

use App\Entity\Pizza;
use Core\Attributes\Table;
use Core\Attributes\TargetEntity;
use Core\Database\PDOMySQL;

abstract class Repository
{

    protected \PDO $pdo;

    protected bool $autoCommit = false;

    protected string $targetEntity;

    protected string $tableName;

    public function __construct()
    {
        $this->pdo = PDOMySQL::getPdo();
        $this->targetEntity = $this->resolveTargetEntity();
        $this->tableName = $this->resolveTableName();
    }

    protected function beginTransaction(){

        if(!$this->autoCommit){

            $this->pdo->beginTransaction();
            $this->autoCommit = True;
            return true;
        }
        return false;

    }

    protected function flush()
    {
        try{
            $this->pdo->commit();
            $this->autoCommit = false;
        }catch (\Exception $e)
        {
            throw new \Exception($e);
        }
    }

    protected function resolveTargetEntity(){
        $reflection = new \ReflectionClass($this);
        $attributes = $reflection->getAttributes(TargetEntity::class);
        $arguments = $attributes[0]->getArguments();
        $name = $arguments["name"];
        return $name;
    }

    public function resolveTableName(){
        $reflection = new \ReflectionClass($this->targetEntity);
        $attributes = $reflection->getAttributes(Table::class);
        $arguments = $attributes[0]->getArguments();

        $tableName = $arguments['name'];
        return $tableName;
    }

    public function findAll():array
    {

        $query = $this->pdo->query("SELECT * FROM $this->tableName");

        $items = $query->fetchAll(\PDO::FETCH_CLASS,get_class(new $this->targetEntity()));

        return $items;
    }

    public function find($id):object
    {


        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id");

        $query->execute([
            "id" => $id
        ]);

        $query->setFetchMode(\PDO::FETCH_CLASS,get_class(new $this->targetEntity()));

        $item = $query->fetch();

        return $item;
    }
    public function save($object):void{
        //if autocommit
        $reflection = new \ReflectionClass(get_class($object));
        if (!$reflection->getNamespaceName() == "App\Entity"){
            throw new \Exception("Entity not found");
        }
        $props = $reflection->getProperties();
        $sql = "INSERT INTO $this->tableName SET ";
        $toBeUsed = [];
        foreach ($props as $prop){
            foreach ($prop->getAttributes() as $attribute) {
                if ($attribute->getName() == "App\Entity\Column"){
                    $toBeUsed[]=$prop;
                }
            }
        }
        foreach ($toBeUsed as $item){
            $index = $item->getName();
            $sql.="$index = :$index ,";
            $getter = "get".ucfirst($index);
            $tabeauExecutable[$index] = $object->$getter();
        }

        $this->beginTransaction();
        $sql = substr_replace($sql, ";", -1);

        // A changer
        $query = $this->pdo->prepare($sql);
        $query->execute($tabeauExecutable);
    }


    public function delete(object $object):void
    {

        $query = $this->pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
        $query->execute([
            "id"=>$object->getId()
        ]);

    }



}