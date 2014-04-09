<?php

if(isset($_POST['ajout'])){
		echo "<div class='ok' > l'article a été bien inserer. </div>";
  		$erreurinsertarticle = $article->insertArticle();
}

if(isset($_GET['do']) &&  $_GET['do'] == 'addarticle' ){
	$article->addArticle();
}

if(isset($_POST["search"]) && !empty($_POST["searchquery"]) ){
	$article->showarticle($_POST["searchquery"]);
}

if(isset($_GET['do']) && $_GET['do'] == 'payerfacture' && !empty($_GET['id_facture']) ){
	$facture->paymentFacture($_GET['id_facture']);
}

if(isset($_GET['do']) && $_GET['do'] == 'factures' ){
		if(!isset($_POST['searchfacture'])){
		echo'
		<div class="headpanel"> Factures </div>
			<form action="" method="POST" >
				<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
					<tr>
						<th>Numéro ou Nom Du Client</th>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F7F9FA" ><input type="text" style="padding : 8px;" size="60" name="searchquery" value="" /></td>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F2F2F2" ><input type="submit" name="searchfacture" value="Rechercher" /></td>
					</tr>

			</form>
			';
	}
	$facture->showFacturePanel();
}

if(isset($_GET['do']) && $_GET['do'] == 'showarticles' ){

	if(!isset($_POST['search'])){	
	echo '
		<div class="headpanel"> Articles </div> 
			<form action="" method="POST">
				<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
					<tr>
						<th>Titre ou Category du Film </th>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F7F9FA" ><input type="text" style="padding : 8px;" size="60" name="searchquery" value="" /></td>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F2F2F2" ><input type="submit" name="search" value="Rechercher" /></td>
					</tr>

			</form>
	';
	}
	$article->showArticles();
}

if(isset($_POST['searchfacture']) && !empty($_POST['searchquery']) ){
	$facture->searchfacture($_POST['searchquery']);
}

if(isset($_POST['deletegroupe'])){
	$article->deleteArticles();
}

if(isset($_GET['do']) && $_GET['do'] == 'modifarticle' ){
	$article->showmodifArticle($_GET['id']);
}

if(isset($_POST['modifier'])){
	$article->modifarticle($_POST['id']);
}

if(isset($_POST["searchmember"]) && !empty($_POST["searchquery"]) ){
	$user->showUser($_POST["searchquery"]);
}

if(isset($_GET['do']) && $_GET['do'] == "showmembers" ){

	if(!isset($_POST['searchmember'])){	
	echo '
		<div class="headpanel">Membres</div> 
			<form action="" method="POST">
				<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
					<tr>
						<th>Nom ou Adress Email du Membre</th>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F7F9FA" ><input type="text" style="padding : 8px;" size="60" name="searchquery" value="" /></td>
					</tr>
					<tr>
						<td  align="center" bgcolor="#F2F2F2" ><input type="submit" name="searchmember" value="Rechercher" /></td>
					</tr>

			</form>
	';
	}

	if(isset($_GET['erreurdeleteuser']) && $_GET['erreurdeleteuser'] == 'false' ){
		echo "<div class='no'>Impossible de Supprimer un Administrateur ! Veuillez le retirer d'abord de l'administration. </div>";
	}elseif(isset($_GET['erreurdeleteuser']) && $_GET['erreurdeleteuser'] == 'true' ){
		echo "<div class='ok'>Utilisateur(s) ont été supprimés. </div>";
	}
	$user->showUsers();
}



if(isset($_GET['do']) && $_GET['do'] == "makeadmin" && isset($_GET['id']) ){
	$user->makeAdmin($_GET['id']);
	echo "<meta http-equiv='refresh' content='1; url=index.php?do=showmembers' />";
}

if(isset($_GET['do']) && $_GET['do'] == "deletadmin" && isset($_GET['id']) ){
	$user->deletAdmin($_GET['id']);
	echo "<meta http-equiv='refresh' content='1; url=index.php?do=showmembers' />";
}

if(isset($_POST['deleteuser']) && $_POST['deleteuser'] ){
	$user->deletUsers();
}

if(isset($_GET['do']) && $_GET['do'] == 'stats' ){
			 $row = $DB->count(" id_article "," articles ");
			 $nbarticles = $row->rowCount();
			 $row = $DB->count(" id_facture "," facture ");
			 $nbfacture = $row->rowCount();
			 $row = $DB->count(" id_facture "," facture "," etat='1' ");
			 $nbfacturep = $row->rowCount();
			 $total = 0;
			 $row = $DB->query(" facture.totale "," facture "," etat='1' ");
			 foreach ($row as $value) {
			 	$total += $value->totale;
			 }
			echo '
			<div class="headpanel"> Statistiques </div>
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
							<tr>	
								<th>Nombre D\'Articles</th>
								<th>Nombre De Factures</th>
								<th>Nombre De Factures Payées</th>
								<th>Totale des Ventes</th>
							</tr>
							<tr>
								<td align="center" bgcolor="#F7F9FA" >'.$nbarticles.'</td>
								<td align="center" bgcolor="#F7F9FA" >'.$nbfacture.'</td>
								<td align="center" bgcolor="#F7F9FA" >'.$nbfacturep.'</td>
								<td align="center" bgcolor="#F7F9FA" >'.$total.'</td>
							<tr>
			</table>
			';
			//"#F7F9FA";
}

?>