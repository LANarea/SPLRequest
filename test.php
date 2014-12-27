<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS',DIRECTORY_SEPARATOR);


use StationPlaylist as SPL;

require __DIR__ . DS . 'spl.class.php';

$spl = new SPL\SplCollection();
echo $spl->buildLibrary($spl->config['libdir']);

// var_dump($spl);
// $spl->