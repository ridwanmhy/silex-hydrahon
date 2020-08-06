<?php

namespace App\Route;

use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\Request;
use Exception;

class R_errorHandler
{
    public function __construct($app)
    {
        $app->error(function (Exception $e, Request $request, $code) {
            switch ($code) {
                case 404:
                    $message = 'The requested page on ' .$request->getPathInfo(). ' could not be found. ';
                    break;
                default:
                    $message = 'We are sorry, but something went terribly wrong.';
            }

            return new Response($message);
        });
    }
}
