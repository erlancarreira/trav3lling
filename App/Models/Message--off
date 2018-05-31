<?php

namespace App\Models;

use App\Core\Model;
use App\Models\Posts;
use App\Models\Users;

class Message extends Model {

    public function getUser($id_post) {

        $id_post = $_POST['id_post'];

        $sql = "SELECT * FROM posts_pl WHERE id = :id_post";

        $sql = $this->db->prepare($sql);
        
        $sql->bindValue(":id_post", $id_post);

        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
               foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {
                
                $array = ['postUser' => $value['id_user'],
                          'title' => $value['title'], 
                          'img' => $value['url']
                        ];
               }
               return $array;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
     
    }

    public function getUserPost() {

        $sql = "SELECT id_user, id_user_to, id_post FROM inbox_msg ";

        $sql = $this->db->prepare($sql);

        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {

                //var_dump($sql->fetchAll(\PDO::FETCH_ASSOC)); exit;
               foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {
                
                $array['id_post'][] = $value['id_post'];
                $array['id_user'][] = $value['id_user']; 
                $array['id_user_to'][] = $value['id_user'];
                        
               }

               //var_dump($array); exit;
               return $array;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
     
    }


    public function getPost($id_From = null)
    {
        
        // if(isset($id_From) && !empty($id_From)) {

        // foreach (self::userFrom($id_From) as $key => $value) {
        //     $id_From = $value['from'];
        //     $id_To = $value['to'];
        //     $id_post = $value['id_post'];
      
        //    }
        // } 

        $sql = "SELECT inbox_msg.id_post, posts_pl.* FROM inbox_msg, posts_pl WHERE posts_pl.id = inbox_msg.id_post";
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
    
    public function getMsgs($id_user) {
    
    $id_user = $_SESSION['user'];

    $sql = "SELECT * FROM inbox_msg WHERE id_user_from = :id_user AND id_notifications = 2";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    

    }

    public function idTo() {
    
    $id_user = $_SESSION['user'];
    
    $sql = "SELECT * FROM inbox_msg WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch(\PDO::FETCH_ASSOC);
               // var_dump($sql); exit;
                return $sql['id_user'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    

    }

    public function getReply($id_user) {
    
    $id_user = $_SESSION['user'];

    $sql = "SELECT * FROM inbox_msg WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
        
               foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {
                   
                $array['user_from'] = $value['id_user_to'];
                $array['user_to'] = $value['id_user_from'];
                $array['post'] = $value['id_post'];

               }
              
            return $array; 

            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    

    }


    /*
    public function getMsgUser($id_user) {
    
    $id_user = $_SESSION['user'];

    $sql = "SELECT * FROM inbox_msg WHERE id_user_to = :id_user_to AND id_notifications = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user_to", $id_user);
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
   
    public function userFrom($id_user = null, $id_user_to = null, $id_post = null) {
    
    $array = array();

    $id_user = $_SESSION['user'];

    $sql = "SELECT inbox_msg.*, users.name, users.id as user, posts_pl.title, posts_pl.id_user as user_start, 
    posts_pl.id as post_id, posts_pl.url as img
    FROM inbox_msg, users, posts_pl 
    WHERE inbox_msg.id_user = users.id 
    
    || inbox_msg.id_user_to = :id_user
    
   
    ORDER BY inbox_msg.date_time ASC";
    
    // if (!empty($id_user_to)) {
        
    //     $sql .= " AND id_user_to = :id_user_to";
    // }

    // if (!empty($id_post)) {

    // $sql .= " AND id_post = :id_post ";
    // }

   // $sql .= " GROUP BY inbox_msg.id  ";

    $sql = $this->db->prepare($sql);

    if (!empty($id_user)) {
        
        $sql->bindValue(":id_user", $id_user);
    }

    // if (!empty($id_post)) {
        
    //     $sql->bindValue(":id_post", $id_post);
    // }

    // if (!empty($id_user_to)) {
    //   AND users.id = posts_pl.id_user 
    // OR  users.id = inbox_msg.id_user_to  
    //     $sql->bindValue(":id_user_to", $id_user_to);
    // }
    
        try {
            
            $sql->execute();
        //var_dump($sql); exit;    
            if ($sql->rowCount() > 0) {
          //  
           // var_dump($sql->fetchAll()); exit;

                foreach ($sql->fetchAll(\PDO::FETCH_ASSOC) as $value) {
                 
                    // if ($value['id_user'] == $id_user) {
                        
                    
                    $array[] = [ 
                            'id_msg' => $value['id'],
                            'id_post' => $value['id_post'],
                            'from' => $value['id_user'],
                            'to' => $value['id_user_to'],
                            'name' => ($value['user'] !== $value['id_user'] ? $value['name'] : $value['name']),
                            'title' => $value['title'],
                            'img' => $value['img'],
                            'data_msg' => $value['date_time'],
                            'message' => $value['message'],
                            'id_notifications' => $value['id_notifications']                       
                                              
                        ]; 
                    // }  

                    // if ($value['id_user_to'] == $id_user) {
                                         
                    // $array['user_to'][] = [ 
                    //         'id_msg' => $value['id'],
                    //         'id_post' => $value['id_post'],
                    //         'from' => $value['id_user'],
                    //         'to' => $value['id_user_to'],
                    //         'data_msg' => $value['date_time'],
                    //         'message' => $value['message'],
                    //         'id_notifications' => $value['id_notifications']                       
                                              
                    //     ];
                    // }         
 
                } 
             // var_dump($array); exit;    
                return $array;  
               
            }
            return false;  

        } catch (PDOException $e) {
            
            die($e->getMessage());
        }
    

    }

    public function userTo($id_user_to = null) {
    
    $array = array();

    $sql = "SELECT * FROM inbox_msg WHERE id_user_to = :id_user_to"; 

    $sql = $this->db->prepare($sql);

    if (!empty($id_user_to)) {
        
        $sql->bindValue(":id_user_to", $id_user_to);
    }
    
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                
                return $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    

    }

    public function getFrom($id_user_from = null) {
    
    $array = array();

    $sql = "SELECT * FROM inbox_msg WHERE id_user_from = :id_user_from"; 

    $sql = $this->db->prepare($sql);

    if (!empty($id_user_from)) {
        
        $sql->bindValue(":id_user_from", $id_user_from);
    }
    
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                
                var_dump($sql->fetchAll(\PDO::FETCH_ASSOC));
        exit;
                return $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    

    }
    

    public function getName($id) {
        
        $User = new Users();

        $sql = "SELECT name FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['name'];
        }  else {
            return '';
        }
    }



    public function setMsg($id_user_to, $id_post_to = null, $msg) {
    
    $id_user_from = $_SESSION['user'];
    $id_user_to = $_SESSION['id_user_to'];
    $id_post_to = $_SESSION['id_post'];
    $msg = (string)$_POST['msg']; 
    //$id_post = intval($_GET['id_post']);

    $sql = "INSERT INTO inbox_msg (id_post, id_user, id_user_to, date_time, message, id_notifications) VALUES (:id_post_to, :id_user_from, :id_user_to, NOW(), :message, 1)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user_from", $id_user_from);
        $sql->bindValue(":id_user_to", $id_user_to);
        $sql->bindValue(":id_post_to", $id_post_to);
        $sql->bindValue(":message", $msg);

        try {
            
            $sql->execute();
           
            if ($sql->rowCount() > 0) {
               
                header("Location: ".BASE."inbox");
                exit();

            } else {

                return $array = "Nada enviado";
                
            }

        } catch (PDOException $e) {

            die($e->getMessage());
        
        }

    }

    public function replyMsg($id_post_to = null, $id_user_from, $id_user_to = null, $msg) {
    
    $id_user_from = $_SESSION['user'];
    $msg = $_POST['msg']; 
    //$id_post = intval($_GET['id_post']);

    $sql = "INSERT INTO inbox_msg (id_post, id_user, id_user_to, date_time, message, id_notifications) VALUES (:id_post_to, :id_user_from, :id_user_to, NOW(), :message, 2)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user_from", $id_user_from);
        $sql->bindValue(":id_user_to", $id_user_to);
        $sql->bindValue(":id_post_to", $id_post_to);
        $sql->bindValue(":message", $msg);
        

        try {
            
            $sql->execute();
           
            if ($sql->rowCount() > 0) {

                return true;            
            } 

         
           

        } catch (PDOException $e) {

            die($e->getMessage());
        
        }

    } 
     

    public function imprime_array($indice) {
        $arr = self::getUserMsg($_SESSION['user']);
        reset($arr[0]);
        while (list($chave,$valor) = each($arr[0]))
       
        if ($indice == $chave) {
            $aqui = $valor;
         } 
        var_dump($aqui); 
    }

    public function dataUser($indice = null) 
    {

        $array = array();
        $value = array();

        $value = self::userTo($_SESSION['user']);
        
        foreach ($value as $key) {
        
        if(isset($indice) && !empty($indice)) {
        reset($key);
        while (list($chave,$valor) = each($key))
       
        if ($indice == $chave) {
           return $valor;
         } 
      
        } else {
        
        $array[] = [
                'id_message' => $value['id'],
                'id_post' => $value['id_post'],
                'id_user_from' => $value['id_user_from'],
                'id_user_to' => $value['id_user_to'],
                'date_time' => $value['date_time'],
                'message' => $value['message'],
                'id_notifications' => $value['id_notifications']
                ]; 
            }    
                 
        }
        var_dump($array); exit;  
        return $array;

    } 

    public function getSuccess() 
    {
       return $this->Sucess;
    }  

}
