<div class="container py-3">
  <div class="row">
    <?php  if(!empty($_SESSION['msgConfirm'])): ?>  
    <div class="col">
      <div class="alert alert-warning my-0 border-0" role="alert"><script> alert('<?php echo $_SESSION['msgConfirm']; ?>'); </script>
     
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
   </div>
 <?php endif; ?>
    <?php  if(!empty($msg)): ?>  
      <div class="col-md-12">
        <div class="">
         
          <div class="alert alert-warning" role="alert"><?= $msg ?><?= $TotalSubs ?> propostas</div>
    
        </div>
      </div>   
     
                                                                               
             
              <div class="col">
                <div class="row">
                
                
  
                  <div class="col-md-4"> 
                <?php foreach ($Host as $value)  { ?>                                
                    <div class="box-shadow my-3">
                          <img class="card-img-top" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['main_image']?>" alt="Card image" style="width:100%">
                            <div class="card-body">
                              <?= $value['id']?>
                                <h4 class="card-text"><?= $value['title']?></h4>
                                <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                             </div> 
                          </div>   
                <?php } ?>    
                 
                  </div>   
              
               <div class="col-md-8"> 
            <?php foreach ($Freelancer as $freel)  { ?>     
              <div class="bg my-3 p-3 box-shadow">
                  <img src="<?= BASE; ?>App/assets/img/user-img.jpg" class="img-fluid rounded-circle mr-3" style="max-width: 150px; float: left;"> 
                     
                          <div class="col position-relative ">
                            <div class="col">
                                <h4 class="card-text"><?= $freel['name']?></h4>
                                <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                <div class="form-inline">
                                <div class="">
                                  <blockquote class="mr-2">Skills</blockquote>    
                                  <p class="mr-2 btn-sm btn btn-primary">Master Chef</p>
                                </div>
                                <div class="">
                                  <blockquote class="mr-2">Languages</blockquote>
                                  <p class="btn-sm btn btn-primary">Ingles</p>
                                  <p class="btn-sm btn btn-primary">Frances</p>
                                  <p class="mr-2 btn-sm btn btn-primary">Espanhol</p>
                                </div>
                             
                                 <div class="form-inline" style="position: absolute; right: 0;" >
                                  
                                  <blockquote></blockquote>                                     
                              <form method="POST" action="<?= BASE; ?>subscribes/notAccept">  
                                  <input type="hidden" name="id_post" value="<?= $freel['id']; ?>" >
                                  <input type="hidden" name="id_user_to" value="<?= $freel['id_user_from']; ?>">   
                                  <button type="submit" class="btn bg-transparent border-0" >
                                  <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                  </button> 
                              </form>    
                               <form method="POST" action="<?= BASE; ?>subscribes/accept"> 
                                  <input type="hidden" name="id_post" value="<?= $freel['id']; ?>" >
                                  <input type="hidden" name="id_user_to" value="<?= $freel['id_user_from']; ?>">
                                  <button type="submit" class="btn bg-transparent border-0">
                                    <i class="fa fa-check fa-2x" aria-hidden="true"></i>
                                  </button>
                                </form>    
                                 
                                 
                                </div>
                              
                              </div> 
                                </div>
                               </div>                           
                               </div>
                    <?php } ?>   
                    </div>             
              <?php  else: ?>             
            <div class="col alert-primary">
              <div class="col">
              <h5>You have not received any proposal yet</h5>
              </div>
            </div>
           
                
           <?php unset($_SESSION['msgConfirm']); endif; ?>
          
      </div>    
     </div>
      <div class="dropdown-divider"></div>
        
     
   
</div>
</div>

