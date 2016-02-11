<?php 
require('../_include/header.php');
if(isset($_SESSION)){
	session_destroy();
}

if($connection) {
	mysql_free_result();
	mysql_close($connection);
}

die("You have been successfully logged out.<br /><a href='$site'>Home</a>");

?>