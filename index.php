<?php
include 'inc/header.php'; 
?>

<body>
  <div class="Main">
	
	
	
	<header><div class="container-fluid">
	<div class="row">
	<div class="col-md-6"><h3>Link Organizer</h3></div>
	<div class="col-md-6 right">
	<a class="headBtn" href="logout.php">Logout</a>
	<a class="headBtn" target="_blank" href="admin/">Admin</a>
	</div>
	</div>
	</div></header>
	
	<div class="container-fluid">
	<?php
	$cate = 0;
	if (isset($_GET['p'])){
		$cate = $_GET["p"];
	}
	
	if(mysqli_num_rows($getcats) > 0) {
		$menucontent = '<div class="menu">';
		$cnt = 0;
		while($ct = mysqli_fetch_assoc($getcats)) {
			if($cnt == 0 && $cate == 0){
				$cate = $ct["id"];
			}
			$ctid = $ct["id"];
			$ctname = $ct["categoryname"];
			$menucontent .= '<a ';
			if ($cate == $ctid) {
				$menucontent .= 'class="active"'; 
			}
			$menucontent .= ' href="index.php?p='.$ctid.'">'.$ctname.'</a>';
			$cnt++;
		}
		
		$menucontent .= '</div>';
		echo $menucontent;
	
	} else {
		echo 'there is no categories in the database';
	}
	
	?>
	
	
	<?php
		
		$links = "SELECT * FROM list WHERE category=".$cate." ORDER BY name";
		
		$getlinks = mysqli_query($conn, $links);
		if(mysqli_num_rows($getlinks) > 0) {
			$linkscontent = '<div class="links"><div class="row headline">';
			$linkscontent .= '<div class="col-md-1 col" url="">Logo:</div>';
			$linkscontent .= '<div class="col-md-2 col" url="">Company Name:</div>';
			$linkscontent .= '<div class="col-md-2 col">Location:</div>';
			$linkscontent .= '<div class="col-md-1 col">Linkedin:</div>';
			$linkscontent .= '<div class="col-md-1 col">Facebook:</div>';
			$linkscontent .= '<div class="col-md-1 col">Instagram:</div>';
			$linkscontent .= '</div>';
			while($lk = mysqli_fetch_assoc($getlinks)) {
				$linkscontent .= '<div class="row lnk">';
				$linkscontent .= '<div class="col-md-1 col logo"><img src="images/logos/'.$lk['logo'].'"/></div>';
				$linkscontent .= '<div class="col-md-2 col"><a href="'.$lk['url'].'" target="_blank">'.$lk['name'].'</a></div>';
				
				$locnum = $lk['location'];
				$locdb = "SELECT * FROM location WHERE id=".$locnum;
				$locations = mysqli_query($conn, $locdb);
				$location = mysqli_fetch_assoc($locations);
				$locationtitle = $location['country'];
				$linkscontent .= '<div class="col-md-2 col">'.$locationtitle.'</div>';
				
				$linkscontent .= '<div class="col-md-1 col">';
				if($lk['linkedin']){
				$linkscontent .= '<a href="'.$lk['linkedin'].'" target="_blank">L - url</a>';
				}
				$linkscontent .= '</div>';
				
				$linkscontent .= '<div class="col-md-1 col">';
				if($lk['linkedin']){
				$linkscontent .= '<a href="'.$lk['facebook'].'" target="_blank">F - url</a>';
				}
				$linkscontent .= '</div>';
				
				$linkscontent .= '<div class="col-md-1 col">';
				if($lk['linkedin']){
				$linkscontent .= '<a href="'.$lk['instagram'].'" target="_blank">I - url</a>';
				}
				$linkscontent .= '</div>';


				$linkscontent .= '</div>';
			}
			$linkscontent .= '</div>';
			
			echo $linkscontent;
		}
	?>
	
	
	</div>
    </div>
	
</body>
</html>
