<?php

/**
 * Class Model_Abstract
 */
abstract class Model_Abstract extends Object_Abstract{

    /**
     * @var array
     */
    public $_data = array();

    /**
     * @var string
     */
    protected $_modelName = '';


    /**
     *
     */
    public function __construct()
    {
        $this->_data = $this->_getSessionData();
    }


    /**
     * @return mixed
     */
    private function _getSessionData()
    {
        if($this->_modelName != '' && isset($_SESSION['data'][$this->_modelName])){
            $data = $_SESSION['data'][$this->_modelName];
        }else {
            $data = array();
        }
        return $data;
    }



    /**
     *
     */
    public function save()
    {
        if($this->_modelName != ''){
            $_SESSION['data'][$this->_modelName] = $this->_data;
        }else{
           $_SESSION['data'] = array();
        }
        return $this;
    }


    /**
     *
     */
    public function __destruct()
    {
        $this->save();
    }

    /**
     * @param $name
     * @param null $value
     * @return $this
     */
    public function setData($name, $value = null)
    {
        if(is_array($name)){
            $this->_data = $name;
        }else{
            $this->_data[$name] = $value;
        }
        return $this;
    }

    /**
     * @param string $name
     * @return array|mixed
     */
    public function getData($name = '')
    {
        if($name == ''){
            return $this->_data;
        }else{
            return isset($this->_data[$name]) ? $this->_data[$name] : null;
        }
    }

    /**
     * @param string $name
     * @return $this
     */
    public function unsetData($name = '')
    {
        if($name == ''){
            unset($this->_data);
        }elseif(isset($this->_data[$name])){
            unset($this->_data[$name]);
        }

        return $this;
    }



}