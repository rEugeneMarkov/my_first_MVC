<?php

namespace models;

// модель
class Index
{
    protected $db;
    protected $table;
    private $dataResult;

    public function getIndex()
    {
        return array('id' => 1, 'name' => 'test_index');
    }
}
