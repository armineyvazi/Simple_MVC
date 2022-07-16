<?php

namespace app\core;

use app\core\Model;
use Attribute;

abstract  class DbModel extends Model
{

    abstract public function tableName():string;
    abstract public function attribute():array;

    public function save()
    {
        $tableName=$this->tableName();
        $attribute=$this->attribute();
     
        $params=array_map(fn($atrr)=>":$atrr",$attribute); 
        $statement=self::prepare("INSERT INTO $tableName(".implode(',',$attribute).") VALUES (".implode(',',$params).")");

        foreach($attribute as $attribute)
        {
            $statement->bindValue(":$attribute",$this->{$attribute});


        }

        $statement->execute();
    
    }
    public function findOne($where)
    {
        $tableName=static::tableName();
        $attribute=array_keys($where);
        $sql=implode('AND',array_map(fn($atrr)=>"$atrr= :$atrr",$attribute));
        $statement=self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key=>$item)
        {
            $statement->bindValue(":$key",$item);
        }
        $statement->execute();

        return  $statement->fetchObject();
    } 

    public static function prepare($sql)
    {
       return Application::$app->db->pdo->prepare($sql);
    }
}
