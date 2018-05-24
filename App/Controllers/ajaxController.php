<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Relations;
use App\Models\Account;
use App\Models\Posts;

class AjaxController extends Controller {
    
  private $User;
  private $post;
  private $relations;
  private $DataPost;
  private $Places;

    public function __construct() {
    	parent::__construct();
    	$this->User = new Users(); 
      $this->User->verifyLogin();
      $this->post = new Account(); 
      $this->relations = new Relations(); 
      $this->Places = new Posts();
   
      
    }
  

    public function index() {}
    
    // public function addSubscriber() {

    // $this->data = $this->User->getDados($_SESSION['user']); 
      
    //    if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {
    //    	  $id = addslashes($_SESSION['user']); // ID USUARIO LOGADO
    //       $id_post = addslashes($_POST['id_post']); // ID POST 
    //       $id_user_to = addslashes($_POST['id_user']); // ID DO USUARIO DONO DO POST
    //       $postTitle = addslashes($_POST['postTitle']); // TITULO DO POST

      	  
    //    	if($id && $id_post && $id_user_to && $postTitle) {  
        
    //     $this->relations->addSubscriber($id, $id_post, $id_user_to)      

    //     } else {

    //       $this->data['msg'] = "Ocorreu algum problema!";
        
    //     }
    //   }
    // }

    public function acceptSubscriber() {

       if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {
       	  $id_post = addslashes($_POST['id_post']);
          $id_user = addslashes($_POST['id_user']);
          
       	  $r = new Relations();
       	  $r->acceptSubscriber($id_user, $id_post);
       }

    }
    
    public function curtir() {

      if(isset($_POST['id']) && !empty($_POST['id'])) {
          $id = addslashes($_POST['id']);
          $id_usuario = $_SESSION['user'];

          $p = new Posts();
          if($p->isLiked($id, $id_usuario)) {
            $p->removeLike($id, $id_usuario);
          } else {
            $p->addLike($id, $id_usuario);
          }

      } 

    }

    public function comentar() {
      if(isset($_POST['id']) && !empty($_POST['id'])) {
          $id = addslashes($_POST['id']);
          $id_usuario = $_SESSION['user'];
          $txt = addslashes($_POST['txt']);
          $p = new Posts();

          if(!empty($txt)) {
              $p->addComentario($id, $id_usuario, $txt);
          }
          
      } 
  }

  public function result() {
      if(isset($_POST['id']) && !empty($_POST['id'])) {
          $id = addslashes($_POST['id']);
          $id_usuario = $_SESSION['user'];
          $txt = addslashes($_POST['txt']);
          $p = new Posts();

          if(!empty($txt)) {
              $p->addComentario($id, $id_usuario, $txt);
          }
          
      } 
  }

  public function updateSkills() 
  {
  
    if(isset($_POST['id']) && !empty($_POST['id'])) {
      $id_user = $_SESSION['user'];
      echo $_POST['setSkills'];
      echo '<br>';  
      echo $_POST['hidden_setSkills'];
    }
  }

  public function updateImage() 
  {
    if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
      
      print_r($_POST['insert']);  
        if($_POST['photo']) {
          $this->Places->uploadImg($_POST['photo']);
        } else {
          $this->Places->uploadImg($_POST['insert']);
        }   
      }     
  }
    


}