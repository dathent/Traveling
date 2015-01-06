<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 18:21
 */
class Block_Abstract{

    public $html = '';

    public $template;

    public $templateDirectory;

    public function __construct()
    {
        $this->templateDirectyory = BASE_DIR.DS.'app'.DS.'design'.DS.'Template';
        $this->_init();
    }

    protected function _init()
    {
        $this->setTemplate('html/home.phtml');
    }

    public function setTemplate($nameTemplate)
    {
        $templateFile = $this->templateDirectyory.DS.str_ireplace('/',DS,$nameTemplate);
        if(file_exists($templateFile)){
            $this->template = $templateFile;
        }

        return $this;
    }

    public function toHtml()
    {

        if($this->template){
            ob_start();
            include_once($this->template);
            $this->html = ob_get_clean();
        }
        return $this->html;
    }



}