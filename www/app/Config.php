<?
namespace app;

class Config
{
	public static function init()
	{
		define('DB_CONNECTION', 'mysql:host=localhost;dbname=finance');
		define('DB_USER', 'otkzstat');
		define('DB_PASS', 'qroCYV!9');
		define('LOG_PATH', '/../logger.log');
	}
}

?>