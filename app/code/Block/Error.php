<?php

/**
 * Class Block_Error
 */
class Block_Error extends Block_Abstract{

    /**
     *
     */
    protected function _init()
    {
        $this->setTemplate('error');
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $html = "<ul>";
        foreach($this->getError() as $error)
        {
            $html .= '<li>'.$error.'</li>';
        }

        $html .= '</ul>';

        $this->unsetError();
        return $html;
    }

}