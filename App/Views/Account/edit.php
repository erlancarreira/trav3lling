<section class="container">
   <?php  if(!empty($msg)): ?>
   <div class="col">
      <div class="alert alert-warning" role="alert"><?php echo $msg ?> 
        
        <div class="float-right">
          <button type="sumbit" name='click'>X</button>
        </div>
      </div>
   </div>
   <?php endif; ?>

   <div class="">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data">
         <div class="col">
            <div class="card">
               <div class="card-header"> 
                  <label for="add_foto">My places:</label>
               </div>
               <input type="file" class="p-3" name="photos">
               <div class="panel panel-default">
                  <div class="panel-heading">Images of places</div>
                  <div class="panel-body">
                   

                  </div>
               </div>
               
            </div>
         </div>

         <div class="bg-white pinside40 mb30">
            <div class="form-group">
               <label class="col control-label" for="name">Title</label>
               <div class="col">
                  <input id="title" name="title" type="text" placeholder="" class="form-control input-md">
               </div>
            </div>
         </div>
         <div class="form-group">
            <label class="col control-label" for="">Description</label>
            <div class="col">
               <textarea type="text" name="description" placeholder="" style="height: 200px;" class="form-control input-md"></textarea>
            </div>
         </div>
         <address>
            <div class="form-group">
               <label class="col control-label" for="">Address Line</label>                                     
               <div class="col">
                  <input type="text" name="address_line" placeholder="" class="form-control input-md">
               </div>
            </div>
            <div class="form-horizontal">
               <div class="col">
                  <div class="row"> 
                        <div class="col-md-2">
                           <label class="control-label" for="">City</label>
                           <input type="text" name="city" placeholder="" class="form-control input-md">
                        </div>
                        <div class="col-md-2">
                           <label class="control-label" for="">State</label>
                           <input type="text" name="state" placeholder="" class="form-control input-md">
                        </div>
                     <div class="col-md-2">
                        <label class="control-label" for="">Zip / Postal Code</label>
                        <input type="text" name="zip" placeholder="" class="form-control input-md">
                     </div>
                     <div class="col-md-2">
                        <label class="control-label" for="">Country</label>
                        <input type="text" name="country" placeholder="" class="form-control input-md">
                     </div>
                  
                     <div class="col-md-2">
                       <label class="control-label" for="">Min. Days</label>                   
                       <input type="number" name="min_days" placeholder="Min. Days" class="form-control input-md">                      
                     </div>

                     <div class="col-md-2">
                       <label class="control-label" for="">Max. Days</label>                      
                       <input type="number" name="max_days" placeholder="Max. Days" class="form-control input-md"> 
                     </div>
                   </div> 
               </div>
               
               </div>
               </address>   
                <div class="form-group p-0">
                 <label class="col control-label" for="name">Skills</label>
                 <div class="col">
                    <input id="skils" name="skills_name" type="text" placeholder="" class="form-control input-md" >
                 </div>
              </div>
              </div>    
              <div class="form-group">
                 <label class="col control-label" for="">Idiomas</label>
                 <div class="col form-inline">
                    <select name="languages_name[]"  class="" multiple="multiple" style="border: none; overflow: hidden; display: inline-block; outline: none; height: 35px">
                       <option type="radio" name="languages_ingles" class="form-control mr-2 input-md"> Inglês </option>
                       <option type="radio" name="languages_portugues" class="form-control mx-2 input-md"> Português </option>
                       <option type="radio" name="languages_alemao" class="form-control mx-2 input-md"> Alemão </option>
                       <option type="radio" name="languages_espanhol" class="form-control mx-2 input-md"> Espanhol </option>
                       <option type="radio" name="languages_frances" class="form-control mx-2 input-md"> Francês </option>
                       <option type="radio" name="languages_italiano" class="form-control mx-2 input-md"> Italiano </option>
                    </select>
                 </div>
              </div>
              </div>
              <div class="col mb-4">
                 <input type="submit" class="btn btn-primary btn-block" value="Save" /> 
              </div>
              </form> 

              </section>

              <div class="dropdown-divider"></div>

  
              <?php if(!empty($lugares)): ?>


              
                <div class="container py-4">
                  <div class="row">  
                  <?php  foreach ($lugares as $lugar => $listar): ?>

                    <div class="col-md-6">
                    
                    <div class="d-flex col">
                      
                      <div class="card mb-3">
                        <div> 
                          <img class="card-img-top img-fluid mw-100" src="public/assets/images/places/<?= $listar['url']; ?>" alt="<?= $listar['title']; ?>">
                        </div>
                        <div class="card-body">
                          <h5 class="card-title"><?= $listar['title']; ?></h5>
                          <p class="card-text"><?= $listar['description']; ?></p>
                          <p class="card-text"><b> Address: </b><?= $listar['address_line']; ?></p>
                          <div class="d-flex flex-wrap">
                          <p class="card-text mr-3"><b> City: </b><?= $listar['city']; ?></p>  
                          <p class="card-text mr-3"><b> State: </b><?= $listar['state']; ?></p>
                          <p class="card-text mr-3"><b> Zip: </b><?= $listar['zip']; ?></p>
                          <p class="card-text mr-3"><b> Country: </b><?= $listar['country']; ?></p>
                          <p class="card-text mr-3"><b>Min Days: </b><?= $listar['min_days']; ?></p>
                          <p class="card-text mr-3"><b>Max Days: </b><?= $listar['max_days']; ?></p>
                          </div>
                          <?php  foreach ($listar['skill'] as $skill):  ?>  
                            <p class="card-text"><b>Skills: </b><?= $skill['name']; ?></p>
                          <?php endforeach; ?>
                          
                          <p class="card-text"><b>Languages: </b><div class="form-inline">
                          <?php  foreach ($listar['linguas'] as $lingua):  ?>  
                            <div class="form-control inline-block mr-2 input-md"><?= $lingua['name'];?></div>
                          <?php endforeach; ?>
                        </p></div>
                          
                          </div>
                       
                        </div>
                      </div>  

                    </div>
                  <?php endforeach; ?> 
                </div> 
                
              </div>
             
                 
              <?php endif; ?>  