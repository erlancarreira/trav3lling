<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;
use App\Models\Posts;
use App\Lib\Pagination;
use App\Lib\Helps;
use App\Lib\Sessao;




class AccountController extends Controller
{   
  private $user;
  private $Post;
  private $Places;
  private $Pagination;
  private $DataPost;


  public function __construct() {
    parent::__construct();
    $this->user = new Users(); 
    $this->user->verifyLogin();
    $this->post = new Account();
    $this->Places = new Posts(); 
    $this->Pagination = new Pagination();
    $this->data = $this->user->getDados($_SESSION['user']);
    !$this->Places->getPosts($id_post = null, $_SESSION['user']);
    !$this->data['category'] = $this->post->getCategory(); 
    $this->data['msg'] = Sessao::getMsg();
  }

  public function index()
  {

     
    
    Sessao::clearMsg(); 

    $this->data['category'] = $this->post->getCategory(); 


    !$this->data['Places'] =  $this->Places->getPosts($id_post = null, $_SESSION['user']); 


    $this->loadTemplate('account/index', $this->getData());        	

  }

  public function insert() {  

    Sessao::getMsg();

    if(isset($_POST['title']) && !empty($_POST['title'])) {

      $id_user = $_SESSION['user'];
      $id_category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT); 
      $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING); 
      $address_line = filter_input(INPUT_POST, 'address_line', FILTER_SANITIZE_STRING);     
      $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
      $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
      $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
      $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING); 
      $min_days = filter_input(INPUT_POST, 'min_days', FILTER_SANITIZE_NUMBER_INT); 
      $max_days = filter_input(INPUT_POST, 'max_days', FILTER_SANITIZE_NUMBER_INT); 
      $skills = filter_input(INPUT_POST, 'skills', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
      $languages = filter_input(INPUT_POST, 'languages', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

      if ($id_user && $id_category && $title && $description && $address_line && $city && $state && $zip && $country && $min_days && $max_days && $skills && $languages) {

        
        $id_post = $this->Places->setPost($id_user, $id_category, $title, $description);      

        $this->Places->setAddress($id_post, $address_line, $city, $state, $zip, $country); 

        $this->Places->insertSkills($id_post, $skills);

        $this->Places->insertLanguages($id_post, $languages);

        $this->Places->setDays($id_post, $min_days, $max_days);

        
        if (isset($_FILES['photos']) && !empty($_FILES['photos']['tmp_name'])) {
        
          $images = $_FILES['photos'];

          if(!$this->Places->postImg($id_post, $images)){

            Sessao::setMsg($this->data['msg'] = $this->Places->getMsg()); 
            
          }
          

        }
      
      

      } else {

        $this->loadTemplate('account/error/index', $this->getData()); 
        die();
      
      }
      
    }


      $this->redirect('account/'); 
    }

    public function edit() {

      $id_user = $_SESSION['user'];

      $id_post = intval($_GET['id']); 

      $this->data['category'] = $this->post->getCategory();

      $this->data['Places'] = $this->Places->getPosts($id_post , $_SESSION['user']);

      $this->data['msgteste'] = $this->Places->checkPrimary($id_post);
      
      if ($this->DataPost = filter_input_array(INPUT_POST, FILTER_DEFAULT)) {    

        // if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
        
        
       
        // $id_photo = $this->DataPost['photo'];  
       
        // // var_dump($_FILES['photo'], $id_photo);

        // // die;
                 
          
        //   $this->Places->uploadImg($this->DataPost['id_photo']);

        //   // $this->Places->checkImg($id_foto, $array);

        // }        

        //   if(!$this->Places->verifyImg($images, $id_foto)){

        //     Sessao::setMsg($this->data['msg'] = $this->Places->getMsg()); 
            
        //   }
        // }
          
        if($this->DataPost['category'] || $this->DataPost['title'] || $this->DataPost['description']) {

          $this->Places->updatePost(array( 
            'id_category' => $this->DataPost['category'],
            'title' => $this->DataPost['title'],
            'description' => $this->DataPost['description']        
          ));
        }


        if ($this->DataPost['address_line'] || $this->DataPost['city'] || $this->DataPost['state'] || $this->DataPost['zip'] || $this->DataPost['country']) { 

          $this->Places->updateAddress(array( 
            'address_line' => $this->DataPost['address_line'],
            'city' => $this->DataPost['city'],
            'state' => $this->DataPost['state'],
            'zip' => $this->DataPost['zip'],
            'country' => $this->DataPost['country']
          ));
        }  

        if ($this->DataPost['min_days'] || $this->DataPost['max_days']) {

          $this->Places->updateDays(array( 
            'min_days' => $this->DataPost['min_days'], 
            'max_days' => $this->DataPost['max_days']
          ));
        } 

        if($this->DataPost['languages'] && !empty($this->DataPost['languages'])) {

          $this->Places->deleteLanguages($this->DataPost['id_post']);

          $this->Places->insertLanguages($this->DataPost['id_post'], $this->DataPost['languages']);

          
        } 

        if(isset($this->DataPost['skills']) && !empty($this->DataPost['skills'])) {

          $this->Places->deleteSkills($this->DataPost['id_post']);

          $this->Places->insertSkills($this->DataPost['id_post'], $this->DataPost['skills']);

        } 

        // $this->data['msg'] = Helps::alert('success', 'Data successfully updated');

        $this->loadTemplate('account/edit/index', $this->getData()); 
        die();
      }

      $this->loadTemplate('account/edit/index', $this->getData());    


    }

    public function delete() {


      if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {


        $id = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

        $id_user = $_SESSION['user'];

        if($id && $id_user) { 
          
          $this->Places->deletePost($id, $id_user);

          $this->data['msg'] = "Post deleted successfully";   
         
          $this->loadTemplate('account/success/index', $this->getData()); 
          die();
        
        }  

      }  



      $this->redirect('account/');    


    }








  }