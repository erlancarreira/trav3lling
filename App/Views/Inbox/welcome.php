<div class="container py-5">
<?php if (!empty($Pagination) && isset($Pagination)): ?>
  <div class="col-md-12 p-0 " data-spy="scroll" data-target="#navbar-swix" data-offset="0" class="scrollspy-example">
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
 <?php else: ?> 


<div class="card panel-info  ">
        <div class="card-header bg-primary ">
          <h5 class="text-white">Welcome to chat!</h5>
        </div>     
      <div id="navbar-swix">
    <ul class="m-0  py-5" role="tablist">
    <li class="mb-3 py-5" style="min-height: 400px;">
	<div  class="form-inline mx-5">
	  <a class="mr-3" href="#">
	    <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/bot-icon.png" />
	  </a>

	  <h5 class="">Hey, <?= $viewData['name']; ?> you not have messages! Go to the search and start.</h5>
	</div>  
	</li>
   </ul>
</div>
</div>
<?php endif; ?> 	    
</div>	    