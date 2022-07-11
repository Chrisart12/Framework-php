<?php

namespace Route;

require_once 'helpers/helpers.php';

class Application 
{
    /**
     * App Root directory
     *
     * @var [type]
     */
    public static $ROOT_DIR;

    /**
     * Undocumented variable
     *
     * @var [Router]
     */
    public $router;

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

    public static $app;

    public function __construct($rootPath)
    {

        self::$ROOT_DIR = $rootPath;

        self::$app = $this;

        $this->request = new Request();

        $this->response = new Response();
    
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
       echo $this->router->resolve();
    }
}