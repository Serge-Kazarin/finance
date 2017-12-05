<?php

use app\Auth;
use app\Router;

require( 'lib/autoload.php' );

Auth::session_start();

define('DB_CONNECTION', 'mysql:host=localhost;dbname=finance');
define('DB_USER', 'otkzstat');
define('DB_PASS', 'qroCYV!9');

Router::go();



?>

