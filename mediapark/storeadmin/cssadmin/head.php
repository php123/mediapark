<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>MediaPark - Store Admin </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="cssadmin/css.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Mate|Strait' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<?php
		require "../include/database.class.php";
		require "./include/article.class.php";
		require "./include/user.class.php";
		require "./include/facture.class.php";
		$DB = new Db();
		$article = new Article();
		$user = new User();
		$facture = new Facture($DB);
	?>

</head>