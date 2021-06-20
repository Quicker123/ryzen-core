<?php

namespace ryzen\ryzen;

use ryzen\ryzen\middlewares\BaseMiddleware;

/**
 * @author razoo.choudhary@gmail.com
 * Class Controller
 * @package ryzen\ryzen
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