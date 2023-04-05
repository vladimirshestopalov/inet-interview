<?php
class Concept {
    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getUserData() {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}

interface KeyStorable{
    public function getKey();
}

class FileStorage implements KeyStorable {
    public function getKey()
    {
        return "ключ из файлового хранилища";
    }
}

class DBStorage implements KeyStorable {
    public function getKey()
    {
        return "ключ из БД";
    }
}

class RedisStorage implements KeyStorable {
    public function getKey()
    {
        return "ключ из Redis";
    }
}

class StorageFactory{
    private $storage_alias;
    public function __construct($storage_alias)
    {
        $this->storage_alias=$storage_alias;
    }

    public function getStorage()
    {
        switch ($this->storage_alias){
            case "file":
                $storage=new FileStorage();
                break;
            case "DB":
                $storage=new DBStorage();
                break;
            case "Redis":
                $storage=new RedisStorage();
                break;
        }
        return $storage;
    }
}

$alias='Redis';
$storage=new StorageFactory($alias);
$key=$storage->getKey();
