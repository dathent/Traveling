<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 15:39
 */

class Controllers_Actions extends Controllers_Abstract
{

    public function __construct()
    {
        $this->_initAction();
    }

    private function _initAction()
    {
        $action = $this->getControllerAction();
        $controller_class = 'Controllers_'.ucfirst($action[1]);
        $actionMethodName = $action[2].'Action';
        if(class_exists($controller_class)){
            $controller = new $controller_class;
            if(is_callable(array($controller,$actionMethodName),false)){
                $controller->$actionMethodName();
            }

        }


    }

    private function getControllerAction()
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $currentAction = array(1=>'index',2=>'index');
        if($action = stristr($requestUrl,'index.php')){
            $action = str_ireplace('index.php','',$action);
            if($action && $action != '/'){
                $path = explode('/',$action);
                unset($path[0]);
                $path[2] = ($path[2] == '')? 'index' : $path[2];
                $currentAction = $path;
            }
        }
        return $currentAction;
    }
}