<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 20:56
 */
class Block_Head extends Block_Abstract{

    protected function _init()
    {
        $this->setTemplate('html/head.phtml');
    }

    public function getJs()
    {
        return $this->getIncludeFile('js');
    }

    public function getCss()
    {
        return $this->getIncludeFile('css');
    }

    private function getIncludeFile($type)
    {
        $directory = BASE_DIR.DS.$type;
        $url = str_ireplace('index.php','',BASE_URL);
        $collectionFiles = array();

        if($openDir = opendir($directory))
        {
            while(false !== ($file = readdir($openDir))){
                if($file == '.' || $file == '..'){
                    continue;
                }
                $collectionFiles[] = $url.$type.'/'.$file;
            }
            closedir($openDir);
        }
        return $collectionFiles;
    }

}