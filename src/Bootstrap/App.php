<?php

namespace Phpmng\Bootstrap;
use Phpmng\File\File;
use Phpmng\Http\Request;
use Phpmng\Router\Route;
use Phpmng\Http\Response;
use Phpmng\Session\Session;
use Phpmng\Exceptions\Whoops;
use DevCoder\DotEnv;

class app{

    public static function run(){

        //Register php-dotenv library
        $absolutePathToEnvFile = File::path('.env');
        (new DotEnv($absolutePathToEnvFile))->load();

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

