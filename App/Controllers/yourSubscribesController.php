<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;
use App\Models\Search;
use App\Models\Relations;
use App\Models\Subscribe;
use App\Models\Posts;
use App\Lib\Helps;


class yoursubscribesController extends Controller
{   

    private $user;
    private $relations;
    private $post;
    private $sub;
    private $search;
    private $msg;
    private $Places;

   // private $pagination;
   


    public function index()
    {   
    
    //$this->pagination = new Pagination();
    
    $this->user = new Users(); 
    $this->post = new Account();
    $this->sub = new Subscribe();
    $this->search = new Search();
    $this->relations = new Relations();
    $this->Places = new Posts();
    $this->data = $this->user->getDados($_SESSION['user']);   

    if ($getSubs = $this->relations->getSubscribers()) { 
     //   var_dump($getSubs);
       //for ($i=0; $i < count($getSubs); $i++) {   
       foreach ($getSubs as $value) {
           
        $id = $value['id'];
        $id_user = $value['id_user'];
        
        !$this->data['userPhone'] = $this->relations->getPhone($id_user);

        !$this->data['dataEvent'] = $this->Places->getEvent($id, $_SESSION['user']);
        
        $places[] = $this->Places->getPosts($id, $id_user);
                
        }

        $this->data['Places'] = $places;          
       
    }
    
    if ($this->relations->getMySubs()) { 
      foreach ($this->relations->getMySubs() as $key) {

           
        $id = $key['id'];
        $id_user = $key['id_user'];
        
        !$this->data['MyUserPhone'] = $this->relations->getPhone($id_user);
        
        $mySubs[] = $this->Places->getPosts($id, $id_user);
            
      }
      
      $this->data['MySubs'] = $mySubs;  
    }    
    
    if(isset($_POST['check_in']) && !empty($_POST['check_in']) && isset($_POST['check_out']) && !empty($_POST['check_out'])) {
         
      $check_in = $_POST['check_in'];
      $check_out = $_POST['check_out'];
      $id_post = $_POST['id_post'];
      $id_user = $_POST['id_user'];

      if($this->Places->setEvent($check_in, $check_out, $id_post, $id_user)) {
         
        $_SESSION['msg'] = "Data inserida com sucesso!"; 
      
      }  

    }   


        
      


    $this->loadTemplate('yourSubscribes/index', $this->getData());

  }

}