<?php

use Dotenv\Util\Str;

/**
 *
 * @param function debug
 *
 *
 */
function dd(...$item)
{
    foreach($item as $item)
    {
        echo '<pre>';
        var_dump($item);
        echo '</pre>';
    }
    die;
}
function setLayout($layout)
{

    ob_start();
    include_once  "../views/layouts/$layout.php";
    return ob_get_clean();
}

if(!function_exists('view')){

    function view($view,$params=[])
    {
        foreach($params as $key => $value)
        {
            $$key=$value;
        }
        $array=explode('.', $view);

        ob_start();
        include_once "../views/{$array[0]}/$array[1].php";
        return ob_get_clean();



    }
}

function views($view,$params=[],$layout='main')
{
    $layoutContent=setLayout('main');
    $viewContent=view($view,$params);
    return str_replace('{{content}}', $viewContent, $layoutContent);
}

function redirect(string $url)
{
    header('Location: '.$url);
}

