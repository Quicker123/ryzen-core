<?php

namespace app\core\middlewares;

/**
 * @author razoo.choudhary@gmail.com
 * Class BaseMiddleware
 * @package app\core\middlewares
 */

abstract class BaseMiddleware
{
    abstract public function execute();
}