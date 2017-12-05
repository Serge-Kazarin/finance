<?
namespace app;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/*
 * Tiny wrapper over Monolog lib
 */
class Log
{
	protected static $log = false;

	public static function init()
	{
		$root = $_SERVER['DOCUMENT_ROOT'];
		$path = $root.LOG_PATH;
		static::$log = new Logger('mylogger');
		static::$log->pushHandler(new StreamHandler( $path, Logger::INFO));
	}
	
	public static function i()
	{
		if( static::$log === false )
		{
			throw new Exception("Logger was not initialized");
		}
		return static::$log;
	}
	
}

?>