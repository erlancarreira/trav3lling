<section class="container py-5">
  <?php  if(!empty($msg)): ?>
    
	    <div class="col">
	      <div class="alert alert-warning mb-3 border-0" role="alert"><?= $msg ?>       
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	        </button>
	        
	      </div>
	    </div>
   <?php endif; ?>

   <?php if (!empty($msgteste)) {
      print_r($msgteste);
   } ?>

            
  
              <?php if(!empty($Places)): ?>
    <form method="post" enctype="multipart/form-data" class="rtw-form">
                <div class="col col-md-12">
			        <div class="col">
			    	  <p class="data-msg"></p>
			        </div>  
                  <div class="row" style="background-color: #e0ffff3d;">
                    <?php  foreach ($Places as $lugar => $listar): ?>                     
                    
                      <div class="form-horizontal box-shadow pb-3 border-top-0 ">

                        <div class="col">
	                        <div class="row">

	                       	
	              
		                <?php if (count($listar['img_slider']) > 0): ?>
		                  
                      <?php
                        
                        $total = count($listar['img_slider']); 
                        $offset = 6 - $total; 
                            
                      ?> 	     
		                    
                        <?php for($i=0; $i < $total; $i++): ?>  
		                        
		                                           	     	                       	                        
		                        <div class="col-md-4 p-0 w-100 img-file"  style="border-left: 1px solid white; border-right: 1px solid white;">  
		                          <img style="min-height: 293px;" class="img-fluid border-top-0 p-0 mw-100 img-replace" src="<?= BASE; ?>App/assets/img/account/places/<?= $listar['img_slider'][$i]['url']; ?>" alt="<?= $listar['title']; ?>">  
		                            
			                        <div class="btn btn-block btn-file input-am p-0 border-0">
				                        
				                        <div class="form-group mb-0">
										  <input class="input-file" data-index="<?= $i; ?>" data-id="<?= $listar['img_slider'][$i]['id']; ?>" type="file" id="photo<?= $i; ?>" name="photo" >
										  <label for="photo<?= $i; ?>" class="btn btn-tertiary js-labelFile">
										    <i class="photo<?= $i; ?> icon fa "></i>
										    <span class="js-fileName">Change</span>
										  </label>
										  <!-- <input class="input-val" type="hidden" name="id_photo[]" value="<?// $value['id']; ?>"> -->
										</div>                      
						            </div>     			                        
		                        </div>
		              
		                        <?php endfor; ?>

		                      <?php if ($offset < 6): ?>  
                            
                          <?php for($a=0; $a < $offset; $a++): ?>  
                                      
                                <div class="col-md-4 p-0 w-100 img-file"  style="border-left: 1px solid white; border-right: 1px solid white;">  
		                          <img style="min-height: 293px;" class="img-fluid border-top-0 p-0 mw-100" src="<?= BASE; ?>App/assets/img/account/places/no-image.jpg" alt="No Image">  
		                            
			                        <div class="btn btn-block btn-file input-am p-0 border-0">
				                        <div class="form-group mb-0">
										  <input type="file" id="photo<?= $a.$a; ?>" class="input-file" name="insert" data-id-post="<?= $listar['id_post']; ?>">
										  <label for="photo<?= $a.$a; ?>" class="btn btn-tertiary js-labelFile">
										    <i class=" icon fa photo<?= $a.$a; ?>"></i>
										    <span class="js-fileName">Change</span>
										  </label>
										 <!--  <input id="insert" type="hidden" name="insert"> -->
										</div>				 			                            
						            </div>     			                        
		                        </div>  

		                      <?php endfor; ?>  
                            <?php endif ?> 
		                   
		                    </div> 
		                </div>       
		                        
		                      <?php else: ?>
		                        <div class="col text-center p-0 w-100"> 
		                          <h4>You have no images, please insert now.</h4>
		                                             
		                        </div>
		                     
	                         <?php endif; ?>
	                                         
	                        
                        
                        <div class="card-body " id="account">
                          
                          <input type="hidden" name="id_post" value="<?= $listar['id_post']; ?>">
                          
                          <div class="form-group my-3">
                            
                              <label class="control-label">Category</label>
                           
                              <select name="category" class="form-control col text-capitalize">
                                <?php foreach ($category as $key => $value): ?>
                                	
                                <option <?= ($value['id'] == 1 ? 'selected="selected"':''); ($value['id'] == 2 ? 'selected="selected"':''); ($value['id'] == 3 ? 'selected="selected"':''); ?> value="<?= $value['id'] ?>" ><?= $value['title']; ?></option>  
                                <?php endforeach; ?>                   
                              </select>

                          </div>
                          
                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Title</label>
                            </div>
                            <input type="text" name="title" class="form-control" value="<?= $listar['title']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                          
                          <div class="rounded my-3 ">
                            <label class="" >Description</label>
                            
                            <textarea style="height: 150px;" name="description" class="form-control rounded-0 p-2" aria-label="Default" aria-describedby="inputGroup-sizing-default"><?= $listar['description']; ?></textarea>
                           
                          </div> 

                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Country</label>
                            </div>
                            <input type="text" name="country" class="form-control" value="<?= $listar['country']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>

                          <div class="form-group my-3">
                            <div>
                              <label class="">City</label>
                            </div>
                            <input type="text" name="city" class="form-control" value="<?= $listar['city']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>

                          <div class="form-group my-3">
                            <div class="">
                              <label class="">State</label>
                            </div>
                            <input type="text" name="state" class="form-control" value="<?= $listar['state']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>  

                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Zip</label>
                            </div>
                            <input type="text" name="zip" class="form-control" value="<?= $listar['zip']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
      
                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Address</label>
                            </div>
                            <input type="text" name="address_line" class="form-control" value="<?= $listar['address_line']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div> 

                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Min Days</label>
                            </div>
                            <input type="text" name="min_days" class="form-control" value="<?= $listar['min_days']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>  
                          
                          <div class="form-group my-3">
                            <div class="">
                              <label class="">Max Days</label>
                            </div>
                            <input type="text" name="max_days" class="form-control" value="<?= $listar['max_days']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>                                                                   

                        <div class="form-group my-3">
                            <div class="">
                              <label class="">Languages</label>
                            </div>
                              <select name="languages[]" id="setLanguages" class="form-control" multiple="multiple">   
                                <?php if (!empty($listar['linguas'])) : ?>           
                                  <?php foreach ($listar['linguas'] as $value) { ?>
                                    <option value="<?= $value['name']; ?>" selected="selected"><?= $value['name']; ?></option>
                                  <?php } ?>  
                                <?php endif ?>
                              </select>
                        </div>
                        
                        <div class="form-group my-3">
                            <div class="">
                              <label class="">Skills</label>
                            </div>
                              <select name="skills[]" id="setSkills" class="form-control" multiple="multiple">   
                                <?php if (!empty($listar['skill'])) : ?>           
                                  <?php foreach ($listar['skill'] as $value) { ?>
                                    <option value="<?= $value['name']; ?>" selected="selected"><?= $value['name']; ?></option>
                                  <?php } ?>  
                                <?php endif ?>
                               
                              </select>
                              </div>
                       
                            <div class="my-4">
                               <input type="submit" class="btn btn-primary btn-block" value="Save" /> 
                            </div>
                     
                        
                            
                         
                        </div> 
                      <?php endforeach; ?>    
                        </div>
                      

                    </div>
                </form>
                             
              <?php endif; ?>  


              </section>

