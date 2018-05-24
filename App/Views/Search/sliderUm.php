                   
                    <?php foreach ($listagem as $key => $listar): ?> 
                      <div class="col-md-4 p-0">
                        <div id="<?= $listar['id']?>" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">

                            <?php
                           
                            foreach($imagens_post as $key => $img){
                             
                             
                                  
                                       
                           ?>
                                 <li data-target="#<?= $listar['id']?>" data-slide-to="<?= $key?>" <?php echo ($key == 0 ?  'class="active"' : '');?> ></li>
                           <?php 
                         
                       }
                            ?>
                          </ol>
                          <div class="carousel-inner bg-white">

                           
                           <?php foreach($imagens_post as $key => $img) {     
                           //$x = 0;
                             // for($x = 0;$x < count($img); $x++){      
                                              
                            ?>
                            
                            <div class="carousel-item <?php echo ($key == 0 ?  ' active':'')?>">
                                    
                               
                          
                              <img class="d-block w-100" src="<?= BASE; ?>App/assets/img/account/places/<?= $img['url']; ?>" alt="First slide">
                            
                              <div class="carousel-caption d-none d-md-block">
                                <h5><?= $listar['id']?></h5>
                                <p>...</p>
                              </div>
                             
                            </div>
                            <?php
                           
                           // }
                           }
                             ?>
                          </div>
                          <a class="carousel-control-prev" href="#<?= $listar['id']?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#<?= $listar['id']?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      </div>   
                  <?php endforeach; ?>   
                    
                 
                 