<?php

namespace ryzen\ryzen\exception;

/**
 * @author razoo.choudhary@gmail.com
 * Class NotFoundException
 * @package ryzen\ryzen\exception
 */

class NotFoundException extends \Exception
{
    protected $message ="Page Not Found";
    protected $code = 404;
}