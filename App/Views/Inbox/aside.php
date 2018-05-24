
<form method="GET" action="<?= BASE; ?>inbox/index">   
    <aside class="col-md-4 p-0" id="navbar-swix">
        <?php foreach ($Pagination as $key => $value) { ?> 
        <a href="<?= BASE; ?>inbox?chat_id=<?= (int)$value['user_chat']; ?>"> 
          <div class=" bg-dark p-4"> 
            <img src="<?= BASE; ?>App/assets/img/account/places/<?= (!empty($value['post_img'])) ? $value['post_img']: ''; ?>" class="rounded-circle clearfix float-left mr-3 " style="width: 64px; height: 64px;">
              <p class="text-white"> <?= (!empty($value['post_title'])) ? $value['post_title'] : ''; ?> </p>
          
          </div>
          </a>
       
        <div class="dropdown-divider"></div>
       
      <?php  }  ?>  

      </aside>  
</form>