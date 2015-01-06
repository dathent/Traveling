<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 15:39
 */

class Controllers_Actions extends Controllers_Abstract
{


    protected function _initAction()
    {
        $action = $this->getControllerAction();
        $controller_class = 'Controllers_'.ucfirst($action[1]);
        $actionMethodName = $action[2].'Action';
        if(class_exists($controller_class)){
            $controller = new $controller_class;
            if(is_callable(array($controller,$actionMethodName),false)){
                $controller->$actionMethodName();
            }else{
                $controller->indexAction();
            }

        }else{
            $controller = new Controllers_Index();
            $controller->indexAction();
        }


    }

}