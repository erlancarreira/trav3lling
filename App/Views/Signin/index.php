<div class="container">
    <div class="row">
        
        <div class="col-lg-6 col-md-12 col-sm-12 py-5 mx-auto">
           
            
            <?php  if(!empty($erro)): ?>
           <div>
               <div class="alert alert-warning" role="alert"><?php echo $erro ?></div>
           </div>
           <?php endif; ?>

           <div class="bg-primary m-0">    
                <blockquote class="card-header font-weight-bold px-5 text-white text-uppercase"><i class="fa fa-sign-in mr-3" aria-hidden="true"></i>Sign In</blockquote>
            </div>
            <form class="box-shadow card-outline-secondary p-5 m-0" action="<?php echo BASE; ?>login/entrar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" value="<?= (isset($cookie_user) ? $cookie_user: '') ?>" placeholder="email"  required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="<?= (isset($cookie_password) ? md5($cookie_password): '') ?>" placeholder="*******"  required>
                </div>
                 <div class="form-check">
                    <input type="checkbox" name="remember_me" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                  </div>

                <button type="submit" class="btn btn-success  w-100">Log In</button>
            </form>
        </div>
       <!-- <div class=" col-md-3"></div> -->
    </div>
</div>