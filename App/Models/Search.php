<?php

namespace App\Models;

use App\Core\Model;
use App\Lib\Helps;

class Search extends Model {

  private $Result;


  public function getTotalPosts($offset = null, $limit = null, $id_category = null) {

  $id_user = $_SESSION['user'];

  if( isset($id_category) && !empty($id_category)) {

  $sql = "SELECT * FROM posts_pl WHERE id_user NOT IN ($id_user) AND id_category = '$id_category'";

  } else {

   $sql = "SELECT * FROM posts_pl WHERE id_user NOT IN ($id_user)";   
  
  }  
          
  if (!empty($limit) || !empty($offset)) {
    
    $sql .= " ORDER BY id_category LIMIT $offset, $limit ";
  
  }  

 $sql = $this->db->prepare($sql);        

try {
  $sql->execute();

  if ($sql->rowCount() > 0) {

    foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $lug) {
      $address = self::getAddress($lug['id']);
      $category = self::getCategoryId($lug['id_category']); 
      $days = self::getDays($lug['id']);

      $array[] = [
        'id' => $lug['id'],
        'id_user' => $lug['id_user'],
        'id_category' => $lug['id_category'],
        'title' => $lug['title'],
        'description' => $lug['description'],
        'address_line' => $address['address_line'],
        'city' => $address['city'],
        'state' => $address['state'],
        'zip' => $address['zip'],
        'country' => $address['country'],
        'category_name' => $category['title'],
        'main_image' => $lug['url'],
        'img_slider' => self::getImages($lug['id']),
        'min_days' => $days['min_days'],
        'max_days' => $days['max_days'],
        'linguas' => self::getLanguages($lug['id']),
        'skill' => self::getSkills($lug['id']),
        'date_post' => $lug['date_create']
      ];
    } 
               
    return $array;

  }
} catch (PDOException $e) {
  die($e->getMessage());
}

}
public function getSearch($array) {
  $array = array();
  !$texto = intval($_GET['texto']);
  !$category = intval($_GET['category']);	

  if(!empty($_GET['texto']) || !empty($_GET['category'])) {
    !$texto = $_GET['texto'];
    !$category = intval($_GET['category']);


    $sql = "SELECT * FROM posts_pl WHERE"; 
    !$sql .= " title LIKE :texto ";
    if($texto && $category) {
      $sql .= "AND";
    }  
    !$sql .= " id_category = :id_category ";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":texto", '%'.$texto.'%');
    !$sql->bindValue(':id_category', $id_category);
    try {
      $sql->execute();
      if ($sql->rowCount() > 0) {

        foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $post) {
          $array[] = array('title'=>$post['title'], 
           'id'=>$post['id']);
        }

        return json_encode($array);
      }


    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }    
}



public function getTotal() {
  $user = $_SESSION['user'];
  $sql = "SELECT COUNT(*) as c FROM posts_pl WHERE id_user != '$user'";
  $sql = $this->db->query($sql);
  $sql = $sql->fetch();
  
  return $sql['c']; 
} 


public function getPost() {

  $this->a = new Account();

    //    $ids = implode(",", self::getResult());

 //       $id_post = $ids; 
  $id_post = self::getResult();
  if (!empty($id_post)) {        
    $id_post = array_values($id_post);
    $id_post = implode(",", $id_post);
  }

  $sql = "SELECT * FROM posts_pl WHERE ";

  $sql .= "FIND_IN_SET (id, :id_post)";

  $sql = $this->db->prepare($sql);

  $sql->bindValue(':id_post', $id_post);
  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {

      foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $lug) {
        $address = $this->a->getAddress($lug['id']);
        $category = $this->a->getCategoryId($lug['id_category']); 
        $days = $this->a->getDays($lug['id']);

        $array[] = [
          'id' => $lug['id'],
          'id_user' => $lug['id_user'],
          'id_category' => $lug['id_category'],
          'title' => $lug['title'],
          'description' => $lug['description'],
          'address_line' => $address['address_line'],
          'city' => $address['city'],
          'state' => $address['state'],
          'zip' => $address['zip'],
          'country' => $address['country'],
          'category_name' => $category['title'],
          'main_image' => $lug['url'],
          'img_slider' => $this->a->getImages($lug['id']),
          'min_days' => $days['min_days'],
          'max_days' => $days['max_days'],
          'linguas' => $this->a->getLanguages($lug['id']),
          'skill' => $this->a->getSkills($lug['id']),
          'date_post' => $lug['date_create']
        ];
      } 

      return $array;


    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }

}




public function getResult() {


 if ($this->Result) {
  for ($i=0; $i < count($this->Result); $i++) {  

    $value[] = $this->Result[$i];     

  }

  return $value;
}


return $this->Result;

}


public function searchPosts($title, $id_category) {
  
  $id_user = $_SESSION['user'];      
  
  $sql = "SELECT address_pl.id_post, posts_pl.id FROM address_pl, posts_pl WHERE posts_pl.id_user != '$id_user' AND posts_pl.title LIKE '%' :title '%'"; 

  if ($id_category == 'all') {   

    $sql .= " AND posts_pl.id_category IN (1,2,3)"; 
  
  } else {

    $sql .= " AND posts_pl.id_category = :id_category;";
  }

  $sql .= " OR (address_pl.city LIKE '%' :title '%' AND posts_pl.id = address_pl.id_post) OR (address_pl.address_line LIKE '%' :title '%' AND posts_pl.id = address_pl.id_post) OR (address_pl.state LIKE '%' :title '%' AND posts_pl.id = address_pl.id_post) OR (address_pl.zip LIKE '%' :title '%' AND posts_pl.id = address_pl.id_post) OR (address_pl.country LIKE '%' :title '%' AND posts_pl.id = address_pl.id_post)"; 

  $sql = $this->db->prepare($sql);
  
  $sql->bindValue(':title', $title);
  
  $sql->bindValue(':id_category', $id_category);

  
  try {

    $sql->execute();

    if ($sql->rowCount() > 0) {

      foreach ($sql->fetchAll() as $value) {

        $this->Result[] = $value['id'];

      }               
    }

  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// public function searchPosts($array) {
//   $id_user = $_SESSION['user'];

//   $where = $this->buildWhere($array);  

//   $sql = $this->db->prepare("SELECT address_pl.*, posts_pl.id FROM address_pl, posts_pl WHERE posts_pl.id_user != '$id_user' AND " . implode(' AND ', $where)); 

//   $this->bindWhere($array, $sql);   

//   try {

//     $sql->execute();

//     if ($sql->rowCount() > 0) {
   
//       foreach ($sql->fetchAll() as $value) {

//         $this->Result[] = $value['id'];

//       }               
//     } //else {
//     //     self::searchAddress($array);
//     // }

//   } catch (PDOException $e) {
//     die($e->getMessage());
//   }
// }

private function buildWhere($array) {
  $where = array(
    '1=1'
  );

  if (!empty($array['search'])) {
    $where[] = "title LIKE '%':search'%'";
  }

  if (!empty($array['id_category']) && $array['id_category'] != 'all') {
    $where[] = "posts_pl.id_category = :id_category";
  }

  if ($array['id_category'] == 'all') {   

    $where[] = "posts_pl.id_category IN (1,2,3)"; 
  }      

  if (!empty($array['title'])) {
    $where[] = "posts_pl.title LIKE '%' :title '%' || address_pl.city LIKE '%' :title '%'";
  }

  if (!empty($array['id'])) {
    $where[] = "id = :id";
  }

  if (!empty($array['id_user'])) {
    $where[] = "id_user = :id_user";
  }


  if (!empty($array['id_post'])) {
    $where[] = "id_post = :id_post";
  }

  return $where;
}

private function bindWhere($array, $sql) {

  if (!empty($array['id_category']) && $array['id_category'] != 'all') {
    $sql->bindValue(":id_category", $array['id_category']);

  }

  if ($array['id_category'] == 'all') {   

    $where[] = "id_category IN (1,2,3)"; 
  }

  if (!empty($array['title'])) {
    $sql->bindValue(":title", $array['title']);
  }

  if (!empty($array['id'])) {
    $sql->bindValue(":id", $array['id']);
  }

  if (!empty($array['id_user'])) {
    $sql->bindValue(":id_user", $array['id_user']);
  }

  if (!empty($array['id_post'])) {
    $sql->bindValue(":id_post", $array['id_post']);

  }

}

}	