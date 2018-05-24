                      

                      <div class="row m-0 p-0">
                   
                      <?php foreach ($lugares as $key => $listar): ?>  

                        <div class="col-md-4 p-0"> 
                        <?= $listar['id']; ?> 
                          <div id="<?= $listar['id']; ?>" class="carousel slide" data-ride="carousel">                      
                              <ol class="carousel-indicators">
                                <?php 
                                  $n = 0;
                                   foreach ($listar['images'] as $key => $value):  
                                    $n++;

                                    $active = '';
                                    if($key == 1) {
                                      $active = 'active';
                                    }

                                    if($n != 0) {
                                      $r = $n - 1;
                                    }

                                    ?>                                                            
                                <li data-target="#<?= $value['id_post'] ?>" data-slide-to="<?= $r; ?>" class="<?= $active; ?>"></li> 
                                <?php endforeach; ?>   
                              
                              </ol>

                             
                          
                              <div class="carousel-inner">

                               <?php 
                              
                              foreach ($listar['images'] as $key => $value): 

                                $active = '';
                                if($key == 1) {
                                  $active = 'active';
                                }
                                
                              ?>
  
                                <div class="carousel-item <?= $active; ?>">
                                  <img class="d-block" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['url'] ?>" alt="California">
                                  <div class="carousel-caption">
                                    <h3 class="display-4">California</h3>
                                  </div>
                                </div>
                            <?php endforeach; ?>                            
                             
                              <a class="carousel-control-prev" href="#<?= $value['id_post'] ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                              </a>
                              <a class="carousel-control-next" href="#<?= $value['id_post'] ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Próximo</span>
                              </a>
                            </div>              
                        </div>    
                      </div>
                  <?php endforeach; ?>  
                  </div>   
                 
                 