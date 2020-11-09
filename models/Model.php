<?php
namespace App\models;

use App\services\DB;

abstract class Model // abstract значит что экземпляр класса создать нельзя
{
    protected $db;

    public function __construct(DB $db){
        $this->db = $db;
    }

    abstract protected function getTableName():string;

    public function getAll(){
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->getAll($sql);
    }
    public function getOne(int $id){
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = $id";
        return $this->db->getOne($sql);
    }
}