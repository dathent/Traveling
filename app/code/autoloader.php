<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 13:29
 */

function class_autoload($classname){

    $directoryClass = BASE_DIR.'/class/';

    $classFile = $directoryClass.str_ireplace('_','/',$classname).'/'.str_ireplace('_','',strrchr('_',$classname)).'php';

    if(is_file($classFile)){
        include_once($classFile);
    }

}
if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('class_autoload', true, true);
    } else {
        spl_autoload_register('class_autoload');
    }
} else {
    function __autoload($classname)
    {
        class_autoload($classname);
    }
}