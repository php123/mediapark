<?php

 class Article extends Db {
	
	public function __construct(){
		parent::__construct();
	}

	public function insertArticle(){

		if (!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["prix"]) && !empty($_POST["trailer"]) && !empty($_POST["ctg"]) ){
			$row = $this->query("id_user"," user "," (user_name='".$_SESSION["manager"]."') ");
			foreach ($row as $value){
				$id = $value->id_user;
			}
			$dir = "posters";
	        $nomfichier = $_FILES['poster']['name'];
	        $nomfichier = str_replace (" ","_",$nomfichier);// Remplacement des espace par _
	        $nomfichier = str_replace ("'","-",$nomfichier); // Remplacement des ' par -
	        $pieces = explode(".", $nomfichier);
	        $tmpfichier = $_FILES['poster']['tmp_name'];
			$title = stripslashes($_POST["title"]);
			$description = stripslashes($_POST["description"]);
			$note = $_POST["note"];
			$prix = stripslashes($_POST["prix"]);
			$qtn = stripslashes($_POST["prix"]);
			$trailer = stripcslashes(($_POST["trailer"]));
			$category = $_POST["ctg"];
			$this->insert(" articles ",' ("","'.$title.'","'.$description.'","'.$category.'","'.$note.'","'.$prix.'","'.$qtn.'","'.$nomfichier.'","'.$trailer.'","'.$id.'","") ');
			$id = $this->db->lastInsertId();
			$this->insert(" likes ","('','0','$id') ");
			$nomfichier  = $id.$pieces[0].".".$pieces[1];
			$this->update(" articles "," poster='". $nomfichier ."'  ", " id_article='".$id."' " );
	        $move = move_uploaded_file($tmpfichier,"$dir/$nomfichier");
	       	return $erreurinsertarticle = true;
		}else {
			echo "<div class='no' > Erreur :( ! Veuillez Réessayer à nouveau. </div>";
		}

	}

	public function addArticle(){
			echo '
					<div class="requests">
						<div class="headpanel"> Ajouter Un Article </div>
						<form action="" method="POST" enctype="multipart/form-data">
							<table class="table" align="center" width="900" cellspacing="10" >	
								<tr><td colspan="" > Titre de l\'article : </td><td><input type="text" size="95" style="padding-top : 7px; padding-bottom : 7px; " name="title"></td></tr>
								<tr>
								<td> Description : </td><td><textarea name="description" cols="20" rows="4" ></textarea></td>
								</tr>
								<tr>
									<td> category : </td>
									<td align="center" >
										<select name="ctg">
											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Horror">Horror</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
										</select> 
									</td>
								</tr>
							</table>
							<table class="table" align="center" width="900" >
								<tr><td> Note : </td><td> Prix : </td><td> Quantité En Stock : </td><td> Poster : </td><td> Trailer : </td></tr>
								<tr>
								<td><input type="text" size="2" name="note"></td>
								<td><input type="text" size="2" name="prix"></td>
								<td><input type="text" size="2" name="qtn"></td>
								<td><input type="file" name="poster"></td>
								<td><input type="text" name="trailer"></td>
								</tr>
								<tr><td align="center" class="headpanel" colspan="5"><input type="submit" value="Valider" name="ajout" /></td></tr>
							</table>
						</form>
					</div>
          	'
          	;
	}


	/*** La Suppression Des Articles **/


	public	function deleteArticles(){
	
		for ($i=0;$i < count($_POST['supprarticle']);$i++){
			$row = $this->query(" poster "," articles "," id_article='".$_POST['supprarticle'][$i]."' ");
			foreach ($row as $value) {
				unlink("posters/$value->poster");	
			}
			$this->delete(" articles "," id_article='".$_POST['supprarticle'][$i]."' ");
			$this->delete(" likes ", " id_article='".$_POST['supprarticle'][$i]."' ");
		}

		echo "<meta http-equiv='refresh' content='1; url=index.php?do=showarticles' />";
		
	}

	/* L'Affichage Des Articles */

	public function showArticles() {
		
		$rows = $this->__query(" articles.id_article, articles.title, articles.quantite, articles.poster, likes.like "," articles LEFT JOIN likes ON articles.id_article=likes.id_article ORDER BY articles.id_article DESC ");

		echo '
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Titre de l\'article</th>
					<th>Quantité </th>
					<th>Impression </th>
					<th>Modifier </th>
					<th>Suppression <br />Par Groupe</th>
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
					<td bgcolor=".$bg." ><a target='_blank' href='../article.php?id=".$value->id_article."'> ". $value->title ."</a></td>
					<td bgcolor=".$bg." >".$value->quantite."</td>
					<td bgcolor=".$bg."  align='center' >". $value->like ."&nbsp;&nbsp; <img src='./include/images/like.png' alt='heart' title='likes' /></td>
					<td bgcolor=".$bg."  align='center' ><a href=' ?do=modifarticle&id=".$value->id_article."'><img src='./include/images/editarticle.png' /></a></td>
					<td bgcolor=".$bg."  align='center' ><input type='checkbox' id='checkbox-".$i."' class='regular-checkbox' name='supprarticle[]' value='".$value->id_article."' /><label for='checkbox-".$i."'></label></td>
				</tr>
		";
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			<tr><td colspan="5" class="headpanel" align="center" ><input value="Delete Articles" type="submit" name="deletegroupe" /></td></tr>
			</table>
		';
		

	}

	public function showArticle($search){

		$rows = $this->__query(" articles.id_article, articles.title, articles.quantite, articles.poster, likes.like "," articles LEFT JOIN likes ON articles.id_article=likes.id_article WHERE articles.title LIKE :search or articles.category LIKE :search ORDER BY articles.id_article DESC  ",array("search" => "%".$search."%" ));

		echo '
			<div class="headpanel"> Articles </div>
			<form action="" method="POST" >
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
			<form action="" method="POST">
			<table style="margin-top : 10px;" border="0" align="center" width="1100" cellspacing="2" cellpadding="7" >
				<tr>	
					<th>Titre de l\'article</th>
					<th>Quantité </th>
					<th>Impression </th>
					<th>Modifier </th>
					<th>Suppression <br />Par Groupe</th>
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
					<td bgcolor=".$bg." ><a target='_blank' href='../article.php?id=".$value->id_article."'> ". $value->title ."</a></td>
					<td bgcolor=".$bg." >".$value->quantite."</td>
					<td bgcolor=".$bg."  align='center' >". $value->like ."&nbsp;&nbsp; <img src='./include/images/like.png' alt='heart' title='likes' /></td>
					<td bgcolor=".$bg."  align='center' ><a href=' ?do=modifarticle&id=".$value->id_article."'><img src='./include/images/editarticle.png' /></a></td>
					<td bgcolor=".$bg."  align='center' ><input type='checkbox' id='checkbox-".$i."' class='regular-checkbox' name='supprarticle[]' value='".$value->id_article."' /><label for='checkbox-".$i."'></label></td>
				</tr>
		";
		// <td align='center' ><input type='checkbox'  name='suppr[]' value='".$value->id_article."' /></td>
		$i++;
		endforeach;
		echo '
			<tr><td colspan="5" class="headpanel" align="center" ><input value="Delete Articles" type="submit" name="deletegroupe" /></td></tr>
			</table>
		';
		


	}

	public function showmodifArticle($id){

		if(!intval(abs($id)) or $id < 1 ) { die("<div class='no'><font color='white'> L'article demandé  est introuvable </font></div>"); }
		$id = intval(abs($id));
		$id    = intval(abs($id));
		$array = array("-",":","'",'"',";","=",",","+","*","/",".","'","\"","\\","/",">","<",")","(","}","{","#",",",";",":","%","£","^","¨","`","°","²","&","=","*","×","§");
		$id    = str_replace($array,"",$id);
		$row = $this->query(" * "," articles "," id_article=$id ");

		foreach ($row as $value) {
		echo '
					<div class="requests">
						<div class="headpanel"> Modification D\'article </div>
						<form action="" method="POST" enctype="multipart/form-data">
							<table class="table" cellspacing="10" align="center" width="900"  >	
								<tr><td colspan="" > Titre de l\'article : </td><td><input type="text" value="'.$value->title.'" size="50" name="title"></td></tr>
								<tr>
								<td> Description : </td><td><textarea name="description"  cols="20" rows="4" >'.$value->description.'</textarea></td>
								</tr>
								<tr>
									<td> category : </td>
									<td align="center" >
										<select name="ctg">
			';

			if($value->category == "Action & Adventure" ) : echo '<option selected="selected" value="Action & Adventure">Action &amp; Adventure</option>'; 
			echo '
											
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Horror">Horror</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Horror" ) : echo '<option selected="selected" value="Horror">Horror</option>'; 
			echo '
											
											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Anime & Manga" ) : echo '<option selected="selected" value="Anime & Manga">Anime &amp; Manga</option>'; 
			echo '
											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Classics" ) : echo '<option selected="selected" value="Classics">Classics</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Musicals" ) : echo '<option selected="selected" value="Musicals">Musicals</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Drama" ) : echo '<option selected="selected" value="Drama">Drama</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Mystery & Suspense" ) : echo '<option selected="selected" value="Mystery & Suspense">Mystery &amp; Suspense</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Science Fiction & Fantasy" ) : echo '<option selected="selected" value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Westerns">Westerns</option>
			';
			endif;

			if($value->category == "Westerns" ) : echo '<option value="Westerns">Westerns</option>'; 
			echo '							

											<option value="Action & Adventure">Action &amp; Adventure</option>
											<option value="Horror">Horror</option>
											<option value="Anime & Manga">Anime &amp; Manga</option>
											<option value="Classics">Classics</option>
											<option value="Musicals">Musicals</option>
											<option value="Drama">Drama</option>
											<option value="Mystery & Suspense">Mystery &amp; Suspense</option>
											<option value="Science Fiction & Fantasy">Science Fiction &amp; Fantasy</option>
											
			';
			endif;

			echo '
										</select> 
									</td>
								</tr>
							</table>
							<table class="table" align="center" width="900" >
								<tr><td> Note : </td><td> Prix : </td><td> Quantité : </td><td> Poster : </td><td> Trailer : </td></tr>
								<tr>
								<td><input type="text" size="2" value="'.$value->note.'" name="note"></td>
								<td><input type="text" size="2" value="'.$value->prix.'" name="prix"></td>
								<td><input type="text" size="2" value="'.$value->quantite.'" name="qtn"></td>
								<td align="center" ><img width="290" height="240" src="./posters/'.$value->poster.'" /><br /><input type="file" name="poster"></td>
								<td><input type="text" value="'.$value->trailer.'" name="trailer"></td>
								</tr>
								<tr><td align="center" class="headpanel" colspan="5"><input type="submit" value="Valider" name="modifier" /></td></tr>
							</table>
							<input type="hidden" name="id" value='.$id.' />
						</form>
					</div>
          	';
          }//endforeach
	}

	public function modifarticle($id){
		if(!empty($_POST['title']) and !empty($_POST['description']) and !empty($_POST['note']) and !empty($_POST['prix'])){
			
			if(!empty($_FILES['poster']['name'])){
				$row = $this->query(" poster "," articles "," id_article='".$id."' ");
				foreach ($row as $value) {
					$poster = $value->poster;
				}
				unlink("./posters/$poster");
				$dir = "posters";
		        $nomfichier = $_FILES['poster']['name'];
		        $nomfichier = str_replace (" ","_",$nomfichier);// Remplacement des espace par _
		        $nomfichier = str_replace ("'","-",$nomfichier); // Remplacement des ' par -
		        $pieces = explode(".", $nomfichier);
		        $tmpfichier = $_FILES['poster']['tmp_name'];
		        $nomfichier  = $id.$pieces[0].".".$pieces[1];
		        $move = move_uploaded_file($tmpfichier,"$dir/$nomfichier");
		        $title = stripslashes($_POST["title"]);
				$description = stripslashes($_POST["description"]);
				$note = $_POST["note"];
				$prix = stripslashes($_POST["prix"]);
				$qtn  = $_POST['qtn'];
				$trailer = stripcslashes(($_POST["trailer"]));
				$category = $_POST["ctg"];
				$this->update(" articles "," title='".$title."', description='".$description."', category='".$category."', note='".$note."', prix='".$prix."', quantite='".$qtn."', poster='".$nomfichier."', trailer='".$trailer."'    "," id_article='".$id."' ");
				echo "<meta http-equiv='refresh' content='1; url=index.php?do=showarticles' />";
	        }else{
		        $title = stripslashes($_POST["title"]);
				$description = addslashes($_POST["description"]);
				$note = $_POST["note"];
				$prix = stripslashes($_POST["prix"]);
				$qtn = $_POST['qtn'];
				$trailer = stripcslashes(($_POST["trailer"]));
				$category = $_POST["ctg"];
				$this->update(" articles "," title='".$title."', description='".$description."', category='".$category."', note='".$note."', prix='".$prix."',  quantite='".$qtn."', trailer='".$trailer."'    "," id_article='".$id."' ");
	    		echo "<meta http-equiv='refresh' content='1; url=index.php?do=showarticles' />";
	        }


		}

	} 


}// end of class

?>
