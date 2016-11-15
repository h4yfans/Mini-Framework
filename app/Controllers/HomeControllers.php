<?php
/**
 * Created by PhpStorm.
 * User: Kaan
 * Date: 11/15/2016
 * Time: 2:12 PM
 */
namespace App\Controllers;

class HomeController
{

    public function index($response)
    {
        echo $response->setBody('Home');
    }
}