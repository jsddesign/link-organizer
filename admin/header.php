<?php
error_reporting(0);
session_start();
include_once("../inc/conn.php");
if($_SESSION["user_id"] == NULL) {
    header("Location: ../login.php");
}

$cats = "SELECT * FROM categories ORDER BY id";
$getcats = mysqli_query($conn, $cats);
$links = "SELECT * FROM list ORDER BY name";
$getlinks = mysqli_query($conn, $links);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Link Directory | Admin</title>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/media.css">
</head>

<body>

<div class="adminPanel">

<header>
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-6"><h2>Link Organizer Dashboard</h2></div>
	<div class="col-md-6 right"><a class="headBtn" href="../logout.php">Logout</a></div>
	</div>
	</div>
</header>