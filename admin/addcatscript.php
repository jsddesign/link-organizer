<?php
ob_start();
include 'header.php';

echo '<div id="data">';

if($_POST['submit']){

$categoryname = $_POST['categoryname'];
$slug = strtolower($categoryname);

$errormessage = "";

if(empty($categoryname)){
	$errormessage = "The form is not filled entirely.<br>Please go back and try again.";

} else {	
	$sql = "INSERT into categories (categoryname, slug) values ('$categoryname','$slug')";
	if (mysqli_query($conn, $sql)) {
		header ('Location: index.php');
	}else{
		$errormessage = "form submit failed.<br>Please go back and try again.";
	} 
}
if($errormessage != ""){
	echo "<div class='messageBox'>" . $errormessage . "</div></body></html>";
}
return false;
}


ob_end_flush();
?>