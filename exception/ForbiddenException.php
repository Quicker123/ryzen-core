<?php

namespace ryzen\ryzen\exception;

/**
 * @author razoo.choudhary@gmail.com
 * Class ForbiddenException
 * @package ryzen\ryzen\exception
 */

class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Access to page denied';
}