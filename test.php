<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);

use LANarea\SPLRequest;

require __DIR__ . DS . 'src' . DS . 'spl.class.php';

$spl = new SPLRequest('0.0.0.0',0);

// Note: Might get rough with big folders...
echo '<pre>', var_dump($spl->getAllSongs()), '</pre>';