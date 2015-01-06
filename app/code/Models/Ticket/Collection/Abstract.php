<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 13:48
 */

class Models_Ticket_Collection_Abstract extends Models_Session_Abstract
{

    private $_data = array();

    private $_collectionName = 'ticket';

    public function __construct()
    {
       $this->_data = parent::getData($this->_collectionName);
    }

    public function getData($key = '')
    {
        if($key == ''){
            return $this->_data;
        }
        return (isset($this->_data[$key])) ? $this->_data[$key] : null;
    }

    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    public function unsetData($key = '')
    {
        if($key == ''){
            unset($this->_data);
            return $this;
        }

        unset($this->_data[$key]);
        return $this;

    }

    public function __destruct()
    {
        parent::setData($this->_collectionName, $this->_data);
    }

}