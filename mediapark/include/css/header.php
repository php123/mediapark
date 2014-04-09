  <div id="header">
              <a href="http://localhost/mediapark/index.php"><h1></h1></a>
              <div id="nav">
                  <a class="home" href="index.php" ></a>
                  <?php if(isset($_SESSION["user"])): echo "<a href='#'>".$_SESSION['user']."</a> |"; endif;  ?>
                  <?php if(isset($_SESSION["manager"])): echo "<a href='storeadmin/index.php'>".$_SESSION['manager']."</a> |"; endif;  ?>
                  <?php if( !isset($_SESSION["user"]) and !isset($_SESSION["manager"]) ): ?>
                  <a href="login_inscription.php" class="inscription-login" ></a> | <?php endif; ?>
                  <span class="panier" ><a href="panier.php"> <?php if(isset($_SESSION['panier'])) echo count($_SESSION['panier']); ?> <img style="display : inline" src="./include/images/shopping.png"  valign="middle" /></a></span>
                  <?php if(isset($_SESSION['user']) || isset($_SESSION["manager"]) ): echo "  <a href='logout.php' class='logout' ></a>"; endif ?>
              </div><!-- end nav -->
             <div class="clear"></div>