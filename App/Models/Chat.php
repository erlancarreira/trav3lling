<?php

namespace App\Models;

use App\Core\Model;
use App\Models\Posts;
use App\Models\Users;

class Chat extends Model {

    // private $checkReply;
    private $insertReply;
    private $lastId;

    public function checkMsg() {

     

        var_dump($ids);

        foreach ($ids as $key => $value) {
       
        $sql = "SELECT R.* FROM conversation_reply R WHERE c_id_fk = '$value[c_id]'";
        
        $sql = $this->db->prepare($sql);

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
 
    public function startChat($user_one, $user_two, $ip = null) {
                
        if(self::checkReply($user_one, $user_two) == 0) {
        
        $sql = "INSERT INTO conversation (user_one, user_two, ip, date_time) VALUES (:user_one, :user_two, :ip, NOW())";
        
        $sql = $this->db->prepare($sql);
        
        $sql->bindValue(":user_one", $user_one);

        $sql->bindValue(":user_two", $user_two);

        $sql->bindValue(":ip", $ip);

        try {
            
            $sql->execute();
            
            if ($sql->rowCount() > 0) {             
                
                $_SESSION['chat_id'] = $this->lastId($user_one);
                return true;
               
            }
               
        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }

       }

    }

    public function checkConversation() {

        $sql = "SELECT c_id FROM conversation_reply WHERE c_id = :chat_id";

        $sql = $this->db->prepare($sql);
        
        $sql->bindValue(":chat_id", $_SESSION['chat_id']);

        try {
            
            $sql->execute();
            
            if ($sql->rowCount() > 0) {

            return true;

          }       

        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }

    }

    public function getMessage() 
    {  
       $user_one = $_SESSION['user'];
         
       $sql = "SELECT U.id, C.c_id, U.name, U.email, U.url 
        FROM conversation C, conversation_reply R, users U
        WHERE 
        CASE
        WHEN C.user_one = :user_one
        THEN C.user_two = U.id
        WHEN C.user_two = :user_one
        THEN C.user_one= U.id
        END

        AND 
        C.c_id = R.c_id_fk
        AND
        (C.user_one = :user_one OR C.user_two = :user_one) ORDER BY C.c_id ASC";

        $sql = $this->db->prepare($sql);
        
        $sql->bindValue(":user_one", $user_one);

        try {
            
            $sql->execute();
            
            if ($sql->rowCount() > 0) {

                foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $key) {

                $array[] = [
                            'user_cv' => $key['c_id'],
                            'user_name' => $key['name'],
                            'user_email' => $key['email'],
                            'user_img' => $key['url'],
                            ];
                    }           
               
           }
       
        return $array;  
              
            
               
        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }      


    }
    
      


    public function getIdMsg() 
    {
        $user_one = $_SESSION['user'];

        $sql = "SELECT c_id FROM conversation WHERE user_one = '$user_one' OR user_two = '$user_one'";

        $sql = $this->db->prepare($sql);

        try {
            
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                
                // var_dump($sql->fetchAll(\PDO::FETCH_ASSOC)); exit;
                return $sql->fetch(\PDO::FETCH_ASSOC);
               
            }
               
        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }
    }

    public function getMsg($c_id) 
    {
        $array = array();

        $sql = "SELECT U.id, U.name, U.email, U.url, R.cr_id, R.c_id_fk, R.id_post, R.date_time, R.reply, R.user_id_fk FROM conversation_reply R, users U WHERE R.c_id_fk = :c_id AND R.user_id_fk = U.id ORDER BY R.cr_id ASC";

        $sql = $this->db->prepare($sql);

        $sql->bindValue(":c_id", $c_id);
       
        try {
            
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                        
                foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) { 
                
                $array[] = [ 
                            'chat_id' => $value['c_id_fk'], 
                            'id_post' => $value['id_post'], 
                            'user_id' => $value['user_id_fk'],
                            'user_name' => $value['name'],
                            'user_email' => $value['email'],
                            'user_img' => $value['url'],
                            'message' => $value['reply'],
                            'data' => $value['date_time']
                            ];
                    }
                }
            
        //    var_dump($array);
            return $array;  
              
           
               
        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }
    // }
      


    }

    public function getPaginationChat() 
    {
       
        $user = $_SESSION['user'];

        $sql = "SELECT C.*, R.*, P.* 
        FROM conversation_reply R 
        LEFT JOIN conversation C ON C.user_one = '$user' OR C.user_two = '$user' 
        LEFT JOIN posts_pl P ON P.id = R.id_post WHERE R.c_id_fk = C.c_id GROUP BY C.c_id";

        $sql = $this->db->prepare($sql);

        try {
            
            $sql->execute();
            // var_dump($sql->fetchAll(\PDO::FETCH_ASSOC)); exit;   
            if ($sql->rowCount() > 0) {
                
             
               
                
                $value = $sql->fetchAll(\PDO::FETCH_ASSOC);
                for ($i=0; $i < count($value); $i++) { 
                 
                 
       
                $array[] = [
                            
                            'user_id' => $value[$i]['user_id_fk'],
                            'post_id' => $value[$i]['id_post'],
                            'user_chat' => $value[$i]['c_id'],
                            'post_title' => $value[$i]['title'],
                            'post_img' => $value[$i]['url'],
                            'message' => $value[$i]['reply'],
                            'data' => $value[$i]['date_time']
                            ];
                    }
                        // var_dump($array); exit;  
            return $array;  
              
            }
               
        } catch (PDOException $e) {
        
            die($e->getMessage());
        
        }

      


    }

    public function getPost($id_From = null)
    {

        $sql = "SELECT * FROM  posts_pl WHERE id = '$id_From'";
        
        $sql = $this->db->prepare($sql);
        
        try {
        
            $sql->execute();
        
            if ($sql->rowCount() > 0) {
        
               foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {
                
                $array = ['title' => $value['title'], 
                          'img' => $value['url']
                        ];
               }
               return $array;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    
           
    } 


    public function insertReply($id_user, $message, $ip, $post_id, $c_id) 
    {
    
    $array = array();    

    $sql = "INSERT INTO conversation_reply (user_id_fk, reply, ip, date_time, id_post, c_id_fk) VALUES ( :user_id, :reply, :ip, NOW(), :post_id, :c_id)"; 
   
    $sql = $this->db->prepare($sql);

    $sql->bindValue(":user_id", $id_user);

    $sql->bindValue(":reply", $message);

    $sql->bindValue(":ip", $ip);

    $sql->bindValue(":post_id", $post_id);

    $sql->bindValue(":c_id", $c_id);
    
    try {

        $sql->execute();

        $array = $this->db->lastInsertId(); 
         
        if ($sql->rowCount() > 0) {             
        
            return $array;

        }

    } catch (PDOException $e) {
        die($e->getMessage());
  }



}

    public function checkReply($user_one, $user_two)  
    {

    $sql = "SELECT c_id 
        
        FROM conversation 
        
        WHERE 
        
        (user_one = :user_one AND user_two = :user_two)
        
        OR
        
        (user_one = :user_two AND user_two = :user_one)";
        
        $sql = $this->db->prepare($sql);

        $sql->bindValue(":user_one", $user_one);

        $sql->bindValue(":user_two", $user_two);
        
        try {

        $sql->execute();

        if ($sql->rowCount() > 0) {
        
               $_SESSION['last_id'] = $sql->fetch(\PDO::FETCH_ASSOC)['c_id']; 
               return true;
            } 

        } catch (PDOException $e) {
            die($e->getMessage());
    }
}    
      
    // public function getCheckReply() 
    // {
    //    return $this->checkReply;  
    // }  

    private function lastId($user_one = null)  
    {

    $sql = "SELECT c_id FROM conversation WHERE user_one = :user_one ORDER BY c_id DESC limit 1";
        
        $sql = $this->db->prepare($sql);

        $sql->bindValue(":user_one", $user_one);
        
        try {

        $sql->execute();

        if ($sql->rowCount() > 0) {
        
            $_SESSION['chat_id'] = $sql->fetch(\PDO::FETCH_ASSOC);
            return true;
            
            } 

        } catch (PDOException $e) {
            die($e->getMessage());
    }
}    


    
}




 // //Conversation Reply Insert
 //         