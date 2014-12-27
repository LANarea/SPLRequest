<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);

use LANarea;

require __DIR__ . DS . 'src' . DS . 'spl.class.php';

$config_file_path = __DIR__ . DS . 'spl.config.php';

$spl = new LANarea\SPLRequest($config_file_path);
echo $spl->buildLibrary($spl->config['libdir']);