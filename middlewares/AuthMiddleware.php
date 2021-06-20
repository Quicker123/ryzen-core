<?php

namespace ryzen\ryzen\middlewares;

use ryzen\ryzen\Application;
use ryzen\ryzen\exception\ForbiddenException;

/**
 * @author razoo.choudhary@gmail.com
 * Class AuthMiddleware
 * @package ryzen\ryzen\middlewares
 */

class AuthMiddleware extends BaseMiddleware
{

    public array $actions =[];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()){

            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){

                throw new ForbiddenException();
            }
        }
    }
}