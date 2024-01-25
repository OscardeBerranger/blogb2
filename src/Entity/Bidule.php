<?php

namespace App\Entity;

class Bidule
{
private int $id;
private string $name;
private string $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->faisUnTruc();

        $this->name = $name;
    }

    private function faisUnTruc()
    {


    }


}