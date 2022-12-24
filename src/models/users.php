<?php

namespace Models;

class Users
{
    private $name;
    private $email;
    private $pass;
    private $mysql;

    public function __construct($mysql, $user)
    {
        $this->mysql = $mysql;
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->pass = $user['pass'];
    }
    public function register()
    {
        $escapedName = $mysql->real_escape_string($this->name);
        $escapedEmail = $mysql->real_escape_string($this->email);
        $escapedPass = $mysql->real_escape_string($this->pass);
        $mysql->query("INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
            VALUES (NULL, '$escapedName', MD5('$escapedPass'), '$escapedEmail', CURRENT_TIMESTAMP)");
    }
    public function login()
    {
        $escapedEmail = $mysql->real_escape_string($email);
        $escapedPass = $mysql->real_escape_string($pass);
        $result = $mysql->query("SELECT * FROM `users` 
        WHERE email = '" . $escapedEmail . "' AND pass = '" . $escapedPass . "'");
        $user = $result->fetch_assoc();
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->pass = $user['pass'];
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

    public function getUserEmail()
    {
        return "{$this->email}";
    }

    public function hello()
    {
        echo "Добро пожаловать {$this->name}";
    }
}
