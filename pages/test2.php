<?php

namespace First;

class User
{
    public $name;
    public $email;
    public $pass;

    public function __construct($name, $email, $pass)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
    }
    public function getInfo()
    {
        $info = "{$this->name} " . "{$this->email} " . "{$this->pass}";
        return $info;
    }

    public function getUserName()
    {
        return "{$this->name}";
    }

    public function hello()
    {
        echo "Добро пожаловать {$this->name}";
    }
}
