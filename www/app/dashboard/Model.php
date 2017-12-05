<?
namespace app\dashboard;

use app\AR;
use app\Auth;
use Exception;
use PDO;
use const DB_CONNECTION;
use const DB_PASS;
use const DB_USER;

class Model
{
	protected static $conn = false;


	public static function getUser( $login, $password )
	{
		$hash = static::hash( $password );
		
		$data = static::doGetUser( $login );
		
		$dbLogin = AR::get( $data, 'Login' );
		$dbBalance = AR::get( $data, 'Balance' );
		$dbPass = AR::get( $data, 'Pass' );
		
		if(password_verify( $password, $dbPass) )
		{
			return 
			[
				'login' => $dbLogin,
				'balance' => $dbBalance
			];
		}
		
		return false;

	}
	
	public static function doGetUser( $login )
	{
		$conn = static::getConnection();
		$stmt = $conn->prepare( "SELECT Id, Login, Pass, Balance FROM O_User where Login=:Login" );
		$stmt->bindValue( 'Login', $login );
		$stmt->execute();
		$data = $stmt->fetch();
		
		return $data;
	}
	
	protected static function doExpend( $id, $balance, $amount )
	{
		$conn = static::getConnection();
		$newBalance = $balance-$amount;
		if( $newBalance >= 0 )
		{
			$stmt = $conn->prepare( "UPDATE O_User SET Balance=:Balance where Id=:Id" );
			$stmt->bindValue( 'Balance', $newBalance );
			$stmt->bindValue( 'Id', $id );
			$stmt->execute();
			
			return true;
		}
		
		return false;
	}
	

	public static function hash( $password )
	{
		$options = ['cost' => 12];
		$pHash = password_hash($password, PASSWORD_BCRYPT, $options);
		return $pHash;
	}
	
	
	
	public static function getConnection()
	{
		$user = DB_USER;
		$pass = DB_PASS;

		if( static::$conn === false )
		{
			static::$conn = new PDO(DB_CONNECTION, $user, $pass, array(PDO::ATTR_PERSISTENT => true) );
			static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			static::$conn->exec("set names utf8");
		}
		return static::$conn;
	}
	
	public function expend( $amount )
	{
		$conn = static::getConnection();
		$r = false;

		try
		{
			$conn->beginTransaction();
			
			$user = Auth::getUser();
			$login = AR::get( $user, 'login' );
			$data = static::doGetUser( $login );
			$id = AR::get( $data, 'Id' );

			$balance = AR::get( $data, 'Balance' );
			$balance = floatval($balance);

			$result = static::doExpend( $id, $balance, $amount );
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