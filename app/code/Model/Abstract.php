<?php

/**
 * Class Model_Abstract
 */
abstract class Model_Abstract extends Object_Abstract{

    /**
     * @var array
     */
    public $data = array();

    /**
     * @var string
     */
    protected $_modelName = '';


    /**
     *
     */
    public function __construct()
    {
        $this->data = $this->_getSessionData();
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
            $_SESSION['data'][$this->_modelName] = $this->data;
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
            $this->data = $name;
        }else{
            $this->data[$name] = $value;
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
            return $this->data;
        }else{
            return isset($this->data[$name]) ? $this->data[$name] : null;
        }
    }

    /**
     * @param string $name
     * @return $this
     */
    public function unsetData($name = '')
    {
        if($name == ''){
            unset($this->data);
        }elseif(isset($this->data[$name])){
            unset($this->data[$name]);
        }

        return $this;
    }



}