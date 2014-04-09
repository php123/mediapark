<?php
session_start();
ob_start();
require "include/database.class.php";
require "include/user.class.php";
require "include/pagination.class.php";
require "include/panier.class.php";
require "include/article.class.php";
$DB = new Db();
$user = new User();
$pagination = new Pagination();
$panier = new Panier();
$article = new Article($DB);


/* Inscription */

if (isset($_POST["signup"])){
	$answerinscrip = $user->signup();
}// end signup


/* LOGIN ADMIN & USER */
if (isset($_POST["login"])){
		 $answer = $user->session($_POST['username'],$_POST['password']);
} // endlogin

if(isset($_GET['do']) && $_GET['do'] == 'addtocart' && isset($_GET['id']) ){

		$row = $DB->query(" id_article "," articles "," id_article=:id ", array("id" => $_GET['id'] ));
		if(empty($row)){
			$erreurpanier = "<div class='no'> Ce Produit n'exist pas ! </div>";
		}else{
			$panier->addPanier($row[0]->id_article);
		}
}
 
if(isset($_GET['do']) && $_GET['do'] == "additem" && isset($_GET['id']) ){
		$row = $DB->query(" id_article "," articles "," id_article=:id ", array("id" => $_GET['id'] ));
		if(empty($row)){
			$erreurpanier = "<div class='no'> Ce Produit n'exist pas ! </div>";
		}else{
			$panier->addItem($row[0]->id_article);
		}
}

if(isset($_GET['do']) && $_GET['do'] == "deletitem" && isset($_GET['id']) ){
		$row = $DB->query(" id_article "," articles "," id_article=:id ", array("id" => $_GET['id'] ));
		if(empty($row)){
			$erreurpanier = "<div class='no'> Ce Produit n'exist pas ! </div>";
		}else{
			$panier->deletItem($row[0]->id_article);
		}
}


if(isset($_POST['supprarticlepanier']) && !empty($_POST['supprarticlepanier']) ){
	$panier->deleteArticle();
}

?>