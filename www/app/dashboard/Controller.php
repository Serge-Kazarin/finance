<?
namespace app\dashboard;

use app\Arr;
use app\Auth;

class Controller
{
	public function index()
	{
		$view = new View();
		$userSession = Auth::getUser();
		
		if( $userSession )
		{
			$login = Arr::get( $userSession, 'login' );
			$userDb = Model::getUserInfo( $login );
			$view->renderDashboard( $userDb );
		}
		else
		{
			$status = Arr::get( $_GET, 'status' );
			$view->renderLogin( $status );
		}
	}
	
	public function expend()
	{	
		$amount = Arr::get( $_POST, 'amount' );
		$amount = floatval($amount);
		$result = Model::expend( $amount );
		
		$view = new View();
		$view->redirect( "/" );
	}
	
	public function login()
	{
		
		$login = Arr::get( $_POST, 'login' );
		$pass = Arr::get( $_POST, 'pass' );
		
		$result = Auth::login( $login, $pass );
		
		$view = new View();
		if( !$result ) $view->redirect( "/?status=err" );
		else $view->redirect( "/" );
	}
	
	public function logout()
	{
		Auth::logout();
		$view = new View();
		$view->redirect('/');
	}
	
}

?>