<?php

/**
 * Class Model_Sorttickets
 */
class Model_Sorttickets extends Object_Abstract{


    /**
     * @var null
     */
    private $_modelCollection = null;


    /**
     * Sort tickets
     */
    public function sortTickets()
    {
        $collectionTickets = $this->getCollectionTickets();
        $arrayFrom = array();
        $arrayTo = array();
        $sortingTickets = array();

        foreach($collectionTickets as $ticket){
            $arrayFrom[$ticket->getData('from')] = $ticket;
            $arrayTo[$ticket->getData('to')] = $ticket;
        }

        $arrayDiffFrom = array_diff_key($arrayFrom,$arrayTo);

        $ticketStart = current($arrayDiffFrom);

        $sortingTickets[$ticketStart->getData('id')] = $ticketStart;

        for($i=1;$i < count($collectionTickets) ;$i++){

            $currentTicket = current($sortingTickets);
            if(!$nextPointTicket = $arrayFrom[$currentTicket->getData('to')]){
                break;
            }

            $sortingTickets[$nextPointTicket->getData('id')] = $nextPointTicket;
            next($sortingTickets);

        }

        reset($sortingTickets);

        if(count($collectionTickets) == count($sortingTickets)){

            $this->saveSortingTickets($sortingTickets);
            return true;
        }else{
            return false;
        }


    }

    /**
     * @return mixed
     */
    private function getCollectionTickets()
    {

        return $this->_getModelCollection()->getItems();
    }


    /**
     * @return Model_Ticket_Collection
     */
    private function _getModelCollection()
    {
        if(!$this->_modelCollection){
            $this->_modelCollection = $this->getModel('ticket/collection');
        }
        return $this->_modelCollection;
    }

    /**
     * @param $tikets
     */
    private function saveSortingTickets($tikets)
    {
        $this->_getModelCollection()->setData('sorting_tickets', $tikets)->save();
    }

}