<?php

use app\Auth;
use app\Config;
use app\Log;
use app\Router;

require( 'lib/autoload.php' );

Config::init();
Auth::init();
Log::init();

Router::run();

?>

