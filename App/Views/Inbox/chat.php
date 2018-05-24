        <div class="container py-5">
         <?php  if(!empty($_SESSION['msg'])): ?>
           <div class="my-3">
            <div class="alert alert-warning my-0 border-0 box-shadow" role="alert"><?php echo $_SESSION['msg']; ?>       
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>

       </div>
   </div>
   <?php unset($_SESSION['msg']); endif; ?>
   <div class="card panel-info">
    <div class="card-header bg-primary ">
      <h5 class="text-white">Welcome to chat!</h5>
  </div>  
  <form method="POST">      
      <div id="navbar-swix">

        <ul class="m-0 p-0" role="tablist">
            <li class="media ">

              <div class="col">
                <div class="row"> 
                   

                    <div class="col-md-12 p-0" data-spy="scroll" data-target="#navbar-swix" data-offset="20" class="scrollspy-example">  
                     <li class="media <?= (!empty($_SESSION['id_user_to']) && $_SESSION['id_user_to'] == $_SESSION['user'] ? 'bg-light' : ''); ?> py-2">

                        <div class="col">    
                           <div class="col-lg-6 <?= (!empty($_SESSION['id_user_to']) ? 'float-right' : 'float-left'); ?> py-2">     
                            <div class="media-body">
                                <div class="float-left mb-5"> 
                                    <a class="<?= (!empty($_SESSION['id_user_to']) && $_SESSION['id_user_to'] !== $_SESSION['user'] ? 'float-left' : 'float-right'); ?> mr-3" href="#">
                                        <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/account/places/<?= (!empty($_SESSION['Host_Post']['img'])) ? $_SESSION['Host_Post']['img'] : 'user-img.jpg'; ?>" />
                                    </a>
                                </div> 
                                <div></div> 

                                <h5><?= (!empty($_SESSION['Host_Post']['title'])) ? $_SESSION['Host_Post']['title'] : ''; ?></h5> 
                                <p class="p-0 m-0">Welcome, start chat with <?= (!empty($_SESSION['Host_Name'])) ? $_SESSION['Host_Name'] : ''; ?></p>  
                                <small class="text-muted"><?= ($_SESSION['id_user_to'] !== $_SESSION['user'] ? $_SESSION['Host_Name'] : $viewData['name']); ?></small>
                            </div>    




                        </div>

                    </div>


                </li>

                <div class="card-footer">

                    <div class="input-group py-3">

                      <input type="text" class="form-control" name="message" placeholder="Enter Message" aria-label="Enter Message" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">SEND</button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

</li>
</ul>

</div>
</form>  
</div>   