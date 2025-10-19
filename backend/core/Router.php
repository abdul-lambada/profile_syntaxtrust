<?php
/**
 * Profile Syntaxtrust - Router Class
 * Handles URL routing and request dispatching
 */

class Router {
    private $routes = [];
    private $currentRoute;
    private $params = [];

    public function __construct() {
        $this->currentRoute = $this->getCurrentRoute();
    }

    public function add($method, $route, $controller, $action = 'index') {
        $route = preg_replace('/^\//', '', $route);
        $route = preg_replace('/\/$/', '', $route);
        $route = $route ?: '/';

        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get($route, $controller, $action = 'index') {
        $this->add('GET', $route, $controller, $action);
    }

    public function post($route, $controller, $action = 'index') {
        $this->add('POST', $route, $controller, $action);
    }

    public function put($route, $controller, $action = 'index') {
        $this->add('PUT', $route, $controller, $action);
    }

    public function delete($route, $controller, $action = 'index') {
        $this->add('DELETE', $route, $controller, $action);
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->getCurrentRoute();

        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $method, $uri)) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();

                    if (method_exists($controller, $actionName)) {
                        // Check CSRF token for POST/PUT/DELETE requests
                        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
                            if (!$this->validateCSRFToken()) {
                                $this->handleError(403, 'CSRF token validation failed');
                                return;
                            }
                        }

                        call_user_func_array([$controller, $actionName], $this->params);
                        return;
                    } else {
                        $this->handleError(404, 'Action not found: ' . $actionName);
                        return;
                    }
                } else {
                    $this->handleError(404, 'Controller not found: ' . $controllerName);
                    return;
                }
            }
        }

        $this->handleError(404, 'Route not found');
    }

    private function matchRoute($route, $method, $uri) {
        if ($route['method'] !== $method) {
            return false;
        }

        $routePattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $route['route']);
        $routePattern = str_replace('/', '\/', $routePattern);

        if (preg_match('/^' . $routePattern . '$/', $uri, $matches)) {
            array_shift($matches); // Remove full match

            // Extract parameter names from route
            preg_match_all('/\{([^}]+)\}/', $route['route'], $paramNames);
            $paramNames = $paramNames[1];

            // Combine parameter names with values
            $this->params = array_combine($paramNames, $matches);

            return true;
        }

        return false;
    }

    private function getCurrentRoute() {
        $uri = $_SERVER['REQUEST_URI'];

        // Remove query string
        $uri = explode('?', $uri)[0];

        // Remove base path if exists
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }

        // Remove leading slash
        $uri = ltrim($uri, '/');

        return $uri ?: '/';
    }

    private function validateCSRFToken() {
        if (!isset($_POST[CSRF_TOKEN_NAME])) {
            return false;
        }

        $token = $_POST[CSRF_TOKEN_NAME];

        if (isset($_SESSION[CSRF_TOKEN_NAME]) && $_SESSION[CSRF_TOKEN_NAME] === $token) {
            // Generate new token for next request
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
            return true;
        }

        return false;
    }

    private function handleError($code, $message) {
        http_response_code($code);

        // For API requests, return JSON
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            header('Content-Type: application/json');
            echo json_encode(['error' => true, 'message' => $message]);
        } else {
            // For web requests, show error page
            $data = ['error' => $message, 'code' => $code];
            extract($data);
            include 'app/views/errors/' . $code . '.php';
        }
    }

    // Utility method to generate CSRF token
    public static function generateCSRFToken() {
        if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
        }
        return $_SESSION[CSRF_TOKEN_NAME];
    }

    // Utility method to get CSRF token for forms
    public static function csrfField() {
        return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . self::generateCSRFToken() . '">';
    }
}
