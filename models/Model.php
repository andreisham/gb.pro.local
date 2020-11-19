<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    abstract protected function getTableName():string;

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->getDB()->getAllObjects($sql,static::class);
    }
    public function getOne(int $id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        $params = [':id' => $id];
        return $this->getDB()->getOneObject($sql,static::class, $params);
    }

    protected function insert()
    {
        $params = [];
        foreach ($this as $key => $value) {
            if (!isset($value) || $key == 'id') {
                continue;
            }
            $fields[] = $key;
            $placeholder = ":" . $key;
            $params[$placeholder] = $value;
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(", ", $fields),
            implode(',', array_keys($params))
        );
        $this->getDB()->exec($sql, $params);
        $this->id = $this->getDB()->getLastId();
    }

    protected function update()
    {
        $params = [];
        $fields = [];
        foreach ($this as $key => $value) {
            if (!isset($value)) {
                continue;
            }
            $placeholder = ":" . $key;
            $params[$placeholder] = $value;
            if ($key == 'id'){
                continue;
            }
            $fields[] = "$key = $placeholder";
            }
        $sql = sprintf("UPDATE %s SET %s WHERE id = :id",
            $this->getTableName(),
            implode(',', $fields)
        );
        $this->getDB()->exec($sql, $params);
    }

    public function delete()
    {
        $sql = "delete from {$this->getTableName()} where id = $this->id;";
        return $this->getDB()->exec($sql);
    }

    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        }
        return $this->update();
    }

    protected function getDB(): DB
    {
        return DB::instanse();
    }
}