<?php

session_start();
if (!isset($_SESSION['manager'])){
	header("Location: ../login_inscription.php");
	exit();
}
require "cssadmin/head.php";
?>
<body>
  <div id="wrapper">
	<div id="header">
			<a href="../index.php"><h1 class="logo"></h1></a>
			<div id="nav">
				<a class="home" href="../index.php" ></a>
				<?php if(isset($_SESSION["manager"])): echo "<a href='index.php'>".$_SESSION['manager']."</a> |"; endif;  ?>
				<?php if(!isset($_SESSION["manager"])): ?><a href="#">articles()</a><?php endif; ?>
				 <span class="panier" ><a href="../panier.php"> <?php if(isset($_SESSION['panier'])) echo count($_SESSION['panier']); ?> <img style="display : inline" src="./include/images/shopping.png"  valign="middle" /></a></span>
				<?php if(isset($_SESSION['user']) || isset($_SESSION["manager"]) ): echo " <a href='../logout.php' class='logout' ></a>"; endif ?>
				</div><!-- end nav -->
		<div class="clear"></div>
	</div><!-- HEADER -->

  	<?php if(!isset($_GET['do'])){  ?>

  	<div id="panel">
		 
			<table class="table" align="center" cellspacing="30" width="900" cellpadding="8" border="0">
				<tr><td class="tdheader" colspan="6" align="center" >Panel d'Administration</td></tr>
				<tr> 
					<td><img src="./include/images/home.png" alt="home" title="Home" /></td>
					<td><img src="./include/images/members.png" alt="members" title="memebers" /></td>
					<td><img src="./include/images/addarticle.png" alt="addarticle" title="addarticle" /></td>
					<td><img src="./include/images/showarticle.png" alt="show articles" title="show articles" /></td>
					<td><img src="./include/images/Donate.png" alt="Factures" title="factures" /></td>
					<td><img src="./include/images/stats.png" alt="statistiques" title="statistiques" /></td>
				</tr>
				<tr> 
					<td><a href="../index.php" >Home</a></td>
					<td><a href=" ?do=showmembers" >Les Membres</a></td>
					<td><a href=" ?do=addarticle" >Ajouter Un Article</a></td>
					<td><a href=" ?do=showarticles" >Aficher Les Articles</a></td>
					<td><a href=" ?do=factures" >Payement Des Factures</a></td>
					<td><a href=" ?do=stats" >statistiques</a></td>
				</tr>
			</table>
		
	</div><!-- HIGHCLOUD PANEL -->

	

	<?php
		}else{
			require "requests.php";
		}
	?>

  </div><!-- end wrapper -->
</body>
</html>
