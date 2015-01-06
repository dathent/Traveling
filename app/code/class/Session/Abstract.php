<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 14:04
 */

class Session_Abstract{


    public function __construct()
    {
        session_start();
    }

    public function getData($key)
    {
        return $this->getSessionData($key);
    }

    private function  getSessionData($key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
    }

    public function setData($key, $value)
    {
        $this->setDataSession($key, $value);
        return $this;
    }

    private function setDataSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }


}