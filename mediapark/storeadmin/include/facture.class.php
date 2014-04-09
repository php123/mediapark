<?php 

class Facture {
	
	private $DB;

	public function __construct($db){
		$this->DB = $db;
	}

	public function showFacturePanel(){

		$rows = $this->DB->query(" * "," facture ");

		echo '
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Numéro Facture</th>
					<th>Total</th>
					<th>Date</th>
					<th>Nom Prénom</th>
					<th>Payer</th>
				</tr>
		';
		// var_dump($rows);
		$i = 1;

		$bgcolor1 = "#F7F9FA";
		$bgcolor2 = "#F2F2F2";
		foreach ($rows as $value):
		if ($i % 2 == 0){ $bg = $bgcolor1; }else{  $bg = $bgcolor2; }
		echo "	
				<tr>
					<td bgcolor=".$bg." >". $value->id_facture ."</a></td>
					<td bgcolor=".$bg." >".$value->totale."</td>
					<td bgcolor=".$bg."  align='center' >". $value->date ."</td>
					<td bgcolor=".$bg."  align='center' >". $value->Nom ." ".$value->Prenom."</td>
					<td bgcolor=".$bg."  align='center' >";
					if($value->etat == 0){ echo " <a href='index.php?do=payerfacture&id_facture=".$value->id_facture."'><img src='./include/images/dollar.png' />";
					echo "</a>";}else{
						echo "Déja Payée";
					}
					echo "
					</td>
				</tr>
		";
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			</table>
		';
		


	}

	public function searchfacture($search){
		
		$rows = $this->DB->query(" * "," facture "," id_facture LIKE :search OR Nom LIKE :search OR Prenom LIKE :search ",array("search" => $search));

		echo '
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
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Numéro Facture</th>
					<th>Total</th>
					<th>Date</th>
					<th>Nom Prénom</th>
					<th>Payer</th>
				</tr>
		';
		// var_dump($rows);
		$i = 1;

		$bgcolor1 = "#F7F9FA";
		$bgcolor2 = "#F2F2F2";
		foreach ($rows as $value):
		if ($i % 2 == 0){ $bg = $bgcolor1; }else{  $bg = $bgcolor2; }
		echo "	
				<tr>
					<td bgcolor=".$bg." >". $value->id_facture ."</a></td>
					<td bgcolor=".$bg." >".$value->totale."</td>
					<td bgcolor=".$bg."  align='center' >". $value->date ."</td>
					<td bgcolor=".$bg."  align='center' >". $value->Nom ." ".$value->Prenom."</td>
					<td bgcolor=".$bg."  align='center' >";
					if($value->etat == 0){ echo " <a href='index.php?do=payerfacture&id_facture=".$value->id_facture."'><img src='./include/images/dollar.png' />";
					echo "</a>";}else{
						echo "Déja Payée";
					}
					echo "
					</td>
				</tr>
		";
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			</table>
		';
	}

	public function paymentFacture($id_facture){
		
		$rows = $this->DB->query(" facture.id_article, facture.quantite "," facture "," id_facture=:id ",array("id" => $id_facture ));
		$id_articles = $rows[0]->id_article;
		$qtn = explode(",", $rows[0]->quantite);
		$rows = $this->DB->query(" * "," articles "," id_article IN (".$id_articles.") ");
		$i = 0;
		foreach ($rows as $value) {
			$quantite = $value->quantite - $qtn[$i];
			$this->DB->update(" articles "," quantite='".$quantite."' "," id_article='".$value->id_article."' ");
			$i++;
		}
		$this->DB->update(" facture "," etat='1' "," id_facture=:id ",array("id" => $id_facture ));
		echo "<div class='ok'> Payement de la facture terminé </div>";
	}

}



?>