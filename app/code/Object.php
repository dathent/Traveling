<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 07.01.2015
 * Time: 12:21
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


    public function setRedirect($url)
    {
        define('REDIRECT',BASE_URL.'/'.$url);
        return $this;
    }

    public function getRedirect()
    {
       return ($this->isRedirect())? REDIRECT : BASE_URL;
    }

    public function isRedirect()
    {
        return defined('REDIRECT');
    }





}