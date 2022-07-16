<?php

namespace app\core;


class Session
{
    /**
     * @param session_start
     */
    public function __construct()
    {
        session_start();
        
    }
    /**
     * Undocumented function
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function setSession($key,$value)
    {
        $_SESSION[$key]=$value;
    }
    /**
     * Undocumented function
     *
     * @param [type] $key
     * @return void
     */
    public function getSession($key)
    {
        return $_SESSION[$key] ?? false;
       
    }
    /**
     * 
     *
     * @param [type] $key
     * @return void
     */
    public function delete($key)
    {
       unset($_SESSION[$key]);
    }
    
    
}












