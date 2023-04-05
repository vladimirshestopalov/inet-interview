<?php
interface Nameable {
    public function getObjectName();
}

abstract class Obj implements Nameable{
    protected $name;

    public function __construct(string $name) {
        $this->name=$name;
    }

    public function getObjectName() {
        return $this->name;
    }
}

class SomeObject extends Obj{}

class handlerFactory {
    public function create(Nameable $object)
    {
            if ($object->getObjectName() == 'object_1')
                return 'handle_object_1';
            if ($object->getObjectName() == 'object_2')
                return 'handle_object_2';
    }
}

class SomeObjectsHandler {

    private $handlers;

    public function __construct() {
        $this->handlers=[];
    }
    public function handleObjects(array $objects): array {
        foreach ($objects as $object) {
            $hf=new handlerFactory();
            $this->handlers[]=$hf->create($object);
        }
        return $this->handlers;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);