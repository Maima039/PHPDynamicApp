<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;
    public function __construct($config, $username = 'root', $pwd = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        // $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";
        $this->connection = new PDO($dsn, $username, $pwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {
        // !!Never inline userdata(input) in query string, in case input is drop table...
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    // get all
    public function get()
    {
        // $statement -> fetch();
        return $this->statement->fetchAll();
    }

    // find one
    public function find()
    {
        // $statement -> fetch();
        return $this->statement->fetch();
    }

    // find or fail
    public function findOrFail()
    {
        $result = $this->find();
        if (!$result){
            abort();
        }
        return $result;
    }



}


// class Person
// {
//     public $name;
//     public $age;
//     public function breathe()
//     {
//         echo $this->name . " is breathing";
//     }
// }

// $person = new Person();
// $person->name = 'John';
// $person->age = 30;

// $person->breathe();
