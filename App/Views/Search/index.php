<section class="container">           
    <h2 class="display-4 text-center text-secondary">Search your paradise</h2>
    
    <form id="search" method="GET" action="<?= BASE; ?>search/result">  
      <div class="my-3 bg-transparent">     
        <div class="bg-transparent">

          
           
           <div class="input-group bg-white p-0">
            
              <select name="category" id="category" class="custom-select text-capitalize col-md-3 custom-select-sm">
                <option value="all" selected>Select your category</option>                            
                <?php foreach ($category as $cat): ?>
                <option name="<?php $cat['id']; ?>" value="<?= $cat['id']; ?>"><?= $cat['title']; ?></option>  
                <?php endforeach; ?>   
              </select>         
         
              <input type="text" id="busca" name="title" class="form-control custom-select-sm p-2" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Search</button>
              </div>               
           </div> 

            <?php if(isset($category) && !empty($category)) { ?>
               <div class="container mb-3 p-0">
                <ul class="" id="result"></ul>          
              </div>  
            <?php } ?> 
                
         </div>
        </div>
      </form>   
    

      <!---VIEW HOME-->
    <!--Start-->
  
        <div class="container my-4 p-0">
        <div class="">
          <h6 class="card-header text-uppercase bg-primary text-white">House</h6>
        </div>    
        
        
          <?php $this->loadView('search/home/index', $viewData); ?>          
           
        
        </div>  

        <div class="container my-4 p-0">
        <div class="">
          <h6 class="card-header text-uppercase bg-primary text-white">Hotel and Line Resorts</h6>
        </div>    
        
        
          <?php $this->loadView('search/hotel/index', $viewData); ?>  
       
        </div> 

        <div class="container my-4 p-0">
        <div class="">
          <h6 class="card-header text-uppercase bg-primary text-white">Experience</h6>
        </div>    
      
        
          <?php $this->loadView('search/experience/index', $viewData); ?>  
           
        
        </div> 
                
        <?php if ($total > 3): ?>
                                 
        <nav class="my-4 col-md-12 p-0">
          <ul class="pagination">
            <!-- <li class="page-item">
                <a class="page-link" href="<? //BASE; ?>search?p=<? //$currentPage -1; ?>" aria-label="Previous">              
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>  
            </li> -->
            <?php for ($q=1; $q < $pages; $q++): ?>
            <li class="page-item <?= ($currentPage == $q ? 'active' : ''); ?>">
              <a class="page-link" href="<?= BASE; ?>search?p=<?= $q; ?>">
                <?= $q; ?>
              </a>
            </li>
            <?php endfor; ?> 
            <!-- <li class="page-item">
                <a class="page-link" href="<?// BASE; ?>search?p=<? //($currentPage < $pages ? $currentPage +1 : $currentPage); ?>" aria-label="Next">
               
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>  
            </li> -->
          </ul>
        </nav>
      <?php endif; ?> 
    
                 
           
      <!--END-->
      <!-- END HOME -->   
     
                   
  </section>

       

       
       
