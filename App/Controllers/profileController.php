<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class profileController extends Controller 
{
    private $User;
    private $msg;

    public function __construct() {
    	parent::__construct();
    	$this->User = new Users();
    	$this->User->verifyLogin(); 
        $this->data = $this->User->getDados($_SESSION['user']); 
    }


    public function index() 
    {    
     
        if(isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
       
            $image = $_FILES['photo'];
            $user = $_SESSION['user'];

            if ($this->User->profileImg($user, $image)) {
                
                $_SESSION['msg'] = $this->User->getMsg();
            
            } else {

                $_SESSION['msg'] = $this->User->getMsg();
            }
    
        }   

        if(isset($_POST['name']) && !empty($_POST['name'])) {
            
            $name = addslashes($_POST['name']);
            $bio = addslashes($_POST['bio']);
            
            $this->User->updatePerfil(array(
               'name' => $name,
               'bio' => $bio
            ));
        

            if(isset($_POST['password']) && !empty($_POST['password'])) {
                $password = md5($_POST['password']);

                $this->User->updatePerfil(array(
                    'password' => $password   
                ));
            }
            
        }

        if(!empty($_POST['languages'])) {
           
            $id_user = $_SESSION['user'];
            $languages = $_POST['languages'];

            if($this->User->selectLanguages($id_user) !== true) {

                $this->User->insertLanguages($id_user, $languages);
            
            } else {
                
                $this->User->deleteLanguages($id_user, $languages);

                $this->User->insertLanguages($id_user, $languages);
            }
        } 
        
         if(!empty($_POST['skills'])) {
           
            $id_user = $_SESSION['user'];
            $skills = $_POST['skills'];

            if($this->User->selectSkills($id_user) !== true) {

                $this->User->insertSkills($id_user, $skills);
            
            } else {
                
                $this->User->deleteSkills($id_user, $skills);

                $this->User->insertSkills($id_user, $skills);
            }
        } 

        
        
       
       

        !$this->data['skills'] = $this->User->getSkills($_SESSION['user']);  

        !$this->data['languages'] = $this->User->getLanguages($_SESSION['user']);  
        
        $this->data['info'] = $this->User->getDados($_SESSION['user']);
     
        $this->loadTemplate('profile/index', $this->getData());       
    }




}
