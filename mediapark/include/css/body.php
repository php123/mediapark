</dl>  
          <div id="body">
              
              <div class="inner">
            <!-- RECHERCHE -->
                      <?php if(isset($erreurpanier)) echo $erreurpanier; ?>
            <?php  if(isset ($_GET['search']) && !empty($_GET['searchquery']) ) {
            
                    $searcharticle = $_GET['searchquery'];
                    $erreursearch = $article->searchArticle($searcharticle);
                    if($erreursearch == false){
                      echo "<div class='no'> L'article demandé est introuvable </div>";
                    }else{
                      $i = 0;
                      echo "<table cellspacing='7' width='995' >";
                      foreach ($erreursearch as $k) {
                         
                         
                          if ($i  === 0 ){
                              echo "<tr>";
                          }
                      ?>
  
                          <td>
                              <center><a href="article.php?id=<?=$k->id_article ?>" ><h3 class="itemtititle" ><?=$k->title  ?></h3></a></center>
                              <center><img src="./storeadmin/posters/<?=$k->poster; ?>" width="200" height="250" alt="photo 1" /></center>
                              <div class="price" ><b>DH</b> <b><?=$k->prix;?></b></div>
                              <center><div class="buy" ><a href=" ?do=addtocart&id=<?=$k->id_article; ?>"><img src="./include/images/addtocart.png" /></a></div></center>
                          </td>

                      <?php
                            $i++;
                            if ($i  === 4 ){
                                  echo "</tr>";
                                  $i = 0;
                            }
                       }
                         if($i != 4 ){
                                     echo "</tr></table>";
                          } 
                    }
            }else{ ?>

                      <!-- END RECHERCHE -->
                      <table cellspacing="14" width="995"  >
                         <?php

                               $row = $pagination->pagination();
                               if($row != false){
                               $i = 0;
                               foreach ($row as $k):
                                    if ($i  === 0 ){
                                            echo "<tr>";
                                    }
                                ?>
                                  <td width="240" >
                                          <center><a href="article.php?id=<?=$k->id_article ?>" ><h3 class="itemtititle" ><?=$k->title  ?></h3></a></center>
                                          <center><img src="./storeadmin/posters/<?=$k->poster; ?>" width="200" height="250" alt="photo 1" /></center>
                                          <div class="price" ><b>DH</b> <b><?=$k->prix;?></b></div>
                                          <center><div class="buy" ><a href=" ?do=addtocart&id=<?=$k->id_article; ?>"><img src="./include/images/addtocart.png" /></a></div></center>
                                  </td>
                                  <?php
                                          $i++;
                                          if ($i  === 4 ){
                                                echo "</tr>";
                                                $i = 0;
                                          }
                                  endforeach;

                                  if($i != 4 ){
                                     echo "</tr>";
                                  }

                                  ?>
                                  
                                    <tr>
                                      <td style="height : 20px;" colspan="4" align="center" >
                                        <?php
                                                $pagination->pages();
                                                }else { 
                                                echo "<h1 style='font-size : 20px' >Pas d'article pour le moment !</h1>";
                                                }

                                         ?>
                                      </td>
                                    </tr>
                                  </table>
                  
                 <?php } ?>

                      

                      
              </div><!-- end .inner -->





























