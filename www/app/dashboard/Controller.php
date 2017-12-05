<?
namespace app\dashboard;

use app\AR;
use app\Auth;

class Controller
{
	public function index()
	{
		$view = new View();
		$userSession = Auth::getUser();
		
		$model = new Model();
		if( $userSession )
		{
			$login = AR::get( $userSession, 'login' );
			$userDb = Model::doGetUser( $login );
			$view->renderDashboard( $userDb );
		}
		else
		{
			$status = AR::get( $_GET, 'status' );
			$view->renderLogin( $status );
		}
	}
	
	public function expend()
	{	
		$amount = AR::get( $_POST, 'amount' );
		$amount = floatval($amount);
		$model = new Model();
		$result = $model->expend( $amount );
		
		$view = new View();
		$view->redirect( "/" );
	}
	
	public function login()
	{
		
		$login = AR::get( $_POST, 'login' );
		$pass = AR::get( $_POST, 'pass' );
		
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