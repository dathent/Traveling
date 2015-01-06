<?php
/**
 * Created by PhpStorm.
 * User: Dmytryi
 * Date: 06.01.2015
 * Time: 13:25
 */

define('BASE_DIR',__DIR__);
define('DS', DIRECTORY_SEPARATOR);
include_once(BASE_DIR.DS.'app'.DS.'code'.DS.'class'.DS.'Load.php');

Load::run();