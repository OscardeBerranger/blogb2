<?php

namespace Core\Attributes;

#[\Attribute]
class Column
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}