<div class="container">
  <div class="row">
    <div class="col">
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
         
        <form method="POST" action="<?= BASE; ?>inbox/send">  
          <div class="col">    
            <div class="row">                                  
               <?php foreach ($list['host'] as $key => $value) { ?>
                <?php if ($key == 0): ?>                                
                  <div class="col-lg-4 <?= ($key == 0) ? $value['id_post'] : 'd-none'; ?>">                   
                    <div class="box-shadow my-3">
                          <img class="card-img-top" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['main_image']; ?>" alt="Card image" style="width:100%">
                            <div class="card-body">
                                <h4 class="card-text"><?= $value['title']; ?></h4>
                                <p class="card-text"><?= $value['description']; ?></p>
                                <input type="hidden" name="postTitle" value="<?= $value['title']; ?>">
                                <input type="hidden" name="id_post" value="<?= $value['id_post']; ?>">
                                <input type="hidden" name="id_user" value="<?= $_SESSION['user']; ?>">                                
                  
                             </div> 
                          </div>   
                  </div> 
                <?php else: ?>
                 <div class="col-lg-4"></div>  
                <?php endif; ?>
              <?php  } ?>      
             

    
               <div class="col-lg-8"> 
              <?php foreach ($list['freelancer'] as $key => $value) { ?>  
              
              <div class="bg my-3 p-3 box-shadow ">
                  <div class="float-left">
                    <div>
                    <img src="<?= BASE; ?>App/assets/img/users/<?= ($value['user_img']) ? $value['user_img'] : 'user-img.jpg'; ?>" class="img-fluid rounded-circle mr-3" style="max-width: 90px; float: left;"> 
                    </div>
                  </div>                                       
                          <div class="col position-relative ">
                            <div class="col">
                                <h4 class="card-text"><?= $value['name']?></h4>
                                <p class="card-text"><?= $value['bio']?></p>
                                <input type="hidden" name="id_user_to" value="<?= $value['id_freelancer']; ?>">
                                
                                
                                <ul class="list-unstyled d-flex justify-content-between">   
                                <div class="d-flex">  
                                <li class="">
                                  <blockquote class="mr-2">Skills</blockquote> 
                                <?php if (!empty($value['skills'])) : ?>      
                                 <?php foreach ($value['skills'] as $skill): ?>  
                                   <p class="mr-2 btn-sm btn btn-primary text-capitalize"><?= $skill['name']; ?></p>
                                 <?php endforeach; ?>
                                <?php endif ?>  
                                
                                </li>
                              
                                <li class="">  
                                   <blockquote class="mr-2">Languages</blockquote>
                                  <?php if (!empty($value['languages'])) : ?>  
                                  <?php foreach ($value['languages'] as $languages): ?>  
                                   <p class="mr-2 btn-sm btn btn-primary text-capitalize"><?= $languages['name']; ?></p>
                                 <?php endforeach; ?>
                                <?php endif ?> 
                                </li>
                            </div>
                            
                          
                            <div class="d-flex">   
                              <li class="">
                              <blockquote class="mr-2">Refuse</blockquote>                                      
                              <form method="POST" action="<?= BASE; ?>subscribes/notAccept">  
                                  <input type="hidden" name="id_post" value="<?= $value['id_post']; ?>" >
                                  <input type="hidden" name="id_user_to" value="<?= $value['id_freelancer']; ?>">   
                                  <button type="submit" class="btn bg-transparent border-0" >
                                  <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                  </button> 
                              </form>
                             
                              </li>
                              <li class=" "> 
                               <blockquote class="mr-2">Accept</blockquote>  
                               <form method="POST" action="<?= BASE; ?>subscribes/accept"> 
                                  <input type="hidden" name="id_post" value="<?= $value['id_post']; ?>" >
                                  <input type="hidden" name="id_user_to" value="<?= $value['id_freelancer']; ?>">
                                  <button type="submit" class="btn bg-transparent border-0">
                                    <i class="fa fa-check fa-2x" aria-hidden="true"></i>
                                  </button>
                                </form>    
                                 
                              </li>

                          
                          </div>
                     
                          
                            

 
                              </ul>
                            
                            
                             
                            
                                </div>
                               </div>
                          <div class="mt-2 clear"> 
                            <button type="submit" name="inbox" class="btn btn-primary border-0 text-white font-weight-bold"><i class="fa fa-comment mr-2" aria-hidden="true"></i>Inbox</button>  
                          </div>       

                    </div>

                    <?php  } ?>    
                    
                     </div>                    
                 
        </div>    
      </div>
    </form>           
      <div class="dropdown-divider"></div>
        
      <?php else: ?>             
            
              <div class="col alert-primary">
                <p>You have not received any proposal yet</p>
              </div>
            
           <?php unset($_SESSION['msgConfirm']); ?>

      <?php  endif; ?>     
   
</div>
</div>
</div>


