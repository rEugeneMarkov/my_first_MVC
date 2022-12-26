<?php

namespace controllers;

// абстрактый класс контроллера
abstract class Base
{
    protected $template;
    protected $layouts; // шаблон

    public $vars = array();

    // в конструкторе подключаем шаблоны
    public function __construct()
    {
        // шаблоны
        $this->template = new \classes\Template($this->layouts, get_class($this));
    }

    abstract public function index();
}
