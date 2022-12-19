<?php

namespace models;

abstract class Base
{
    protected $db;
    protected $table;
    private $dataResult;

    public function __construct($select = false)
    {
        // объект бд коннекта
        global $dbObject;
        $this->db = $dbObject;

        // имя таблицы
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        $tableName = strtolower($arrExp[1]);
        $this->table = $tableName;

        // обработка запроса, если нужно
        $sql = $this->getSelect($select);
        if ($sql) {
            $this->getResult("SELECT * FROM $this->table" . $sql);
        }
    }

    // получить имя таблицы
    public function getTableName()
    {
        return $this->table;
    }

    // получить все записи
    public function getAllRows()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) {
            return false;
        }
        return $this->dataResult;
    }

    // получить одну запись
    public function getOneRow()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) {
            return false;
        }
        return $this->dataResult[0];
    }

    // извлечь из базы данных одну запись
    public function fetchOne()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) {
            return false;
        }
        foreach ($this->dataResult[0] as $key => $val) {
            $this->$key = $val;
        }
        return true;
    }

     // получить запись по id
    public function getRowById($id)
    {
        try {
            $db = $this->db;
            $stmt = $db->query("SELECT * from $this->table WHERE id = $id");
            $row = $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }

     // запись в базу данных
    public function save()
    {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = array();
        $arrayData = array();
        foreach ($arrayAllFields as $field) {
            if (!empty($this->$field)) {
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;
            }
        }
        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);

        try {
            $db = $this->db;
            $stmt = $db->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");
            $result = $stmt->execute($arrayData);
        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)'";
            exit();
        }

        return $result;
    }

     // составление запроса к базе данных
    private function getSelect($select)
    {
        if (is_array($select)) {
            $allQuery = array_keys($select);
            array_walk($allQuery, function (&$val) {
                $val = strtoupper($val);
            });

            $querySql = "";
            if (in_array("WHERE", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "WHERE") {
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if (in_array("GROUP", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "GROUP") {
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }

            if (in_array("ORDER", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "ORDER") {
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            if (in_array("LIMIT", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "LIMIT") {
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    // выполнение запроса к базе данных
    private function getResult($sql)
    {
        try {
            $db = $this->db;
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $rows;
    }

    // уделение записей из базы данных по условию
    public function deleteBySelect($select)
    {
        $sql = $this->_getSelect($select);
        try {
            $db = $this->db;
            $result = $db->exec("DELETE FROM $this->table " . $sql);
        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "'DELETE FROM $this->table " . $sql . "'";
            exit();
        }
        return $result;
    }

    // уделение строки из базы данных
    public function deleteRow()
    {
        $arrayAllFields = array_keys($this->fieldsTable());
        array_walk($arrayAllFields, function (&$val) {
            $val = strtoupper($val);
        });
        if (in_array('ID', $arrayAllFields)) {
            try {
                $db = $this->db;
                $result = $db->exec("DELETE FROM $this->table WHERE `id` = $this->id");
                foreach ($arrayAllFields as $one) {
                    unset($this->$one);
                }
            } catch (PDOException $e) {
                echo 'Error : ' . $e->getMessage();
                echo '<br/>Error sql : ' . "'DELETE FROM $this->table WHERE `id` = $this->id'";
                exit();
            }
        } else {
            echo "ID table `$this->table` not found!";
            exit;
        }
        return $result;
    }

    // обновление записи. Происходит по ID
    public function update()
    {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arrayForSet = array();
        foreach ($arrayAllFields as $field) {
            if (!empty($this->$field)) {
                if (strtoupper($field) != 'ID') {
                    $arrayForSet[] = $field . ' = "' . $this->$field . '"';
                } else {
                    $whereID = $this->$field;
                }
            }
        }
        if (!isset($arrayForSet) or empty($arrayForSet)) {
            echo "Array data table `$this->table` empty!";
            exit;
        }
        if (!isset($whereID) or empty($whereID)) {
            echo "ID table `$this->table` not found!";
            exit;
        }

        $strForSet = implode(', ', $arrayForSet);

        try {
            $db = $this->db;
            $stmt = $db->prepare("UPDATE $this->table SET $strForSet WHERE `id` = $whereID");
            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "'UPDATE $this->table SET $strForSet WHERE `id` = $whereID'";
            exit();
        }
        return $result;
    }
}
