                <div class="container">

                  <?php  foreach ($postId as $lugar => $listar): ?>
                  <div class="my-5 box-shadow">
                    <div class="card-header bg-primary"> 
                     <h5 class="text-white"><?= $listar['title']; ?></h5>
                    </div>  

                    <div class="row">  

                    
                
                    <div class="col-12 col-sm-12 col-lg-6">
                        
                        <?php  if(!empty($msg)): ?>
                           <div>
                               <div id="#verMsg" class="alert msg alert-warning" role="alert"><?= $msg; ?></div>
                           </div>
                        <?php endif; ?>  
                     
                                                    
                                <div id="<?= $listar['id_post']; ?>" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators d-none">
                                  <?php foreach ($listar['img_slider'] as $key => $value): ?>                                                                                                            
                                  <li data-target="#<?= $value['id_post'] ?>" data-slide-to="<?= $key; ?>" class="<?php echo ($key == 0 ?  'active' : '');?>"></li> 
                                  <?php endforeach; ?>   
                                
                                </ol>
                                  
                                  <div class="carousel-inner">
                                    
                                    <?php foreach ($listar['img_slider'] as $key => $value): ?>
                        
                                    <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
                                       
                                      <img class="p-0  col-auto " src="<?= BASE; ?>App/assets/img/account/places/<?= $value['url'] ?>" alt="First slide">
                                      
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
                            
                      </div>        
                            <div class="col d-flex align-items-center m-0">
                            

                            <div class="card-block p-3 pb-0 ">
                            
                                
                            <div class="d-flex flex-wrap ">
                              
                              <p class="card-text w-100"><?= $listar['description']; ?></p>
                              <p class="card-text mr-3"><b> Address: </b><?= $listar['address_line']; ?></p>
                              
                              <p class="card-text mr-3"><b> City: </b><?= $listar['city']; ?></p>  
                              <p class="card-text mr-3"><b> State: </b><?= $listar['state']; ?></p>
                              <p class="card-text mr-3"><b> Zip: </b><?= $listar['zip']; ?></p>
                              <p class="card-text mr-3"><b> Country: </b><?= $listar['country']; ?></p>
                            
                              <p class="card-text mr-3"><b>Min Days: </b><?= $listar['min_days']; ?></p>                              
                              <p class="card-text mr-3 mb-3"><b>Max Days: </b><?= $listar['max_days'] ?></p>
                  
                              </div> 
                              <div class="d-flex flex-wrap">
                                
                                <ul class="mr-2 nav form-inline">
                                  <span>
                                    <b>Skills: </b>
                                  </span>
                                <?php  foreach ($listar['skill'] as $skill): ?>  
                                <li class="mx-1 my-2"><?= $skill['name']; ?></li> 
                                <?php endforeach; ?>
                                </ul>
                                
                               
                                <ul class="mr-2 nav form-inline">
                                  <span>
                                    <b>Languages: </b>
                                  </span> 
                                <?php  foreach ($listar['linguas'] as $lingua):  ?>  
                                  <li class="mx-1 my-2"><?= $lingua['name'];?></li>
                                <?php endforeach; ?>
                                </ul>
                               </div>
                            <?php if ($subscriber_status == 1) : ?>

                               <div class="my-2 add-post form-inline ">                           
                              <button type="button" class="btn btn-dark mr-3 font-weight-bold"><i class="fa fa-check text-white mr-2" aria-hidden="true"></i>Wait...</button>
                              <?php foreach ($postId as $key => $value): ?>  
                            <form method="POST" action="<?= BASE; ?>inbox/send" class="mr-3"> 
                              <input type="hidden" name="postTitle" value="<?= $value['title'];  ?>">
                              <input type="hidden" name="id_post" value="<?= $value['id_post'];  ?>">
                              <input type="hidden" name="id_user_to" value="<?= $value['id_user'];  ?>">
                             
                              <div class="mr-2">
                              
                              <button type="submit" name="inbox" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-comment mr-2" aria-hidden="true"></i>Inbox</button>
                              </div>
                            </form>   
                          
                             <?php endforeach; ?>


                            <?php else: ?>
                           
                              
                              <div class="my-2 form-inline">
                              <?php foreach ($postId as $key => $value): ?>  
                            
                            <form method="POST" action="<?= BASE; ?>subscribes/add" class="mr-3">
                              <input type="hidden" name="postTitle" value="<?= $value['title'];  ?>">
                              <input type="hidden" name="id_post" value="<?= $value['id_post'];  ?>">
                              <input type="hidden" name="id_user_to" value="<?= $value['id_user'];  ?>">                              
                              <button type="submit" name="subscribe" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-check text-white mr-2" aria-hidden="true"></i>Subscribe</button> 
                              
                            </form> 
  
                            <form method="POST" action="<?= BASE; ?>inbox/send"> 
                              <input type="hidden" name="postTitle" value="<?= $value['title'];  ?>">
                              <input type="hidden" name="id_post" value="<?= $value['id_post'];  ?>">
                              <input type="hidden" name="id_user_to" value="<?= $value['id_user'];  ?>">
                              <input type="hidden" name="id_user" value="<?= $_SESSION['user'];  ?>">                                
                              <button type="submit" name="inbox" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-comment mr-2" aria-hidden="true"></i>Inbox</button>
                              
                            </form>   
                          
                             <?php endforeach; ?> 
                            </div>   
                             
                            <?php endif; ?>  
                          
                          </div>

                        </div>  
                            
                            
                         
                        </div>  
                      
                    </div>
                   </div>
                  <?php endforeach; ?>                  
                </div>
       
            