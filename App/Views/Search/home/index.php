              <?php if(isset($home) > 0 && !empty($home)): ?>
              <div class="col bg-dark">   
              <div class="row">
                 

                    <?php foreach ($home as $key => $listar): ?> 
                                     
                      
                      <div class="col-lg-4 col-md-12 p-0">
                        <?php if (!empty($listar['img_slider']) && $listar['img_slider'] != null): ?>
                        <div id="<?= $listar['id']?>" class="carousel slide" data-ride="carousel">
                         
                        
                        <?php if (sizeof($listar['img_slider']) > 1): ?>  
                          <ol class="carousel-indicators">            
                            <?php foreach ($listar['img_slider'] as $indice => $value): ?>  
                              <li data-target="#<?= $listar['id']?>" data-slide-to="$indice" class="<?php echo ($indice == 0 ?  'active' : '');?> "></li> 
                            <?php endforeach; ?>                                     
                             
                          </ol>
                          <?php endif; ?>   
                         
                          <div class="carousel-inner bg-white">
                          <?php foreach ($listar['img_slider'] as $indice => $value): ?> 
                            <div class="carousel-item <?= ($indice == 0 ? 'active' : ''); ?>">                              
                                <div class="w-100" style="background-color: #000; height: 100%; width: 100%; position: absolute;"></div>
                                <img class="img-fluid" style="min-height: 254px; opacity: 0.9;" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['url']; ?>" alt="<?= $listar['title']; ?>"> 
                              <div class="carousel-caption text-capitalize">
                                <h5 ><?= $listar['title']; ?></h5>
                                <p><?= $listar['category_name']; ?></p>
                                <form method="GET">
                                  <input type="hidden" name="id" value="<?= $listar['id']; ?>">
                                  <button type="submit" class="btn text-white border-0  bg-primary">View</button>              
                                </form>
                              </div>
                            </div>
                          <?php endforeach; ?>   
                          </div>

                          <?php if (sizeof($listar['img_slider']) > 1): ?>
                          <a class="carousel-control-prev" href="#<?= $listar['id']?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#<?= $listar['id']?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>  
                          <?php endif; ?>    
                        </div>
                        <?php endif; ?>          
                      </div> 
                    
                  <?php endforeach; ?>   
                 </div>
                </div>   
                <?php  else: ?> 
                 
            <div class="col alert-primary">
              Nenhum post cadastrado
            </div>
          <?php endif; ?>  
           
            
           
        

             
           
                 