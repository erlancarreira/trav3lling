<section class="container py-5">
   <?php  if(!empty($_SESSION['msg'])): ?>
    <div class="col">
      <div class="alert alert-warning my-0 border-0" role="alert"><?= $_SESSION['msg']; ?>       
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
        </button>  
      </div>
    </div>
   <?php endif; ?>
  
  <div class="row" style="background-color: #e0ffff3d;">
    <div class="col" id="account">
   
       <form class="" method="POST" action="<?= BASE; ?>account/insert" enctype="multipart/form-data" >
      
        <div class="col">
                <h4>Select images from your computer</h4>
                <input type="file" class="btn btn-outline-secondary w-100" name="photos[]" multiple/> 
                
   
        </div> 

        <div class="form-group my-3">
            <label class="col control-label" for="name">Title</label>
              <div class="col">
                <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required>
              </div>
        </div>
           
          
           <div class="col my-3">
                <select name="category" class="form-control text-capitalize">
                  <option value="">Please select one category</option> 
                  <?php foreach ($category as $key => $value): ?>
                  <option required <?php ($value['id'] == 1 ? 'selected="selected"':'') ; ?> value="<?= $value['id'] ?>" ><?= $value['title']; ?></option>  
                  <?php endforeach; ?>                   
                </select>
             
            </div>
         
          

         

           <div class="form-group">
              <label class="col control-label" for="">Description</label>
              <div class="col">
                 <textarea type="text" name="description" placeholder="" style="height: 200px;" class="form-control input-md" required></textarea>
              </div>
           </div>
           
           <address>
              <div class="form-group">
                 <label class="col control-label" for="">Address Line</label>                                     
                 <div class="col">
                    <input type="text" name="address_line" placeholder="" class="form-control input-md" required>
                 </div>
              </div>

              <div class="form-horizontal">
                 <div class="col"> 
                    <div class="row"> 
                          <div class="col-md-2">
                             <label class="control-label" for="">City</label>
                             <input type="text" name="city" placeholder="" size="3" maxlength="50" class="form-control input-md" required>
                          </div>
                          <div class="col-md-2">
                             <label class="control-label" for="">State</label>
                             <input type="text" name="state" placeholder="" size="3" maxlength="50" class="form-control input-md" required> 
                          </div>
                       <div class="col-md-2">
                          <label class="control-label" for="">Zip / Postal Code</label>
                          <input type="text" name="zip" placeholder="" class="form-control input-md" size="7" maxlength="10" required>
                       </div>
                       <div class="col-md-2">
                          <label class="control-label" for="">Country</label>
                          <input type="text" name="country" placeholder="" size="3" maxlength="50" class="form-control input-md" required>
                       </div>
                    
                       <div class="col-md-2">
                         <label class="control-label" for="">Min. Days</label>                   
                         <input type="number" name="min_days" placeholder="Min. Days" min="1" max="120" class="form-control input-md" required>                      
                       </div>

                       <div class="col-md-2">
                         <label class="control-label" for="">Max. Days</label>                      
                         <input type="number" name="max_days" placeholder="Max. Days" min="1" max="120" class="form-control input-md" required> 
                       </div>
                     </div> 
                     

                 </div>
                 
                 </div>
                 </address>   
                  <div class="col form-group">
                   <label class="w-100">Skills that the host wants:</label>
                    <select name="skills[]" id="setSkills" class="form-control skills" multiple="multiple">
                                   
                    </select>
                    <input type="hidden" name="hidden_setSkills" id="hidden_setSkills" />
                </div>
                    
                <div class="col form-group">
                   <label class="w-100">Select your languages:</label>
                    <select name="languages[]" id="setLanguages" class="languages form-control" multiple="multiple">                  
                    </select>
                    <input type="hidden" name="hidden_languages" id="hidden_languages" />
                </div>
              
                <div class="col mb-4">
                   <input type="submit" class="btn btn-primary btn-block" value="Save" required /> 
                </div>
                
              
               </form>
             
              </div>
          </div>
        </section>

              

  
              <?php if(!empty($Places)): ?>

              <div class="dropdown-divider"></div>
              
                <section class="container py-4">
                  <div class="col ">  
                  
                   
                    <div class="row">
                      
                    <?php  foreach ($Places as $lugar => $listar): ?>  
               
                      <div class="col-md-6"> 
                      <div class="box-shadow mb-3 position-relative rounded-3 p-0">
                        <form method="POST" action="<?= BASE; ?>account/delete"> 
                          <div>
                            <button type="submit" style="z-index: 5; position: absolute; right: 0;" class="btn btn-light rounded-circle m-2" name="id_post" value="<?= $listar['id_post']; ?>">X</button> 
                              <?php if (!empty($listar['img_slider'])): ?>
                        
                       
                              <div id="<?= $listar['id_post']; ?>" class="carousel slide" data-ride="carousel">

                              <ol class="carousel-indicators d-none">
                                <?php foreach ($listar['img_slider'] as $key => $value): ?>                                                                                                            
                                <li data-target="#<?= $value['id_post'] ?>" data-slide-to="<?= $key; ?>" class="<?php echo ($key == 0 ?  'active' : '');?>"></li> 
                                <?php endforeach; ?>   
                              
                              </ol>
                                
                                <div class="carousel-inner">
                                  
                                  <?php foreach ($listar['img_slider'] as $key => $value): ?>
                      
                                  <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
                                     
                                    <img class="img-fluid" src="<?= BASE; ?>App/assets/img/account/places/<?= $value['url'] ?>" alt="First slide">
                                    
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
                           <?php else: ?>
                            <img class="img-fluid" src="<?= BASE; ?>App/assets/img/account/places/no-image" alt="First slide">
                           <?php endif; ?>   
                          </div>
                          
                          <div class="card-body ">
                            <input type="hidden" name="id_post" value="<?= $listar['id_post']; ?>">

                            <div style="display: block; width: 64px; margin: -50px auto 0;"  class="d-block mx-auto align-middle">  

                            <i style="z-index: 2; box-shadow: 3px" class="p-2 bg-white text-primary rounded-circle <?= ($listar['category_name'] == 'hotel and line resorts' ? "fa fa-hotel fa-3x" : "fa fa-home fa-3x");  ?>"></i>   
                            </div>
                            <h5 class="text-uppercase"><?= $listar['category_name']; ?></h5> 
                            
                              

                            <h5 class="card-title"><?= $listar['title']; ?></h5>
                            <p class="card-text text-truncate" style="max-height: 600px;"><?= $listar['description']; ?></p>
                            <p class="card-text"><b> Address: </b><?= $listar['address_line']; ?></p>
                            <div class="d-flex flex-wrap">
                            <p class="card-text mr-3"><b> City: </b><?= $listar['city']; ?></p>  
                            <p class="card-text mr-3"><b> State: </b><?= $listar['state']; ?></p>
                            <p class="card-text mr-3"><b> Zip: </b><?= $listar['zip']; ?></p>
                            <p class="card-text mr-3"><b> Country: </b><?= $listar['country']; ?></p>
                          
                            <p class="card-text mr-3"><b>Min Days: </b><?= $listar['min_days']; ?></p>                              
                            <p class="card-text mr-3"><b>Max Days: </b><?= $listar['max_days'] ?></p>
                
                            </div>
                            
                            <ul class="list-inline">  
                            <p class="font-weight-bold">Skills</p>  
                            <?php if (isset($listar['skill']) && !empty($listar['skill'])): ?>
                            <?php  foreach ($listar['skill'] as $skill): ?>  
                             <li class="list-inline-item"><p class="card-text"><?= $skill['name']; ?></p></li> 
                            <?php endforeach; ?>
                            <?php endif ?>
                            </ul>  
                            
                            <p class="card-text"><b>Languages: </b><div class="form-inline">
                            <?php if (isset($listar['linguas']) && !empty($listar['linguas'])): ?>
                            <?php  foreach ($listar['linguas'] as $lingua):  ?>  
                              <div class="form-control inline-block mr-2 input-md"><?= $lingua['name'];?></div>
                            <?php endforeach; ?>
                            <?php endif ?>
                          </p>
                          
                        </div>
                           

                            <input type="hidden" name="id_post" value="<?= $listar['id_post']; ?>">
                            <a class="btn btn-primary my-3 w-100 bg-primary" href="<?= BASE; ?>account/edit?id=<?= $listar['id_post']; ?>">Edit</a> 
                          </form>    
                          </div>

                         </div>
                      
                      </div>
                    <?php endforeach; ?>   
                    </div>
                  </div>                   
              </section>
                 
              <?php endif; ?>  
             