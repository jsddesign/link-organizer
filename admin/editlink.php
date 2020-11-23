<?php
include 'header.php'; 
?>

<div class="container-fluid editform">

<div class='row groupheadline'>
<div class='col-md-8'><h3>Edit Link</h3></div></div>

<?php 

if($_POST['submit']){

$storeid = $_POST['storeid'];
$companyname = $_POST['companyname'];
$location = $_POST['location'];
$category = $_POST['category'];
$url = $_POST['url'];
$linkedin = $_POST['linkedin'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];

$targetDir = "../images/logos/";
$fileN = basename($_FILES["imfileup"]["name"]);
if($fileN){
	$fileName = $fileN;
} else {
	$fileName = $_POST['storeimg'];
}

if(empty($companyname) || empty($category)){
	echo "The form is not filled entirely";
} else {
	$targetFilePath = $targetDir . $fileName;
		
	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	$allowTypes = array('jpg','png','jpeg','gif');
		
	if(in_array($fileType, $allowTypes)){
		
		if($fileN){
		if(move_uploaded_file($_FILES["imfileup"]["tmp_name"], $targetFilePath)){
				
			$sql = "UPDATE list SET 
			logo='$fileName',
			name='$companyname', 
			location='$location', 
			category='$category',
			url='$url',
			linkedin='$linkedin',
			facebook='$facebook', 
			instagram='$instagram' 
			WHERE id='$storeid'";
				
			if (mysqli_query($conn, $sql)) {
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			}else{
				$statusMsg = "form submit failed, please try again. <a href='index.php'>Go Back</a><br><br>";
			}
				
		}else{
			$statusMsg = "Sorry, there was an error uploading your file. <a href='index.php'>Go Back</a><br><br>";
		}
		}else{
			$sql = "UPDATE list SET 
			logo='$fileName',
			name='$companyname', 
			location='$location', 
			category='$category',
			url='$url',
			linkedin='$linkedin',
			facebook='$facebook', 
			instagram='$instagram' 
			WHERE id='$storeid'";
				
			if (mysqli_query($conn, $sql)) {
				//header ('Location: index.php');
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			}else{
				$statusMsg = "form submit failed, please try again. <a href='index.php'>Go Back</a><br><br>";
			}
		}
	}else{
		$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload. <a href="index.php">Go Back</a><br><br>';
	}

	
}

echo $statusMsg;
return false;
}


$lid = $_GET["id"]; 
$linki = "SELECT * FROM list WHERE id=".$lid;
$getlink = mysqli_query($conn, $linki);
$link = mysqli_fetch_assoc($getlink);
?>

<form action="editlink.php" method="post" enctype="multipart/form-data">
<p><label for="answer">Company logo: </label>
<input type='file' name="imfileup" id="imfileup" onchange="getLogoURL(this);" />
<img id="complogo" src="../images/logos/<?php echo $link['logo']; ?>" alt="Logo image" />
<input type="hidden" id="storeimg" name="storeimg" value="<?php echo $link['logo'];?>">
</p>
<p><label for="answer">Company Name: </label><input type="text" name="companyname" id="companyname" value="<?php echo $link['name']; ?>" /></p>

<?php

$locs = "SELECT * FROM location ORDER BY countrygroup"; 
$locati = mysqli_query($conn, $locs);
if(mysqli_num_rows($locati) > 0) {
	$loccontent = "<p><label for='answer'>Location: </label><select name='location' id='location'><option value=''> </option>";
	$cntrgrprev = "";
	while ($obj = mysqli_fetch_array($locati)) {
		$cntrgr = $obj['countrygroup'];
		$cntrgrU = strtoupper($cntrgr);
		$cntr = $obj['country'];
		$cntrid = $obj['id'];
		
		if($cntrgr != $cntrgrprev){
			$loccontent .= "<optgroup label='".$cntrgrU."...............'></optgroup>";
		}
		$loccontent .= "<option value='".$cntrid."'>".$cntr."</option>";
		
		$cntrgrprev = $cntrgr;
	}
	$loccontent .= "</select></p>";
	echo $loccontent;
}

$formcats = "SELECT * FROM categories ORDER BY id";
$formcatsq = mysqli_query($conn, $formcats);
if(mysqli_num_rows($formcatsq) > 0) {
	$catcont = "<p><label>Category: </label><select name='category' id='category'><option value=''> </option>";
	while ($obj = mysqli_fetch_array($formcatsq)) {
		$catid = $obj['id'];
		$catname = $obj['categoryname'];
		$catcont .= "<option value='".$catid."'>".$catname."</option>";
	}
	$catcont .= "</select></p>";
	echo $catcont;
}

?>

<p><label for="url">URL: </label><input type="text" name="url" id="url" value="<?php echo $link['url']; ?>" /></p>
<p><label for="url">Linkedin: </label><input type="text" name="linkedin" id="linkedin" value="<?php echo $link['linkedin']; ?>" /></p>
<p><label for="url">Facebook: </label><input type="text" name="facebook" id="facebook" value="<?php echo $link['facebook']; ?>" /></p>
<p><label for="url">Instagram: </label><input type="text" name="instagram" id="instagram" value="<?php echo $link['instagram']; ?>" /></p>
<input type="hidden" id="storeid" name="storeid" value="<?php echo $lid;?>">
<div class="formBtns"><input type="submit" name="submit" value="Submit"><input type="button" class="cancel" name="cancel" value="cancel"></div>
</form>

</div>

</div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

function getLogoURL(input) {
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#complogo').attr('src', e.target.result).width(120);
        };
		reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
$('#location').val('<?php echo $link['location'];?>');
$('#category').val('<?php echo $link['category'];?>');
$('.cancel').click(function(){
	window.open('index.php', '_self');
});

});
</script>