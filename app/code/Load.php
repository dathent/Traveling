<?php

/**
 * Class Load
 */
class Load{

    /**
     *
     */
    public static function run()
    {
        $load = new self;

        define('CODE_DIR',BASE_DIR.DS.'app'.DS.'code');

        include_once(CODE_DIR.DS.'Object.php');

        $load->getAllClass(CODE_DIR);

        define('BASE_URL',$load->getBaseUrl());

        session_start();

        new Controllers_Actions();

    }


    /**
     * @param $directory
     */
    private function getAllClass($directory)
    {
        if($openDir = opendir($directory))
        {
            while(false !== ($file = readdir($openDir))){
                if($file == '.' || $file == '..'){
                    continue;
                }
                if(is_file($directory.DS.$file) && $file != 'Load.php'){
                    include_once($directory.DS.$file);
                }
                if(is_dir($directory.DS.$file)){
                    $this->getAllClass($directory.DS.$file);
                }
            }
            closedir($openDir);
        }

    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        $baseUrl = mb_strtolower(str_ireplace('/','',stristr($_SERVER['SERVER_PROTOCOL'],'/',true))).'://'.$_SERVER['SERVER_NAME'];
        $skriptName = str_ireplace('/index.php','',$_SERVER['SCRIPT_NAME']);
        if($skriptName){
            $baseUrl = $baseUrl.$skriptName;
        }
        return $baseUrl.'/index.php';
    }




}