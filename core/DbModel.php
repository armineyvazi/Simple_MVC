<?php

namespace app\core;

use app\core\Model;
use Attribute;

abstract  class DbModel extends Model
{
    // public function rules()
    // {
        
    // }
    abstract public function tableName():string;
    abstract public function attribute():array;

    public function save()
    {
        $tableName=$this->tableName();
        $attribute=$this->attribute();
        $params=array_map(fn($atrr)=>":$atrr",$attribute);
        $statement=self::prepare("INSERT INTO $tableName(".implode(',',$attribute).") VALUES(".implode(',',$params).")");

        foreach($attribute as $attribute)
        {
            $statement->bindValue(":$attribute",$this->{$attribute});


        }

        $statement->execute();
    
    }

    public static function prepare($sql)
    {
       return Application::$app->db->pdo->prepare($sql);
    }
}
