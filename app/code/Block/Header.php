<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 22:50
 */
class Block_Header extends Block_Abstract{

    protected function _init()
    {
        $this->setTemplate('html/header.phtml');
    }
}