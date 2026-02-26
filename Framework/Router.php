<?php

/**
 * Router Class
 */

namespace Framework;

use App\Controllers\ErrorController;
use ReflectionMethod;

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
        if (!str_contains($action, '@')) {
            throw new \InvalidArgumentException("Invalid route action: {$action}. Expected Controller@method.");
        }

        [$controller, $controllerMethod] = explode('@', $action, 2);

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
     * @return void
     */

    public function route($uri)
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);

        foreach ($this->routes as $route) {
            // Split the incoming URI into segments
            $uriSegments = explode('/', trim($uri, '/'));
            // Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            // Check if the number of segments match and the method matches
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method']) === $requestMethod) {

                $params = [];

                // Check each segment for dynamic parameters
                foreach ($routeSegments as $index => $segment) {
                    if (preg_match('/^{\w+}$/', $segment)) {
                        // Extract parameter name and value
                        $paramName = trim($segment, '{}');
                        $params[$paramName] = $uriSegments[$index];
                    } elseif ($segment !== $uriSegments[$index]) {
                        // If a static segment doesn't match, this route is not a match
                        continue 2; // Skip to the next route
                    }
                }
                // Extract controller and controllerMethod from the route
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instantiate the controller and call the method with parameters
                if (class_exists($controller) && method_exists($controller, $controllerMethod)) {
                    $controllerInstance = new $controller();

                    // Preserve backward compatibility for controllers that read route params from $_GET.
                    $_GET = array_merge($_GET, $params);

                    // Invoke methods safely by matching params by name when present.
                    $reflectionMethod = new ReflectionMethod($controllerInstance, $controllerMethod);
                    $args = [];

                    foreach ($reflectionMethod->getParameters() as $parameter) {
                        $paramName = $parameter->getName();

                        if (array_key_exists($paramName, $params)) {
                            $args[] = $params[$paramName];
                        } elseif ($parameter->isDefaultValueAvailable()) {
                            $args[] = $parameter->getDefaultValue();
                        } elseif ($parameter->allowsNull()) {
                            $args[] = null;
                        } else {
                            ErrorController::serverError("Missing required route parameter: {$paramName}");
                            return;
                        }
                    }

                    $reflectionMethod->invokeArgs($controllerInstance, $args);
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
