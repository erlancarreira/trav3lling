
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
  
              <?php if(!empty($Places)): ?>
    <form id="form" method="POST" enctype="multipart/form-data" >
                <div class="col col-md-12">
                
                  <div class="row">                
                   
                    <?php  foreach ($Places as $lugar => $listar): ?>                     
                    <!-- <?php// var_dump($listar); ?>   -->
                      <div class="form-horizontal box-shadow pb-3 border-top-0 ">

                        
                        <style> 
                            .img-file .btn-file {
									width: 100%;
									background-color: #3498db;
									border-radius: 0;
									color: #fff;
									cursor: pointer;
									border-left: 1px solid white;
									border-right: 1px solid white;
									cursor: pointer;
								
							}
							.img-file label {
								width: 100%;
							}

							.img-file:first-child .btn-file {
								border-left: 0 !important;
								
							}

							.img-file:last-child .btn-file {
								border-right: 0 !important;
								
							}

							.img-file input[type='file'] {
									display: none
								}
							.img-file img {
								min-height: 248px;
							}		

                          }
                        </style>
                        <div class="col">
	                        <div class="row">
	                  <!--       <?php// var_dump($listar['img_slider']); ?> -->	

		                    <?php if ($listar['img_slider'] > 0): ?>
		                      <?php for ($i=0; $i < count($listar['img_slider']); $i++): ?>

		                      
		                     <!--  <?php// foreach ($listar['img_slider'] as $key => $value): ?> -->
		                      	                        	     	                       	                        
		                        <div class="col-md-4 p-0 w-100 img-file" style="border-left: 1px solid white; border-right: 1px solid white;">  
		                          <img class="img-fluid border-top-0 p-0 mw-100" src="<?= BASE; ?>App/assets/img/account/places/<?= ( count($listar['img_slider'][$i]['url']) > 0) ? $listar['img_slider'][$i]['url'] : ''; ?>" alt="<?= (count($listar['title']) > 0 ) ? $listar['title'] : ''; ?>">  
		                            
			                        <div class="btn btn-block btn-file">
				                        
				                        <label for='input-img'>Update Image</label>
				                      
				                        <input id="input-img" type="file" name="photos[]">
				 			                         
				                        <input type="hidden" name="id_photo" value="<?= ( count($listar['img_slider'][$i]['id']) > 0 ? $listar['img_slider'][$i]['id'] : ''); ?>">
				                        
						            </div>     			                        
		                        </div>
                           


                      
		                        <!-- <?php// endforeach; ?> -->
		                    <?php endfor; ?>
		                    </div> 
		                </div>       
		                        
		                      <?php else: ?>
		                        <div class="col text-center p-0 w-100"> 
		                          <h4>You have no images, please insert now.</h4>
		                                             
		                        </div>
		                     
	                         <?php endif; ?>
	                                         
	                        
                        
                        <div class="card-body ">
                          
                          <input type="hidden" name="id_post" value="<?= $listar['id_post']; ?>">
                          
                          <div class="input-group my-3 w-100">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Category</b></span>
                            </div>
                              <select name="category" class="form-control text-capitalize">
                                <?php foreach ($category as $key => $value): ?>
                                	<?php var_dump($category); ?>
                                <option <?= ($value['id'] == 1 ? 'selected="selected"':''); ($value['id'] == 2 ? 'selected="selected"':''); ($value['id'] == 3 ? 'selected="selected"':''); ?> value="<?= $value['id'] ?>" ><?= $value['title']; ?></option>  
                                <?php endforeach; ?>                   
                              </select>

                          </div>
                          
                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Title</b></span>
                            </div>
                            <input type="text" name="title" class="form-control" value="<?= $listar['title']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                          
                          <div class="rounded my-3 ">
                            <span class="input-group-text rounded-0" ><b>Description</b></span>
                            
                            <textarea style="height: 150px;" name="description" class="form-control rounded-0 p-2" aria-label="Default" aria-describedby="inputGroup-sizing-default"><?= $listar['description']; ?></textarea>
                           
                          </div> 

                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Country</b></span>
                            </div>
                            <input type="text" name="country" class="form-control" value="<?= $listar['country']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>

                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>City</b></span>
                            </div>
                            <input type="text" name="city" class="form-control" value="<?= $listar['city']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>

                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>State</b></span>
                            </div>
                            <input type="text" name="state" class="form-control" value="<?= $listar['state']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>  

                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Zip</b></span>
                            </div>
                            <input type="text" name="zip" class="form-control" value="<?= $listar['zip']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
      
                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Address</b></span>
                            </div>
                            <input type="text" name="address_line" class="form-control" value="<?= $listar['address_line']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div> 

                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Min Days</b></span>
                            </div>
                            <input type="text" name="min_days" class="form-control" value="<?= $listar['min_days']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>  
                          
                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Max Days</b></span>
                            </div>
                            <input type="text" name="max_days" class="form-control" value="<?= $listar['max_days']; ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>                                                                   

                        <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Languages</b></span>
                            </div>
                              <select name="languages[]" id="setLanguages" class="form-control" multiple="multiple">   
                                <?php if (!empty($listar['linguas'])) : ?>           
                                  <?php foreach ($listar['linguas'] as $value) { ?>
                                    <option value="<?= $value['name']; ?>" selected="selected"><?= $value['name']; ?></option>
                                  <?php } ?>  
                                <?php endif ?>
                              </select>
                        </div>
                        
                        <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default"><b>Skills</b></span>
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

