<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Lib\Helps;


class loginController extends Controller
{   
    private $User; 


    public function __construct() {
        parent::__construct();
        $this->User = new Users();

     }


     public function index()
     {  
      

      if (isset($_COOKIE['user']) && isset($_COOKIE['password'])) {
          $this->data['cookie_user'] = $_COOKIE['user'];
          $this->data['cookie_password'] = $_COOKIE['password'];
      }
        
      $this->loadTemplate('signin/index', $this->getData());
    
        
     }   

     public function entrar()
     {  

        if(isset($_POST['email']) && !empty($_POST['email'])) {
          $email = addslashes($_POST['email']);     
          $password = $_POST['password'];
         

        self::saveCookie($email, $password); 
        
        Helps::filterCheck($password);
        
        Helps::filterCheck($email);

  
          $this->data['erro'] = $this->User->logar($email, $password);
        }

        $this->loadTemplate('signin/index', $this->getData());
     }

             
            
    
    public function logout()
    { 
      unset($_SESSION['user']);
      header("Location: ".BASE);

    }
  
    public function saveCookie($email, $password) 
    { 
      if (isset($_POST['remember_me'])) {

      if (!isset($_COOKIE['cookie_user']) || !isset($_COOKIE['password'])) {
            setcookie('user', $email, (time() + (2 * 3600)));
            setcookie('password', $password, (time() + (2 * 3600)));

      }
    }  
    return false;
  }
 }