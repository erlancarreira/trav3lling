<div class="container py-5">
      <?php  if(!empty($Places)): ?>   
        <div class="row">
        <?php foreach ($Places as $key ): ?>
        <?php foreach ($key as $value): ?>                   
          
          <div class="col-md-4"> 
          <div class="box-shadow">  
            <div class="position-relative p-0 ">             
                  <div id="<?= $value['id_post']; ?>" class="carousel slide" data-ride="carousel">

                  <ol class="carousel-indicators d-none">

                    <?php foreach ($value['img_slider'] as $key => $slide): ?>                                                                                                            
                    <li data-target="#<?= $slide['id_post']; ?>" data-slide-to="<?= $key; ?>" class="<?php echo ($key == 0 ?  'active' : ''); ?>"></li> 
                  <?php endforeach; ?>  
                  
                  </ol>
                    
                    <div class="carousel-inner">
                      
                      <?php foreach ($value['img_slider'] as $key => $slide): ?>
          
                      <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
                         
                        <img class="img-fluid" src="<?= BASE; ?>App/assets/img/account/places/<?= $slide['url']; ?>" alt="First slide">
                        
                      </div>
                    <?php endforeach; ?>  
                       
                    <?php if(sizeof($value['img_slider']) > 1): ?>
                    <a class="carousel-control-prev" href="#<?= $slide['id_post']; ?>" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#<?= $slide['id_post']; ?>" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                   <?php endif; ?>
                                   
                      
                 
                  </div>
                <div class="col text-white bg-success">
                    <blockquote class=" btn-sm py-2"><b>Congratulations you were confirmed here.</b></blockquote>             
                  </div>   

                  
               </div>  
              </div>
                
              <div class="card-body">
                <input type="hidden" name="id_post" value="<?= $value['id_post']; ?>">
                <h5 class="card-title"><?= $value['title']; ?></h5>
                <p class="card-text" style="max-height: 600px;"><?= $value['description']; ?></p>
               
              <?php if (!empty($userPhone)): ?>
                <?php foreach ($userPhone as $val): ?>
                  <p class="card-text"><?= $val['phone']; ?></p>
                <?php endforeach; ?>
              <?php endif; ?>
                 
              <form method="POST" action="<?= BASE; ?>inbox/send"> 
                <input type="hidden" name="postTitle" value="<?= $value['title']; ?>">
                <input type="hidden" name="id_post" value="<?= $value['id_post']; ?>">
                <input type="hidden" name="id_user_to" value="<?= $value['id_user']; ?>">
                <input type="hidden" name="id_user" value="<?= $_SESSION['user']; ?>">                                
                <button type="submit" name="inbox" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-comment mr-2" aria-hidden="true"></i>Inbox</button>
                                  
              </form>    
              </div>
            
                          
              </div>
              </div>

             
            <?php endforeach; ?>
            <?php endforeach; ?>
            </div>
            <?php  else: ?>             
            <div class="col alert-primary">
             
              You have not subscribe yet 

            </div>
              
           <?php endif; ?>  
        </div>
                 
              

