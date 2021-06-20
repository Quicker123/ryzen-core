<?php

namespace app\core\exception;

/**
 * @author razoo.choudhary@gmail.com
 * Class ForbiddenException
 * @package app\core\exception
 */

class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Access to page denied';
}