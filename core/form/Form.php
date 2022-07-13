<?php

namespace app\core\form;

use app\core\Model;


class Form
{
    public static function begin($action,$method){

        
        echo sprintf('<form action="%s" method="%s" class="mt-8 space-y-6">',$action,$method);
        

        return new Form();
    }
    public static function end(){

        return '</form>';
    }
    public function field(Model $model,$attribute){

        return new Field($model,$attribute);
    }
}   
