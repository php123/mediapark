<?php
      require "include/css/head.php";
?>
<body>
  <div id="wrapper">
   
      <div id="inner">
                <?php   require "include/css/header.php";  ?>
              </div>
                <div id="bodyarticle">            
              	
              			<?php
                			if(isset($_GET['id']) && !empty($_GET['id']) ){
  							
          							$id = intval(abs($_GET['id']));
          							$row = $DB->__query(" * ", " articles LEFT JOIN likes ON articles.id_article=likes.id_article WHERE articles.id_article=:id " , array("id" => $id) );
                        if(empty($row)){
                          echo "<div class='no'> Impossible d'afficher l'article demandé ! </div>";
                          echo "<br /><center><img src='./include/images/sad-face.png' /></center>";
                        }
                        foreach ($row as $k) {
						        ?>

                    <table cellspacing="20" width="1000" >
                      <tr> 
                        <td><img width="215"  height="320" src="./storeadmin/posters/<?php echo $k->poster; ?>" /></td>
                        <td valign="top" >
                         <div class="titlearticle" ><h1><?php echo $k->title; ?></h1><?php if(isset($_SESSION['manager'])){ echo "<a style='color : #5D5D5D;' href='./storeadmin/index.php?do=modifarticle&id=".$k->id_article."'><sub>EDIT</sub></a>"; } ?><br /><?php echo $k->category; ?><br /><?php echo $k->quantite." DVD en Stock "; ?></div>
                         <div class="description" ><?php echo $k->description; ?></div>
                         <div class="notearticle" > <?php echo $k->note." <img src='./include/images/imdb.png' valign='middle' />";  ?> </div>
                         <div class="like"> <?php echo $k->like." <img src='./include/images/like.png' />"; ?></div>
                          <span><span style="font-size : 16px; top : 10px; position:relative; " > Trailer :  </span><a href="<?=$k->trailer  ?>" target="_blank" ><img src="./include/images/youtube.png" style="display : inline" valign="middle" /></a></span>
                        </td>
                        <td>
                            <center><div class="buy" ><a href=" ?do=addtocart&id=<?=$k->id_article; ?>"><img src="./include/images/addtocartbig.png" /></a></div></center>
                        </td>
                      </tr>
                    </table>
              	   <?php
                    }//endforeach
                    }//endif
                    else{
                        echo "<div class='no'> Impossible d'afficher l'article demandé ! </div>";
                        echo "<br /><img src='./include/images/sad-face.png' />";
                   }
                   ?>
              	</div><!-- BODY -->
                
                <?php  require "include/css/footer.php";  ?>
          
      </div><!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>