<?php

require_once __DIR__ ."/../vendor/autoload.php";

$app = new Silex\Application();
$app["debug"] = true;

$R_undang2 = require_once __DIR__ ."/../app/Route/R_undang2.php";
$R_undang2($app);

$app->run();