<?php

/**
 * Class Controllers_Abstract
 */
abstract class Controllers_Abstract extends Object_Abstract{


    /**
     * @var array
     */
    private $data = array();



    /**
     *
     */
    public function __construct()
    {
        $this->_initAction();
    }

    /**
     *
     */
    protected function _initAction()
    {
        $this->data['blocks'] = array(
            'head'=> $this->getBlock('head'),
            'header'=> $this->getBlock('header')
        );
        if($this->getError()){
            $this->data['blocks']['error'] = $this->getBlock('error','error');
        }
    }


    /**
     * @param $blockName
     * @param $reference
     * @return $this
     */
    public function setBlock($blockName, $reference)
   {
       $this->data['blocks'][$reference] = $this->getBlock($blockName);
       return $this;
   }

    /**
     * @param $error
     * @return $this
     */
    public function addError($error)
    {
        $this->setError($error);
        return $this;
    }


    /**
     * @return array
     */
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


    /**
     * @return $this
     */
    public function toHtml()
    {
        return $this->setBlock('footer','footer')->_toHtml();
    }


    /**
     * @return $this
     */
    private function _toHtml()
    {
        $html = '<!DOCTYPE html><html>';
        if($this->isRedirect()){
            $html .= $this->data['blocks']['head']->toHtml();
            $html .= '<body></body></html>';
            echo $html;
            return $this;
        }
        $bodyStart = true;
        foreach($this->data['blocks'] as $reference => $block){
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

        return $this;
    }



}