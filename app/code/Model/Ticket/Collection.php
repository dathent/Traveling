<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 13:48
 */

class Model_Ticket_Collection extends Model_Abstract
{

    protected $_modelName = 'ticket/collection';

    public $_data = array(
        'items' => array(),
        'sorting_tickets' => array(),
    );



    public function getItem($id)
    {
        return (isset($this->_data['items'][$id])) ? $this->_data['items'][$id] : null;
    }

    public function getItems()
    {
        return $this->_data['items'];
    }

    public function saveItem($item)
    {
        $idItem = $item->getData('id');
        if(!$idItem){
            $idItem = $this->_getNewItemId($item);
        }
        $this->_data['items'][$idItem] = $item;
        $this->save();
    }

    private function _getNewItemId($item)
    {
        if($this->_data['items']){

            end($this->_data['items']);
            $newItemId = key($this->_data['items'])+1;
            reset($this->_data['items']);
        }else{
            $newItemId = 1;
        }
        $item->setData('id',$newItemId);
        return $newItemId;
    }


}