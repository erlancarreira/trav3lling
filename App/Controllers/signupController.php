<?php

namespace App\Controllers;

use App\Core\Controller;


class signupController extends Controller
{
    
  private = $User;

    public function __construct() {
        parent::__construct();
        $this->User = new Users();

     } 

    public function index()
    {  
        
          
      $this->loadTemplate('signup/index');
      
          
    }  

    public function register()
    {

        $u = new Usuarios(); 
        $email = $_POST['email'];
        $nome  = $_POST['nome']; 
        $senha = $_POST['senha'];
        $confirm = $_POST['confirmation']; 

        if(isset($_POST['email']) && !empty($_POST['email']) ) { 
        
         
       var_dump($senha, $confirm);
        
        if($confirm !== $senha) {
      
           $data['msg'] = 'Senha incorreta';
        } 


        if ($u->cadastrar($nome, $email, $senha) == 1) {
           $data['msg'] = 'Cadastro feito com sucesso';
        
        } else {
          $data['msg'] = 'Email existente';
           
        }
                     
        }   

        else {
          $this->redirect('signup', $data);
        }
           

       // if { 
             
       // $data['msg'] = 'Entrei em cadastrar';
       // $this->redirect('signup', $data);

       // }  else {         
           
           
      //    $data['msg'] = 'Dados incorretos';
        //  $this->redirect('signup', $data);
        //}

      $this->loadTemplate('signup/index', $data);   
        
    }
           
             

       
  
   
      
    
 }