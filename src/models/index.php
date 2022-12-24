<?php

namespace models;

// модель
class Index extends Base
{
    public function getIndex()
    {
        return array('id' => 1, 'name' => 'test_index');
    }
}
