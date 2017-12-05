<?
namespace app;

class AR
{
	public static function get( $arr, $name, $default = '' )
	{
		if( isset($arr[$name]) ) return $arr[$name];
		
		return $default;
	}
}

?>