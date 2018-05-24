<?php var_dump(1); exit; ?>
<?php foreach ($viewData as $value): ?>     
    <div class="mb-3 position-relative rounded-3 p-0">  
                         
      <div id="<?= $value['id_post']; ?>" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators d-none">

        <?php foreach ($value['img_slider'] as $key => $slide): ?>                                                                                                            
        <li data-target="#<?= $slide['id_post']; ?>" data-slide-to="<?= $key; ?>" class="<?php echo ($key == 0 ?  'active' : ''); ?>"></li> 
      <?php endforeach; ?>  
      
      </ol>
        
        <div class="carousel-inner">
          
        <?php foreach ($value['img_slider'] as $key => $slide): ?>

          <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
             
            <img class="img-fluid" src="<?= BASE; ?>App/assets/img/account/places/<?= $slide['url']; ?>" alt="First slide">
            
          </div>
        <?php endforeach; ?>  
           
        <?php if(sizeof($value['img_slider']) > 1): ?>
        <a class="carousel-control-prev" href="#<?= $slide['id_post']; ?>" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#<?= $slide['id_post']; ?>" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
       <?php endif; ?>         
      </div>
   </div>  
  </div>
<?php endforeach; ?>   