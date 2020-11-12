<?php
namespace App\services;

class DB implements IDB
{
    use TSingleton;

    protected $connect;
    protected $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'gbphppro',
        'charset' => 'UTF8',
        'userName' => 'root',
        'passWd' => 'root'
    ];
    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getDSNString(),
                $this->config['userName'],
                $this->config['passWd']

            );
            $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }
        return $this->connect;
    }

    protected function getDSNString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset']
        );
    }

    protected function query($sql, $params = [])
    {
        $PDOStatment = $this->getConnect()->prepare($sql);
        $PDOStatment->execute($params);
        return $PDOStatment;
    }
    public function getAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }
    public function getOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }
    public function exec($sql, $params = [])
    {
        return $this->query($sql, $params);
    }
}