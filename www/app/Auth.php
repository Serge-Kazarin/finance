<?
namespace app;

use app\dashboard\Model;

class Auth
{
	public static function getUser()
	{
		if( !static::isAuthorized() ) return false;
		
		return Arr::get( $_SESSION, 'user' );
	}
	
	public static function isAuthorized()
	{
		if( isset($_SESSION['user']) ) return true;
		return false;
	}
	
	public static function login( $login, $pass )
	{
		$user = Model::getUser( $login, $pass );
		
		if( $user )
		{
			$_SESSION['user'] = $user;
			
			Log::i()->info("User signed in");
			
			return true;
		}
		
		return false;
	}
	
	public static function logout()
	{
		session_unset();
		session_destroy();
		
		Log::i()->info("User signed out");
	}
	
	public static function init()
	{
		session_start();
	}
}

?>