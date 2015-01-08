<?php

/**
 * Class Model_Ticket_Item
 */
class Model_Ticket_Item extends Model_Abstract{


    /**
     * @var array
     */
    public $_propertiesItem = array(
        'id' =>'identifier' ,
        'time_create' => 'Time create',
        'type_transport' => 'Type transport',
        'id_transport' => 'Number transport',
        'seat' => 'Seat',
        'from' => 'From',
        'to' => 'To',
        'gate' => 'Gate',
        'baggage_drop' => 'Baggage drop at ticket counter',
    );

    /**
     * @var array
     */
    public $_typeTransport = array(
        'train' => 'Train',
        'bus' => 'Bus',
        'airliner' => 'Airliner',
    );


    /**
     * @var string
     */
    protected $_modelName = 'item';

    /**
     * @var array
     */
    public $_data = array();

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @param $name
     * @param null $value
     * @return $this
     */
    public function setData($name, $value = null)
    {
        if(is_array($name)){
            foreach($name as $key => $_value){
                $this->_setData($key,$_value);
            }
        }else{
            $this->_setData($name,$value);
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    private function _setData($key,$value)
    {
        if(array_key_exists($key, $this->_propertiesItem)){
            if($key != 'type_transport'){
                parent::setData($key,$value);
            }elseif(array_key_exists($value, $this->_typeTransport)){
                parent::setData($key,$value);
            }
        }
    }


    /**
     * @param $id
     * @return $this
     */
    public function load($id)
    {
        $item = $this->getModelCollection()->getItem($id);
        if(is_object($item)){
            return $item;
        }else{
            return $this;
        }
    }

    /**
     * @return null
     */
    private function getModelCollection()
    {
        return $this->getModel('ticket/collection');
    }

    /**
     * @return $this
     */
    public function save()
    {
        $this->setData('time_create', date('Y-m-d H:mm:s',time()));
        $this->getModelCollection()->saveItem($this);
        return $this;
    }

    function __destruct()
    {

    }


}