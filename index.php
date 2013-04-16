<?php
	
    session_start(); 
    //Get data from client and store into php variables
	require 'fars_connection.php';
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	//$username = 'kes51290';
	//$password = 'admin';
//Query that checks whether the username and password is in the db
$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

//This counts the number of rows in which the result returns. If there is a match there should only be one row returned. 
$count=mysql_num_rows($result);

if($count==1)
{

//The query that returns the users information also with the account type 
$query = "SELECT s.f_name, s.l_name, s.username, a.account_type
    FROM users s, accounts a
    WHERE s.username = '$username' AND s.account_type = a.act_id";
$result=mysql_query($query);
$user= mysql_fetch_assoc($result,MYSQL_ASSOC);

	if(!$user)
	{
		die('Could not get data:'.mysql_error());
	}

//This stores the user variable into the session global variable 
echo $_SESSION['userinfo'] = $user;

//This redirects the user to the member page
header("Location: Memberpage.php");
}
else {
//Displays an error message if the username and password aren't found in the db.
echo "Wrong Username or Password";
}
// Register $myusername, $mypassword and redirect to file "login_success.php"
//$_SESSION['username']=$username;


//Gather user data to display on the profile page
//$sql1 = "SELECT * FROM `users` WHERE username = '$username' ";
//echo "Welcome" . "<p>test</p> " .$username. $password;  

//echo json_encode(mysql_fetch_array($userinfo));
//mysql_close($con);
   
    //$arr = array('fnam' => $fname, 'lname' => $lname, 'gamertag' => $gamertag, 'email' => $email); 
   //echo json_encode($arr);
    //echo $fname . $lname;
?>
	
	