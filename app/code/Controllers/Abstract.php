<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 14:50
 */
class Controllers_Abstract{


    private $_data = array();


    public function __construct()
    {
        $this->_initAction();
    }

    protected function _initAction()
    {
        $this->_data['blocks'] = array(
            'head'=> $this->getBlock('head'),
            'header'=> $this->getBlock('header')
        );
    }


   public function setBlock($blockName, $reference)
   {
       $this->_data['blocks'][$reference] = $this->getBlock($blockName);
       return $this;
   }

    public function getBlock($blockName)
    {
        $blockClass = 'Block_'.ucfirst($blockName);
        $block = null;
        if(class_exists($blockClass)){
            $block = new $blockClass;
        }
        return $block;
    }


    protected function getControllerAction()
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


    public function toHtml()
    {
        $this->setBlock('footer','footer')->_toHtml();
    }


    private function _toHtml()
    {
        $html = '<!DOCTYPE html><html>';
        $bodyStart = true;
        foreach($this->_data['blocks'] as $reference => $block){
            if($reference != 'head'){
                $html .= '<div class="'.$reference.'">';
            }

            if(is_object($block)){

                $html .= $block->toHtml();
            }

            if($reference == 'head' && $bodyStart){
                $html .= '<body>';
                $bodyStart = false;
            }

            if($reference != 'head'){
                $html .= '</div>';
            }


        }
        $html .= '</body></html>';
        echo $html;
        return;
    }

}