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

    public function __construct($rootPath)
    {

        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
    
        $this->router = new Router($this->request);
    }

    public function run()
    {
       echo $this->router->resolve();
    }
}