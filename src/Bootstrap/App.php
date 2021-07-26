<?php

namespace Phpmng\Bootstrap;
use Phpmng\File\File;
use Phpmng\Http\Request;
use Phpmng\Router\Route;
use Phpmng\Cookie\Cookie;
use Phpmng\Http\Response;
use Phpmng\Session\Session;
use Phpmng\Exceptions\Whoops;

class app{

    public static function run(){

        // Register Whoops to handle erros
        Whoops::handle();

        // start session
        Session::start();


        # Handle the requests
        Request::handle();


        # Require all route files in route directory
        File::require_directory('routes');

        // Handle the routes
        $data = Route::handle();
        
  
        # Show the data returned by Route
        Response::output($data);


    }

}
