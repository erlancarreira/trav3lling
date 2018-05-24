<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class errorController extends Controller {

    //private $user;

    public function index() {

    	$this->user = new Users(); 
    	$this->data = $this->user->getDados($_SESSION['user']);
    	

        $this->loadView('error_404', $this->getData());
    }

}
