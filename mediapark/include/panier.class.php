<?php

	class Panier {

		public function __construct(){
			if(!isset($_SESSION['panier'])){
				$_SESSION['panier'] = array();
			}
		}

		public function addPanier($id_article){
			if(isset($_SESSION['panier'][$id_article])){
				$_SESSION['panier'][$id_article] += 1;
				header("Location: index.php");
			}
			else{
				$_SESSION['panier'][$id_article] = 1;
				header("Location: index.php");
			}
		}

		public function addItem($id_article){
			
			if(isset($_SESSION['panier'][$id_article])){
				$_SESSION['panier'][$id_article] += 1;
				header("Location: panier.php");
			}
			else{
				$_SESSION['panier'][$id_article] = 1;
				header("Location: panier.php");
			}

		}

		public function deletItem($id_article){
			if(isset($_SESSION['panier'][$id_article]) && $_SESSION['panier'][$id_article] > 1 ){
				$_SESSION['panier'][$id_article] -= 1;
				header("Location: panier.php");
			}
			elseif( $_SESSION['panier'][$id_article] == 1 ){
				unset($_SESSION['panier'][$id_article]);
				header("Location: panier.php");
			}
		}

		public function deleteArticle(){
			for ($i=0;$i < count($_POST['supprarticle']);$i++){
				unset($_SESSION['panier'][$_POST['supprarticle'][$i]]);
			}
			header("Location: panier.php");
		}



	}


?>