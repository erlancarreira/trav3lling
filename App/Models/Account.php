<?php  


namespace App\Models;

use App\Core\Model;
use App\Lib\Image;

class Account extends Model
{
  private $msg;

  public function insertPost($title, $description, $id_user, $id_category, $address_line, $city, $state, $zip, $country, $language_name, $skills_name, $min_days, $max_days) {
      
      $id_user = $_SESSION['user'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $id_category = $_POST['category'];
      $languages_name = $_POST['languages_name'];
      $skills_name = $_POST['skills_name'];

     // $this->beginTransaction();      
      try {

      $this->db->beginTransaction();  
     
    
        
      $sql = "INSERT INTO posts_pl (title, description, id_category, date_create, id_user) 
              VALUES ('$title', '$description', '$id_category', NOW(), '$id_user')";  


      $sql = $this->db->query($sql);

      $id_post = $this->db->lastInsertId(); 



      if (isset($_FILES['photos']) && !empty($_FILES['photos']['tmp_name'])):  
  
      $imagens = $_FILES['photos'];

      $this->postImg($id_post, $imagens);

      $this->data['msg'] = $this->msg;

      endif; 



      $sql = "INSERT INTO address_pl (address_line, city, state, zip, country, id_post) 
              VALUES ('$address_line', '$city', '$state', '$zip', '$country', '$id_post')"; 
      
      $sql = $this->db->query($sql); 



      
         
      foreach ($languages_name as $language_name) {

     // $this->db->beginTransaction();   

      $sql = "INSERT INTO languages (id_post, name) VALUES ('$id_post', '$language_name')";  
        
      $sql = $this->db->query($sql);
    
      }





      $sql = "INSERT INTO skills (id_post, name) VALUES ('$id_post', '$skills_name')";
       
      $sql = $this->db->query($sql);
      

      $min_days = $_POST['min_days'];
      
      $max_days = $_POST['max_days'];

      $sql = "INSERT INTO date_pl (id_post, min_days, max_days) VALUES ('$id_post', '$min_days', '$max_days')";
       
      $sql = $this->db->query($sql);

      $daysId = $this->db->lastInsertId();  

      $this->db->commit();   

      return $id_post;

      } catch (Exception $e) {
        
        echo $e->getMessage();
        $this->db->rollBack();

      }       
  
}
/*
  public function insertPost($title, $description, $id_user) {
      
      $id_user = $_SESSION['user'];
      $title = $_POST['title'];
      $description = $_POST['description'];

      $sql = "INSERT INTO posts_pl (title, description, date_create, id_user) 
              VALUES ('$title', '$description', NOW(), '$id_user')";   

      $sql = $this->db->query($sql);
      
      $id_post = $this->db->lastInsertId();     

      return $id_post;

     
}


public function insertPostCategory($id_post, $category) {  
      $category = $_POST['category'];

      $sql = "INSERT INTO posts_pl (id_post, category) 
              VALUES ('$id_post', '$category')"; 
      
      $sql = $this->db->query($sql);
      
     // $id_post = $this->db->lastInsertId();

    //  return $id_post;

        
} 

public function insertPostAddress($address_line, $city, $state, $zip, $country, $id) {


      $sql = "INSERT INTO lugares (address_line, city, state, zip, country, id_post) 
              VALUES ('$address_line', '$city', '$state', '$zip', '$country', '$id')"; 
      
      $sql = $this->db->query($sql);
      
      $id_post = $this->db->lastInsertId();

      return $id_post;

   
}
*/
public function postImg($id = null, array $Image, $MaxFileSize = null) {
          $this->File = $Image;
          $destiny = 'App/assets/img/account/places/';
          $extensao = $this->File['type'];
          $extensao = explode("/", $extensao[0]);
          $extensao = $extensao[1];
          $MaxFileSize = ($MaxFileSize ? ($MaxFileSize * 1024) : (1 * 1024));
          $SizeFile = ($this->File['size'][0] / 1000);
          $SizeFile . + $SizeFile;

          $ext = ['jpeg', 'jpg', 'png'];

          if(!in_array($extensao, $ext)):
              $this->msg = "Imagem do tipo não permitido!";
          elseif ($SizeFile > $MaxFileSize): 
              $this->msg = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
          else:
              if(count($this->File['tmp_name']) > 0) {
                for ($q=0; $q < count($this->File['tmp_name']); $q++) { 
                  $nomedoarquivo = md5($this->File['name'][$q]) . '.jpg';
                  move_uploaded_file($this->File['tmp_name'][$q], $destiny.$nomedoarquivo);
              $this->addPostImgs($id, $nomedoarquivo);
              $this->msg = "Imagens Cadastradas com Sucesso!";
                }
              }
          endif;       
      }

/*   

public function insertPhotos($id_post, $photos) {

    $sql = "INSERT INTO lugares_images (id_post, url) 
              VALUES ('$id_post', $photos')"; 

    $sql = $this->db->query($sql);
      
}

public function insertLanguages($id_post, $language_name) {
    
    $languages_name = $_POST['languages_name'];
         
    foreach ($languages_name as $language_name) {

    $sql = "INSERT INTO languages (id_post, name) VALUES ('$id_post', '$language_name')";  
      
    $sql = $this->db->query($sql);

    $languagesId = $this->db->lastInsertId();

    }   
}

public function insertSkills($id_post, $skills_name) {

    $skills_name = $_POST['skills_name'];

    $sql = "INSERT INTO skills (id_post, name) VALUES ('$id_post', '$skills_name')";
     
    $sql = $this->db->query($sql);

    $skillsId = $this->db->lastInsertId();   
}

public function insertDate($id_post, $min_days, $max_days) {

    $min_days = $_POST['min_days'];
    $max_days = $_POST['max_days'];

    $sql = "INSERT INTO date_pl (id_post, min_days, max_days) VALUES ('$id_post', '$min_days', '$max_days')";
     
    $sql = $this->db->query($sql);

    $daysId = $this->db->lastInsertId();   
}

*/

public function updatePost($array = array()) {      
      $id = $_POST['id'];
      $id_usuario = $_SESSION['user'];
      
      if(count($array) > 0) {

            $sql = "UPDATE lugares SET ";

            $campos = array();
            foreach($array as $campo => $valor) {
               $campos[] = $campo." = '".$valor."'";
            }

            $sql .= implode(', ', $campos);

            $sql .= " WHERE id = '$id' AND id_usuario = '$id_usuario'";

           
            $sql = $this->db->query($sql); 


            
        }
}

public function deletePost($id, $id_user) {      
      $id = $_POST['id'];
      $id_user = $_SESSION['user'];

          $sql = $this->db->query("DELETE FROM posts_pl WHERE posts_pl.id = '$id' AND posts_pl.id_user = '$id_user'");
          $sql = $this->db->query("DELETE FROM address_pl WHERE address_pl.id_post = '$id'");
          $sql = $this->db->query("DELETE FROM images_pl WHERE id_post = '$id'");
          $sql = $this->db->query("DELETE FROM skills WHERE id_post = '$id'");
          $sql = $this->db->query("DELETE FROM languages WHERE id_post = '$id'");        
      
}


public function getData($userid) {
        
        $array = array();
        
        $userid = $_SESSION['user'];        

        $sql = "SELECT * FROM posts_pl WHERE id_usuario = '$userid'";
    
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            /*foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $lugares ) {
                $array[] = $lugares; 
            }*/
        }
        
        return $array;
    }



public function addPostImgs($id_post, $imagem) {

  $sql = "UPDATE posts_pl SET url = '$imagem' WHERE id = '$id_post' LIMIT 1";

  $sql = $this->db->query($sql);

  $sql = "INSERT INTO images_pl (id_post, url) VALUES ('$id_post', '$imagem')";
 
  $sql = $this->db->query($sql);


}          
       
      
public function getMsg() {
  
  return $this->msg;

}   
    


public function getTotal() {
  $user = $_SESSION['user'];
  $sql = "SELECT COUNT(*) as c FROM posts_pl WHERE id_user != '$user'";
  $sql = $this->db->query($sql);
  $sql = $sql->fetch();

  return $sql['c']; 
} 

/*
public function getSearch() {
        $sql = "SELECT * FROM posts_pl INNER JOIN languages
            ON posts_pl.id = languages.id_post
            WHERE posts_pl.id_user = :id_user
            GROUP BY posts_pl.id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_usuario);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
*/ //group_concat() as url

public function getPosts($id_post = null, $id_user = null, $id_category = null) {
      $array = array();
      $id_post = intval($_POST['id']);
      $id_user = $_SESSION['user'];
      
      !$id_category = intval($_GET['category']);

      $sql = "SELECT * FROM posts_pl WHERE id_user = :id_user AND id = :id_post"; 
      $sql = $this->db->prepare($sql);             
      $sql->bindValue(':id_user', $id_user);
      $sql->bindValue(':id_post', $id_post);
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
               // $result = $array['id'];
                return $array;
                
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
}          
 

public function getLugares($id_usuario) {
        $sql = "SELECT * FROM posts_pl INNER JOIN languages
            ON posts_pl.id = languages.id_post
            WHERE posts_pl.id_user = :id_user
            GROUP BY posts_pl.id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_usuario);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

public function getTotalPosts($offset = null, $limit = null) {

  $id_user = $_SESSION['user'];

  $sql = "SELECT * FROM posts_pl WHERE id_user NOT IN ($id_user) AND id_category = 1";   
          
  if (!empty($limit) || !empty($offset)) {
    
    $sql .= " ORDER BY date_create LIMIT $offset, $limit ";
  
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

public function getHotel($offset = null, $limit = null) {

  $id_user = $_SESSION['user'];

  $sql = "SELECT * FROM posts_pl WHERE id_user NOT IN ($id_user) AND id_category = 2";   
          
  if (!empty($limit) || !empty($offset)) {
    
    $sql .= " ORDER BY date_create LIMIT $offset, $limit ";
  
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

public function getExperience($offset = null, $limit = null) {

  $id_user = $_SESSION['user'];

  $sql = "SELECT * FROM posts_pl WHERE id_user NOT IN ($id_user) AND id_category = 3";   
          
  if (!empty($limit) || !empty($offset)) {
    
    $sql .= " ORDER BY date_create LIMIT $offset, $limit ";
  
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

  public function getSearch($id_post, $filtros) {

        $id_post = intval($id_post);

  }

  public function getPostId($id_post) {
        
        $id_post = intval($_GET['id']);
        
        $id_user = $_SESSION['user'];

        $sql = "SELECT * FROM posts_pl WHERE id = :id_post";
  
        $sql = $this->db->prepare($sql);
                     
        $sql->bindValue(':id_post', $id_post);

        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
              
              foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $lug) {
                $address = self::getAddress($lug['id']);
                $category = self::getCategoryId($lug['id_category']); 
                $days = self::getDays($lug['id']);
                           
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
                'img_slider' => self::getImages($lug['id']),
                'min_days' => $days['min_days'],
                'max_days' => $days['max_days'],
                'linguas' => self::getLanguages($lug['id']),
                'skill' => self::getSkills($lug['id']),
                'date_post' => $lug['date_create']
            ];
              } 
                             // $result = $array['id'];
                return $array;
                
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    
  }


/*
public function getImagensPost($id_post)  {

        $sql = "SELECT * FROM images_pl WHERE images_pl.id_post = ':id_post'";
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

*/

public function getHouse($id_category) {
        $sql = "SELECT * FROM posts_pl INNER JOIN category
            ON posts_pl.id_category = :id_category
            GROUP BY category.id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_category", $id_category);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
/*    public function getPosts($offset, $limit) {
      $array = array();
      
      $sql = "SELECT * FROM posts_pl WHERE id_category = 1 ORDER BY id DESC LIMIT $offset, $limit";
      $sql = $this->db->prepare($sql);
      $sql->execute();

      if($sql->rowCount() > 0) {

        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($result); $i++) { 
        $ids[] = $result[$i]['id']; 
              
        }
      
      //  $var = implode(",", $ids);
      //  var_dump($var);
      //          die();  
               
      }

      return $array;
    }
*/
    public function getCategoryId($id_category) {
      $sql = "SELECT * FROM category WHERE category.id = '$id_category'"; 
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {

       return $array = $sql->fetch(\PDO::FETCH_ASSOC); 
    }
  }

  public function getCategory() {
      $sql = "SELECT * FROM category"; 
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {

       return $array = $sql->fetchAll(\PDO::FETCH_ASSOC); 
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

    public function getImages($id_post) {

      $sql = "SELECT * FROM images_pl WHERE id_post = '$id_post' LIMIT 5"; 
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


}

















	
