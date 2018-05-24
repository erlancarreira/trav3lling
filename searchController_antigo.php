<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Models\Account;
use App\Models\Posts;
use App\Lib\Pagination;
use App\Models\Search;

class searchController extends Controller
{
    private $user;
    private $post;
   // private $pagination;
   


    public function index()
    {   
    
    //$this->pagination = new Pagination();
    $this->user = new Users(); 
    $this->post = new Account();
    $this->data = $this->user->getDados($_SESSION['user']);     

    $category = $this->post->getCategory(); 

    

   /* try {
        $this->pagination->MaxPerPage(3);
        //$this->pagination->Page('erlan');
        $this->pagination->MaxLinks(2);
        $this->data['listagem'] = $this->pagination->CreatePagination("SELECT posts_pl.*, category.* FROM posts_pl, category WHERE posts_pl.id_category = category.id");

       $this->data['links'] = $this->pagination->CreateLinks();
    } catch (Exception $e) {
        die($e->getMessage());
    }
    */ 
/*
    $images_url = null;
      
    foreach($this->data['listagem'] as $key => $images) {            
            
    $images_url = $this->post->getImagensPost($images['id']); 
        
      $images_url[] = [
      'url' => $images_url
     ];
       
       
   } 
         
   
   $this->data['imagens_post'] = $images_url; 


*/

  
 /*

   $offset = 0;
   $limit = 5;
  if($this->post->getPosts($_SESSION['user'], $offset, $limit) !== NULL) {
   
 
    
 

  
    $p = null; 

    

        foreach ($this->post->getLugares($_SESSION['user'], $offset, $limit) as $key => $lug) {         
         
         
            $addr = $this->post->getAddress($lug['id_post']);
            $days = $this->post->getDays($lug['id_post']);
            $category = $this->post->getCategoryId($lug['id_category']);
            $images = $this->post->getImages($lug['id_post']);



            $p[] = [
                'id' => $lug['id_post'],
                'id_category' => $category['id'],
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
    var_dump($this->data['lugares']);
    exit;
    }
  */
    $this->data['totalPosts'] = $this->post->getTotalPosts(); 
    var_dump($this->data['totalPosts']);

    $offset = 0;
    $limit = 3; 
    $total = $this->post->getTotal(1);

    //$this->foreach($this->data['lugares']
  

    $this->data['pages'] = ceil($total / $limit);
   
    $this->data['currentPage'] = 1;
   
    if (!empty($_GET['p'])) {

        $this->data['currentPage'] = intval($_GET['p']);
    }

    $offset = ($this->data['currentPage'] * $limit) - $limit;

    $this->data['lugares'] = $this->post->getPosts($offset, $limit);



    $this->data['category'] = $this->post->getCategory();   
    //$this->data['house'] = $this->post->getHouse($category[0]['id']);       
   
    
    
/*
    if (isset($_POST['category'])) {
       
       $id_category = $_POST['category'];

       $array = $this->post->getPosts($id_category);

       header("Content-Type: application/json; charset=utf-8");

       echo json_encode($array);
       exit;
    }

    
  
    if(!empty($_POST['texto'])) {

    $texto = $_POST['texto'];

    $s = new Search();

    $s->getSearch($texto);
    var_dump($s->getSearch($texto));
    exit();


    $this->data['texto'] = $texto;
    

    }
*/
    $this->loadTemplate('search/index', $this->getData());

}  

    public function home()
    {
       
        $this->user = new Users(); 
        $this->data = $this->user->getDados($_SESSION['user']); 
       
        if(isset($_POST['category']) && !empty($_POST['category']) && $_POST['category'] == 1) {

           $this->loadTemplate('search/home', $this->getData()); 
        }

        $this->loadTemplate('search/home/index', $this->getData());
        
    }


  
}