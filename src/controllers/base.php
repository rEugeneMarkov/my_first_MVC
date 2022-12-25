<?php

namespace controllers;

use classes\Db;

// абстрактый класс контроллера
abstract class Base
{
    private $db;
    protected $template;
    protected $layouts; // шаблон

    public $vars = array();

    // в конструкторе подключаем шаблоны
    public function __construct()
    {
        // шаблоны
        $this->template = new \classes\Template($this->layouts, get_class($this));
        $this->db = new \classes\Db();
    }

    abstract public function index();
}
