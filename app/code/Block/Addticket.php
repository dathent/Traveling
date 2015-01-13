<?php

/**
 * Class Block_Addticket
 */
class Block_Addticket extends Block_Abstract{


    private $_modelTicket;

    /**
     *
     */
    protected function _init()
    {
        $this->setTemplate('ticket/add_form.phtml');
    }

    public function getTypeTransport()
    {
        return $this->_getModelTicket()->typeTransport;
    }

    public function getPropertiesTicket()
    {
        $propertiesTicket = $this->_getModelTicket()->propertiesItem;
        unset($propertiesTicket['id']);
        unset($propertiesTicket['time_create']);
        return $propertiesTicket;
    }

    private function _getModelTicket()
    {
        if(!$this->_modelTicket){
            $this->_modelTicket = $this->getModel('ticket/item');
        }
        return $this->_modelTicket;
    }


}