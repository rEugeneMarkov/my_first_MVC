<?php

namespace Test;

// Класс хранилища

class Registry
{
    private $vars = array();

    // запись данных
    public function set($key, $var)
    {
        if (isset($this->vars[$key]) == true) {
            throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }
        $this->vars[$key] = $var;
        return true;
    }

    // получение данных
    public function get($key)
    {
        if (isset($this->vars[$key]) == false) {
            return null;
        }
        return $this->vars[$key];
    }

    // удаление данных
    public function remove($var)
    {
        unset($this->vars[$key]);
    }
}
