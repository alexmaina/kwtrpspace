<!--/*****************************************************************************
/*Copyright (C) 2016 Alex Maina Mwangi
/*****************************************************************************
(KWTRPSPACE Version 1.0), is Manuscript management information system
designed to manage manuscripts from conception to publication in peer-reviewed journals. 
This program is free software; you can redistribute it and/or modify it under the terms
of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License,
or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program;
If not, see <http://www.gnu.org/licenses/>.
/*****************************************************************************
For any details please feel free to contact me at afroscholar@users.sourceforge.net
Or for snail mail. P. O. Box 71044,Nairobi-00610, East Africa-Kenya.
/*****************************************************************************/-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>kwtrpspace</title>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="main.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="validation.js"></script>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


if (!isset($_SESSION['LoggedIn'])){
//include "login3.php";
include "functions.php";
UserLogin();
exit();

}

$ip = $_SESSION['ip'];
//
$_SESSION['LoggedIn'] = true;
$username = $_SESSION['username'];
//
//
?>
</head>

<body>

	<div id="header">
		<div id ="center">
		<p><h3>Manuscript Management Information System</h3></p>


		<form action = "" method = "get">
			<select name = "choice">
				<option value = "title" name = "title">title</option>
				<option value = "author" name = "author"> author</option>
				<option value = "scc" name = "scc"> SCC_NO</option>
			</select>
				<input name= "search" type ="text" value ="<?php echo $_GET['search'];?>" size="65" maxlength = "88" style = "display:inline">
				<input name = "mysearch" type="submit" value = "search" style = "display:inline">


		</form>

		</div>
	</div><p>

<div id="content-wrapper">
	<div id="content-main">

		<p></p> 

<?php
include "functions.php";


$con = dbConnect();
$query = "select roleid from user join userrole on user.id = userrole.userid where user.username = :username";
$sql = $con->prepare($query);
$sql->bindValue(':username', $username, PDO::PARAM_STR);
$sql->execute();
$row = $sql->fetch();
$roleid = $row['roleid'];

//	
function getUserRole($username,$roleid){
//
$con = dbConnect();
//
//$roleid = $_GET['roleid'];
$query="select * from user inner join userrole on user.id = userrole.userid inner join role on role.id = userrole.roleid where username = :username and roleid = :roleid";
$sql=$con->prepare($query);
	$sql->bindValue(':username',$username);
	$sql->bindValue(':roleid',$roleid);
	$sql->execute();
	$row = $sql->fetch();
		$username = $row['username'];
		$roleid = $row['roleid'];	
			if($row > 0){
					
				return  $roleid;
			}
			else{
				return false;
			}
}
//*************************//
$userhasrole = getUserRole($username, $roleid);
echo "Karibu $username <br>";
 

$page = $_GET['page'];
	if($page){
		
  		if($page=="abstract"){
   		get_abstract();
			}
		if($page=="logout"){
			logout();
			}
		if($page=="approved"){
			approved();
			}

		/*if($page=="addsupplementary"){
			addsupp();
			}*/

		if($page=="SubmittedPubcom"){
			SubmittedPubcom();
			}
		if($page=="addletters"){
			addCorrespondence();
			}
		if($page=="noResponcePubcom"){
			noResponcePubcom();
			}
		if($page=="CscList"){
			getSubmittedToPubcomList();
			}
		if($page=="get2015"){
			get2015();
			}
		if($page=="get2016"){
			get2016();
			}
		if($page=="registeruser"){
			UserRegistration();
			}
//***********************************//
		if($userhasrole == 'administrator' && $page=="addmanuscript"){
			addmanuscript();
			}
		elseif($userhasrole == 'administrator' && $page=="addsupplementary"){
			addsupp();	
			}
		elseif($userhasrole == 'administrator' && $page=="update"){
			updatemanuscript();	
			}
		elseif($userhasrole == 'reviewer' && $page=="manuscriptapproval"){
			approveManuscript();
			}
		else{
			print ("Sorry! You dont have permissions to view this page");
			}
			
	}				
else{
get_manuscript();
}
?>
<p>
	<p>
	</div>
	<div id="content-secondary">
		 Welcome:<?php print $username;?></br>
		<!--<p>Your IP is:<?php print $ip;?></p>-->
		<a href="index.php?">Home</a><br>
		<a href="index.php?page=logout">Logout</a><br>
		<?php ?>
		<a href="index.php?page=addmanuscript">add manuscript</a><br>
		<a href="index.php?page=get2016">review manuscripts</a><p>
		Archive<br>
		<a href="index.php?page=get2016">2016</a><br>
		<a href="index.php?page=get2015">2015</a><br>
		<?php ?>
	</div>
</div>
<div id="sidebar">
<?php
if($page=="abstract"){
echo 'welcome';
}

else{
?>
	PUBCOM Reports<br>
   	<!-- <a href="">Recently published</a><p>--><?php
	 echo '<a href="index.php?page=approved">Approved for publication</a><br>';
	 echo '<a href="index.php?page=SubmittedPubcom">Submitted to PubCom</a><br>';
	echo '<a href="index.php?page=noResponcePubcom">No response from pubcom</a><br>';
	echo '<a href="index.php?page=CscList">Monthly report</a><br>';
	 echo '<a href="">Non-Open Access</a><br>';
}	
	
?>
</div>
<div id="footer"><p>KEMRI-Wellcome Trust Programme</p>

</div>
</body>
</html>
