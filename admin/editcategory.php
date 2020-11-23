<?php
include 'header.php'; 
?>

<div class="container-fluid editform">

<div class='row groupheadline'>
<div class='col-md-8'><h3>Edit Category</h3></div></div>

<?php 

if($_POST['submit']){

$storeid = $_POST['storeid'];
$categoryname = $_POST['categoryname'];
$categoryslug = strtolower($categoryname);

if(empty($categoryname)){
	echo "The form is not filled entirely";
} else {	
	$sql = "UPDATE categories SET categoryname='$categoryname', slug='$categoryslug' WHERE id='$storeid'";
				
	if (mysqli_query($conn, $sql)) {
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}else{
		$statusMsg = "form submit failed, please try again. <a href='index.php'>Go Back</a><br><br>";
	}
}

echo $statusMsg;
return false;
}


$cid = $_GET["id"]; 
$linki = "SELECT * FROM categories WHERE id=".$cid;
$getlink = mysqli_query($conn, $linki);
$link = mysqli_fetch_assoc($getlink);
?>

<form action="editcategory.php" method="post" enctype="multipart/form-data">
<p><label for="answer">Category Name: </label><input type="text" name="categoryname" id="categoryname" value="<?php echo $link['categoryname']; ?>" /></p>
<input type="hidden" id="storeid" name="storeid" value="<?php echo $cid;?>">
<div class="formBtns"><input type="submit" name="submit" value="Submit"><input type="button" class="cancel" name="cancel" value="cancel"></div>
</form>

</div>

</div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
$('.cancel').click(function(){
	window.open('index.php', '_self');
});

});
</script>
