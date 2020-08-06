<?php

require_once __DIR__ ."/../vendor/autoload.php";

$app = new \Silex\Application();
$app["debug"] = true;

new \App\Route\R_undang2($app);
new \App\Route\R_errorHandler($app);
$app->run();