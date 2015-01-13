<?php

/**
 * Class Object_Abstract
 */
abstract class Object_Abstract{


    /**
     * @param $blockName
     * @return null
     */
    public function getBlock($blockName)
    {
        $blockClass = 'Block_'.ucfirst($blockName);
        $block = null;
        if(class_exists($blockClass)){
            $block = new $blockClass;
        }
        return $block;
    }

    /**
     * @param $modelName
     * @return null
     */
    public function getModel($modelName)
    {
        $modelClass = 'Model';
        $model = null;
        foreach(explode('/',$modelName) as $word){
            if($word != ''){
                $modelClass .= '_'.ucfirst($word);
            }
        }

        if(class_exists($modelClass)){
            $model = new $modelClass;
        }

        return $model;

    }


    /**
     * @param string $name
     * @return bool
     */
    public function getPostData($name = '')
    {
        $dataPost = (isset($_POST)) ? $_POST : false;
        if($dataPost){
            if($name != ''){
                return (isset($dataPost[$name])) ? $dataPost[$name] : false;
            }else{
                return $dataPost;
            }

        }else{
            return false;
        }

    }


    /**
     * @param $url
     * @return $this
     */
    public function setRedirect($url)
    {
        define('REDIRECT',BASE_URL.'/'.$url);
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
       return ($this->isRedirect())? REDIRECT : BASE_URL;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return defined('REDIRECT');
    }

    /**
     * @return bool
     */
    public function getError()
    {
        return (isset($_SESSION['error'])) ? $_SESSION['error'] : false;
    }

    /**
     * @param $error
     * @return $this
     */
    public function setError($error)
    {
        $_SESSION['error'][] = $error;
        return $this;
    }

    /**
     * @return $this
     */
    public function unsetError()
    {
        unset($_SESSION['error']);
        return $this;
    }

}