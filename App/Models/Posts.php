<?php 
namespace App\Models;

use App\Core\Model;
use App\Lib\Pagination;
use App\Lib\Upload;


class Posts extends Model
{
  private $Pagination;  
  private $msg;
  private $File;
  private $Upload;
  private $Images;

  public function getPlaces($id_user) 
  {

    $this->Pagination = new Pagination();

    try {

      foreach ($this->Pagination->CreatePagination("SELECT * FROM posts_pl WHERE id_user = $id_user") as $lug) {
        $address = $this->getAddress($lug['id']);
        $category = $this->getCategoryId($lug['id_category']); 
        $days = $this->getDays($lug['id']);

        $array[] = [
          'id_post' => $lug['id'],
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
          'img_slider' => $this->getImages($lug['id']),
          'min_days' => $days['min_days'],
          'max_days' => $days['max_days'],
          'linguas' => $this->getLanguages($lug['id']),
          'skill' => $this->getSkills($lug['id']),
          'date_post' => $lug['date_create']
        ];
      } 

      $array['Pagination'] = $this->Pagination->CreateLinks();
      

      return $array;


      
      $this->Pagination->MaxLinks(2); 

    } catch (Exception $e) {
      die($e->getMessage());
    }

  }

  public function getPosts($id_post = null, $id_user = null) 
  {      

    if (empty($id_user)) {

      $id_user = $_SESSION['user'];
    }  

    $sql = "SELECT * FROM posts_pl WHERE"; 

    if (!empty($id_user)) {	
      $sql .= " id_user = :id_user ";
    }

    if(isset($id_user) && isset($id_post)) {
      $sql .= "AND";
    }

    if (!empty($id_post)) {	 
      $sql .= " id = :id_post ";
    }

    $sql = $this->db->prepare($sql);
    if (!empty($id_user)) {
      $sql->bindValue(":id_user", $id_user);
    }
    if (!empty($id_post)) {
      $sql->bindValue(":id_post", $id_post);
    }

    try {
      $sql->execute();
      if ($sql->rowCount() > 0) {

        foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $lug) {
         $address = $this->getAddress($lug['id']);
         $category = $this->getCategoryId($lug['id_category']); 
         $days = $this->getDays($lug['id']);

         $array[] = [
           'id_post' => $lug['id'],
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
           'img_slider' => $this->getImages($lug['id']),
           'min_days' => $days['min_days'],
           'max_days' => $days['max_days'],
           'linguas' => $this->getLanguages($lug['id']),
           'skill' => $this->getSkills($lug['id']),
           'date_post' => $lug['date_create']
         ];
       } 

       return $array;

     }

   } catch (PDOException $e) {
    die($e->getMessage());
  }
}

public function getPost($id_post = null, $id_user = null) 
{      

  if (empty($id_user)) {

    $id_user = $_SESSION['user'];
  }  

  $sql = "SELECT * FROM posts_pl WHERE"; 

  if (!empty($id_user)) { 
    $sql .= " id_user = :id_user ";
  }

  if(isset($id_user) && isset($id_post)) {
    $sql .= "AND";
  }

  if (!empty($id_post)) {  
    $sql .= " id = :id_post ";
  }

  $sql = $this->db->prepare($sql);
  if (!empty($id_user)) {
    $sql->bindValue(":id_user", $id_user);
  }
  if (!empty($id_post)) {
    $sql->bindValue(":id_post", $id_post);
  }

  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {

      $array[] = $sql->fetchAll(\PDO::FETCH_ASSOC);


      return $array;

    }

  } catch (PDOException $e) {
    die($e->getMessage());
  }
}


public function getMsg() {

  return $this->msg;

}  



public function getImages($id_post) {

  $sql = "SELECT * FROM images_pl WHERE id_post = '$id_post' LIMIT 6"; 

  $sql = $this->db->query($sql);

  if ($sql->rowCount() > 0) {

    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }
}    

public function getLanguages($id_post) {
  $sql = "SELECT * FROM languages WHERE id_post = :id_post";

  $sql = $this->db->prepare($sql);

  $sql->bindValue(":id_post", $id_post);

  try {

    $sql->execute();

    if ($sql->rowCount() > 0) {

      return $sql->fetchAll(\PDO::FETCH_ASSOC);
      
    }

  } catch (PDOException $e) {

    die($e->getMessage());
  }
}

public function getSkills($id_post) {
  $sql = "SELECT * FROM skills WHERE id_post = :id_post";
  $sql = $this->db->prepare($sql);
  $sql->bindValue(":id_post", $id_post);
  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {
      return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

public function getAddress($id_post) {
  $sql = "SELECT * FROM address_pl WHERE id_post = '$id_post'"; 
  $sql = $this->db->query($sql);
  if ($sql->rowCount() > 0) {   

    $result = $sql->fetchAll(\PDO::FETCH_ASSOC); 

    for ($i=0; $i < count($result); $i++) { 
      $result = $result[$i];
      return $result;
    }

  }
}

public function getDays($id_post) {
  $sql = "SELECT min_days, max_days FROM date_pl WHERE id_post = '$id_post'"; 
  $sql = $this->db->query($sql);
  if ($sql->rowCount() > 0) {

    $result = $sql->fetchAll(\PDO::FETCH_ASSOC); 

    for ($i=0; $i < count($result); $i++) { 
      $result = $result[$i];      

      return $result;

    }
  }
}

public function getCategory() {
  $sql = "SELECT * FROM category"; 
  $sql = $this->db->query($sql);
  if ($sql->rowCount() > 0) {

   return $array = $sql->fetchAll(\PDO::FETCH_ASSOC); 
 }
}

public function getCategoryId($id_category) {
  $sql = "SELECT * FROM category WHERE category.id = '$id_category'"; 
  $sql = $this->db->query($sql);
  if ($sql->rowCount() > 0) {

   return $array = $sql->fetch(\PDO::FETCH_ASSOC); 
 }
}

public function getEvent($id_post, $id_user) {
  
  // print_r($id_post, $id_user);

  // exit();
  
  $sql = "SELECT * FROM events_pl WHERE id_post = :id_post AND id_user = :id_user"; 
  
  $sql = $this->db->prepare($sql);

  $sql->bindValue(":id_post", $id_post);

  $sql->bindValue(":id_user", $id_user);

 
  $sql->execute();
  if ($sql->rowCount() > 0) {



    return $array = $sql->fetchAll(\PDO::FETCH_ASSOC); 
  
  }
}




/*---------------------------------Inserts--------------------------------------------------------*/


public function setPost($id_user, $id_category, $title, $description) {

  $array = array();

  $id_user = $_SESSION['user'];
  $id_category = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['description'];        

  $sql = "INSERT INTO posts_pl (id_user, id_category, title, description, date_create) 
  VALUES (:id_user, :id_category, :title, :description, NOW())";   

  $sql = $this->db->prepare($sql);

  $sql->bindValue(":id_user", $id_user);
  $sql->bindValue(":id_category", $id_category);
  $sql->bindValue(":title", $title);
  $sql->bindValue(":description", $description);

  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {

      return $id_post = $this->db->lastInsertId();  

    } else {
     return $array = "Problem in insert";
   }

 } catch (PDOException $e) {
  die($e->getMessage());
}

}

public function setCategory($id_post, $category) {  

  $category = $_POST['category'];

  $sql = "INSERT INTO posts_pl (id_post, category) 
  VALUES (':id_post', ':category')"; 

  $sql = $this->db->query($sql);

  $sql = $this->db->prepare($sql);

  $sql->bindValue(":id_post", $id_post);

  $sql->bindValue(":category", $category);


  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {

      return true;  

    } else {

     return $array = "Problem in insert";
   }

 } catch (PDOException $e) {
  die($e->getMessage());
} 
}   



public function postImg($id, array $Images) {
  //  $MaxFileSize = null
  $this->File = $Images;
  $destiny = 'App/assets/img/account/places/';
  $extensao = $this->File['type'];
  $extensao = explode("/", $extensao[0]);
  $extensao = $extensao[1];
  // $MaxFileSize = ($MaxFileSize ? ($MaxFileSize * 1024) : (1 * 1024));
  $SizeFile = ($this->File['size'][0] / 1000);
  $SizeFile . + $SizeFile;

  $ext = ['jpeg', 'jpg', 'png'];

  if(!in_array($extensao, $ext)):
    $this->msg = "Imagem do tipo não permitido!";
    return false;
  // elseif ($SizeFile > $MaxFileSize): 
  //   $this->msg = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
  //   return false;
  else:
    if(count($this->File['tmp_name']) > 0) {
      for ($q=0; $q < count($this->File['tmp_name']); $q++) { 
        $nomedoarquivo = md5($this->File['name'][$q]) . '.jpg';
          if(move_uploaded_file($this->File['tmp_name'][$q], $destiny.$nomedoarquivo)){
          $this->addPostImgs($id, $nomedoarquivo);
          $this->msg = "Imagens Cadastradas com Sucesso!";
          
        }else{
          $this->msg = "Falha no Upload!";
          return false;
        }


      }
    }
  endif;       
}


public function addPostImgs($id_post, $images) {


    try {     

      $sql = "UPDATE posts_pl SET url = :images WHERE id = :id_post LIMIT 1";

      $sql = $this->db->prepare($sql);

      $sql->bindValue(":images", $images);

      $sql->bindValue(":id_post", $id_post);

      
      $sql = "INSERT INTO images_pl (id_post, url) VALUES (:id_post, :images)";

      $sql = $this->db->prepare($sql);

      $sql->bindValue(":images", $images);

      $sql->bindValue(":id_post", $id_post);

    if ($sql->rowCount() > 0) {

        return true;  

      } else {

        return $this->msg;
      
      } 

    } catch (PDOException $e) {
       die($e->getMessage());
    
  } 

} 



public function setAddress($id_post, $address_line, $city, $state, $zip, $country) {

  $array = array();

  $sql = "INSERT INTO address_pl (id_post, address_line, city, state, zip, country) 
  VALUES (:id_post, :address_line, :city, :state, :zip, :country)";        

  $sql = $this->db->prepare($sql);

  $sql->bindValue(":id_post", $id_post);
  $sql->bindValue(":address_line", $address_line);
  $sql->bindValue(":city", $city);
  $sql->bindValue(":state", $state);
  $sql->bindValue(":zip", $zip);
  $sql->bindValue(":country", $country);


  try {
    $sql->execute();
    if ($sql->rowCount() > 0) {

      return true;  

    } 

  } catch (PDOException $e) {
    die($e->getMessage());
  } 
}

public function insertSkills($id_post = null, $array = null) 
{   

  if(count($array) > 0) {    

    $campos = array();

    foreach($array as $campo => $valor) {

      $sql = "INSERT INTO skills SET id_post = :id_post, name = :valor"; 

      $sql = $this->db->prepare($sql);

      $sql->bindValue(":id_post", $id_post);
      $sql->bindValue(":valor", $valor);

      try { 

        $sql->execute();

      } catch (PDOException $e) {

        die($e->getMessage());

      }
    }  

  }          

}

public function insertLanguages($id_post = null, $array = null) 
{


  if(count($array) > 0) {    

    $campos = array();

    foreach($array as $campo => $valor) {

      $sql = "INSERT INTO languages SET id_post = :id_post, name = :valor"; 

      $sql = $this->db->prepare($sql);

      $sql->bindValue(":id_post", $id_post);
      $sql->bindValue(":valor", $valor);

      try { 

        $sql->execute();

      } catch (PDOException $e) {

        die($e->getMessage());

      }
    }  

  }          

}  

public function setDays($id_post, $min_days, $max_days) {

 $min_days = $_POST['min_days'];

 $max_days = $_POST['max_days'];

 $sql = "INSERT INTO date_pl (id_post, min_days, max_days) VALUES ('$id_post', '$min_days', '$max_days')";

 $sql = $this->db->query($sql);
} 

public function insertImg($image, $id_post) {    

    $sql = "INSERT INTO images_pl (url, id_post) VALUES (:image, :id_post)";

    $sql = $this->db->prepare($sql);

    $sql->bindValue(":image", $image);  

    $sql->bindValue(":id_post", $id_post); 

    
  try {
      $sql->execute();
      
      if ($sql->rowCount() > 0) {   
      
        return true; 

    } else {

        return $this->msg;
        
      } 

  } catch (PDOException $e) {
         die($e->getMessage());
    
    }
   



} 

public function setEvent($check_in, $check_out, $id_post, $id_user) {
  
  $sql = "INSERT INTO events_pl (check_in, check_out, id_post, id_user) VALUES (:check_in, :check_out, :id_post, :id_user)";

    $sql = $this->db->prepare($sql);

    $sql->bindValue(":check_in", $check_in); 

    $sql->bindValue(":check_out", $check_out); 

    $sql->bindValue(":id_post", $id_post);  

    $sql->bindValue(":id_user", $id_user); 
    
  try {

    $sql->execute();
      
      if ($sql->rowCount() > 0) {   
      
        return true; 

      } else {

        return $this->msg;
        
      } 

  } catch (PDOException $e) {
         die($e->getMessage());
    
    }    
}

/*-------------------------------------UPDATE-------------------------------------------------*/  

public function uploadImg($id) { 
  
  $Upload = new Upload(); 

  try {
         
      if (isset($_FILES['photo']) && !empty($_FILES['photo']) && isset($id)) {

          $Upload->set()
                 ->jpeg() //engloba os mimes (jpeg,jpg,pjeg)
                 ->png()  //engloba os mimes (png,x-png) 
                 ->path("App/assets/img/account/places/")
                 
                 ->moveFile('photo');

          if (!$Upload->getErros()) {

             if (isset($_POST['photo']) && !empty($_POST['photo'])){

              self::updateImg($Upload->getNameFile(), $_POST['photo']);
            
            }
            
            if(isset($_POST['insert']) && !empty($_POST['insert'])) {
              
              self::insertImg($Upload->getNameFile(), $_POST['insert']);
              
            } 

          } else {
            echo $Upload->getErros();
          }
              }
          } catch (Exception $e) {
              die($e->getMessage());
          }
}

public function checkImg($id_foto, array $photos) {

  // var_dump($photos); exit;
    if (isset($_FILES['photos']) && !empty($_FILES['photos'])) {
       
      for ($i=0; $i < count($_FILES['photos']['tmp_name']); $i++) { 

        $perm = array('image/jpeg', 'image/jpg', 'image/png');

          if(in_array($_FILES['photos']['type'][$i], $perm)) {
            
            $name = explode(".", $_FILES['photos']['name'][$i]);
            
            $nome = $name[0].'_trav3lling_'.time().'.jpg';
             
            move_uploaded_file($_FILES['photos']['tmp_name'][$i], 'App/assets/img/account/places/'.$nome);
            
           
          
            self::updateImg($nome, $id_foto[$i]);
          
          }
      }       
    }  
}

public function checkPrimary($id_photo) 
{

  $sql = "SELECT * FROM images_pl WHERE id_post = :id_photo";

      $sql = $this->db->prepare($sql);  

      $sql->bindValue(":id_photo", $id_photo); 

      try {
      $sql->execute();
      
      if ($sql->rowCount() > 0) {   
      
        return print_r($sql->fetchAll(\PDO::FETCH_ASSOC)[0]); 
        // return $array = $sql->fetchAll(); 


    } else {

        return $this->msg;
        
      } 

  } catch (PDOException $e) {
         die($e->getMessage());
    
    }
}

public function updateImg($image, $id_photo) {    

      $sql = "UPDATE images_pl SET url = :image WHERE id = :id_photo";

      $sql = $this->db->prepare($sql);

      $sql->bindValue(":image", $image);  

      $sql->bindValue(":id_photo", $id_photo); 

    
  try {
      $sql->execute();
      
      if ($sql->rowCount() > 0) {   
      
        return true; 

    } else {

        return $this->msg;
        
      } 

  } catch (PDOException $e) {
         die($e->getMessage());
    
    }
  




} 

public function updatePlace($id_post, $array = array()) {
  $id_post = $_POST['id_post'];
  $id_user = $_SESSION['user']; 
  if(count($array) > 0) {

    $this->Places->updatePost(array( 
      'id_category' => $id_category,
      'title' => $title,
      'description' => $description        
    ));

    !$this->updatePost($id_post = null, $array = null);
    !$this->updateAddress($id_post = null, $array = null);
    !$this->updateDays($id_post = null, $array = null);      
  }
}

public function updatePost($array = array()) {      
  $id = $_POST['id_post'];
  $id_user = $_SESSION['user'];

  if(count($array) > 0) {

    $sql = "UPDATE posts_pl SET ";

    $campos = array();
    foreach($array as $campo => $valor) {
     $campos[] = $campo." = '".$valor."'";
   }

   $sql .= implode(', ', $campos);

   $sql .= " WHERE id = '$id' AND id_user = '$id_user'";


   $sql = $this->db->query($sql); 



 }
} 

public function updateAddress($array = array()) {      
  $id_post = $_POST['id_post'];

  if(count($array) > 0) {

    $sql = "UPDATE address_pl SET ";

    $campos = array();
    foreach($array as $campo => $valor) {
     $campos[] = $campo." = '".$valor."'";
   }

   $sql .= implode(', ', $campos);

   $sql .= " WHERE id_post = '$id_post'";


   $sql = $this->db->query($sql); 



 }
} 

public function updateSkills($id_post, $array = array()) {      
  $id_post = $_POST['id_post'];

  if(count($array) > 0) {

    $sql = "UPDATE skills SET ";

    $campos = array();
    foreach($array as $campo => $valor) {
     $campos[] = $campo." = '".$valor."'";
   }

   $sql .= implode(', ', $campos);

   $sql .= " WHERE id_post = '$id_post'";


   $sql = $this->db->query($sql); 



 }
} 

public function updateDays($array = array()) {      
  $id_post = $_POST['id_post'];

  if(count($array) > 0) {

    $sql = "UPDATE date_pl SET ";

    $campos = array();
    foreach($array as $campo => $valor) {
     $campos[] = $campo." = '".$valor."'";
   }

   $sql .= implode(', ', $campos);

   $sql .= " WHERE id_post = '$id_post'";

   $sql = $this->db->query($sql); 



 }
}  

public function upLang($id_post, $languages_name) {

 $id_post = $_POST['id_post'];

 $languages_name = $_POST['languages_name'];

 foreach ($languages_name as $language_name) {

   $sql = "UPDATE languages SET name = '$language_name', id_post = '$id_post'";  

   $sql = $this->db->query($sql);   

 }
} 

/*------------------------------------Delete------------------------------------*/

public function deleteLanguages($id_post) 
{

  $sql = "DELETE FROM languages WHERE id_post = '$id_post'"; 

  $sql = $this->db->prepare($sql);

  try { 

    $sql->execute();

  } catch (PDOException $e) {

    die($e->getMessage());

  }  
}

public function deleteSkills($id_post) 
{

  $sql = "DELETE FROM skills WHERE id_post = '$id_post'"; 

  $sql = $this->db->prepare($sql);

  try { 

    $sql->execute();

  } catch (PDOException $e) {

    die($e->getMessage());

  }  
}

public function deletePost($id, $id_user) {      
  $id = $_POST['id_post'];
  $id_user = $_SESSION['user'];

  $sql = $this->db->query("DELETE FROM posts_pl WHERE posts_pl.id = '$id' AND posts_pl.id_user = '$id_user'");
  $sql = $this->db->query("DELETE FROM address_pl WHERE address_pl.id_post = '$id'");
  $sql = $this->db->query("DELETE FROM images_pl WHERE id_post = '$id'");
  $sql = $this->db->query("DELETE FROM skills WHERE id_post = '$id'");
  $sql = $this->db->query("DELETE FROM languages WHERE id_post = '$id'");
  $sql = $this->db->query("DELETE FROM relations WHERE id_post = '$id'");        

}



}      
