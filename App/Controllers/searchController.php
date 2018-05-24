<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;

use App\Models\Relations;
use App\Models\Search;
use App\Lib\Helps;

class searchController extends Controller
{
    private $user;
    private $post;
    private $search;
    private $msg;

    public function __construct() {
    parent::__construct();
    $this->user = new Users(); 
    $this->user->verifyLogin();
    $this->post = new Account();
    $this->search = new Search();
    $this->data = $this->user->getDados($_SESSION['user']);
     
  }
   


    public function index()
    {   
    
    $this->user = new Users(); 
    $this->post = new Account();
    
    $this->search = new Search();
    $this->data = $this->user->getDados($_SESSION['user']);     

    !$category = $this->post->getCategory();
    

    $offset = 0;
    $limit = 3; 
    $total = $this->search->getTotal();
    
    $this->data['pages'] = ceil($total / $limit);
   
    $this->data['currentPage'] = 1;
   
    if (!empty($_GET['p'])) {

        $this->data['currentPage'] = intval($_GET['p']);
    }

    $offset = ($this->data['currentPage'] * $limit) - $limit;     

    $this->data['home'] = $this->post->getTotalPosts($offset, $limit);
    $this->data['hotel'] = $this->post->getHotel($offset, $limit);
    $this->data['experience'] = $this->post->getExperience($offset, $limit);

    $this->data['total'] = $total;

    $this->data['category'] = $this->post->getCategory();   


    if (isset($_GET['id']) && !empty($_GET['id']))  {    
         
        $this->relations = new Relations;     

        $id_post = intval($_GET['id']);
        
        $id_user = $_SESSION['user'];
        
        $this->data['postId'] = $this->post->getPostId($id_post); 

        $this->data['subscriber_status'] = $this->relations->verifySubscriber(); 
       
        $this->loadTemp('search/single/index', $this->getData());
       
       
    }


    $this->loadTemplate('search/index', $this->getData());


}  


    public function result()
    {    
         
        
       
        if (isset($_GET['title']) && !empty($_GET['title']))  { 
            
             
        $title = $_GET['title'];
        $id_category = intval($_GET['category']);
        
        $this->search->searchPosts($title, $id_category);
        $this->data['search'] = $this->search->getResult();
        $this->data['lugares'] = $this->search->getPost(); 
        
      } 
    
        
    $this->loadTemplate('search/result/index', $this->getData());   
    
  }

}