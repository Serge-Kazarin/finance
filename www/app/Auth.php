<?
namespace app;

use app\dashboard\Model;

class Auth
{
	public static function getUser()
	{
		if( !static::isAuthorized() ) return false;
		
		return AR::get( $_SESSION, 'user' );
	}
	
	public static function isAuthorized()
	{
		if( isset($_SESSION['user']) ) return true;
		return false;
	}
	
	public static function login( $login, $pass )
	{
		$model = new Model();
		$user = $model->getUser( $login, $pass );
		
		if( $user )
		{
			$_SESSION['user'] = $user;
			return true;
		}
		
		return false;
	}
	
	public static function logout()
	{
		session_unset();
		session_destroy();
	}
	
	public static function session_start()
	{
		session_start();
	}
}

?>