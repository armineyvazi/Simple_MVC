<?php




namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;


class Posts extends DbModel
{
    public string $title='';
    public string $body='';

    /**
     * @return string
     * 
     * @param tableName
     */
    public function tableName(): string
    {
        return 'posts';
    }
    /**
     * Undocumented function
     *
     * @return array
     * 
     * @param attribute
     */
    public function attribute():array
    {
        return ['title','body','deleted'];
    }
    /**
     * Undocumented function
     *
     * @return array
     * 
     * @param rules
     */
    public function rules():array
    {
        return [

            'title'=>[self::RULE_REQUIRED],
            'body'=>[self::RULE_REQUIRED],
        
        ];
    }
    public function create()
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
   


}
