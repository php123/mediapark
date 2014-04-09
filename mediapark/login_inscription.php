<?php
      require "include/css/head.php";
?>

<body>
  <div id="wrapper">
      <div id="inner">

                <?php   require "include/css/header.php";  ?>

                    <!-- LOGIN -->
          </div>
          <?php if(isset($answerinscrip) && $answerinscrip == "inscri" ){ echo "<div class='hello' >L'inscription est términée avec success. Vous Pouvez Vous Connectez Maintenant ! <img src='./include/images/happy-face-green.png' /></div>"; } ?>
          <?php if(isset($answer) && $answer == "manager" ){ echo "<div  class='hello'>Bonjour ".$_SESSION["manager"]."&nbsp;&nbsp;&nbsp;<img src='./include/images/happy-face.png' valign='middle' /></div><meta http-equiv='refresh' content='2; url=storeadmin/index.php' />"; exit(); } ?>
          <?php if(isset($answer) && $answer == "user" ){ echo "<div   class='hello'>Bonjour Mr.".$_SESSION["user"]."&nbsp;&nbsp;&nbsp;<img src='./include/images/happy-face.png' valign='middle' /></div><meta http-equiv='refresh' content='2; url=index.php' />"; exit(); } ?>
          <div class="featured">
              <img src="./storeadmin/featuredcover/Cover.jpg" />
          </div>
          <?php if(isset($answer) && $answer != "user" && $answer != "manager" && $answer != "not found" ) : echo $answer; endif; ?>
          <?php if(isset($answerinscrip) && $answerinscrip != "inscri" ) : echo "<tr><td colspan='2'>".$answerinscrip."</td></tr>"; endif; ?>
          <?php if(isset($answer) && $answer == "not found" ) echo "<div class='no'>Erreur lors du connexion, Veuillez à nouveau saisir votre login et mot de passe.</div>"; ?>
          <div id="sectionleft" >
                <form action="login_inscription.php" method="POST">
                   <table class="table"  cellspacing="10" cellpadding="8" border="0">
                   	       <tr>
                              <td align="center" colspan="2" >Connexion</td>
                           </tr>
                   		<tr>
                   			<td>Login : </td><td><input type="text" name="username" /></td>
                   		</tr>
                   		<tr>
                   			<td>Mot de pass : </td><td><input type="password" name="password" /></td>
                   		</tr>
                          <tr><td></td></tr>
                           <tr><td align="center" colspan="2" ><img src="./include/images/bluelogo.png"  /></td></tr>
                          <tr><td></td></tr>
                          <tr>
                                <td align="center" colspan="2" ><input type="submit" name="login" value="Connexion" </td>
                          </tr>
                   </table>
                </form>
          </div><!-- SECTION LEFT -->

            <!-- INSCRIPTION -->

        <div id="sectionright">
                 <form action="" method="POST">
                   <table class="table"  cellspacing="10" cellpadding="8" border="0">
                      <tr><td align="center" class="tdheader" colspan="2" >Inscription</td></tr>
                      <tr>
                        <td>Nom d'utilisateur : </td><td><input type="text" name="username" /></td>
                      </tr>
                      <tr>
                        <td>E-Mail : </td><td><input type="email" name="e-mail" /></td>
                      </tr>
                      <tr>
                        <td>Mot de pass : </td><td><input type="password" name="password" /></td>
                      </tr>
                      <tr>
                        <td>Pays : </td>
                        <td>
                          <select name="country" >
                            <option value="Maroc" selected="selected" >Maroc</option>
                            <option value="France" >France</option>
                            <option value="Palestine" >Palestine</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Sexe : </td>
                        <td>
                          <input type="radio" id="radio-1-2" class="regular-radio" name="sexe" value="homme" /><label for="radio-1-2"></label> homme
                          <input type="radio" id="radio-1-3" name="sexe" class="regular-radio" /><label for="radio-1-3"></label> femme
                        </td>
                      </tr>
                      
                      <tr><td colspan="2" align="center" > <input type="submit" name="signup" value="inscription" /></td></tr>
                   </table>
                </form>
        </div><!-- SECTION RIGHT -->

        <div id="sectioncenter">
          <table class="table"  cellspacing="10" cellpadding="8" width="360" >
            <tr><td class="tdheader" colspan="3">Suivez Nous Sur :</td></tr>
            <tr>
              <td align="center" ><a href="#"  ><img src="include/images/facebook.png" alt="facebook" /></a></td>
              <td align="center" ><a href="#"><img src="include/images/twitter.png" alt="twitter" /></a></td>
              <td align="center" ><a href="#"><img src="include/images/googleplus.png" alt="google+" /></a></td>
            </tr>
          </table>

          <table class="table"  cellspacing="10" cellpadding="8" width="360">
            <tr><td colspan="2" class="tdheader" > Hello Guest ! </td></tr>
            <tr><th align="center" >Connectez Vous</th><th align="center" >Inscription</th><tr>
            <tr><td align="center" ><img src="include/images/connectionsmiley.png" alt="" /></td><td align="center" ><img src="include/images/inscriptionsmiley.png" alt="" /></td><tr>
          </table>
        </div>
      <div class="clear"></div>
          <?php  require "include/css/footer.php";  ?>

      </div><!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>
