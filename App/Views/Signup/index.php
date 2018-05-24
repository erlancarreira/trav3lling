<div class="container">
    <div class="row">
        
        <div class="col-lg-6 col-md-12 col-sm-12 py-5 mx-auto">
            
            <?php  if(!empty($msg)): ?>
               <div class="my-3">
                  <div class="alert alert-warning my-0 border-0 box-shadow" role="alert"><?php echo $msg ?>       
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                    
                  </div>
               </div>
            <?php endif; ?>
            
            <div class="bg-primary m-0">    
                <blockquote class=" card-header font-weight-bold px-5 text-white text-uppercase"><i class="fa fa-user-plus mr-3" aria-hidden="true"></i>Register</blockquote>
            </div>
            <form class="box-shadow card-outline-secondary m-0 p-5" action="<?php echo BASE; ?>register/go" method="post" id="form_cadastro">

                <div class="form-group ">
                    <label for="nome">Name</label>
                    <input type="text" class="form-control"  name="name" placeholder="Your name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="*******" required>
                </div>            
                <div class="form-group">
                    <label for="password">Set password</label>
                    <input type="password" class="form-control" name="checkPass" placeholder="*******" required>
                </div>  
                <button type="submit" class="btn btn-success w-100">Register</button>                   
                 
            </form>
        </div>
       <!-- <div class=" col-md-3"></div> -->
    </div>
</div>