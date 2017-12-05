<?
namespace app\dashboard;

use app\Arr;
use app\Auth;
use app\User;

class Controller
{
	public function index()
	{
		$userSession = Auth::getUser();
		
		if( $userSession )
		{
			$login = Arr::get( $userSession, 'login' );
			$userDb = User::getInfo( $login );
			View::renderDashboard( $userDb );
		}
		else
		{
			$status = Arr::get( $_GET, 'status' );
			View::renderLogin( $status );
		}
	}
	
	public function expend()
	{	
		$amount = Arr::get( $_POST, 'amount' );
		$amount = floatval($amount);
		$result = Model::expend( $amount );
		
		View::redirect( "/" );
	}
	
	public function login()
	{
		
		$login = Arr::get( $_POST, 'login' );
		$pass = Arr::get( $_POST, 'pass' );
		
		$login = strip_tags($login);
		$login = htmlspecialchars($login);
		
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		$result = Auth::login( $login, $pass );
		
		if( !$result ) View::redirect( "/?status=err" );
		else View::redirect( "/" );
	}
	
	public function logout()
	{
		Auth::logout();
		View::redirect('/');
	}
	
}

?>