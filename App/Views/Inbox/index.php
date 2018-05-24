
<div class="container">
  <div class="row">
    <div class="col-md-12 ">
      <?php  if(!empty($_SESSION['msg'])): ?>
       <div class="my-3">
        <div class="alert alert-warning my-0 border-0 box-shadow" role="alert"><?php echo $_SESSION['msg']; ?>       
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>

       </div>
     </div>
     <?php unset($_SESSION['msg']); endif; ?>
     <form method="POST">
      <div class="card panel-info">
        <div class="card-header bg-primary ">
          <h5 class="text-white">Welcome to chat!</h5>
        </div>     
    <!--  <?php// var_dump($Pagination); ?>   -->
    <!-- <?php //var_dump($listMsg); exit;?>  -->  
      <div id="navbar-swix">
        <ul class="m-0 p-0" role="tablist">
          <?php if (!empty($listMsg)): ?> 
              
            <li class="media ">
              <div class="col">
                <div class="row"> 
                <?= $this->loadView('inbox/aside', $viewData);  ?>             
                  <div class="col-md-8 p-0" data-spy="scroll" data-target="#navbar-swix" data-offset="20" class="scrollspy-example"> 
              <?php foreach ($listMsg as $key => $value) { ?> 

                    <div class="clearfix <?= ($value['user_id'] !== $_SESSION['user'] ? 'bg-light' : ''); ?> col p-3">       
                      <a class="<?= ($value['user_id'] == $_SESSION['user'] ? 'float-right' : 'float-left'); ?> mr-3" href="#">
                        <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/users/<?= ($_SESSION['user'] == $value['user_id'] ? $viewData['url'] : $value['user_img']); ?>" />
                      </a>
                      <div class="col-md-10 <?= ($_SESSION['user'] == $value['user_id'] ? 'float-left' : 'float-right'); ?> py-2">     
                        <div class="media-body">
                         <p class="p-0 m-0"><?= $value['message']; ?></p>  
                       </div>    
                       <div class="p-0">
                        <small class="text-muted"><?= ($value['user_id'] == $_SESSION['user'] ? $viewData['name'] : $value['user_name']); ?> | <?= $value['data']; ?> </small>
                      </div> 

                      <input type="hidden" name="id_user_to" value="<?= (!empty($value['user_id'])) ? $value['user_id'] : ''; ?>">
                      <input type="hidden" name="id_post" value="<?= (!empty($value['id_post'])) ? $value['id_post'] : ''; ?>"> 
                      <input type="hidden" name="chat_id" value="<?= (!empty($value['chat_id'])) ? $value['chat_id'] : ''; ?>">    
                    </div>
                  </div> 

              <?php  }  ?>    
                </div>
               
              </div>

            </div>      
          </li> 
        <?php else: ?>
          <?php $this->loadView('inbox/empty', $viewData); ?>
        <?php endif; ?>                                    
      </ul>
    </div>  
    <?php if (!empty($listMsg)): ?> 
      <div class="card-footer">
        <div class="input-group py-3">
          <input type="text" class="form-control" name="message" placeholder="Enter Message" aria-label="Enter Message" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">SEND</button>
          </div>
        </div>
      </div>
    <?php endif; ?>    
    </div>
  </form>
</div>
</div>
</div>
