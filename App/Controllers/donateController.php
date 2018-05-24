<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;


class DonateController extends Controller
{
    public function index()
    {   
    	
        $u = new Users();
        $this->data = $u->getDados($_SESSION['user']);

        $this->loadTemplate('donate/index', $this->getData());
    }
}