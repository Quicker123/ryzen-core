<?php

namespace ryzen\ryzen\db;

use ryzen\ryzen\Application;
use ryzen\ryzen\Model;
use app\models;

/**
 * @author razoo.choudhary@gmail.com
 * Class DbModel
 * @package ryzen\ryzen
 */

abstract class DbModel extends Model
{

    abstract public static function tableName(): string;

    abstract public static function attributes(): array;

    abstract public static function primaryKey(): string;

    public static function findOne($where){

        $tableName  = static::tableName();
        $attributes = array_keys($where);
        $sql        = implode("AND ",array_map(fn($attr)=>"$attr = :$attr", $attributes));
        $statement  = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item){

            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public function save(){

        $tableName  = $this->tableName();
        $attribute  = $this->attributes();
        $params     = array_map(fn($attr)=>":$attr", $attribute);
        $statement  = self::prepare("INSERT INTO $tableName (".implode(',',$attribute).") VALUES (".implode(",",$params).")");

        foreach ($attribute as $attributes){

            $statement->bindValue(":$attributes", $this->{$attributes});
        }

        $statement->execute();

        return true;
    }

    public static function prepare($sql){

        return Application::$app->db->pdo->prepare($sql);
    }
}