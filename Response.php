<?php

namespace ryzen\ryzen;

/**
 * @author razoo.choudhary@gmail.com
 * Class Response
 * @package ryzen\ryzen
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