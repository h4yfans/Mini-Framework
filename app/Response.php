<?php
/**
 * Created by PhpStorm.
 * User: Kaan
 * Date: 11/15/2016
 * Time: 2:36 PM
 */

namespace App;

class Response
{
    protected $body;

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }
}