<?php

/**
 * Class Block_Abstract
 */
abstract class Block_Abstract extends Object_Abstract{

    /**
     * @var string
     */
    public $html = '';

    /**
     * @var
     */
    public $template;

    /**
     * @var
     */
    public $templateDirectory;

    /**
     *
     */
    public function __construct()
    {
        $this->templateDirectyory = BASE_DIR.DS.'app'.DS.'design'.DS.'Template';
        $this->_init();
    }

    /**
     *
     */
    protected function _init()
    {
        $this->setTemplate('html/home.phtml');
    }

    /**
     * @param $nameTemplate
     * @return $this
     */
    public function setTemplate($nameTemplate)
    {
        $templateFile = $this->templateDirectyory.DS.str_ireplace('/',DS,$nameTemplate);
        if(file_exists($templateFile)){
            $this->template = $templateFile;
        }

        return $this;
    }

    /**
     * @return string
     */
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