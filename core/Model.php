<?php

namespace app\core;
use app\core\models\Registermodel;

abstract class Model
{
    public const RULE_REQUIRED='required';
    public const RULE_EMAIL ='email';
    public const RULE_MIN='min';
    public const RULE_MAX='max';
    public const RULE_MATCH='match';

    public function loadData($data){
       
        foreach ($data as $key => $value) {

         
            if(property_exists($this,$key)){
               
                $this->{$key}=$value;
              
            }
           
        }
     
    }
    /**
     * @param return array
     */
    abstract public function rules();

    public array $errors=[];

    public function validate():bool
    {

        foreach ($this->rules() as $attribute => $rules) {
            # code...
            $value=$this->{$attribute};
          
            foreach ($rules as $rule) {
                # code...
                $rulename=$rule;

                if(!is_string($rulename)){

                    $rulename=$rule[0];
                }
                if($rulename===self::RULE_REQUIRED and !$value){
                    $this->addError($attribute,self::RULE_REQUIRED);
                    /**
                     * @param This fields is required
                     */
                }
                if($rulename===self::RULE_EMAIL and !filter_var($value,FILTER_VALIDATE_EMAIL)){

                    $this->addError($attribute,self::RULE_EMAIL);
                    /**
                     * @param This field must be valid email addres
                     */
                }
                                                            
                if($rulename===self::RULE_MIN and strlen($value) <$rule['min']){
                    $this->addError($attribute,self::RULE_MIN,$rule);
                }
                if($rulename===self::RULE_MAX and strlen($value) > $rule['max'])
                {
                   
                    $this->addError($attribute,self::RULE_MAX,$rule);
                }
                if($rulename===self::RULE_MATCH and $value!==$this->{$rule['match']})
                {
                    $this->addError($attribute,self::RULE_MATCH,$rule);
                }
                
            }
        }

        return empty($this->errors);
        /**
         * @param if errors is emtpy true
         */

    }
    public function addError(string $attribute,string $rule,array $params=[]){
        
        $message=$this->errorMessages()[$rule]?? '';
      
        foreach ($params as $key => $value) {
            
            $message=str_replace("{{$key}}",$value,$message);
            /**
             * @param replace RULE_MIN=>'Min length of this field must be {main}.
             * 
             * @param replace 'This field must be the same as {match}. 
             * 
             */
        }
        $this->errors[$attribute][]=$message;
    }
    public function errorMessages(){

        return [

            self::RULE_REQUIRED=>'This fields is required',

            self::RULE_EMAIL=>'This field must be valid email addres',

            self::RULE_MIN=>'Min length of this field must be {min}',

            self::RULE_MAX=>'Max lenght of this field must be {max}',

            self::RULE_MATCH=>'This field must be the same as {match}',

        ];

    }
    public function hasError($attribute){
        
        return $this->errors[$attribute] ?? false;

    }
    public function getFirstError($attribute){

        return $this->errors[$attribute][0] ?? false;

    }
   
}
