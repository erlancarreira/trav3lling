             <!-- <?php //var_dump($lugares); exit; ?> -->
              <div class="container"> 
              <?php if (isset($lugares) && !empty($lugares)): ?>                   
                  <div class="col">  
                    <div class="row"> 
                     <?php  foreach ($lugares as $lugar => $listar): ?>                     
                     <div class="col-md-6 my-3">  
                        <div class="form-horizontal box-shadow">                        
                            <div id="<?= $listar['id']; ?>" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators d-none">
                                  <?php foreach ($listar['img_slider'] as $key => $value): ?>                                                                                                            
                                  <li data-target="#<?= $value['id_post'] ?>" data-slide-to="<?= $key; ?>" class="<?php echo ($key == 0 ?  'active' : '');?>"></li> 
                                  <?php endforeach; ?>   
                                
                                </ol>
                                  
                                  <div class="carousel-inner">
                                    
                                  <?php foreach ($listar['img_slider'] as $key => $value): ?>
                        
                                  <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
                                       
                                      <img class="img-fluid" style="height: 315px;" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['url'] ?>" alt="First slide">
                                      
                                      
                                  </div>

                                  <?php endforeach; ?>  
                                     
                                  <?php if(sizeof($listar['img_slider']) > 1): ?>
                                  <a class="carousel-control-prev" href="#<?= $value['id_post'] ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#<?= $value['id_post'] ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                 <?php endif; ?>
                                                 
                                    
                                </div>

                                
                             </div>                            
                            

                            <div class="col d-flex flex-wrap p-3">
                              <div style="display: block; width: 64px; margin: -50px auto 0;"  class="d-block mx-auto align-middle">  

                            <i style="z-index: 2; box-shadow: 3px" class="p-2 bg-white text-primary rounded-circle <?= ($listar['category_name'] == 'hotel and line resorts' ? "fa fa-hotel fa-3x" : "fa fa-home fa-3x");  ?>"></i>   
                            </div>    
                              <h5 class="text-dark w-100"><?= $listar['title']; ?></h5>
                              <p class="card-text desc w-100 readmore" id="desc"><?= $listar['description']; ?></p>
                              <p class="card-text mr-3"><b> Address: </b><?= $listar['address_line']; ?></p>
                              
                              <p class="card-text mr-3"><b> City: </b><?= $listar['city']; ?></p>  
                              <p class="card-text mr-3"><b> State: </b><?= $listar['state']; ?></p>
                              <p class="card-text mr-3"><b> Zip: </b><?= $listar['zip']; ?></p>
                              <p class="card-text mr-3"><b> Country: </b><?= $listar['country']; ?></p>
                            
                              <p class="card-text mr-3"><b>Min Days: </b><?= $listar['min_days']; ?></p>                              
                              <p class="card-text mr-3"><b>Max Days: </b><?= $listar['max_days'] ?></p>
                  
                              <div class="mr-2">
                                <ul class="list-inline"><b>Skills: </b>
                                  <?php  foreach ($listar['skill'] as $skill): ?>  
                                    <li class="mr-2 list-inline-item"><?= $skill['name']; ?></li>
                                  <?php endforeach; ?>
                                </ul>                              
                              </div> 
                              <div class="mr-2">
                                <ul class="list-inline"><b>Languages: </b> 
                                <?php  foreach ($listar['linguas'] as $lingua):  ?>  
                                  <li class="mr-2 list-inline-item"><?= $lingua['name'];?></li>
                                <?php endforeach; ?>
                                </ul>
                              </div>  
                              <div class="my-2 form-inline">
                              
                            
                                <form method="POST" action="<?= BASE; ?>subscribes/add" class="mr-3">
                                  <input type="hidden" name="postTitle" value="<?= $listar['title'];  ?>">
                                  <input type="hidden" name="id_post" value="<?= $listar['id'];  ?>">
                                  <input type="hidden" name="id_user_to" value="<?= $listar['id_user'];  ?>">                              
                                  <button type="submit" name="subscribe" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-check text-white mr-2" aria-hidden="true"></i>Subscribe</button> 
                                  
                                </form> 
      
                                <form method="POST" action="<?= BASE; ?>inbox/send"> 
                                  <input type="hidden" name="postTitle" value="<?= $listar['title'];  ?>">
                                  <input type="hidden" name="id_post" value="<?= $listar['id'];  ?>">
                                  <input type="hidden" name="id_user_to" value="<?= $listar['id_user'];  ?>">
                                  <input type="hidden" name="id_user" value="<?= $_SESSION['user'];  ?>">                                
                                  <button type="submit" name="inbox" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-comment mr-2" aria-hidden="true"></i>Inbox</button>
                                  
                                </form>   
                              
                             
                                </div>   
                            
                                                          
                          </div>
                          
                                               
                        </div>
                        </div>
                       <?php endforeach; ?>   
                       
                    </div>  
                  </div>  
                      
                    
                   
                                 
        
       
               <?php else: ?>

               <div>
                    <h5>Parece que não encontramos o resultado para a sua pesquisa!</h5>
               </div>
            <?php endif; ?>   
            </div>
               