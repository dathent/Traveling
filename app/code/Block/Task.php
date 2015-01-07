<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 07.01.2015
 * Time: 2:42
 */
class Block_Task extends Block_Abstract{

    public function _init()
    {
        $this->setTemplate('html/task.phtml');
    }
}