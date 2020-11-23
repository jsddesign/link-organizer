<?php
ob_start();
include 'header.php';

echo '<div id="data">';

if($_POST['submit']){

$targetDir = "../images/logos/";
$fileName = basename($_FILES["imfileup"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$companyname = $_POST['companyname'];
$location = $_POST['location'];
$category = $_POST['category'];
$url = $_POST['url'];
$linkedin = $_POST['linkedin'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];

$statusMsg = "";

//$temp = explode(".", $_FILES["imfileup"]["name"]);
//$fileName = round(microtime(true)) . '.' . end($temp);
$allowTypes = array('jpg','png','jpeg','gif');


if(in_array($fileType, $allowTypes)){
	if(move_uploaded_file($_FILES["imfileup"]["tmp_name"], $targetFilePath)){
		
		$sql = "INSERT into list 
		(category, logo, name, location, url, facebook, instagram, linkedin) values 
		('$category','$fileName','$companyname','$location','$url','$facebook','$instagram','$linkedin')";
		
		if (mysqli_query($conn, $sql)) {
			header ('Location: index.php');
		}else{
			$statusMsg = "form submit failed, please try again. <a href='index.php'>Go Back</a>";
		}	
	
	}else{
		$statusMsg = "Sorry, there was an error uploading your file. <a href='index.php'>Go Back</a>";
	}
}else{
	$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload. <a href="index.php">Go Back</a>';
}

echo $statusMsg . "</div></body></html>";
return false;
}


ob_end_flush();
?>