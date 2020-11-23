<?php
session_start();
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
    	if ( $_POST['password'] == 'sld3' && $_POST['username'] == 'sld' ) {
    		$_SESSION['user_id'] = '21';
			header("Location: index.php");
    	}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Log</title>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>

<body>
	
	<form action="" method="post">
	<input type="text" name="username" placeholder="us" required >
    <input type="password" name="password" placeholder="p" required >
    <input type="submit" value="Submit">
</form>

    </div>
	
</body>
</html>
