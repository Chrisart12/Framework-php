<?php 

namespace App\Http\Controllers;

use Route\Request;
use Route\Application;

class PostController extends Controller
{
    public function index()
    {
        $params = [
            'name' => 'Issifou'
        ];

        return $this->view('posts', compact('params'));
    }

    public function home()
    {
        $params = [
            'name' => 'Issifou'
        ];

        return $this->view('home', $params);
    }

    public function create(Request $request)
    {
        dd($request->getBody());
        Application::$app->request->getBody();
        return 'eeeeeee';
    }
}