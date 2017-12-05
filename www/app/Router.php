<?php
namespace app;

use app\dashboard\Controller;

class Router
{
	public static function run()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$url = parse_url($uri);
		$path = Arr::get( $url, 'path' );
		$path = str_replace('/', '', $path);
		
		$controller = new Controller();
		
		if( empty($path) )
		{
			$controller->index();
		}
		elseif( $path == 'login' )
		{
			$controller->login();
		}
		elseif( $path == 'logout' )
		{
			$controller->logout();
		}
		elseif( $path == 'expend' )
		{
			$controller->expend();
		}
	}
	
}

?>