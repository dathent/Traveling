<?php

class Block_Notsortingtickets extends Block_Abstract{

    public function _init()
    {
        $this->setTemplate('ticket/list.phtml');
    }

    public function getItems()
    {
        return $this->getModel('ticket/collection')->getItems();
    }
}