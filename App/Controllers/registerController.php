<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class registerController extends Controller
{   
    private $User; 


    public function __construct() {
        parent::__construct();
        $this->User = new Users();

     }


     public function index()
     {  
      $dados = array();
        
      $this->loadTemplate('signup/index', $dados);
    
        
     }   

     public function go() 
     {  

    
        if(isset($_POST['checkPass']) && !empty($_POST['checkPass']) && $_POST['checkPass'] == $_POST['password']) {
        
          if(isset($_POST['email']) && !empty($_POST['email'])) {
            $name = addslashes($_POST['name']);
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);       
         

            $this->User->signup($name, $email, $password);
            $this->data['msg'] = "Register Success!";
        
        } 

        } else {
           
           $this->data['msg'] = "Password confirm issues!";
        
        }

        $this->loadTemplate('signup/index', $this->getData());
     }              
    
    
 }