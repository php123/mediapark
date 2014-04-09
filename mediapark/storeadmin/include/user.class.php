<?php

class User extends Db  {

	public function __construct() {
		parent::__construct();
	}

	public function showUsers(){

		$rows = $this->query(" * "," user ");

		echo '
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Nom D\'utilisateur</th>
					<th>E-Mail </th>
					<th>Adresse</th>
					<th>Pays</th>
					<th>Sexe</th>
					<th>Supprimer</th>
					<th>Statue</th>
				</tr>
		';
		// var_dump($rows);
		$i = 2;

		$bgcolor1 = "#F7F9FA";
		$bgcolor2 = "#F2F2F2";
		foreach ($rows as $value):
		if ($i % 2 == 0){ $bg = $bgcolor1; }else{  $bg = $bgcolor2; }
		echo "	
				<tr>
					<td bgcolor=".$bg." align='center' >".$value->user_name."</td>
					<td bgcolor=".$bg." align='center' >".$value->e_mail."</td>
					<td bgcolor=".$bg." align='center' >".$value->adresse."</td>
					<td bgcolor=".$bg." align='center' >".$value->pays."</td>
					<td bgcolor=".$bg." align='center' >".$value->sexe."</td>
					<td bgcolor=".$bg." align='center' ><input type='checkbox' id='checkbox-".$i."' class='regular-checkbox' name='supprmembre[]' value='".$value->id_user."' /><label for='checkbox-".$i."'></label></td>
		";		
				if($value->state == 1){ echo "<td bgcolor=".$bg." align='center' ><a href=' ?do=deletadmin&id=".$value->id_user."'><img src='./include/images/admin.png' /><a/></td>";}
				if($value->state == 0){ echo "<td bgcolor=".$bg." align='center' ><a href=' ?do=makeadmin&id=".$value->id_user."'><img src='./include/images/deletadmin.png' /><a/></td>";}
				
				echo "</tr>";
		
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			<tr><td colspan="7" class="headpanel" align="center" ><img src="./include/images/admin.png" /> [Statue = Admin -> Supprimer de l\'administration] &nbsp;&nbsp;&nbsp; <img src="./include/images/deletadmin.png" /> [Statue = Utilisateur -> Déf. Comme Administrateur du site] </td></tr>
			<tr><td colspan="7" class="headpanel" align="center" ><input value="Supprimer" type="submit" name="deleteuser" /></td></tr>
			</table>
		';
	
	}

	public function showUser($search){
		$rows = $this->query(" * "," user "," user.user_name LIKE :search or user.e_mail LIKE :search ",array("search" => "%".$search."%"));
		echo '
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
			<div class="headpanel"> Membres </div>
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Nom D\'utilisateur</th>
					<th>E-Mail </th>
					<th>Adresse</th>
					<th>Pays</th>
					<th>Sexe</th>
					<th>Supprimer</th>
					<th>Statue</th>
				</tr>
		';
		// var_dump($rows);
		$i = 2;

		$bgcolor1 = "#F7F9FA";
		$bgcolor2 = "#F2F2F2";
		foreach ($rows as $value):
		if ($i % 2 == 0){ $bg = $bgcolor1; }else{  $bg = $bgcolor2; }
		echo "	
				<tr>
					<td bgcolor=".$bg." align='center' >".$value->user_name."</td>
					<td bgcolor=".$bg." align='center' >".$value->e_mail."</td>
					<td bgcolor=".$bg." align='center' >".$value->adresse."</td>
					<td bgcolor=".$bg." align='center' >".$value->pays."</td>
					<td bgcolor=".$bg." align='center' >".$value->sexe."</td>
					<td bgcolor=".$bg." align='center' ><input type='checkbox' id='checkbox-".$i."' class='regular-checkbox' name='supprmembre[]' value='".$value->id_user."' /><label for='checkbox-".$i."'></label></td>
		";		
				if($value->state == 1){ echo "<td bgcolor=".$bg." align='center' ><a href=' ?do=deletadmin&id=".$value->id_user."'><img src='./include/images/admin.png' /><a/></td>";}
				if($value->state == 0){ echo "<td bgcolor=".$bg." align='center' ><a href=' ?do=makeadmin&id=".$value->id_user."'><img src='./include/images/deletadmin.png' /><a/></td>";}
				
				echo "</tr>";
		
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			<tr><td colspan="7" class="headpanel" align="center" ><img src="./include/images/admin.png" /> [Statue = Admin -> Supprimer de l\'administration] &nbsp;&nbsp;&nbsp; <img src="./include/images/deletadmin.png" /> [Statue = Utilisateur -> Déf. Comme Administrateur du site] </td></tr>
			<tr><td colspan="7" class="headpanel" align="center" ><input value="Supprimer" type="submit" name="deleteuser" /></td></tr>
			</table>
		';
	}

	public function deletUsers(){

		$erreurdeletuser = true;
		for ($i=0;$i < count($_POST['supprmembre']);$i++){
			$row = $this->query(" state "," user "," id_user='".$_POST['supprmembre'][$i]."' ");
			if($row[0]->state != 1 ){
				$this->delete(" user "," id_user='".$_POST['supprmembre'][$i]."' ");
			}else{
				$erreurdeletuser = false;
			}
		}
		
		if($erreurdeletuser == true){
			echo "<meta http-equiv='refresh' content='1; url=index.php?do=showmembers&erreurdeleteuser=true' />";
		}else{
			echo "<meta http-equiv='refresh' content='1; url=index.php?do=showmembers&erreurdeleteuser=false' />";
		}
	}

	public function makeAdmin($id){
		$this->update(" user "," state='1' "," id_user=:id ",array("id" => $id ));
	}

	public function deletAdmin($id){
		$this->update(" user "," state='0' "," id_user=:id ",array("id" => $id ));
	}

}



?>