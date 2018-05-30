<?php  
/* Relations 
* Se o usuário adicionou um subscribe inicialmente vai mostrar como 0
* Caso o dono do post aceite esse subscribe, mostra como 1 e lista em yoursubscribes
* Se ele recusou o subscribe vai aparecer como 3 e não aparece em yoursubscribes */

namespace App\Models;

use App\Core\Model;
use App\Models\Account;

class Relations extends Model 
{
    public function verifySubscriber()
    {
        $id = addslashes($_SESSION['user']);
        $id_post = addslashes($_GET['id']);
        
        $sql = "SELECT * FROM relations WHERE id_user_from = :id AND id_post = :id_post";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_post', $id_post);
        try {
          $sql->execute();     

          if($sql->rowCount() > 0) {

            return true;
            
        } else {

            return false;
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    } 
}

public function addSubscriber($id, $id_post, $id_user_to) 
{   
    $id = addslashes($_SESSION['user']);
    $id_post = addslashes($_POST['id_post']);
    $id_user_to = addslashes($_POST['id_user_to']);

    $sql = "SELECT * FROM relations WHERE id_user_from = :id AND id_post = :id_post";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':id_post', $id_post);
    try {
      $sql->execute();     

      if($sql->rowCount() == 0) {

        $sql = "INSERT INTO relations (id_user_from, id_user_to, id_post, status) VALUES (:id, :id_user_to, :id_post, '0')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_user_to', $id_user_to);
        $sql->bindValue(':id_post', $id_post);    
        $sql->execute();
        
        $array = "Subscribe Success!"; 
        return header("Location: ".BASE."subscribes");

    } else {

        return false;
    }

} catch (PDOException $e) {
    die($e->getMessage());
}
}

public function acceptSubscriber($id_from, $id_to, $id_post) 
{
    $id_to =  $_POST['id_user_to']; 
    $id_post = $_POST['id_post'];
    $id_from = $_SESSION['user'];

    $sql = "UPDATE relations SET status = '1' WHERE id_user_from = '$id_to' AND id_user_to = '$id_from' AND id_post = '$id_post'";
    try {
        $this->db->query($sql);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
}

public function notSubscriber($id_from, $id_to, $id_post) 
{
    $id_to =  $_POST['id_user_to']; 
    $id_post = $_POST['id_post'];
    $id_from = $_SESSION['user'];

    $sql = "UPDATE relations SET status = '2' WHERE id_user_from = '$id_to' AND id_user_to = '$id_from' AND id_post = '$id_post'";
    try {
        $this->db->query($sql);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
}

public function getRequisicoes() 
{   
    $array = array();
    $result = array();

    $id_user = $_SESSION['user'];

    $sql = "SELECT
    
    user.*, user.url as user_img,

    relations.*, 
    
    post.*, post.url as main_image

    FROM relations 
    
    LEFT JOIN users as user ON user.id = relations.id_user_from

    LEFT JOIN posts_pl as post ON post.id = relations.id_post

    WHERE relations.id_post = post.id AND relations.id_user_to = $id_user AND relations.status = 0 ";

    $sql = $this->db->query($sql);

    //var_dump($sql->fetchAll(\PDO::FETCH_ASSOC)); exit; 
    if($sql->rowCount() > 0) {

        foreach ($result = $sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {

            $array[ ] = [
             'id_freelancer' => $value['id_user_from'],                         
             'id_userPost' => $value['id_user'],
             'id_post' => $value['id']
         ];  

    
     }  
    
 }

 return $result;  
}

public function getList() 
{   
    $array = array();

    $id_user = $_SESSION['user'];

    $sql = "SELECT *

    FROM relations 
    
    WHERE id_user_to = '$id_user' AND status = 0";

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {

       foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {

          $ids['id_post'][] = $value['id_post'];  
          $ids['id_host'] = $value['id_user_to'];
          $ids['id_user'][] = $value['id_user_from'];
      
      
      }

      return $ids;

  }


}

public function getPhone($id_user = null) 
{
    $array = array();
    
    $sql = "SELECT phone 
    
    FROM users
    
    WHERE id = '$id_user'";

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {
       
      return $array = $sql->fetchAll(\PDO::FETCH_ASSOC); 
        
    }
    
}

public function getListPost() 
{   
    $array = array();
    
    $id_host = $_SESSION['user'];

    //var_dump($id_host); exit;
    
    if (!empty(self::getList())) {
        
    $ids = self::getList();
    $list = self::getListUser();
    
    $id_post = $ids['id_post'];
    $id_user = $ids['id_user'];

    $id_post = implode(", ", $id_post);
    $id_user = implode(", ", $id_user);

    
    $sql = "SELECT * 
    
    FROM posts_pl
    
    WHERE id_user = '$id_host' AND id in ($id_post) GROUP BY id";

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {
    
        foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {

        $array['host'][] = [
            
            'id_post' => $value['id'],
            'id_host' => $value['id_user'],
            'id_category' => $value['id_category'],
            'title' => $value['title'],
            'description' => $value['description'],
            'main_image' => $value['url'],
            'date_create' => $value['date_create']
        ];  
        

    }
  $array['freelancer'] = $list;   
  } 

} else {

    return false;
}



return $array;  
}

public function getLang($id_user = null) {
    
    $array = array();

    $sql = "SELECT name FROM languages_user WHERE id_user = '$id_user'";

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {
    
    return $array[] = $sql->fetchAll(\PDO::FETCH_ASSOC);  
        
    }  
}

public function getSkills($id_user = null) {
    
    $array = array();
 
    $sql = "SELECT name FROM skills_user WHERE id_user = '$id_user'";

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {
  
    return $sql->fetchAll(\PDO::FETCH_ASSOC);  
        
    }  
}

public function getListUser() 
{   
    $array = array();
  
    $list = self::getList();
    
    $id_user = $_SESSION['user'];

    $ids = implode(", ", $list['id_post']);

    $id_freelancer = implode(", ", $list['id_user']);
    //AND posts_pl.id IN ($ids) AND posts_pl.id_user = $id_user
    // var_dump($list);
    // exit;
    $var[] = max($list['id_post']);
    // var_dump($var); exit;
    foreach ($var as $key) {
   // var_dump($key); exit;
    $sql = "SELECT relations.id_post as id_post, relations.id_user_to as id_host, relations.id_user_from as id_freelancer, users.*, users.url as user_img FROM relations, users WHERE users.id = relations.id_user_from AND relations.id_post = '$key' AND relations.status = 0";

    $sql = $this->db->query($sql);  
    
    if($sql->rowCount() > 0) {
    
        foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $key => $value) { 
        // var_dump($value); exit;

    $array[] = ['id_freelancer' => $value['id'],
                'id_host' => $value['id_host'],
                'id_post' => $value['id_post'],
                'name' => $value['name'],
                'email' => $value['email'],
                'user_img' => $value['user_img'],
                'bio' => $value['bio'],
                'languages' => self::getLang($value['id']),
                'skills' => self::getSkills($value['id']),
                'phone' => $value['phone'],
                'date_joined' => $value['date_joined']
        ];  
      }
    }  
    
}

return $array;  
}

public function getAll() 
{   
    $array = array();
    
    $Host = self::getListPost();
    $User = self::getListUser();
    
    $array[] = array_merge($Host, $User);
    

    return $array;  
}

/*
     public function listSubscribes() 
    {   
        $array = array();

        $sql = "SELECT users.*, relations.id_user_from, posts_pl.id, posts_pl.id_user FROM relations 
        
        LEFT JOIN users ON users.id = relations.id_user_from

        LEFT JOIN posts_pl ON id_user = '".($_SESSION['user'])."' 
        
        WHERE relations.id_user_to = '".($_SESSION['user'])."' AND relations.id_post = posts_pl.id AND relations.status =  ORDER BY users.id";

        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            
            $array = $sql->fetchAll();
            
        }

        return $array;  
    }
*/

    public function getIdsSubs($id) {
        $array = array();

        $sql = "SELECT * FROM relations WHERE (id_user_from = '$id' OR id_user_to = '$id') AND status = '1'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            foreach($sql->fetchAll() as $ritem) {
                $array[] = $ritem['id_user_from'];
                $array[] = $ritem['id_user_to'];
            }
        }

        return $array;
    }
    
    public function getSubscribers() 
    {
        $array = array();

        $sql = "SELECT posts_pl.id, posts_pl.id_user FROM relations 

        LEFT JOIN posts_pl ON id_user = relations.id_user_to
        
        WHERE relations.id_post = posts_pl.id AND relations.status = 1 ORDER BY posts_pl.id_user";

        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {

            $array = $sql->fetchAll();
            
        }

        return $array;  
    }

     public function getMySubs() 
    {
        $array = array();

        $sql = "SELECT posts_pl.id, posts_pl.id_user FROM relations 

        LEFT JOIN posts_pl ON id_user = relations.id_user_to
        
        WHERE relations.id_post = posts_pl.id AND relations.status = 1 ORDER BY posts_pl.id_user";

        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {

            $array = $sql->fetchAll();
            
        }

        return $array;  
    }

    public function getTotalSubs() 
    {
        $array = array();
        $sql = "SELECT COUNT(*) as totalSubs FROM relations WHERE id_user_to = '".($_SESSION['user'])."' AND relations.status = 0";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        
        return $sql['totalSubs'];   


    }

    public function getTotalAmigos($id) {

        $sql = "SELECT COUNT(*) as c FROM relacionamentos WHERE (usuario_de = '$id' OR usuario_para = '$id') AND status = '1'";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();

        return $sql['c'];
    }

    public function getIdsFriends($id) {
        $array = array();

        $sql = "SELECT * FROM relacionamentos WHERE (usuario_de = '$id' OR usuario_para = '$id') AND status = '1'";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $ritem ) {
                $array[] = $ritem['usuario_de']; 
                $array[] = $ritem['usuario_para'];
            }
        }

        return $array;     
    }

  /*  public function getRel() {
        $id = addslashes($_SESSION['user']);

        $sql = "SELECT *, posts_pl.id FROM relations, posts_pl WHERE relations.id_user_from = $id AND relations.id_post = posts_pl.id";
        $sql = $this->db->prepare($sql);
        //$sql->bindValue(':id', $id);
        try {
          $sql->execute(); 

        if($sql->rowCount() > 0) {
        var_dump($sql);
        exit;
                           
        return true;  
           
        } else {
            return false;
        }
          } catch (PDOException $e) {
            die($e->getMessage());
        }  
    
    }
    */   
}
