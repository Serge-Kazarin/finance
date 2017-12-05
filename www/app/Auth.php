<?
namespace app;

class Auth
{
	public static function getUser()
	{
		if( !static::isAuthorized() ) return false;
		
		return Arr::get( $_SESSION, 'user' );
	}
	
	public static function login( $login, $pass )
	{
		$user = static::checkUser( $login, $pass );
		
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
		session_write_close();
		
		Log::i()->info("User signed out");
	}
	
	public static function init()
	{
		session_start();
	}
	
	protected static function checkUser( $login, $password )
	{
		$data = User::getInfo( $login );
		
		$dbLogin = Arr::get( $data, 'Login' );
		$dbPass = Arr::get( $data, 'Pass' );
		
		if(password_verify( $password, $dbPass) )
		{
			return 
			[
				'login' => $dbLogin
			];
		}
		
		return false;

	}
	
	protected static function isAuthorized()
	{
		if( isset($_SESSION['user']) ) return true;
		return false;
	}
}

?>