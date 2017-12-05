<?
namespace app\dashboard;

use app\Arr;
use app\Auth;
use app\Database;
use app\User;
use Exception;

class Model
{
	public static function expend( $amount )
	{
		$conn = Database::getConnection();
		$r = false;

		$user = Auth::getUser();
		$login = Arr::get( $user, 'login' );
			
		try
		{
			$conn->beginTransaction();
			
			
			$data = User::getInfo( $login );
			$id = Arr::get( $data, 'Id' );

			$balance = Arr::get( $data, 'Balance' );
			$balance = floatval($balance);

			$result = User::doExpend( $id, $balance, $amount );
			if( $result )
			{
				$conn->commit();
				$r = true;
			}
			else
			{
				$conn->rollback();
			}
		} 
		catch ( Exception $e )
		{
			$conn->rollback();
		}
		return $r;
	}

}

?>