<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 22:51
 */

class Block_Footer extends Block_Abstract{

    protected function _init()
    {
        $this->setTemplate('html/footer.phtml');
    }
}