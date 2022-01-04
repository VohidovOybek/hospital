<?php
use Warehouse\Application\Application;

require_once 'vendor/autoload.php';
$app = new Application();
$app->run();
//dump($app->telegram);
$GLOBALS['app'] = $app;
?>
