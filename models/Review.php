<?php
namespace App\models;


class Review extends Model
{
    public $id;
    public $good_id;
    public $author;
    public $text;
    public $created_at;

    protected function getTableName(): string
    {
        return 'reviews';
    }
    public function getReviews($id)
    {
        $sql = "select author, text, created_at from reviews where good_id = :id";
        $params = [':id' => $id];
        return $this->getDB()->getAllObjects($sql,static::class, $params);
    }
}