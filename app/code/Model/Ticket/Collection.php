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

    public $data = array(
        'items' => array(),
        'sorting_tickets' => array(),
    );



    public function getItem($id)
    {
        return (isset($this->data['items'][$id])) ? $this->data['items'][$id] : null;
    }

    public function getItems()
    {
        return $this->data['items'];
    }

    public function saveItem($item)
    {
        $idItem = $item->getData('id');
        if(!$idItem){
            $idItem = $this->_getNewItemId($item);
        }
        $this->data['items'][$idItem] = $item;
        $this->save();
    }

    private function _getNewItemId($item)
    {
        if($this->data['items']){

            end($this->data['items']);
            $newItemId = key($this->data['items'])+1;
            reset($this->data['items']);
        }else{
            $newItemId = 1;
        }
        $item->setData('id',$newItemId);
        return $newItemId;
    }


}