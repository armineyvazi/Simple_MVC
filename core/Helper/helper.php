<?php

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