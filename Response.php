<?php

namespace app\core;

/**
 * @author razoo.choudhary@gmail.com
 * Class Response
 * @package app\core
 */

class Response
{
    public function setStatusCode(int $code){

        http_response_code($code);
    }

    public function redirect(string $string){

        header('Location:'.$string);
    }
}