<?php
error_reporting(0);
include 'header.php';
$id = $_POST['linkid'];
$sql = "DELETE FROM list WHERE id = '$id'";
	
if (mysqli_query($conn, $sql)) {
	header ('Location: ./');
} else {
	echo "There is a problem with this request, please try again.";
}
	
return false; //preventing resubmit

?>