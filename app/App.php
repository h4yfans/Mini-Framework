<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    protected $container;

    public function __construct()
    {
        $this->container = new Container([
            'router' => function () {
                return new Router;
            },
            'response' => function () {
                return new Response;
            }
        ]);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler);
    }

    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    public function map($uri, $handler, array $methods = ['GET'])
    {
        $this->container->router->addRoute($uri, $handler, $methods);
    }

    public function run()
    {
        $router = $this->container->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        try {
            $response = $router->getResponse();
        } catch (RouteNotFoundException $e) {
            if ($this->container->has('errorHandler')) {
                $response = $this->container->errorHandler;
            } else {
                return;
            }
        }

        return $this->respond($this->process($response));
    }

    protected function process($callable)
    {
        $response = $this->container->response;

        if (is_array($callable)) {
            if (!is_object($callable[0])) {
                $callable[0] = new $callable[0];
            }

            return call_user_func($callable, $response);
        }

        return $callable($response);
    }

    protected function respond($response)
    {
        if (!$response instanceof Response) {
            echo $response;
            return;
        }

        echo $response->getBody();
    }
}
