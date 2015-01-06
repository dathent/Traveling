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
        self::getAllClass();
    }

    private function getAllClass()
    {
        chdir(BASE_DIR.'app/code/class/');
        foreach(glob('*.php') as $classFile)
        {
            if($classFile != 'Load.php'){
                include_once($classFile);
            }
        }
    }
}