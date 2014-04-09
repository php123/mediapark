<?php

class User extends Db  {

	public function __construct() {
		parent::__construct();
	}

	/* SESSION */

	/**
	 *	The Session function its used to open a SESSION for a user who's connected with his login and password
	 *	@param String $login the username or e-mail of the user .
	 *	@param String $password the password of the user .
	 *	@return String : it returns a message that agree with the state of the user try to connect .
	*/

	public function session ($login,$password){

		if (!empty($login) && !empty($password) ){

			$password = sha1(md5($password));

			//"SELECT * FROM user WHERE (user_name='$login' or e_mail='$login') and password='$password' "

			$row = $this->count(" * "," user "," (user_name='$login' or e_mail='$login') and password = '$password' ");

			if ($row->rowCount() > 0){

				$row = $this->query(" * "," user "," (user_name='$login' or e_mail='$login') and password = '$password' ");

				foreach ($row as $value){
					$username = $value->user_name;
					$email = $value->e_mail;
					$pass = $value->password;
					$state = $value->state;
				}

				if ($username == $login || $email == $login and $password == $pass and $state == 0 ){
					$_SESSION["user"] = $username;
					return $erreur = "user";
				}elseif($username == $login || $email == $login and $password == $pass and $state == 1 ) {
					$_SESSION["manager"] = $username;
					return $erreur = "manager";
				}else {
					return $erreur = "not found";
				}

			}else{
				$erreur = "<div class='no'>Erreur lors du connexion, Veuillez à nouveau saisir votre login et mot de passe.</div>";
				return  $erreur;
			}
		}else {
			$erreur =  "<div class='no'>vous avez laisser des champs vides !</div>";
			return  $erreur;
		}
	}


	public function signup (){
		if (!empty($_POST["username"]) && !empty($_POST["e-mail"])  && !empty($_POST["password"]) && !empty($_POST["country"])  && !empty($_POST["sexe"])){
	    	$row = $this->count(" 'user_name','e_mail' "," user ","  (user_name='".$_POST['username']."' or e_mail='".$_POST['e-mail']."') ");
		if($row->rowCount() == 0 ){
			$username = $_POST["username"];
			$e_mail = $_POST["e-mail"];
			$password = sha1(md5($_POST["password"]));
			$country = $_POST["country"];
			$sexe = $_POST["sexe"];
			$state = 0; // its a user not an admin by default
			//"INSERT INTO user VALUE(null,'$username','$e_mail','$password','$adresse','$country','$city','$sexe','$age','$state')"
			$this->insert(" user "," (null,'$username','$e_mail','$password','not defined','$country','not defined','$sexe','not defined','$state') ");
			$id = $this->db->lastInsertId();
			if($id == 1 ){
				$this->update(" user "," state='1' "," id_user='".$id."' ");
			}
			//<meta http-equiv='refresh' content='2; url=login_inscription.php' />
			return "inscri";
		}else {
			return "<div class='no'>Utilisateur déja Inscrit ! Réesayer avec un Nom d'utilisateur ou Adresse e-mail différente </div>";
		}
		}// empty
		else {
			return "<div class='no'>vous avez laisser des champs vides !</div>";
		}
	}

}



?>