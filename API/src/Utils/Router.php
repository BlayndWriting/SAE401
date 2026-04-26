<?php

namespace SAE401\BikestoresApi\Utils;

/**
 * Handles API route registration and request dispatching.
 */
class Router {

    /**
     * Registered route definitions.
     *
     * @var array<int, array{method: string, path: string, callback: callable}>
     */
    private array $routes = [];

    /**
     * Registers a route.
     *
     * @param string   $method   HTTP method.
     * @param string   $path     Route path pattern.
     * @param callable $callback Route handler callback.
     *
     * @return void
     */
    public function add(string $method, string $path, callable $callback){
        $this->routes[] = [
            "method" => strtoupper($method),
            "path" => $path,
            "callback" => $callback
        ];
    }

    /**
     * Resolves the current request against registered routes and executes the matching callback.
     *
     * @return void
     */
    public function run(){

        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = strtoupper($_SERVER["REQUEST_METHOD"]);

        // Automatically detect the base directory.
        $basePath = dirname($_SERVER["SCRIPT_NAME"]);
        if ($basePath !== "/" && str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        foreach($this->routes as $route){

            if($route["method"] !== $method){
                continue;
            }

            // Convert /brands/{id} to a regex pattern.
            $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([0-9]+)', $route["path"]);
            $pattern = "#^".$pattern."$#";

            if(preg_match($pattern, $uri, $matches)){

                array_shift($matches);

                call_user_func_array($route["callback"], $matches);
                return;
            }
        }

        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(["error"=>"Route not found"], JSON_PRETTY_PRINT);
    }
}