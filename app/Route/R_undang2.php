<?php

namespace App\Route;

class R_undang2
{
    public function __construct($app)
    {

        $app->get('/', 'App\Controller\C_undang2::index');

        $app->get('/id/{id}', 'App\Controller\C_undang2::id');

        $app->get('/sample', 'App\Controller\C_undang2::withdb');

        $app->get('/sampleqb', 'App\Controller\C_undang2::withqb');
    }
}
