<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("COORDINATE_PRECISION", 6);

require_once 'App/AligentTest.php';
$app = new App\AligentTest();
$app->bootstrap();
