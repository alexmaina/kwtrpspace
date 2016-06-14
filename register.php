<!--/*****************************************************************************
/*Copyright (C) 2016 Alex Maina Mwangi
/*****************************************************************************
(KWTRPSPACE Version 1.0), is Manuscript management information system
designed to manage manuscripts from conception to publication in peer-reviewed journals.
This program is free software; you can redistribute it and/or modify it under the terms
of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program;
if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA or 
check for license.txt at the root folder
/*****************************************************************************
For any details please feel free to contact me at afroscholar@users.sourceforge.net
Or for snail mail. P. O. Box 71044,Nairobi-00610, East Africa-Kenya.
/*****************************************************************************/-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>registration form</title>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="main.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="validation.js"></script>

<?php
function UserRegistration(){
include "data.php";

$con = dbConnect();
if(isset($_POST['action']) && $_POST['action'] == 'register'){
	if(empty($_POST['username']) && empty($_POST['password'])){
		registrationForm();
		?> <div class ="authenticate"> <br> <?php print("both username and password must be filled");?> </div><?php
	}
	elseif(empty($_POST['username'])){
		registrationForm();
 		?> <div class ="authenticate"> <br> <?php print("username cannot be left empty");?> </div><?php
	}
	elseif(empty($_POST['password'])){
		registrationForm();
 		?> <div class ="authenticate"> <br> <?php die("password cannot be left empty");?> </div><?php
	}
if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = urlencode($_POST["username"]);
	$password = md5($_POST['password'] . 'ijdb');
	//
	$query = "select count(*) from user where username = '$username' and password = '$password' limit 1";
		$sql = $con->prepare($query);
		$sql->execute();
		$row = $sql->fetchColumn();
		if ($row > 0){
			registrationForm();
			?> <div class ="authenticate"> <br> <?php print("The username $username already exists");?> </div><?php	
		}
		else{
		$username = urlencode($_POST["username"]);
		$password = md5($_POST['password'] . 'ijdb');
		$query = "insert into user (username, password) values (:username, :password)";
		$sql=$con->prepare($query);
		$sql->bindValue(':username', $username, PDO::PARAM_STR);
		$sql->bindValue(':password', $password, PDO::PARAM_STR);
		$sql->execute();
		registrationForm();
		?> <div class ="authenticate"> <br> <?php print ('you have successfully registered as a user. Click here <a href = "index.php">login</a>');?> </div><?php	
		}
}

//echo 'yes';
}
else{
registrationForm();
?> <div class ="authenticate"> <br> <?php print ('Please enter a username and password to register');?> </div><?php	
}
}
function registrationForm(){
?>
<!DOCTYPE html>
KEMRI-Wellcome Trust Research Programme Library<br>
	<div class ="authenticate">
		KWTRPSPACE<p>
		<form action = "" method = "post">
		<input type = "text" name = "username" placeholder = "kwtrpspace username"><p>
		<input type = "text" style = "display:none">
		<input type = "password" style = "display:none">
		<input type = "password" name = "password" placeholder = "password"><p>
		<div class = "inner"><input type="submit" name="action" value="register"><p></div>
		
		</form>
	</div>

</html>
<?php
}

UserRegistration();
?>

</html>
