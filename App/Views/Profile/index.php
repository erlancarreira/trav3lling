
<div class="container my-5 p-0">

  <?php  if(!empty($_SESSION['msg'])): ?>
    <div class="col py-2">
    <div class="alert alert-warning my-0 border-0" role="alert"><?= $_SESSION['msg']; ?>       
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>

   </div>
 </div>
<?php endif; ?>
<div class="col rounded-top">
  <div class="d-block p-0 bg-primary rounded-top form-inline">

    <blockquote class="clear p-2 m-0  text-white text-center font-weight-bold"><i class="fa fa-wrench text-white m-1" aria-hidden="true"></i> Edit profile</blockquote>
  </div>
  <form class="col mw-100 card m-0 card-outline-secondary p-5 zIdenx-1" method="post" id="multiple_select_form" enctype="multipart/form-data">

   <div class="p-0 mb-2">
     <label for="name">Change your image of profile:</label>
     <input type="file" class="btn btn-outline-secondary w-100" name="photo[]" />  
   </div> 

   <div class="form-group ">
    <label for="name">Name:</label>
    <input type="text" class="form-control"  name="name" placeholder="Your name" value="<?= $info['name']; ?>" required>
  </div>

  <div class="form-group">
   <label for="bio">Bio:</label>
   <textarea name="bio" id="bio" class="form-control"><?= $info['bio']; ?></textarea>
 </div>

 <div id="skills" class="my-3">
  <label>Select your skills:</label>
  <select name="skills[]" id="setSkills" class="form-control" multiple="multiple">
    <?php if (isset($skills) && !empty($skills)) : ?> 
      <?php foreach ($skills as $value) { ?>
      <option value="<?= $value['name']; ?>" selected="selected"><?= $value['name']; ?></option>
      <?php } ?>
    <?php endif ?>    
  </select>
  <input type="hidden" name="hidden_setSkills" id="hidden_setSkills" />

</div>

<div id="languages" class="my-3">
  <label>Select your languages:</label>
  <select name="languages[]" id="setLanguages" class="form-control" multiple="multiple">
    <?php if (isset($languages) && !empty($languages)) : ?>           
      <?php foreach ($languages as $value) { ?>
      <option value="<?= $value['name']; ?>" selected="selected"><?= $value['name']; ?></option>
      <?php } ?>  
    <?php endif ?>  
  </select>
  <input type="hidden" name="hidden_languages" id="hidden_languages" />

</div>

<div class="form-group">
  <label for="password">Password:</label>
  <input type="password" class="form-control" name="password" placeholder="*******">
</div>



<div class="form-group">
  <strong>E-mail:</strong>

  <label><?= $info['email']; ?></label>

</div>          

<button type="submit" class="btn btn-primary font-weight-bold">Save</button>                   

</form>

</div>    
</div>