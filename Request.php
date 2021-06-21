<?php

namespace ryzen\ryzen;

/**
 * @author razoo.choudhary@gmail.com
 * Class Request
 * @package ryzen\ryzen
 */

class Request
{

    public function getPath(){

        $path =  $_SERVER['REQUEST_URI'] ?? '/';

        $position = strpos($path, '?');

        if( $position === false ){

            return $path;
        }

        return substr($path,0,$position);
    }

    public function method(){

        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){

        return $this->method() === 'get';
    }

    public function isPost(){

        return $this->method() === 'post';
    }

    public function getBody(){

        $body = [];

        if($this->method() === 'get'){

            foreach ($_GET as $key => $value){

                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post'){

            $body = $_POST;

            if(!isset($body['_csrf']) || $body['_csrf'] == "" || empty($body['_csrf']) || is_null($body['_csrf'])){

                echo "csrf_token missing or mismatched";
                exit;
            }

            foreach ($_POST as $key => $value){

                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}