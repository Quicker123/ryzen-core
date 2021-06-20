<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * @author razoo.choudhary@gmail.com
 * Class Controller
 * @package app\core
 */

class Controller
{
    public string $layout = 'app';
    public string $action = '';

    /**
     * @var BaseMiddleware[]
     */

    protected array $middlewares = [];

    public function setLayout($layout){

        $this->layout = $layout;
    }
    public function render($view, $params = []){

        return Application::$app->view->renderView($view,$params);
    }
    public function redirect($url){

        return Application::$app->response->redirect($url);
    }

    public function registerMiddleware(BaseMiddleware $middleware){

        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}