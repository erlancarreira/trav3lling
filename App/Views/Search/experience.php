<!---VIEW EXPERIENCE-->
    <!--Start-->
            <div class="container mb-3">   
              <div class="">
                <h6 class="card-header text-uppercase bg-primary text-white">Experience</h6>
              </div> 
             
                <?php if(isset($listar['images']) > 0 && !empty($listar['images'])):  ?>           
                  <div class="row m-0 p-0 bg-dark text-white">
                   
                      <div class="row m-0 p-0">
                        <div class="col-md-4 p-0"> 
                        
                        <h6><?= $listar['id']; ?></h6>    
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

                      <div class="col-md-4 p-0"> 
                        <h6><?= $listar['id']; ?></h6>
                            
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
                    <!-- FIM -->

                    <div class="col-md-4 p-0"> 
                        
                         <h6><?= $listar['id']; ?></h6>   
                          <div id="carouselCidades" class="carousel slide" data-ride="carousel">                      
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
                                <li data-target="#carouselCidades" data-slide-to="<?= $r; ?>" class="<?= $active; ?>"></li> 
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
                             
                              <a class="carousel-control-prev" href="#carouselCidades" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselCidades" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Próximo</span>
                              </a>
                            </div>                          
                        </div>    
                   </div>

                  <!-- FIM -->    



                  </div>
               
           </div>
          <?php else: ?>  
            <div class="col alert-primary">
              Nenhum post cadastrado
            </div> 
          <?php endif; ?>   
        
        </div>
   
    <!--END-->
