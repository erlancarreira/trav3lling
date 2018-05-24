<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;

class sliderController extends Controller
{
    private $user;
    private $post;


    public function index()
    {   
    
    $this->user = new Users(); 
    $this->post = new Account();
    $this->data = $this->user->getDados($_SESSION['user']); 
    //$dados['msg'] = $this->msg->getMsg();   

    //print_r($_SESSION['user']); 
    //exit(); 

  if($this->post->getLugares($_SESSION['user']) !== NULL) {
    
    $p = null; 

     

        foreach ($this->post->getLugares($_SESSION['user']) as $key => $lug) {         
         
          $addr = $this->post->getAddress($lug['id_post']);
          $days = $this->post->getDays($lug['id_post']);
          $category = $this->post->getCategory($lug['id_post']);
          $images[] = $this->post->getImages($lug['id_post']);



            $p[] = [
                'id' => $lug['id_post'],
                'category' => $category['title'],
                'title' => $lug['title'],
                'description' => $lug['description'],
                'address_line' => $addr['address_line'],
                'city' => $addr['city'],
                'state' => $addr['state'],
                'zip' => $addr['zip'],
                'country' => $addr['country'],
                'min_days' => $days['min_days'],
                'max_days' => $days['max_days'],
                'main_image' => $lug['url'],
                'images' => $images,
                'linguas' => $this->post->getLanguages($lug['id_post']),
                'skill' => $this->post->getSkills($lug['id_post'])
            ];
        }
      $this->data['lugares'] = $p; 

       
      
    }

    $this->loadTemplate('search/index', $this->getData());

}  

    public function search()
    {
       
        $u = new Users();
        $dados = $u->getDados($_SESSION['user']);
        
        $this->loadTemplate('search/index', $this->getData());
    }


  
}