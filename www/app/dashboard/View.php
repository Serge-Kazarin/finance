<?
namespace app\dashboard;

use app\Arr;


class View
{
	protected static function renderHeader( $title = '' )
	{
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?></title>
    </head>
    <body>
<?
	}
	
	protected static function renderFooter()
	{
?>
			</body>
		</html>
<?
	}
	
	public static function renderLogin( $status = '')
	{
		static::renderHeader( 'Login' );
?>
		<h1>Please authorize</h1>
		<form action="/login" method="post">
			<input placeholder="Login" name="login"/><br/>
			<input placeholder="Password" name="pass" type="password"/><br/>
			<input type="submit" value="Submit"/>
		</form>
<?
		if( $status == 'err' )
		{
?>
		<div>Wrong username or password</div>
<?
		}
		static::renderFooter();
	}
	
	
	public static function renderDashboard( $user )
	{
		static::renderHeader( 'Dashboard' );
		
		$login = Arr::get( $user, 'Login' );
		$balance = Arr::get( $user, 'Balance' );
?>
		<div>
			<?= $login ?>,&nbsp;<strong><?=$balance?></strong>&nbsp;$
			<a href="/logout">Logout</a>
		</div>
		
		<form action="/expend" method="post">
			<input placeholder="Amount" name="amount"/><br/>
			<input type="submit" value="Expend"/>
		</form>
<?
		static::renderFooter();
	}
	
	
	public static function redirect( $url )
	{
		header("Location: $url");
		exit();
	}
}
?>