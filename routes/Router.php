<?php

namespace Route;

require_once 'helpers/helpers.php';

class Router 
{

    /**
     * Undocumented variable
     *
     * @var [Request]
     */
    public $request;

   /**
    * Undocumented variable
    *
    * @var [Response]
    */
    public $response;

    protected $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
        
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
        
    }

    public function resolve()
    {
        $path = $this->request->getPath();

        $method = $this->request->getMethod();
      
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {

            Application::$app->response->setStatusCode(404);

            return $this->renderError('404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request);

    }

    public function renderView($view, $params = [])
    {
       
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{ content }}', $viewContent, $layoutContent);

    }

    public function renderError($view)
    {
        
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyError($view);

        return str_replace('{{ content }}', $viewContent, $layoutContent);

    }

    protected function layoutContent()
    {
        ob_start();
        require_once Application::$ROOT_DIR ."/resources/views/layouts/app.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    { 
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        require_once Application::$ROOT_DIR ."/resources/views/$view.php";
        return ob_get_clean();
    }

    protected function renderOnlyError($view)
    {
   
        ob_start();
        require_once Application::$ROOT_DIR ."/resources/views/errors/$view.php";
        return ob_get_clean();
    }
}