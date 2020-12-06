<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    abstract protected function getTableName():string;

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->getDB()->getAll($sql);
    }
    public function getOne(int $id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        $params = [':id' => $id];
        return $this->getDB()->getOne($sql, $params);
    }

    protected function insert()
    {
        $params = [];
        foreach ($this as $key => $value) {
            echo "INSERT {$key} => {$value} <br>" ;
            $fields[] = "{$key}";
            $params[] = $value;
        }
        $fields = implode(", ", $fields);
        // здесь хорошо бы сделать так, чтоб количество '?' в поле VALUES менялось в зависимости от количества вставляемых полей
        $sql = "INSERT INTO {$this->getTableName()} ({$fields}) VALUES (?,?,?)";
        return $this->getDB()->exec($sql, $params);
    }

    // вариант без использования PDO (подобный метод делали на базовом курсе)
    protected function update()
    {
        $update_fields = [];
        foreach ($this as $key => $value) {
            echo "UPDATE {$key} => {$value} <br>" ;
            $value = is_numeric($value) ? $value : "'$value'";
            $update_fields[] = "{$key} = {$value}";
        }
        $update_fields = implode(", ", $update_fields);
        $sql = "UPDATE {$this->getTableName()} SET {$update_fields} WHERE id = $this->id";
        return $this->getDB()->exec($sql);
    }

    // вариант с использованием PDO
    protected function update_PDO()
    {
        foreach ($this as $key => $value) {
            echo "UPDATE_PDO {$key} => {$value} <br>" ;
            $params = [$value];
            $sql = "UPDATE {$this->getTableName()} SET $key = ? WHERE id = $this->id";
            $this->getDB()->exec($sql, $params);
        }
    }

    public function delete()
    {
        echo "DELETE from {$this->getTableName()} where id = $this->id" ;
        $sql = "delete from {$this->getTableName()} where id = $this->id;";
        return $this->getDB()->exec($sql);
    }

    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        }
        return $this->update_PDO();
    }

    protected function getDB(): DB
    {
        return DB::instanse();
    }
}