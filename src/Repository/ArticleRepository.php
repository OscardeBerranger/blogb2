<?php

namespace App\Repository;


use App\Entity\Article;
use Core\Attributes\TargetEntity;

#[TargetEntity(name: Article::class)]
class ArticleRepository extends \Core\Repository\Repository
{

    public function save(Article $article): object
    {

        $query = $this->pdo->prepare("INSERT INTO $this->tableName SET title = :title, content = :content, user_id= :user_id");
        $query->execute([
            "user_id"=>$article->getUserId(),
            "title"=>$article->getTitle(),
            "content"=>$article->getContent()
        ]);

        return $this->find($this->pdo->lastInsertId());

    }

    public function edit(Article $article): object
    {

        $query = $this->pdo->prepare("UPDATE $this->tableName SET title = :title, content = :content WHERE id = :id");
        $query->execute([
            "id"=>$article->getId(),
            "title"=>$article->getTitle(),
            "content"=>$article->getContent()
        ]);

        return $this->find($article->getId());

    }



}