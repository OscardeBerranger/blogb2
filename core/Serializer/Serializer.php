<?php

namespace Core\Serializer;

class Serializer
{
    public static function serialize($toSerialize): void
    {
        $serializable = array($toSerialize);
        $serialized = json_encode($serializable);

        //status http
        //interfae sérializable
        //serializable sur entité direct
        //
        echo ($serialized);
    }
}