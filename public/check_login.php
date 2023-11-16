<?php
session_start();
if( !isset($_SESSION['user_id']))
// if ($_SESSION['user_id']=="")
{
	// echo "not login";
	header("refresh: 0; url=login.php"); 
	session_write_close();
}

// else 
// {

//  $message=$_SESSION['staff_id']." ".$_SESSION['staff_name']." LOGIN";
// }

?>