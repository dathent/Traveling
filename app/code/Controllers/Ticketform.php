<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 22:55
 */

class Controllers_Ticketform extends Controllers_Abstract
{
    public function indexAction()
    {
        $this->setBlock('addticket','ticket_add_form')->toHtml();
    }

    public function addticketAction()
    {


    }

}