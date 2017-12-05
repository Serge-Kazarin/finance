<?
namespace app;

use PDO;
use const DB_CONNECTION;
use const DB_PASS;
use const DB_USER;

class Database
{
	protected static $conn = false;
		
	public static function getConnection()
	{
		$user = DB_USER;
		$pass = DB_PASS;

		if( static::$conn === false )
		{
			static::$conn = new PDO(DB_CONNECTION, $user, $pass, array(PDO::ATTR_PERSISTENT => false) );
			static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			static::$conn->exec("set names utf8");
		}
		return static::$conn;
	}
}

?>