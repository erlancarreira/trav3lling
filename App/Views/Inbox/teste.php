<?php if (!empty($listMsg)): ?> 
	<?php foreach ($listMsg as $key => $value) { ?> 
<div id="list-example" class="list-group">
  <a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>
  <a class="list-group-item list-group-item-action" href="#list-item-2">Item2</a>
  <a class="list-group-item list-group-item-action" href="#list-item-3">Item 3</a>
  <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
</div>
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
  <h4 Item 1</h4>
      
    <div id="list-item-1" class="clearfix <?= ($value['user_id'] == $_SESSION['user'] ? 'bg-light' : ''); ?> col p-3">       
      <a class="<?= ($value['user_id'] == $_SESSION['user'] ? 'float-left' : 'float-right'); ?> mr-3" href="#">
        <img style="width: 64px; height: 64px; text-decoration-style: none !important;" class="rounded-circle" src="<?= BASE; ?>App/assets/img/users/<?= ($_SESSION['user'] == $value['user_id'] ? $viewData['url'] : $value['user_img']);  ?>" />
      </a>
      <div class="col-md-10 <?= ($_SESSION['user'] == $value['user_id'] ? 'float-left' : 'float-right'); ?> py-2">     
        <div class="media-body">
         <p class="p-0 m-0"><?= $value['message']; ?></p>  
       </div>    
       <div class="p-0">
        <small class="text-muted"><?= ($value['user_id'] == $_SESSION['user'] ? $viewData['name'] : $value['user_name']); ?> | <?= $value['data']; ?> </small>
      </div>                                                                                        
      <input type="hidden" name="id_user_to" value="<?= (!empty($value['user_id'])) ? $value['user_id'] : ''; ?>">
      <input type="hidden" name="id_post" value="<?= (!empty($value['post_id'])) ? $value['post_id'] : ''; ?>">    
    </div>
  </div> 

              <?php  }  ?>  
  <h4 id="list-item-2">Item 2</h4>
  <p>...</p>
  <h4 id="list-item-3">Item 3</h4>
  <p>...</p>
  <h4 id="list-item-4">Item 4</h4>
  <p>...</p>
</div>
<?php else: ?>
          
        <?php endif; ?> 