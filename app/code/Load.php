<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 14:09
 */

class Load{

    public static function run()
    {
        $load = new self;

        define('CODE_DIR',BASE_DIR.DS.'app'.DS.'code');

        $load->getAllClass(CODE_DIR);

        define('BASE_URL',$load->getBaseUrl());
        new Controllers_Actions();

    }

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