<?php

namespace Classes;

class Db
{
    private $pdo;

    public function __construct()
    {
        global $dbObject;
        $this->pdo = $dbObject;
        //$this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        //$this->pdo->exec('SET CHARACTER SET utf8');
    }
    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }
}
