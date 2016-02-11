<?php session_start();
include('config.php');

$sid = SID; //Session ID #
$authenticated = $_SESSION['CAS'];
if(!($_SESSION['user'])) {
//send user to CAS login if not authenticated
	if (!$authenticated) {
  		$_SESSION['CAS'] = true;
  		header("Location: https://cas.iu.edu/cas/login?cassvc=IU&casurl=".$site."");
 		exit;
}

if ($authenticated==true) {

  //validate since authenticated
  if (isset($_GET["casticket"])) {
	//set up validation URL to ask CAS if ticket is good
	$_url = 'https://cas.iu.edu/cas/validate';
	$cassvc = 'IU';  //search kb.indiana.edu for "cas application code" to determine code to use here in place of "appCode"
	$casurl = $site; //same base URLsent
	$params = "cassvc=$cassvc&casticket=$_GET[casticket]&casurl=$casurl";
	$Furl = "$_url?$params";
	
//CAS sending response on 2 lines.  First line contains "yes" or "no".  If "yes", second line contains username (otherwise, it is empty).
$casResponse=trim(strip_tags(file_get_contents($Furl)));

//split CAS answer into access and user
list($access, $user) = preg_split("/\s/", $casResponse, 2);

//set user and session variable if CAS says YES
if(!($access=="yes")) {
		echo "Sorry, but we are unable to verify your identity through IU's Central Authentication System.  Please contact University Information Technology Services through <a href='http://uits.iu.edu/'>this</a> website.";
		exit();
	}
		$user=trim($user);
		$access=trim($access);
        $_SESSION['user'] = $user;
		   
// Connect to MySQL Server
	$connection=mysql_connect($db, $mysqlUser, $mysqlPass);
	
		   if (!$connection) {
    			die('Could not connect: ' . mysql_error());
			}
			//echo 'Connected successfully';
			  
			  $dbQuery="SELECT * from bfl.user WHERE username='$user';";
			  
			  $result=mysql_query($dbQuery, $connection);
				
			  if(!$result){
				  die('No Results returned: '. mysql_error());
				  
			  }
			
			$data=mysql_fetch_assoc($result);
			
			if (!(empty($data))) {
				foreach($data as $x=> $y) {
					echo "".$x.": ".$y."<br />";
				}
			}
			else {
				die("User not found.");
			}
			
  	}
  mysql_close($connection);
  }

}
?>
