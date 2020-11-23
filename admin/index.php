<?php
include 'header.php'; 
?>


<div class="container-fluid">

<div class='row groupheadline'>
<div class='col-md-8'><h3>Categories</h3></div><div class='col-md-4 right'><div class='btn btnNewCat'>New</div></div></div>

<?php 

if(mysqli_num_rows($getcats) > 0) {
	$catContent = "<div class='categoryList list'>";
	while($row = mysqli_fetch_array($getcats)) {
		
		$catContent .= "<div class='categoryItem item' id='".$row["id"]."'><div class='row'><div class='col-md-8'>".$row["categoryname"]."</div>";
		$catContent .= "<div class='col-md-4 right'><div class='itembtn btnEditCat'>Edit</div></div></div></div>";
		
		
	}
	$catContent .= "</div>";
	echo $catContent;
} else {
	echo "There is no questions in this category";
}

 ?>
 
 
 

<div class='row groupheadline'><div class='col-md-8'><h3>Links</h3></h3></div><div class='col-md-4 right'><div class='btn btnNewLink'>New</div></div></div>

<?php 

if(mysqli_num_rows($getlinks) > 0) {
	$linkContent = "<div class='LinklistIndex'><div class='row'>";
	$linkContent .= "<div class='col-md-1'>Logo</div>";
	$linkContent .= "<div class='col-md-2'>Name</div>";
	$linkContent .= "<div class='col-md-1'>Location</div>";
	$linkContent .= "<div class='col-md-2'>Category</div>";
	$linkContent .= "<div class='col-md-1'>URL</div>";
	$linkContent .= "<div class='col-md-1'>Linkedin</div>";
	$linkContent .= "<div class='col-md-1'>Facebook</div>";
	$linkContent .= "<div class='col-md-1'>Instagram</div>";
	$linkContent .= "</div></div>";
	
	$linkContent .= "<div class='linksList list'>";
	while($row = mysqli_fetch_array($getlinks)) {
		
		$linkContent .= "<div class='linkItem item' id='".$row["id"]."'><div class='row'>";
		$linkContent .= "<div class='col-md-1'><img class='logo' src='../images/logos/".$row["logo"]."' /></div>";
		$linkContent .= "<div class='col-md-2'>".$row["name"]."</div>";
		$locnum = $row["location"];
		$locdb = "SELECT * FROM location WHERE id=".$locnum;
		$locations = mysqli_query($conn, $locdb);
		$location = mysqli_fetch_assoc($locations);
		$locationtitle = $location['country'];
		$linkContent .= "<div class='col-md-1'>".$locationtitle."</div>";
		
		$catid = $row["category"];
		$categorydb = "SELECT * FROM categories WHERE id=".$catid;
		$categorys = mysqli_query($conn, $categorydb);
		$categoryn = mysqli_fetch_assoc($categorys);
		$categoryname = $categoryn['categoryname'];
		
		$linkContent .= "<div class='col-md-2'>".$categoryname."</div>";
		$linkContent .= "<div class='col-md-1'>";
		if($row["url"]){
			$linkContent .= "<a href='".$row["url"]."' target='_blank'>URL</a>";
		}
		$linkContent .= "</div>";
		$linkContent .= "<div class='col-md-1'>";
		if($row["linkedin"]){
			$linkContent .= "<a href='".$row["linkedin"]."' target='_blank'>L - url</a>";
		}
		$linkContent .= "</div>";
		$linkContent .= "<div class='col-md-1'>";
		if($row["facebook"]){
			$linkContent .= "<a href='".$row["facebook"]."' target='_blank'>F - url</a>";
		}
		$linkContent .= "</div>";
		$linkContent .= "<div class='col-md-1'>";
		if($row["instagram"]){
			$linkContent .= "<a href='".$row["instagram"]."' target='_blank'>I - url</a>";
		}
		$linkContent .= "</div>";
		
		$linkContent .= "<div class='col-md-2 right'><div class='itembtn btnEditLink'>Edit</div><div class='itembtn btnDelete'>Delete</div></div></div></div>";
		
		
	}
	$linkContent .= "</div>";
	echo $linkContent;
} else {
	echo "There is no questions in this category";
}

 ?>

</div>
</div>

<div class="popup">
<div class="popupcontent">
<div class="popform formNewCategory">
<h3>Add new category</h3>
<form action="addcatscript.php" method="post" enctype="multipart/form-data">
<p><label for="answer">Category Name: </label><input type="text" name="categoryname" id="categoryname" /></p>
<div class="formBtns"><input type="submit" name="submit" value="Add"><input type="button" class="cancel" name="cancel" value="cancel"></div>
</form>
</div>
<div class="popform formNewLink">
<h3>Add new Link</h3>
<form action="addlinkscript.php" method="post" enctype="multipart/form-data">
<p><label for="answer">Company logo: </label>
<input type='file' name="imfileup" id="imfileup" onchange="getLogoURL(this);" />
<img id="complogo" src="../images/placeholder.jpg" alt="Logo image" />
</p>
<p><label for="answer">Company Name: </label><input type="text" name="companyname" id="companyname" /></p>

<?php

$locs = "SELECT * FROM location ORDER BY id";
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

<p><label for="url">URL: </label><input type="text" name="url" id="url" /></p>
<p><label for="url">Linkedin: </label><input type="text" name="linkedin" id="linkedin" /></p>
<p><label for="url">Facebook: </label><input type="text" name="facebook" id="facebook" /></p>
<p><label for="url">Instagram: </label><input type="text" name="instagram" id="instagram" /></p>
<div class="formBtns"><input type="submit" name="submit" value="Add"><input type="button" class="cancel" name="cancel" value="cancel"></div>
</form>
</div>

<div class="popform formConfirmDelete">
<h4>Are you sure you want to delete this link?</h4>
<form action="deletelinscript.php" method="post" enctype="multipart/form-data">
<div><img class="linkLogoConfirm" src="" /><span class="linkTextConfirm"></span></div>
<input type="hidden" name="linkid" id="linkid" value="">
<div class="formBtns"><input type="button" class="deleteno" name="deleteno" value="NO"><input type="submit" class="deleteyes" name="deleteyes" value="YES"></div>
</form>
</div>

<div class="popform formEditLink">
<h3>Edit Link</h3>
<form action="editlinscript.php" method="post" enctype="multipart/form-data">
<p><label for="answer">Company logo: </label>
<input type='file' name="imfileup" id="imfileup" onchange="getLogoURL(this);" />
<img id="complogo" src="../images/placeholder.jpg" alt="Logo image" />
</p>
<p><label for="answer">Company Name: </label><input type="text" name="companyname" id="companyname" /></p>

<?php

$elocs = "SELECT * FROM location ORDER BY id";  
$elocati = mysqli_query($conn, $elocs);
if(mysqli_num_rows($elocati) > 0) {
	$loccontent = "<p><label for='answer'>Location: </label><select name='location' id='location'><option value=''> </option>";
	$cntrgrprev = "";
	while ($obj = mysqli_fetch_array($elocati)) {	
		$loccontent .= $obj['country'];
		$cntrgr = $obj['countrygroup'];
		$cntrgrU = strtoupper($cntrgr);
		$cntr = $obj['country'];
		$cntrid = $obj['id'];
		if($cntrgr != $cntrgrprev){
			$loccontent .= "<optgroup label='".$cntrgrU."...................'>";
		}
		if($cntrgr == $cntrgrprev){
			
			$loccontent .= "<option value='".$cntrid."'>".$cntr."</option>";
		} else {
			$loccontent .= "</optgroup>";
		}
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

<p><label for="details">Details: </label><input type="text" name="details" id="details" /></p>
<p><label for="fleet">Fleet: </label><input type="text" name="fleet" id="fleet" /></p>
<p><label for="url">URL: </label><input type="text" name="url" id="url" /></p>
<p><label for="url">Linkedin: </label><input type="text" name="linkedin" id="linkedin" /></p>
<p><label for="url">lpja: </label><input type="text" name="lpja" id="lpja" /></p>
<p><label for="url">lpjb: </label><input type="text" name="lpjb" id="lpjb" /></p>
<p><label for="url">lpjc: </label><input type="text" name="lpjc" id="lpjc" /></p>
<div class="formBtns"><input type="submit" name="submit" value="Submit"><input type="button" class="cancel" name="cancel" value="cancel"></div>
</form>
</div>

<img class="close" src="images/close.jpg" />
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

$('.btnNewCat').click(function(){
	$('.popform').hide();
	$('.formNewCategory').show();
	$('.popup').show();
	
});
$('.btnNewLink').click(function(){
	$('.popform').hide();
	$('.formNewLink').show();
	$('.popup').show();
});
$('.popup .close').click(function(){
	$('.popup').hide();
	$('#complogo').attr('src', '../images/placeholder.jpg');
	$('#imfileup').val('');
});
$('.popup .cancel').click(function(){
	$('.popup').hide();
	$('#complogo').attr('src', '../images/placeholder.jpg');
	$('#imfileup').val('');
});

// Confirm Link Delete
$('.linksList .btnDelete').click(function(){
	var linkId = $(this).parent().parent().parent().attr('id');
	var linkLogo = $(this).parent().parent().find('div:first-child').children('img').attr('src');
	var linkName = $(this).parent().parent().children('div:nth-child(2)').text();
	
	$('.formConfirmDelete .linkLogoConfirm').attr('src', linkLogo).css({'width': '120px', 'height': '40px', 'margin-right': '10px'});
	$('.formConfirmDelete .linkTextConfirm').html(linkName);
	$('.formConfirmDelete #linkid').attr('value', linkId);
	
	$('.popform').hide();
	$('.formConfirmDelete').show();
	$('.popup').show();
});
$('.popup .deleteno').click(function(){
	$('.popup').hide();
});

// Edit Category
$('.categoryList .btnEditCat').click(function(){
	var catId = $(this).parent().parent().parent().attr('id');
	window.open('editcategory.php?id=' + catId,'_self');
});

// Edit Link
$('.linksList .btnEditLink').click(function(){
	var linkId = $(this).parent().parent().parent().attr('id');
	window.open('editlink.php?id=' + linkId,'_self');
});

});
</script>