<?php

//namespace Test; 

// абстрактый класс контроллера
abstract class Controller_Base
{
    protected $registry;
    protected $template;
    protected $layouts; // шаблон

    public $vars = array();

    // в конструкторе подключаем шаблоны
    public function __construct($registry)
    {
        $this->registry = $registry;
        // шаблоны
        $this->template = new Template($this->layouts, get_class($this));
    }

    abstract public function index();
}
