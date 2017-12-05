<?
namespace app;

class User
{
	public static function getInfo( $login )
	{
		$conn = Database::getConnection();
		$stmt = $conn->prepare( "SELECT Id, Login, Pass, Balance FROM O_User where Login=:Login" );
		$stmt->bindValue( 'Login', $login );
		$stmt->execute();
		$data = $stmt->fetch();
		
		return $data;
	}
	
	public static function doExpend( $id, $balance, $amount )
	{
		$conn = Database::getConnection();
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
}

?>