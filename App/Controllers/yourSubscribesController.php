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
        
        $places[] = ($this->Places->getPosts($id, $id_user));

                
        }
   // }
      //  var_dump( Helps::recursive_show_array($places) );


        $this->data['Places'] = $places;   
    }

     
  //  var_dump($this->data['Places']);
                //$var = $this->Places->getPosts($this->data['getSubs'][$i]['id']); 

           
        
      // $this->data['Places'] = $this->Places->getPosts($id_post, $id_user);

   
  //  var_dump($this->relations->getIdsSubs($_SESSION['user']));  
   
        
      


    $this->loadTemplate('yourSubscribes/index', $this->getData());

  }

}