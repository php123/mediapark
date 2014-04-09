<?php
      require "include/css/head.php";
?>
<body>
  <div id="wrapper">
   
      <div id="inner">
          
                <?php   require "include/css/header.php";  ?>
                <form action="" method="POST">
               <table align="center" cellspacing="10" cellpadding="8" border="0">
               	
               		<tr>
               			<td>Nom d'utilisateur : </td><td><input type="text" name="username" /></td>	
               		</tr>
               		<tr>
               			<td>E-Mail : </td><td><input type="text" name="e-mail" /></td>
               		</tr>
               		<tr>
               			<td>Mot de pass : </td><td><input type="password" name="password" /></td>
               		</tr>
               		<tr>
               			<td>Adresse : </td><td><textarea name="adresse" cols="20" rows="4" ></textarea></td>
               		</tr>
               		<tr>
               			<td>Pays : </td><td>
               				<select name="country" >
               					<option value="MA" >Maroc</option>
               					<option value="FR" >France</option>
               					<option value="PS" >Palastine</option>
               				</select>
               			</td>
               		</tr>
               		<tr>
               			<td>Ville : </td><td><input type="text" name="city"  /></td>
               		</tr>	
               		<tr>
               			<td>Sexe : </td>
               			<td>
               				<input type="radio" name="sexe" value="homme" /> homme
               				<input type="radio" name="sexe" value="femme" /> femme
               			</td>
               		</tr>
               		<tr>
               			<td>Age : </td><td><input type="text" name="age" size="2" /></td>
               		</tr>
               		<tr><td colspan="2" align="center" > <input type="submit" name="signup" value="inscription" /></td></tr>
               </table>
          	</form>
                <?php  require "include/css/footer.php";  ?>
      </div><!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>
