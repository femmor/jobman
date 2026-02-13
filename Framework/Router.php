<?php

/**
 * Router Class
 */

namespace Framework;

use App\Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Register a route
     * 
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function registerRoute($method, $uri, $action)
    {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * GET route
     *  
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * POST route
     *  
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * PUT route
     *  
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * DELETE route
     *  
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Get error message based on HTTP code
     * @param int $httpCode
     * @return string
     */
    protected function getErrorMessage($httpCode)
    {
        $messages = [
            404 => 'Resource not found',
            500 => 'An unexpected error occurred',
            403 => 'You are not authorized to access this resource'
        ];

        return $messages[$httpCode] ?? 'An error occurred';
    }


    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                // Extract controller and controllerMethod from the route
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instantiate the controller and call the method
                if (class_exists($controller) && method_exists($controller, $controllerMethod)) {
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod();
                } else {
                    ErrorController::serverError(); // Internal Server Error if controller or method not found
                }
                return;
            }
        }

        ErrorController::notFound();
        exit();
    }
}
