<?php

/*****************************************************************************
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
/*****************************************************************************/

//include "data.php";
//include $_SERVER['DOCUMENT_ROOT'] . '/kwtrpspace90/data.php';
include 'data.php';
//function to display abstracts
function get_abstract(){

$manuscript_id = $_GET['manuscript_id'];

$con = dbConnect();
	$sql = $con->prepare("SELECT * FROM manuscript WHERE manuscript_id = $manuscript_id");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		


	while ($row = $sql->fetch()){ 
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$manuscript_link = $row['manuscript_link'];
				$scc_number = $row['scc_number'];
				$centre = $row['centre'];
				$Research_programme = $row['research_programme'];
				$strategic_area = $row['strategic_area'];
				$mdg = $row['mdg'];
				$journal = $row ['journal'];
				$date_of_circulation = $row['date_of_circulation'];
				//$pubmed_link = $row ['pubmed_link'];
				//$pmid = $row ['pmid'];
				//$pmcid = $row ['pmcid'];
				$abstract = $row ['abstract'];
				$abstract = utf8_encode($abstract);
				$abstract = ($abstract);
				$keywords = $row['keywords'];
				//$pubcom_submission_date = $row['pubcom_submission_date'];
				//$date_approved = $row['date_approved'];
				//$approved=$row['approved'];


//////////////////////////////////////////////////////////////////////////////////////////

/*if($pubcom_submission_date != '0000-00-00' && !empty($pubcom_submission_date) && $approved==1){
//echo "yesu";
}*/
if($year==2016 && $approved==''){

//<echo ('<a href="index.php?page=addletters&manuscript_id=' . $manuscript_id . '">' . 'add correspondence' . '</a><p>');
echo ('<a href="index.php?page=manuscriptapproval&manuscript_id=' . $manuscript_id . '">' . 'Review manuscript' . '</a><p>');
}
/*else{
echo ('<a href="index.php?page=update&manuscript_id=' . $manuscript_id . '">' . 'Update manuscript' . '</a>' .'<br>');
echo ('<a href="index.php?page=addsupplementary">' . 'add supplementary files' . '</a>');
}*/

//echo "yesu";
?>

<font size="3" color="green">Abstract</font><br>
<?php
echo "$journal<br>";

echo "<h2>$title</h2>$author <br> <br> $abstract<p>" ;

print "<b>Keywords</b><br>";

echo "$keywords<p>";
print "<p><b>date of circulation</b><br>";
echo "$date_of_circulation<p>";
print "<p><b>SCC number</b><br>";
echo "$scc_number<p>";
print "<p><b>Centre</b><br>";
echo "$centre<p>";
print "<p><b>Research Programme</b><br>";
echo "$Research_programme<p>";
print "<b>Strategic area</b><br>";
echo "$strategic_area<p>";
print "<b>Millenium development goal</b><br>";
echo "$mdg<p>";
/*print "<b>Pubcom submission date</b><br>";
echo "$pubcom_submission_date<p>";*/
print "<b>manuscript fulltext</b><br>";

echo ('<a href = "'.$manuscript_link.'"><img src="/images/word.png"/></a><p>');

?>
<font size="3" color="#A75E14">Supplementary materials</font><br>
<?php
supplementary();
?>




<!--<p><font size="3" color="#A75E14">PubCom correspondence</font><br>-->

<?php
/*correspondence();
if($authors_reply=0){
//echo "maina";
}*/

/////////////////////////////////////////////////////////////////////////////////////////////

}
}

//function to search manuscripts either by author, title or subject

function get_manuscript(){
if(isset($_GET['search']) && !empty($_GET['search']) && $_GET['choice'] == 'title'){
		
		$searchquery = $_GET['search'];
		$searchquery = explode(' ', $searchquery);
		$i=0;
		$query = "SELECT * FROM old_manuscript WHERE ";
		//print_r($searchquery);
		foreach($searchquery as $term){
			$i++;
			if($i == 1){
				$query .= "title LIKE '%$term%'ORDER By manuscript_id DESC ";
			}
			else{
				$query .= "OR title LIKE '%$term%' ORDER By manuscript_id DESC";
			}
		}

//connect
		$con = dbConnect();
		$query = $con->prepare($query);
		$query->execute();
		$results = $query->rowCount();
			if($results > 0){
				echo "$results <br>";
			}
			while ($row = $query->fetch()){
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
		
		
		$pubcom_submission_date = $row['pubcom_submission_date'];
				$date_approved = $row['date_approved'];
				$approved = $row['approved'];
if($approved==1){
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . '<font size="3" color="green">date approved:</font>' . $date_approved . "\r\n"  ."</br>" . "</br>";




}
		elseif(!empty($pubcom_submission_date) && $pubcom_submission_date !="0000-00-00"){
		echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n"  ."</br>" . "</br>";

}

else{
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n" ."</br>" . "</br>";
}
}
			
	}

	
		elseif(isset($_GET['search']) && !empty($_GET['search']) && $_GET['choice'] == 'author'){
			
		$searchquery = $_GET['search'];
		
		$query = "SELECT * FROM manuscript INNER JOIN author_manuscript ON manuscript.manuscript_id = author_manuscript.manuscript_id WHERE medline_name LIKE '%$searchquery%' order by manuscript.manuscript_id desc";
		$con = dbConnect();
		$query = $con->prepare($query);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$results = $query->rowCount();
			if($results >0){
				echo "$results Manuscripts found for author $searchquery <br>";
			}
			else{
				echo "No manuscript found for author $searchquery <br>";
			}
			$x=1;
			while ($row = $query->fetch()){
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
				$date_approved = $row['date_approved'];
				$approved = $row['approved'];
if($approved==1){
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . '<font size="3" color="green">date approved:</font>' . $date_approved . "\r\n"  ."</br>" . "</br>";




}
		elseif(!empty($pubcom_submission_date) && $pubcom_submission_date !="0000-00-00"){
		echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n"  ."</br>" . "</br>";

}

else{
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n" ."</br>" . "</br>";
}
			}
				//echo "jesu";
		}

	elseif(isset($_GET['search']) && !empty($_GET['search']) && $_GET['choice'] == 'scc'){
			$searchquery = $_GET['search'];
			$query="SELECT * FROM manuscript WHERE scc_number = $searchquery ORDER BY manuscript_id DESC";
			$con=dbConnect();
			$query=$con->prepare($query);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$results = $query->rowCount();
			if($results >0){
				echo "$results Manuscripts found for SCC number $searchquery <br>";
			}
			else{
				echo "No manuscript found for SCC number $searchquery <br>";
			}
			$x=1;
			while ($row = $query->fetch()){
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
				$date_approved = $row['date_approved'];
				$approved = $row['approved'];
if($approved==1){
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . '<font size="3" color="green">date approved:</font>' . $date_approved . "\r\n"  ."</br>" . "</br>";




}
		elseif(!empty($pubcom_submission_date) && $pubcom_submission_date !="0000-00-00"){
		echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n"  . '<font size="3" color="green">Pubcom submission date:</font>' . $pubcom_submission_date . "\r\n"  ."</br>" . "</br>";

}

else{
echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" .  $month . "&nbsp" . $year . "\r\n" ."<br>". '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n" ."</br>" . "</br>";
}			

	}
//

	}
	
	 else{
		$time1 = date('F');
		$time2 = date('Y');
		echo "<h4>Manuscripts in circulation in $time1 $time2</h4>";?></p>
		<?php //
		include "currentnews.php";
			//include "home.php";
		//include $_SERVER['DOCUMENT_ROOT'] . '/kwtrpspace90/currentnews.php';
	}
}

function updatemanuscript(){
//get_abstract();
	//read about global variables coz i believe i should not be defining this $manuscript_id a million times.
	$manuscript_id = $_GET['manuscript_id'];
	$con = dbConnect();
	$sql = $con->prepare("select * from manuscript where manuscript_id = $manuscript_id");
	$sql->execute();
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	//$result = $sql->fetchAll();
	//print_r($result);

	$savedauthors = $result["authors"];
	$savedtitle = $result["title"];
	$savedmonth = $result["month"];
	$savedyear = $result["year"];
	$savedabstract = $result["abstract"];
	$savedkeywords = $result["keywords"];
	$savedate_of_circulation = $result["date_of_circulation"];
	$savedjournal = $result["journal"];
 	$savedscc_number = $result["scc_number"];
	$savedcentre = $result["centre"];
	$savedresearchprogramme = $result["research_programme"];
	$savedstrategicarea = $result["strategic_area"];
	$savedmdg = $result["mdg"];
	$savedpubcom_submission_date = $result["pubcom_submission_date"];
	$savedapproved = $result["approved"];
	$saveddate_approved = $result["date_approved"];

if(isset($_POST['submit'])){
	$journal = $_POST['journal'];
	$sccnumber = $_POST['scc_number'];
	$centre = $_POST['centre'];
	$researchprogramme = $_POST['research_programme'];
	$strategicarea = $_POST['strategic_area'];
	$mdg = $_POST['mdg'];
	$pubcom_submission_date = $_POST['pubcom_submission_date'];
	

	$con = dbConnect();
	$sql = $con->prepare("update manuscript set journal = :journal, scc_number = :scc_number, centre = :centre, research_programme = :research_programme, strategic_area = :strategic_area, mdg = :mdg, pubcom_submission_date = :pubcom_submission_date where manuscript_id = $manuscript_id"); 
//echo "noma";
	
	//$sql=$con->prepare("update manuscript set approved = :approved, date_approved = :date_approved where manuscript_id = $manuscript_id");


	$sql->bindValue(':journal', $journal, PDO::PARAM_STR);
	$sql->bindValue(':scc_number', $sccnumber, PDO::PARAM_STR);//echo "hapa";
	$sql->bindValue(':centre', $centre, PDO::PARAM_STR);
	$sql->bindValue(':research_programme', $researchprogramme, PDO::PARAM_STR);
	$sql->bindValue(':strategic_area', $strategicarea, PDO::PARAM_STR);
	$sql->bindValue(':mdg',$mdg , PDO::PARAM_STR);
	$sql->bindValue(':pubcom_submission_date', $pubcom_submission_date, PDO::PARAM_STR);
	
	$sql->execute();

echo $centre;
echo $researchprogramme;
//header ('Location: .');
//exit();

}//end if update manuscript form is submitted
else{
echo "jesus";

?>

<html>

	<form name="update" action="" method="post"enctype="multipart/form-data" >
		Authors: <textarea class="scrollabletextbox" > <?php echo $savedauthors; ?></textarea><p><br>
		Title: <textarea class="scrollabletextbox" ><?php echo $savedtitle; ?></textarea><p>
		Month: <td><input type="text" name="month"  value="<?php echo $savedmonth; ?>" size = "10" maxlength = "10" style = "display:inline" /><p>
		year:  <td><input type="text" name="year"  value="<?php echo $savedyear; ?>" size = "10" maxlength = "10" style = "display:inline" /><p>
		Abstract: <textarea class="scrollabletextbox" > <?php echo $savedabstract; ?></textarea><p>
		
		Keywords:  <td><input type="text" name="keywords"  value="<?php echo $savedkeywords; ?>" size = "50" maxlength = "4000" style = "display:inline" /><p>
		Date of circulation: <td><input type="text" name="date_of_circulation"  value="<?php echo $savedate_of_circulation; ?>" size = "10" maxlength = "10" style = "display:inline" /><p>
		Journal: <td><input type="text" name="journal"  value="<?php echo $savedjournal; ?>" size = "40" maxlength = "60" style = "display:inline" /><p>
		SCC Number: <td><input type="text" name="scc_number"  value="<?php echo $savedscc_number; ?>" size = "10" maxlength = "10" style = "display:inline" /><p>
		Centre: <td><input type="text" name="centre"  value="<?php echo $savedcentre; ?>" size = "10" maxlength = "10" style = "display:inline" /><p>
		Research Programme: <td><input type="text" name="research_programme"  value="<?php echo $savedresearchprogramme; ?>" size = "50" maxlength = "80" style = "display:inline" /><p>
		Strategic Area: <td><input type="text" name="strategic_area"  value="<?php echo $savedstrategicarea; ?> " size = "50" maxlength = "80"  style = "display:inline" /><p>
		MDG: <td><input type="text" name="mdg"  value="<?php echo $savedmdg; ?>" size = "50" maxlength = "50"  style = "display:inline" /><p>
		PubCom submission date: <input type="text" name="pubcom_submission_date" value="<?php echo $savedpubcom_submission_date; ?>" style = "display:inline" id="datepicker" ></p>
		
		<input name = "submit" type = "submit" value = "Update manuscript" style = "display:inline">
		
	</form>

</html>
<?php


}//

}

//function add manuscript
function addmanuscript(){
if(!isset($_POST['add'])){form();}
if(isset($_POST['add'])){
	$authors = $_POST["authors"];
	$title = $_POST["title"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$abstract = $_POST["abstract"];
	$keywords = $_POST["keywords"];
	$journal = $_POST["journal"];
	$department = $_POST["department"];
	$research_programme = $_POST["research_programme"];
	$strategic_area = $_POST["strategic_area"];
	$mdg = $_POST["mdg"];
	$date_of_circulation = $_POST["date_of_circulation"];
	//echo "hello";

	//include "data.php";
	$con=dbConnect();
		$query="SELECT * FROM manuscript WHERE title = :title";
		$sql=$con->prepare($query);
		$sql->execute(array('title'=>$title));
		$result=$sql->rowCount($sql);
	if($result==1){
		echo "title already exists";
		form();
	}

	elseif($result==0){
		//echo "you can go ahead and add a record ";
		//print_r($_FILES);
		define('MAX_FILE_SIZE','5000000');
		define('DIR','/var/www/manuscripts/');
		$filename=$_FILES['manuscript']['name'];
		$newfilename=str_replace(' ', '_', $filename);
		$fileext = substr($newfilename, -4);
		$tmp_filename=$_FILES['manuscript']['tmp_name'];
		$fileerror=$_FILES['manuscript']['error'];
		$filesize=$_FILES['manuscript']['size'];
		$manuscript_link='/manuscripts/'.$newfilename;
		$max=number_format(MAX_FILE_SIZE/1024, 1).'KB';
		$sizeok=0;


		if($filesize >0 && $filesize <= MAX_FILE_SIZE){
			$sizeok=1;
		}
		$filetype=$_FILES['manuscript']['type'];
		$allowedtypes=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/pdf','application/msword','application/vnd.ms-excel');
		$typeok=0;
			foreach($allowedtypes as $allowed){
				if($allowed == $filetype || $fileext == ".pdf"){
					$typeok=1;
					}
			}
					

				if($typeok && $sizeok){
					$success = move_uploaded_file($tmp_filename, DIR.$newfilename);
						if($success){
						//
						$query="insert into manuscript(authors,title,month,year,abstract,keywords,date_of_circulation,manuscript_link) values (:authors,:title,:month,:year,:abstract,:keywords,:date_of_circulation,:manuscript_link)";
						$sql=$con->prepare($query);


						$sql->bindValue(':authors', $authors, PDO::PARAM_STR);
						$sql->bindValue(':title',$title, PDO::PARAM_STR);
						$sql->bindValue(':month', $month, PDO::PARAM_STR);
						$sql->bindValue(':year', $year, PDO::PARAM_STR);
						$sql->bindValue(':abstract',$abstract, PDO::PARAM_STR);
						$sql->bindValue(':keywords',$keywords, PDO::PARAM_STR);
						$sql->bindValue(':date_of_circulation', $date_of_circulation, PDO::PARAM_STR);
						$sql->bindValue(':manuscript_link', $manuscript_link, PDO::PARAM_STR);
						$sql->execute();
						echo "successful upload22<br>";
						//include "addsupp1.php";
						updateAuthorManuscript();
						
						echo '<font size="3" color="green"><a href ="index.php?page=addsupplementary">Add supplementary files</a></font> &nbsp <a href=""> no supplementary files to add</a><br><p>';
						getfirstrecord();
						}
						elseif($fileerror == 2){
							echo "$newfilename exceeds $max size <br>";
							}
						elseif($fileerror == 4){
							echo "no file was uploaded. Please select file<br>";
							}
						elseif(!$typeok){
							echo "$newfilename with $fileext extension not allowed<br>";
							}

						}
				}	


	}

/*else{
form();
}*/
//addsupp();
	
}
///////////////////////////////////////////////////////////////////////

function form(){
//echo "jesu";
?>

<!DOCTYPE HTML>
	<form action="" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return ValidateForm()">
	<input type="hidden"name="MAX_FILE_SIZE" value="50000000">
	Upload Manuscript: <input type ="file" name ="manuscript" style = "display:inline"><p>
	Authors: <input name ="authors" type = "test" size = "55" maxlength = "4000" style = "display:inline"><br>
	(Kazungu, S.T., Thoya, T.)<p>
	Title: <input name ="title" type = "text" size = "58" maxlength = "4000" style = "display:inline"><p>
	Month: <select name="month">
			<option value="">-select month-</option>
			<option value="January">January</option>
			<option value="February">February</option>
	  		<option value="March">March</option><p>
			<option value="April">April</option><p>
			<option value="May">May</option><p>
			<option value="June">June</option><p>
			<option value="July">July</option><p>
			<option value="August">August</option><p>
			<option value="September">September</option><p>
			<option value="October">October</option><p>
			<option value="November">November</option><p>
			<option value="December">December</option><p>
		</select><p>
	Year:	<select name ="year">
			<option value = ""> -select year-</option>
			<option value = "2015"> 2015 </option>
			<option value = "2016"> 2016 </option>
			<option value = "2017"> 2017 </option>
		</select><p>
	Abstract: <textarea class="scrollabletextbox" name="abstract"></textarea><p>
	Keywords: <input name ="keywords" type = "text" size = "50" maxlength = "4000" style = "display:inline"><p>
	Journal: <input name ="journal" type = "text" size = "50" maxlength = "4000" style = "display:inline"><p>
	Department:<input name ="department" type = "text" size = "50" maxlength = "4000" style = "display:inline"><p>
	Research Programme:<input name ="research_programme" type = "text" size = "40" maxlength = "4000" style = "display:inline"><p>
	Strategic area: <input name ="strategic_area" type = "text" size = "40" maxlength = "4000" style = "display:inline"><p>
	Millenium development goal: <input name ="mdg" type = "text" size = "40" maxlength = "4000" style = "display:inline"><p>
	Date of circulation:<input name="date_of_circulation" input type="text" id="datepicker" style = "display:inline"></p>
	<input type="submit" name ="add" value = "submit">

</form>
</html>
<?php
}

//function logout
function logout(){
session_start();
unset($_SESSION['LoggedIn']);
header('Location: .');

}

//function correspondence
function correspondence(){
$manuscript_id = $_GET['manuscript_id'];
$con = dbConnect();
$sql = $con->prepare("SELECT * FROM test.manuscript inner join correspondence on manuscript.manuscript_id = correspondence.manuscript_id WHERE manuscript.manuscript_id = $manuscript_id order by correspondence_date desc");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch()){ 
		$authors_reply = $row['authors_reply'];
		$correspondence_date = $row ['correspondence_date'];
		$url = $row['url'];
echo ('<a href = "'.$url.'"> '.$correspondence_date.'</a><br>');			

}


}


//function supplementary
function supplementary(){
$manuscript_id = $_GET['manuscript_id'];
$con = dbConnect();
$sql = $con->prepare("SELECT * FROM test.manuscript inner join supplementary on manuscript.manuscript_id = supplementary.manuscript_id WHERE manuscript.manuscript_id = $manuscript_id");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch()){ 
		$name = $row ['name'];
		$url = $row ['url'];
echo ('<a href = "'.$url.'"> '.$name.'</a><br>');			
}
}

//function get approved
function approved(){
$con = dbConnect();
$sql = $con->prepare("SELECT * FROM old_manuscript where approved =1 order by manuscript_id desc");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
		$x=1;		
			while ($row = $sql->fetch()){//three
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
				$date_approved = $row['date_approved'];
		
		echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="grey">date of circulation:</font>' . $date_of_circulation ."\t" . "&nbsp" .'<font size="3" color="grey">pubcom submission date:</font>' . $pubcom_submission_date . "\t" . "&nbsp" .'<font size="3" color="grey">date approved:</font>' . $date_approved ."\r\n" . "</br>" . "</br>";

		}

}

//function submitted to pubcom
function SubmittedPubcom(){
$con = dbConnect();

$sql = $con->prepare("SELECT * FROM old_manuscript where pubcom_submission_date  !=0000-00-00 && (approved = 0 || approved is null) order by pubcom_submission_date desc");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
		$x=1;		
			while ($row = $sql->fetch()){//three
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
		
		
		echo $x++;
		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . '<font size="3" color="green">pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . "</br>" . "</br>";

		}


}

//..................//
function getfirstrecord(){

//include "data.php";
$manuscript_id = $_GET['manuscript_id'];
//echo "here";
$query="SELECT * FROM manuscript ORDER BY manuscript_id DESC LIMIT 1";
$con=dbConnect();
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
		


	while ($row = $sql->fetch()){ 
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];

				echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . 					"\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of 					circulation:</font>' . $date_of_circulation . "\r\n" . "</br>" . "</br>";
				echo $manuscript_id;
	}

}

//*************************//
function addsupp(){
$manuscript_id = $_GET['manuscript_id'];
$query="SELECT * FROM manuscript ORDER BY manuscript_id DESC LIMIT 1";
$con=dbConnect();
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
		


	while ($row = $sql->fetch()){ 
				$manuscript_id = $row ['manuscript_id'];
				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];

echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n" . "</br>" . "</br>";
echo $manuscript_id;
}

?>
<!DOCTYPE HTML>
Add supplementary files<p>

<form action ="" method ="post" enctype ="multipart/form-data">
<input type ="hidden" name ="MAX_FILE_SIZE" value ="60000000">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]">
<input type ="file" name ="supplementary[]"><p>
<input type ="submit" name ="upload" value ="Upload">
</form>
</html>
	
<?php
	if(isset($_POST['upload'])){
?>
<pre>
<?php
		print_r($_FILES);

?>
</pre>
<?php			
			define('MAX_FILE_SIZE','60000000');
			define('DIR','/var/www/Supplementary/');
			$tmpname = $_FILES['supplementary']['tmp_name'];
			$filesize = $_FILES['supplementary']['size'];
			$fileerror = $_FILES['supplementary']['error'];
			$myfiles = $_FILES['supplementary']['name'];
			$max = number_format(MAX_FILE_SIZE/1024, 1).'KB';
			
			
			
			
			$sizeok = 0;
			foreach($myfiles as $i => $filename){
				$newfilename = str_replace(' ', '_', $filename);
				$name = $newfilename;
				$url = '/Supplentary/'.$name;
				$fileext = substr($newfilename, -4);
					if($filesize[$i] > 0 && $filesize[$i] <= MAX_FILE_SIZE){
						$sizeok = 1;
						echo "no";
					}

				$filetypes = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword','application/pdf','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.presentationml.presentation', 'image/png');
				$filetype = $_FILES['supplementary']['type'][$i];
				$typeok = 0;
					foreach($filetypes as $allowedtype){
						if($allowedtype == $filetype || $fileext = ".pdf" || $fileext = ".png" || $fileext = ".pptx"){
							$typeok = 1;
							
						}
					}
					if($typeok && $sizeok){
						$success = move_uploaded_file($tmpname[$i], DIR.$newfilename);
							if($success){
								echo "$manuscript_id successful upload <br>";
								$query="INSERT INTO supplementary (manuscript_id, name, url) VALUES (:manuscript_id, :name, :url)";
								$sql=$con->prepare($query);
								$sql->bindValue(':manuscript_id',$manuscript_id,PDO::PARAM_INT);
								$sql->bindValue(':name',$name,PDO::PARAM_STR);
								$sql->bindValue(':url',$url,PDO::PARAM_STR);
								$sql->execute();
//
							}		
					}

					elseif($fileerror[$i] == 2){
						echo "$newfilename exceeds $max size <br>";
					}
					elseif($fileerror[$i] == 4){
						echo "$manuscript_id no file was uploaded. Please select file<br>";
					}
					elseif(!$typeok){
						echo "$newfilename with $fileext extension not allowed<br>";
					}
			}
	}
//print_r($_FILES['supplementary']['name'][0]); 
}

//add correspondence
function addCorrespondence(){
$manuscript_id=$_GET['manuscript_id'];
//echo $manuscript_id;
if(isset($_POST['submit'])){
	
	
	if(!empty($_POST['letter'])){
		if($_POST['letter']=="no"){
			$authors_reply=0;
			//echo $authors_reply;
		}
		elseif($_POST['letter']=="yes"){
			$authors_reply=1;
			//echo $authors_reply;

		}
	}
	else{
		echo "Please select where the correspondence is coming from<br>";
	}	
	
		$manuscript_id=$_GET['manuscript_id'];
		$correspondence_date=$_POST['correspondence_date'];
		//$authors_reply=$_POST['letter'];
		$code=$_POST['code'];
		$forward_date=$_POST['forward_date'];
		define('MAX_FILE_SIZE','3000000');
		define('DIR','/var/www/correspondence/');
		$filename=$_FILES['correspondence']['name'];
		$newfilename=str_replace(' ','_', $filename);
		$tmp_filename=$_FILES['correspondence']['tmp_name'];
		$fileext=substr($newfilename, -4);
		$url='/correspondence/'.$newfilename;
		$fileerror=$_FILES['correspondence']['error'];
		$filesize=$_FILES['correspondence']['size'];
		$max=number_format(MAX_FILE_SIZE/1024, 1).'KB';
		$sizeok=0;
		
			if($filesize>0 && $filesize<=MAX_FILE_SIZE){
				$sizeok=1;
			}
		$filetype=$_FILES['correspondence']['type'];
		$allowedtypes=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword');
		$typeok=0;
			foreach($allowedtypes as $allowed){
				if($allowed==$filetype || $fileext =='.pdf'){
					$typeok=1;
				}
			}
		if($sizeok && $typeok){
			$success = move_uploaded_file($tmp_filename, DIR.$newfilename);
			if($success){
				
				$query="insert into correspondence(manuscript_id,correspondence_date,authors_reply,code,forward_date,pubcom_meeting_number,date_dispatched,url) values(:manuscript_id,:correspondence_date,:authors_reply,:code,:forward_date,:pubcom_meeting_number,:date_dispatched,:url)";
				$con=dbConnect();
				$query=$con->prepare($query);//echo "vaa";
				$query->bindValue(':manuscript_id', $manuscript_id, PDO::PARAM_INT);
				$query->bindValue(':correspondence_date', $correspondence_date, PDO::PARAM_STR);
				$query->bindValue(':authors_reply', $authors_reply, PDO::PARAM_INT);
				$query->bindValue(':code', $code, PDO::PARAM_STR);
				$query->bindValue(':forward_date', $forward_date, PDO::PARAM_STR);
				$query->bindValue(':pubcom_meeting_number', $pubcom_meeting_number, PDO::PARAM_STR);
				$query->bindValue(':date_dispatched', $date_dispatched, PDO::PARAM_STR);
				$query->bindValue(':url', $url, PDO::PARAM_STR);
				$query->execute();
				//var_dump($query);
				echo "successful upload<br>";
				//approveManuscript();
				

				
			}
			elseif($fileerror == 2){
				echo "$newfilename exceeds $max size <br>";
			}
			elseif($fileerror == 4){
				echo "no file was uploaded. Please select file<br>";
			}
			elseif(!$typeok){
				echo "$newfilename with $fileext extension not allowed<br>";
			}

		}session_start();

?><pre><?php
//print_r($_FILES);
?></pre><?php
}
//approveManuscript();	

?>
<!DOCTYPE HTML>

<form name="correspondence" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="">
	add letter:<input type="file" name="correspondence" style="display:inline" ><p>
	KEMRI PubCom<input type="radio" name="letter" value="no" style="display:inline">
	Author<input type="radio" name="letter" value="yes" style="display:inline"><p>
	Correspondence date<input type="text" name="correspondence_date" id="datepicker2" style="display:inline"><p>
	code<input type="text" name="code" style="display:inline"><p>
	forward date<input type="text" name="forward_date" id="datepicker3" style="display:inline"><p>
	pubcom meeting number<input type="text" name="pubcom_meeting_number" style="display:inline"><p>
	date dispatched<input type="text" name="date_dispatched" id="datepicker4" style="display:inline"><p>
	
	<input type="submit" name="submit" value="Submit">
</form>
</html>
<?php


}
///////////////////////////////
function noResponcePubcom(){

$con=dbConnect();

$query="SELECT manuscript.manuscript_id as manuscript_id, manuscript.authors, manuscript.month, manuscript.title, manuscript.year, manuscript.journal, manuscript.date_of_circulation, manuscript.pubcom_submission_date FROM test.manuscript left outer join test.correspondence on test.manuscript.manuscript_id = test.correspondence.manuscript_id where test.correspondence.manuscript_id is null and manuscript.pubcom_submission_date != '0000-00-00' and manuscript.pubcom_submission_date is not null order by test.manuscript.manuscript_id desc";
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
//$result=$sql->fetchAll();
//print_r($result);
		$x=1;		
			while ($row = $sql->fetch()){
				$manuscript_id = $row ['manuscript_id'];

				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				//$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
		
		
		echo $x++;

		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . '<font size="3" color="green">pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . "</br>" . "</br>";

		}

}
//////////////////////////////////////////
function getSubmittedToPubcomList(){

$con=dbConnect();
//$query="select * from manuscript where month(pubcom_submission_date) = month(now()) order by manuscript_id desc";
$query = "select * from manuscript where month = 'April' and year = 2016";
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
//$result=$sql->fetchAll();
//print_r($result);
$x=1;		
			while ($row = $sql->fetch()){
				$manuscript_id = $row ['manuscript_id'];

				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				$pubcom_submission_date = $row['pubcom_submission_date'];
		
		
		echo $x++;

		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . '<font size="3" color="green">pubcom submission date:</font>' . $pubcom_submission_date . "\r\n" . "</br>" . "</br>";

		}

}

//
function updateAuthorManuscript(){
$con=dbConnect();
$sql = $con->prepare('select manuscript_id,authors from manuscript order by manuscript_id desc limit 1');
$sql->execute();
$sql->SetFetchMode(PDO::FETCH_ASSOC);

while ($row=$sql->fetch()){
	$id= $row['manuscript_id'];
	$author = $row['authors'];
	$data = explode("., ",$author);

		foreach ($data as $name){
			list ($name1, $name2) = explode(', ',$name);
			$namex = str_replace('.', '', $name2);
			$initials = rtrim($namex, '.');
			$initialsx = ltrim($initials);
			//echo $name1 . ' ' . $initialsx;
			$medline_name = $name1 . ' ' . $initialsx;;
			$stm = $con->prepare("insert into author_manuscript (manuscript_id,surname,initials,name,medline_name) values (:id, :name1, :initials,:name,:medline_name)");
			
		   $stm->bindValue(':id', $id, PDO::PARAM_INT);
		   $stm->bindValue(':name1', $name1, PDO::PARAM_STR);
		   $stm->bindValue(':initials', $initialsx, PDO::PARAM_STR);
		   $stm->bindValue(':name', $name, PDO::PARAM_STR);
		   $stm->bindValue(':medline_name', $medline_name, PDO::PARAM_STR);
			
			$stm->execute();
			}

}
}
//



//
function approveManuscript(){
$id=true;
$manuscript_id=$_GET['manuscript_id'];
//
$con = dbConnect();
$query = "select * from user where id = :id";
$sql = $con->prepare($query);
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$row = $sql->fetch();
$userid = $row['id'];

//echo "maina";
//echo "$userid<br>";
//$userid = $_GET['userid'];
		//echo "$manuscript_id<br>";
if(isset($_POST['submit'])){
	if(!empty($_POST['approved'])){
		if($_POST['approved']=="no"){
			$approved=0;
			echo "$approved pale";
		}
		elseif($_POST['approved']=="yes"){
			$approved=1;
			echo "$approved hapa";

		}
	}
	else{
		echo "Please indicate if manuscript has been approved or not by selecting one of the options below<br>";
	}
//include "data.php";
		$userid = $row['id'];
		$manuscript_id = "true";
		//$approved=$_POST['approved'];
		$userid = $userid;
		$manuscript_id = $_GET['manuscript_id'];
		$comment = $_POST['comment'];
		$approved = $approved;
		$date=$_POST['date'];
		//$query="Update manuscript set comments =:comments,approved=:approved,date_approved=:date_approved where manuscript_id =$manuscript_id";
		$query = "insert into reviewers_comments(userid,manuscript_id,comment,approved,date) values(:userid,:manuscript_id,:comment,:approved,:date)";
		$con=dbConnect();
				$query=$con->prepare($query);//echo "vaa";
				$query->bindValue(':userid', $userid, PDO::PARAM_INT);
				$query->bindValue(':manuscript_id', $manuscript_id, PDO::PARAM_INT);
				$query->bindValue(':comment', $comment, PDO::PARAM_STR);
				$query->bindValue(':approved', $approved, PDO::PARAM_INT);
				$query->bindValue(':date', $date, PDO::PARAM_STR);
				$query->execute();

}

//echo "success";
?>	
<!DOCTYPE HTML>
<form action="" method="post" onsubmit="return ValidateForm()">

	Reviewers comments:<textarea class="scrollabletextbox" name="comment"></textarea><p>
	approved:<input type="radio" name="approved" value="yes" style="display:inline">
	notapproved<input type="radio" name="approved" value="no" style="display:inline" ><br><p>
	Date: <input type="text" name="date"  style = "display:inline" id="datepicker"></p>
<input type="submit" name="submit" value="Submit">
</form>
</html>
<?php
}

//
function get2015(){

$con=dbConnect();

$query = "select * from manuscript where year = 2015 order by date_of_circulation desc";
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
//$result=$sql->fetchAll();
//print_r($result);
$x=1;		
			while ($row = $sql->fetch()){
				$manuscript_id = $row ['manuscript_id'];

				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				//$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				//$pubcom_submission_date = $row['pubcom_submission_date'];
		
		
		echo $x++;

		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation . "\r\n" . "</br>" . "</br>";

		}

}

//************************************//
function get2016(){

$con=dbConnect();

$query = "select * from manuscript where year = 2016 order by date_of_circulation desc";
$sql=$con->prepare($query);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
//$result=$sql->fetchAll();
//print_r($result);
$x=1;		
			while ($row = $sql->fetch()){
				$manuscript_id = $row ['manuscript_id'];

				$author = $row ['authors'];
				$month = $row ['month'];
				$year = $row ['year'];
				$title = $row['title'];
				$journal = $row ['journal'];
				//$pubmed_link = $row ['pubmed_link'];
				$date_of_circulation = $row['date_of_circulation'];
				//$pubcom_submission_date = $row['pubcom_submission_date'];
		
		
		echo $x++;

		echo "<input type = 'checkbox' id='list' value='list' style = 'display:inline'>";
		echo ('<a href="index.php?page=abstract&manuscript_id=' . $manuscript_id . '">' . $title . '</a>') . "</br>" . "\r\n" . $author . "</br>" . "\r\n" . "<u>" . $journal . "</u>" . "&nbsp" . $month . "\r\n" . "&nbsp" . $year .  "\r\n" . "<br>" . '<font size="3" color="green">date of circulation:</font>' . $date_of_circulation  . "\r\n" . "</br>" . "</br>";

		}

}
//********************************//
function UserLogin(){

$con = dbConnect();

if (isset($_POST['action']) && $_POST['action'] == 'login'){
if(!empty($_POST["username"]) && !empty($_POST["password"])) {
	$username = urlencode($_POST["username"]);
	$password = md5($_POST['password'] . 'ijdb');
			$query = "select count(*) from user where username = '$username' and password = '$password' limit 1";
			$sql = $con->prepare($query);
			$sql->execute();
			$row = $sql->fetchColumn();
//
				if ($row == 1){
					$_SESSION['LoggedIn'] = 1;
					//$username = $result['username'];
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
					$_SESSION['clientname'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
					//*****
					//$roleid = $_SESSION['roleid'];
					$ip = $_SESSION['ip'];
					$clientname = $_SESSION['clientname'];
					$query = "insert into clients(ip, clientname) values (:ip, :clientname)";
					$sql=$con->prepare($query);
					$sql->bindValue(':ip', $ip, PDO::PARAM_STR);
					$sql->bindValue(':clientname', $clientname, PDO::PARAM_STR);
					$sql->execute();
					header('Location: index.php');
					}
				else{
					logonForm(); ?> <div class ="authenticate"> <br> <?php die('Please enter the correct username and Password');?> </div><?php
				}	
}
else{
 logonForm(); ?> <div class ="authenticate"> <br> <?php die('Both username and password must be filled');?> </div>
<?php
}
}
else{
logonForm();
?> <div class ="authenticate"> <br> <?php print ('Not yet registered as a user? <a href = "register.php">Register here</a>');?> </div><?php
							
}
}
//
function logonForm(){
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
		<div class = "inner"><input type="submit" name="action" value="login"></div>
		
		
		</form>
	</div>

</html>
<?php
}

/*********************************************/
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
		?> <div class ="authenticate"> <br> <?php print ('you have successfully registered as a user. Click here <a href = "login3.php">login</a>');?> </div><?php	
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

?>
