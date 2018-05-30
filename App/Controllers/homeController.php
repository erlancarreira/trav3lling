<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class homeController extends Controller {
    
    private $User;
    
    public function __construct() {
    	parent::__construct();
    	$this->User = new Users();
    	// $this->User->verifyLogin();

    }

    public function index() {
    	
    	
    	if(isset($_SESSION['user']) && $_SESSION['user'] != null) {
          
          $this->data = $this->User->getDados($_SESSION['user']);
              	    
    	} else {

            $_SESSION = null;
        }
    	
    	


        $this->loadTemplate('home', $this->getData());
    }

}


