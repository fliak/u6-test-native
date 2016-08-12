<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 12.8.16
 * Time: 7.09
 */

namespace App\Session;


class SessionHandler
{
    
    public function __construct()
    {
        session_start();
    }
    
    public function destroy()    {
        return session_destroy();
    }
    
    public function store($key, $data)  {
        $_SESSION[$key] = $data;
    }
    
    public function fetch($key, $default = null) {
        if (array_key_exists($key, $_SESSION))  {
            return $_SESSION[$key];
        }
        
        return $default;
    }

}