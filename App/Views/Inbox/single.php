
<div class="container py-4">
  <div class="row">
    <div class="col-md-12 ">
      <?php  if(!empty($_SESSION['sMsg'])): ?>
       <div class="my-3">
        <div class="alert alert-warning my-0 border-0 box-shadow" role="alert"><?php echo $_SESSION['sMsg']; ?>       
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>

       </div>
     </div>
     <?php unset($_SESSION['sMsg']); endif; ?>
     <form method="POST">
      <div class="card panel-info">
        <div class="card-header bg-primary ">
          <h5 class="text-white">Welcome to chat!</h5>
        </div>     
      <div id="navbar-swix">
        <ul class="m-0 p-0" role="tablist">
          <?php if (!empty($listMsg)): ?> 
                
            <li class="media ">
              <div class="col">
                <div class="row">
                              
                  <div class="col-md-4 p-0 " data-spy="scroll" data-target="#navbar-swix" data-offset="0" class="scrollspy-example">
                    <?php for ($i=0; $i < count($Pagination); $i++) {  ?>
                    <!-- <?php //foreach ($Pagination as $key => $value) { ?> -->
                
                  <button type="submit" class="bg-transparent" name="user_chat" value="<?= $Pagination[$i]['user_chat'] ?>">
                    
                    <a href="<?= BASE; ?>chat?=<?= (!empty($Pagination[$i]['user_chat'])) ? $Pagination[$i]['user_chat'] : ''; ?>" style="text-decoration: none">
                  </button>    
               
                      <div class=" bg-dark p-4"> 
                        <img src="<?= BASE; ?>App/assets/img/account/places/<?= (!empty($Pagination[$i]['post_img'])) ? $Pagination[$i]['post_img']: ''; ?>" class="rounded-circle clearfix float-left mr-3 mb-3" style="width: 64px; height: 64px;">
                          <small class="text-white m-0 text-left "> <?= (!empty($Pagination[$i]['post_title'])) ? $Pagination[$i]['post_title'] : ''; ?> </small>
                      
                      </div>
                    </a>
                  <?php  }  ?>  
                  </div> 
               
                   

                  <div class="col-md-8 p-0" > 
              <?php foreach ($listMsg as $key => $value) { ?>      
                    <div class="clearfix <?= ($value['user_id'] == $_SESSION['user'] ? 'bg-light' : ''); ?> col p-3">       
                      <a class="<?= ($value['user_id'] == $_SESSION['user'] ? 'float-left' : 'float-right'); ?> mr-3" href="#">
                        <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/users/<?= ($_SESSION['user'] == $value['user_id'] ? $viewData['url'] : $value['user_img']);  ?>" />
                      </a>
                      <div class="col-md-10 <?= ($_SESSION['user'] == $value['user_id'] ? 'float-left' : 'float-right'); ?> py-2">     
                        <div class="media-body">
                         <p class="p-0 m-0"><?= $value['message']; ?></p>  
                       </div>    
                       <div class="p-0">
                        <small class="text-muted"><?= ($value['user_id'] == $_SESSION['user'] ? $viewData['name'] : $value['user_name']); ?> | <?= $value['data']; ?> </small>
                      </div>                                                                                        
                      <input type="hidden" name="id_user_to" value="<?= (!empty($value['user_id'])) ? $value['user_id'] : ''; ?>">
                      <input type="hidden" name="id_post" value="<?= (!empty($value['post_id'])) ? $value['post_id'] : ''; ?>">    
                    </div>
                  </div> 

              <?php  }  ?>    
                </div>
               
              </div>

            </div>      
          </li>

        <?php elseif (isset($_SESSION['post_id']) && !empty($_SESSION['post_id']) ): ?>
          <?php $this->loadView('inbox/chat', $viewData); ?>
        <?php else: ?>
          <div class="mb-3 py-5" style="min-height: 400px;">
            <div  class="form-inline mx-5">
              <a class="mr-3" href="#">
                <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/bot-icon.png" />
              </a>

              <h5 class="">Hey, <?= $viewData['name']; ?> you not have messages! Go to the search and start.</h5>
            </div>  
          </div>    
        <?php endif; ?>                    
      </ul>
    </div>  


      <div class="card-footer">

        <div class="input-group py-3">

          <input type="text" class="form-control" name="message" placeholder="Enter Message" aria-label="Enter Message" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">SEND</button>
          </div>
        </div>

      </div>




    </div>
  </form>
</div>
</div>
</div>
