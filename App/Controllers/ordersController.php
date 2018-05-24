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


class ordersController extends Controller
{   

    private $User;
    private $Relations;
    private $post;
    private $sub;
    private $search;
    private $msg;
    private $Places;

    public function __construct() {
      parent::__construct();
      $this->user = new Users(); 
      $this->user->verifyLogin();
      $this->data = $this->user->getDados($_SESSION['user']); 
    }

    public function index()
    {   
    
    $this->post = new Account();
    $this->sub = new Subscribe();
    $this->search = new Search();
    $this->Relations = new Relations();
    $this->Places = new Posts();

    $category = $this->post->getCategory();
    
    if(!empty($this->data['list'] = $this->Relations->getListPost())) {

      $this->data['msg'] = 'Você tem um total de ';

      $this->data['TotalSubs'] = $this->Relations->getTotalSubs();
         
    }

    if ($this->data['getSubs'] = $this->Relations->getSubscribers()) { 
    
    for ($i=0; $i < count($this->data['getSubs']); $i++) { 
           $this->data['Places'] = $this->Places->getPosts($this->data['getSubs'][$i]['id']);
       }   
    
    }      
      
    $offset = 0;
    $limit = 3; 
    $total = $this->post->getTotal();
  

    $this->data['pages'] = ceil($total / $limit);
   
    $this->data['currentPage'] = 1;
   
    if (!empty($_GET['p'])) {

        $this->data['currentPage'] = intval($_GET['p']);
    }

    $offset = ($this->data['currentPage'] * $limit) - $limit;


    $this->data['lugares'] = $this->post->getTotalPosts($offset, $limit);

    $this->data['total'] = $total;

    $this->data['category'] = $this->post->getCategory();

  $_POST['add'] = null;

    if($_POST['add'] == 'CliqueiEmAdd') {
      var_dump($_POST);
      die;
      self::accept($_POST['id_post'], $_POST['id_user_to']);
    }


    $this->loadTemplate('subscribes/index', $this->getData());

  }

  public function add() {
  

    $this->Relations = new Relations();

       if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {
          $id_user = $_SESSION['user']; // ID USUARIO LOGADO
          $id_post_to = addslashes($_POST['id_post']); // ID POST 
          $id_user_to = addslashes($_POST['id_user_to']); // ID DO USUARIO DONO DO POST
          //$postTitle = addslashes($_POST['postTitle']); // TITULO DO POST

        if($id_user && $id_post_to && $id_user_to) {  
      
          $this->Relations->addSubscriber($id_user, $id_post_to, $id_user_to);  


        } else {

          $this->data['msg'] = "Ocorreu algum problema!";
        
        }
      }

    }

    public function accept() {
      
      $this->User = new Users(); 
      $this->Relations = new Relations(); 
      $this->data = $this->User->getDados($_SESSION['user']);   
      
        if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {
          $id_post = addslashes($_POST['id_post']);
          $id_to = addslashes($_POST['id_user_to']);
          $id_from = $_SESSION['user'];
 
        if ($id_post && $id_from && $id_to) {
         
          $this->Relations->acceptSubscriber($id_from, $id_to, $id_post);
          $_SESSION['msgConfirm'] = "Usuário aceito com sucesso!";
          $this->redirect('subscribes');
        }

        $this->loadTemplate('subscribes/index', $this->getData());
      }

    }

    public function notAccept() {
      
      $this->User = new Users(); 
      $this->Relations = new Relations(); 
      $this->data = $this->User->getDados($_SESSION['user']);   
      
        if(isset($_POST['id_post']) && !empty($_POST['id_post'])) {
          $id_post = addslashes($_POST['id_post']);
          $id_to = addslashes($_POST['id_user_to']);
          $id_from = $_SESSION['user'];
 
        if ($id_post && $id_from && $id_to) {
         
          $this->Relations->notSubscriber($id_from, $id_to, $id_post);
          $_SESSION['msgConfirm'] = "Usuário aceito com sucesso!";
          $this->redirect('subscribes');
        }

        $this->loadTemplate('subscribes/index', $this->getData());
      }

    } 

}

