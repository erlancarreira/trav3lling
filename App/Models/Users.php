<?php

namespace App\Models;

use App\Core\Model;
use App\Lib\Helps;


class Users extends Model 
{   
    private $msg;
    private $Table;
    private $File;


    public function verifyLogin() {
       
        if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && empty($_SESSION['user']))) {
            header("Location: ".BASE);
            exit;
        }
    }

    public function logar($email, $password) {
    
        (Helps::isValidMd5($password)) ? 
        
        $password = $_POST['password'] : $password = md5($_POST['password']);                     
   
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['user'] = $sql['id'];

            header("Location: ".BASE);
            exit;
        } else {
            return "E-mail e/ou password errados!";
        }
    }  

    public function signup($name, $email, $password) {
           
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() == 0) {
            
           $sql = "INSERT INTO users (name, email, password, date_joined) VALUES ('$name', '$email',  MD5('$password'), NOW())";
           $sql = $this->db->query($sql);

           $id = $this->db->lastInsertId();
           $_SESSION['user'] = $id;

           header("Location: ".BASE);
           exit;

        }   else {
            return "E-mail já está cadastrado!";
        }
 
    }

    public function getName($id) {
        
        $sql = "SELECT name FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['name'];
        }  else {
            return '';
        }
    }

    public function getDados($id = null) {
        $array = array();
        //$id = $_SESSION['user'];

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getUrl($id) {

        $sql = "SELECT url FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            
            $sql = $sql->fetch(); 
            
            return $sql['url'];

        } else {
       
          return '';
        }

    }

    public function updatePerfil($array = array()) 
    {
        if(count($array) > 0) {

            $sql = "UPDATE users SET ";

            $campos = array();
            foreach($array as $campo => $valor) {
                $campos[] = $campo." = '".$valor."'";
            }

            $sql .= implode(', ', $campos);

            $sql .= " WHERE id = '".($_SESSION['user'])."'";

            $this->db->query($sql);
            
        }
    }

    public function selectLanguages($id_user = null) 
    {
        $id_user = $_SESSION['user'];

        $sql = "SELECT * FROM languages_user WHERE id_user = '$id_user'"; 

        $sql = $this->db->prepare($sql);

        try { 

        $sql->execute();

        if($sql->rowCount() > 0) {

            return true;
          
          } 

        } catch (PDOException $e) {
            
              die($e->getMessage());
            
      }       
        
    }

   
    public function insertLanguages($id_user, $array = null) 
    {
        $id_user = $_SESSION['user'];  

        if(count($array) > 0) {    
                   
            $campos = array();
            
            foreach($array as $campo => $valor) {

            $sql = "INSERT INTO languages_user SET name = :valor, id_user = :id_user"; 

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $id_user);
            $sql->bindValue(":valor", $valor);

            try { 

            $sql->execute();

            } catch (PDOException $e) {
            
              die($e->getMessage());
            
             }
          }  

        }          

    }

    public function deleteLanguages($id_user) 
    {
            $sql = "DELETE FROM languages_user WHERE id_user = '$id_user'"; 

            $sql = $this->db->prepare($sql);

            try { 

            $sql->execute();

            } catch (PDOException $e) {
            
              die($e->getMessage());
            
           }  

                  

    }

    public function selectSkills($id_user = null) 
    {
        $id_user = $_SESSION['user'];

        $sql = "SELECT * FROM skills_user WHERE id_user = '$id_user'"; 

        $sql = $this->db->prepare($sql);

        try { 

        $sql->execute();

        if($sql->rowCount() > 0) {

            return true;
          
          } 

        } catch (PDOException $e) {
            
              die($e->getMessage());
            
      }       
        
    }

   
    public function insertSkills($id_user, $array = null) 
    {
        $id_user = $_SESSION['user'];  

        if(count($array) > 0) {    
                   
            $campos = array();
            
            foreach($array as $campo => $valor) {

            $sql = "INSERT INTO skills_user SET name = :valor, id_user = :id_user"; 

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $id_user);
            $sql->bindValue(":valor", $valor);

            try { 

            $sql->execute();

            } catch (PDOException $e) {
            
              die($e->getMessage());
            
             }
          }  

        }          

    }

    public function deleteSkills($id_user) 
    {
            $sql = "DELETE FROM skills_user WHERE id_user = '$id_user'"; 

            $sql = $this->db->prepare($sql);

            try { 

            $sql->execute();

            } catch (PDOException $e) {
            
              die($e->getMessage());
            
           }  

                  

    }


    public function updateImg($id_user, $image) 
    {            
            $sql = "UPDATE users SET url = :image WHERE id = :id_user";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":image", $image);
            $sql->bindValue(":id_user", $id_user);
            try {
            $sql->execute(); 
            
            } catch (PDOException $e) {
            die($e->getMessage());
        } 
    
          
    }

    public function profileImg($id = null, $Image, $MaxFileSize = null) {
        

        $this->File = $Image;
        $destiny = 'App/assets/img/users/';
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
                $this->updateImg($id, $nomedoarquivo);
                $this->msg = "Imagens Cadastradas com Sucesso!";
                }
              }
          endif;       
    }

    public function getMsg() 
    {
        return $this->msg;
    }

    public function getSugestoes($limit = 5)
    {
        $array = array();
        $meuid = $_SESSION['user'];

        $r = new Relacionamentos();
        $ids = $r->getIdsFriends($meuid);

        if(count($ids) == 0) {
            $ids[] = $meuid;
        }

        $sql = "SELECT users.id, users.nome FROM users WHERE users.id != '$meuid' AND usuarios.id NOT IN (".implode(',', $ids).") ORDER BY RAND() LIMIT $limit";

        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function procurar($q) 
    {
        $array = array();

        $q = addslashes($q);

        $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$q%'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getSkills($id_user) 
    {
        $array = array();

        $id_user = $_SESSION['user'];

        $sql = "SELECT * FROM skills_user WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);

            
            try {
            
            $sql->execute(); 
            
            if ($sql->rowCount() > 0) {
            
            return $array = $sql->fetchAll();
            
            }
            
            } catch (PDOException $e) {
            die($e->getMessage());
        } 
     
    }

    public function getLanguages($id_user) 
    {
        $array = array();

        $id_user = $_SESSION['user'];

        $sql = "SELECT * FROM languages_user WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);

            
            try {
            
            $sql->execute(); 
            
            if ($sql->rowCount() > 0) {
            
            return $array = $sql->fetchAll();
            
            }
            
            } catch (PDOException $e) {
            die($e->getMessage());
        } 
     
    }

    public function setTable($table) 
    {
        $this->Table = $table;
    }




















}       


/*
class Usuarios extends model
{   
    public function entrar($email, $password) {
        $sql = $this->db->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
        $_SESSION['dados'] = $sql->fetch();
         
        return $dados = $_SESSION['dados'];    
             
        } else {
            return false;
        }
    }

    public function cadastrar($nome, $email, $senha) {
        $sql = $this->db->prepare("SELECT id FROM usuario WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() == 0) {

            $sql = $this->db->prepare("INSERT INTO usuario SET nome = :nome, email = :email, senha = :senha");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();

            return true;

        } else {
            return false;
        }

    }    

} */