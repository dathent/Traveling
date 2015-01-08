<?php

/**
 * Class Block_Sortingtickets
 */
class Block_Sortingtickets extends Block_Abstract{

    /**
     *
     */
    public function _init()
    {
        $this->setTemplate('ticket/list.phtml');
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->getModel('ticket/collection')->getData('sorting_tickets');
    }

}