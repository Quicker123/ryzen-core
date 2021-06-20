<?php

namespace app\core\exception;

/**
 * @author razoo.choudhary@gmail.com
 * Class NotFoundException
 * @package app\core\exception
 */

class NotFoundException extends \Exception
{
    protected $message ="Page Not Found";
    protected $code = 404;
}