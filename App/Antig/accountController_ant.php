<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;
use App\Models\Posts;



class AccountController extends Controller
{   
  private $user;
  private $post;
  private $msg;
  private $Places;

	  public function __construct() {
      parent::__construct();
      $this->user = new Users(); 
      $this->user->verifyLogin();
      $this->post = new Account();
      $this->Places = new Posts();
      //$this->msg->getMsg(); 
    }

    public function index()
    {   
    
    //$post = new Account();  
      

    $this->data = $this->user->getDados($_SESSION['user']); 
    $this->data['category'] = $this->post->getCategory(); 
    //$dados['msg'] = $this->msg->getMsg();   

    //print_r($_SESSION['user']); 
    //exit(); 

  $this->data['Places'] = $this->Places->getPosts($id_post = null, $_SESSION['user']);

  

  if($this->post->getLugares($_SESSION['user']) !== NULL) {
    
    $p = null; 

     

        foreach ($this->post->getLugares($_SESSION['user']) as $key => $lug) {         
         
          $addr = $this->post->getAddress($lug['id_post']);
          $days = $this->post->getDays($lug['id_post']);
          $category = $this->post->getCategoryId($lug['id_category']);
          $images = $this->post->getImages($lug['id_post']);
          

            $p[] = [
                'id' => $lug['id_post'],
                'id_category' => $category['id'],
                'category' => $category['title'],
                'title' => $lug['title'],
                'description' => $lug['description'],
                'address_line' => $addr['address_line'],
                'city' => $addr['city'],
                'state' => $addr['state'],
                'zip' => $addr['zip'],
                'country' => $addr['country'],
                'min_days' => $days['min_days'],
                'max_days' => $days['max_days'],
                'main_image' => $lug['url'],
                'images' => $images,
                'linguas' => $this->post->getLanguages($lug['id_post']),
                'skill' => $this->post->getSkills($lug['id_post'])
            ];
        }
      $this->data['lugares'] = $p;   
}  




$this->loadTemplate('account/index', $this->getData());        	
        
}

public function insert() {
  
  //$post = new Account();  

  $this->data = $this->user->getDados($_SESSION['user']); 

     

   if(isset($_POST['title']) && !empty($_POST['title'])) {
       $title = $_POST['title'];
       $description = $_POST['description'];
       $address_line = $_POST['address_line'];
       $id_category = $_POST['category'];
       $city = $_POST['city'];
       $state = $_POST['state'];
       $zip = $_POST['zip'];
       $country = $_POST['country'];
       $min_days = $_POST['min_days'];
       $max_days = $_POST['max_days']; 
       $photos[] = $_FILES['photos']['tmp_name'];
       $language_name = $_POST['languages_name'];
       $skills_name = $_POST['skills_name'];
       $id_user = $_SESSION['user'];
       $imagens = $_FILES['photos'];
       }
       

      // $this->post->insertPostCategory($id_post, $category);
      // if(isset($_POST)) { 

      if($id_post = $this->post->insertPost($title, $description, $id_user, $id_category, $address_line, $city, $state, $zip, $country, $language_name, $skills_name, $min_days, $max_days, $imagens)) {
       
      /* if (isset($_FILES['photos']) && !empty($_FILES['photos']['tmp_name'])):  
  
       $imagens = $_FILES['photos'];

       $this->post->postImg($id_post, $imagens);

       $this->data['msg'] = $this->post->getMsg();

       endif; */

      // $this->post->insertLanguages($id_post, $language_name);

      // $this->post->insertSkills($id_post, $skills_name); 

      // $dados['id_lugares'] = $id_post;

       $this->data['msg'] = "Mensagem inserida com sucesso";      

       } else {

       $this->data['msg'] = "Houve um problema ao inserir a mensagem!";
         
//      // $this->redirect('account/index', $dados);   
      
    }


$this->loadTemplate('account/index', $this->getData());  
}

public function update() {
  
  $id_user = $_SESSION['user'];
  $id_post = intval($_GET['id']);

  $this->data = $this->user->getDados($_SESSION['user']); 
     
  if($this->post->getLugares($_SESSION['user']) !== NULL) {
    
  $this->data['lugares'] = $this->post->getPosts($id_post, $id_user);
      
}


if(isset($_POST['title']) && !empty($_POST['title'])) {
       $title = $_POST['title'];
       $description = $_POST['description'];
       $address_line = $_POST['address_line'];
       $city = $_POST['city'];
       $state = $_POST['state'];
       $zip = $_POST['zip'];
       $country = $_POST['country'];
       $min_days = $_POST['min_days'];
       $max_days = $_POST['max_days'];
       $photos[] = $_POST['url']; 
       
      // $photos = $_FILES['photos']['tmp_name'];
      // $language_name = $_POST['languages_name'];
       //$skills_name = $_POST['skills_name'];
       $id_usuario = $_SESSION['user'];
      
      
      if ($this->post->getPhotos()) {
          
        }  

       //print_r($_POST);
      // die();
       if(isset($_POST)) { 

      $id_post = $this->post->updatePost(array( 
        'title' => $title,
        'description' => $description, 
        'address_line' => $address_line, 
        'city' => $city, 
        'state' => $state, 
        'zip' => $zip, 
        'country' => $country, 
        'min_days' => $min_days, 
        'max_days' => $max_days
      ));

      $this->post->insertLanguages($id_post, $language_name);

      $this->post->insertSkills($id_post, $skills_name); 

      // $dados['id_lugares'] = $id_post;

       $this->data['msg'] = "Mensagem inserida com sucesso";      

       } else {

       $this->data['msg'] = "Houve um problema ao inserir a mensagem!";
         
//      // $this->redirect('account/index', $dados);   
      
    }
} 




    
  
  $this->loadTemplate('account/edit/index', $this->getData());    


}

public function delete() {
  $post = new Account();  
  $this->data = $this->user->getDados($_SESSION['user']); 
     

   if($this->post->getLugares($_SESSION['user']) !== NULL) {
    
    $p = null; 

     

        foreach ($this->post->getLugares($_SESSION['user']) as $key => $lug) {         
         
          $addr = $this->post->getAddress($lug['id_post']);
          $days = $this->post->getDays($lug['id_post']);
          $category = $this->post->getCategoryId($lug['id_category']);

            $p[] = [
                'id' => $lug['id_post'],
                'id_category' => $lug['id_category'],
                'category' => $category['title'],
                'title' => $lug['title'],
                'description' => $lug['description'],
                'address_line' => $addr['address_line'],
                'city' => $addr['city'],
                'state' => $addr['state'],
                'zip' => $addr['zip'],
                'country' => $addr['country'],
                'min_days' => $days['min_days'],
                'max_days' => $days['max_days'],
                'main_image' => $lug['url'],
                'images' => $this->post->getImages($lug['id_post']),
                'linguas' => $this->post->getLanguages($lug['id_post']),
                'skill' => $this->post->getSkills($lug['id_post'])
            ];
        }
      $this->data['lugares'] = $p; 

       
      
}

       

if(isset($_POST['id']) && !empty($_POST['id'])) {
       

      $id = $_POST['id'];

      // $photos = $_FILES['photos']['tmp_name'];
      // $language_name = $_POST['languages_name'];
       //$skills_name = $_POST['skills_name'];
      $id_user = $_SESSION['user'];
      
      if($post->deletePost($id, $id_user)) { 

      $this->redirect('account/index', $this->getData());
    }  
      
 }  else {

    $this->data['msg'] = "Houve um problema ao deletar!"; 
 } 
  
  $this->loadTemplate('account/index', $this->getData());    
  

}







 
}