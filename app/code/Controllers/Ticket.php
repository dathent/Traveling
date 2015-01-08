<?php

/**
 * Class Controllers_Ticket
 */
class Controllers_Ticket extends Controllers_Abstract
{
    /**
     *
     */
    public function indexAction()
    {
        $this->setBlock('addticket','ticket_add_form')->toHtml();
    }

    /**
     *
     */
    public function addticketAction()
    {
        if($ticketsProperty = $this->getPostData('tickets')){
            $this->getModel('ticket/collection')->unsetData()->save();
            $tickets = $this->_prepareTicketsProperty($ticketsProperty);
            foreach($tickets as $data){

                $this->getModel('ticket/item')->setData($data)->save();
            }
        }

        $this->getModel('sorttickets')->sortTickets();

        $this->setRedirect('ticket/sorted')->toHtml();
    }

    /**
     *
     */
    public function sortedAction()
    {
        $this->setBlock('sortingtickets','ticket_list')->toHtml();
    }

    /**
     *
     */
    public function notsortedAction()
    {
        $this->setBlock('notsortingtickets','ticket_list')->toHtml();
    }

    public function clearAction()
    {
        $this->getModel('ticket/collection')->unsetData();
        $this->setRedirect('ticket/notsorted')->toHtml();
    }




    /**
     * @param $ticketsProperty
     * @return array
     */
    private function _prepareTicketsProperty($ticketsProperty)
    {
        $tickets = array();
        foreach($ticketsProperty as $property => $arrayProperty){
            foreach($arrayProperty as $keyTicket => $value){
                $tickets[$keyTicket][$property] = $value;
            }
        }

        return $tickets;
    }



}