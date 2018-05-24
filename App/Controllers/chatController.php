<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Message;
use App\Models\Chat;
use App\Lib\Pagination;
use App\Lib\Sessao;
use App\Lib\Helps;


class chatController extends Controller {

  private $User;
  private $Chat;
  private $Success;
  private $Pagination;
  private $SendMsg;
  private $PostMsg;


  public function __construct() {
   parent::__construct();
   $this->Pagination = new Pagination();
   $this->User = new Users();
   $this->Chat = new Chat();
   $this->User->verifyLogin();
   $this->data = $this->User->getDados($_SESSION['user']); 


 }

 public function index() 
 {  

  Sessao::clearMsg();
  
 // var_dump($this->Chat->getMsg($this->Chat->getIdMsg()['c_id'])); exit;

    $this->data['listMsg'] = $this->Chat->getMsg($this->Chat->getIdMsg()['c_id']);
    $this->data['Pagination'] = $this->Chat->getPaginationChat();  


    if (!empty($_GET['chat_id']))  {

      $_SESSION['chat_id'] = filter_input(INPUT_GET, 'chat_id', FILTER_SANITIZE_NUMBER_INT);

      $this->data['Pagination'] = $this->Chat->getPaginationChat();  
      $this->data['listMsg'] = $this->Chat->getMsg($_SESSION['chat_id']);
    // $this->redirect('chat/index');

    }



 // else {

 //    $this->data['Pagination'] = $this->Chat->getPaginationChat(); 
 //    $this->data['listMsg'] = $this->Chat->getMsg(self::getIdMsg()[0]['c_id']);
 // }

//   if(isset($_SESSION['post_id']) && !empty($_SESSION['post_id']) && isset($_SESSION['id_user_to']) && !empty($_SESSION['id_user_to'])) 
//   {
//     $this->data['Pagination'] = $this->Chat->getPaginationChat();  
//     $this->data['listMsg'] = $this->Chat->getMsg($_SESSION['lastId']);


//      // $_SESSION['post_id'] = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

//     // $_SESSION['id_user_to'] = filter_input(INPUT_POST, 'id_user_to', FILTER_SANITIZE_NUMBER_INT);

//     // if ($this->Chat->checkReply($_SESSION['user'], $_SESSION['id_user_to'])) {

//     //   $this->redirect('chat/welcome');

//     // }

//     // $this->data['Host_Post'] = $this->Chat->getPost($_SESSION['id_user_to']);

//     // $this->data['Host_Name'] = $this->User->getName($_SESSION['id_user_to']); 

//     // $this->Chat->startChat($_SESSION['user'], $_SESSION['id_user_to'], $_SERVER['REMOTE_ADDR']); //$_SESSION['lastId'] = 

// }  

    if(isset($_POST['message']) && empty($_POST['message'])) { 
       
        $_SESSION['msg'] = "Please fill in all fields";
    }

    if (isset($_POST['message']) && !empty($_POST['message'])) {

      $_SESSION['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

      $_SESSION['id_post'] = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

      $_SESSION['id_user_to'] = filter_input(INPUT_POST, 'id_user_to', FILTER_SANITIZE_NUMBER_INT);

      self::firstChat(); 

    } 
   

// var_dump($this->Chat->getCheckReply());
    $this->loadTemplate('chat/index', $this->getData());

   

}

public function chat() 
{  

//   Sessao::clearMsg();

//   $this->redirect('inbox/empty');

//   $this->data['listMsg'] = $this->Chat->getMsg($_POST['chat_id']);
//   $this->data['Pagination'] = $this->Chat->getPaginationChat();

//   if (isset($_POST['chat_id']) && !empty($_POST['chat_id'])) {

//     $this->data['listMsg'] = $this->Chat->getMsg($_POST['chat_id']); 

//   } else {

//     $this->data['listMsg'] = $this->Chat->getMsg($_SESSION['lastId']);

//   }

//   if(isset($_POST['id_post']) && !empty($_POST['id_post']) && isset($_POST['id_user_to']) && !empty($_POST['id_user_to']) && $_POST['id_user_to'] != $_SESSION['user']) 
//   {

//     $_SESSION['post_id'] = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

//     $_SESSION['id_user_to'] = filter_input(INPUT_POST, 'id_user_to', FILTER_SANITIZE_NUMBER_INT);

//     // $this->data['Host_Post'] = $this->Chat->getPost($_SESSION['id_user_to']);

//     // $this->data['Host_Name'] = $this->User->getName($_SESSION['id_user_to']); 

//     $this->Chat->startChat($_SESSION['user'], $_SESSION['id_user_to'], $_SERVER['REMOTE_ADDR']);  

//     $this->loadTemplate('chat/index', $this->getData());


// }  

// if (isset($_POST['message']) && !empty($_POST['message'])) {

//       $_SESSION['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

//       self::firstChat(); 

//   } 

// // var_dump($this->Chat->getCheckReply());
//   $this->loadTemplate('inbox/index', $this->getData());



}

public function firstChat() 
{
  if($_SESSION['id_post'] && $_SESSION['id_user_to'] && $_SESSION['message']) {
  
  
    $this->Chat->insertReply($_SESSION['user'], $_SESSION['message'], $_SERVER['REMOTE_ADDR'], $_SESSION['id_post'], $_SESSION['chat_id']);

    $this->redirect('chat/index');
   

  } else {

    $_SESSION['msg'] = "Erro ao enviar a mensagem";
  }
}

public function send() 
{
  
  echo "AQUI É SESSION";
  var_dump($_SESSION);
 
  echo "AQUI é POST";
  var_dump($_POST); 


  if(isset($_POST['id_post']) && !empty($_POST['id_post']) && isset($_POST['id_user_to']) && !empty($_POST['id_user_to'])) 
  {

    $_SESSION['post_id'] = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

    $_SESSION['id_user_to'] = filter_input(INPUT_POST, 'id_user_to', FILTER_SANITIZE_NUMBER_INT);

    $_SESSION['Host_Post'] = $this->Chat->getPost($_SESSION['id_user_to']);
    
    $_SESSION['Host_Name'] = $this->User->getName($_SESSION['id_user_to']); 

    $this->Chat->startChat($_SESSION['user'], $_SESSION['id_user_to'], $_SERVER['REMOTE_ADDR']);
  
  }
 
  
  if (isset($_POST['message']) && empty($_POST['message'])) {
       
      $_SESSION['msg'] = "Please fill in all fields";
   } 

  if(isset($_POST['message']) && !empty($_POST['message'])) {

    $_SESSION['id_user_to'] = filter_input(INPUT_POST, 'id_user_to', FILTER_SANITIZE_NUMBER_INT);

    $_SESSION['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if($this->Chat->insertReply($_SESSION['user'], $_SESSION['message'], $_SERVER['REMOTE_ADDR'], $_SESSION['post_id'], $_SESSION['last_id'])) {   
      
      $_SESSION['msg'] = "Sucess";
      $this->redirect('chat');
    
    }  else {

      $_SESSION['msg'] = "Erro ao enviar a mensagem";
    } 
     
  }
   
  

  $this->loadTemplate('chat/chat', $this->getData());

}

public function chatMsg() 
{
  $this->data['Pagination'] = $this->Chat->getPaginationChat();
  $this->loadTemplate('chat/welcome', $this->getData()); 
}


}
