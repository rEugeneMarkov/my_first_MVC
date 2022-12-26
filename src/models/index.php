<?php

namespace models;

// модель
class Index extends Base
{
    public function getIndex()
    {
        $sql = 'SELECT * FROM `index`;';
        $result = $this->query($sql);
        //$this->dataResult = $result;
        $id = 1;
        $test = 'test_index';
        return array('id' => $id,
                    'name' => $test);
    }
}
