<?php

namespace ryzen\ryzen\middlewares;

/**
 * @author razoo.choudhary@gmail.com
 * Class BaseMiddleware
 * @package ryzen\ryzen\middlewares
 */

abstract class BaseMiddleware
{
    abstract public function execute();
}