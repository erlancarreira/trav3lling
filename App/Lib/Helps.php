<?php 

namespace App\Lib;

class Helps
{

  public static function ActionName() { 
  
  $urlName = array('url' => $_SERVER['REQUEST_URI']);
  $url = array_shift($urlName);
  $url = explode('/', $url);
  $name = array_pop($url);
  
  return $this->name; 

  }

  public static function getWeekday($date) {
    //$date = new \DateTime('w');
    return date('w', strtotime($date));
  
  }

  public static function getDays($key) {
      
      $date = new \DateTime('w');
      $dayofweek = 6; 
      $day = 1;
      $check = count($key); 

      if($check === 6) {
 
        return $key = $dayofweek;
        
      } elseif ($check <= 5) {
        
        $key =  date('w', strtotime(($key)));
      
      } else {
         
          $days = date('w', strtotime(($key)));

      $key = date('d', strtotime(($key) - $days.' day', strtotime($key))); 
      return $date->format($key); 
    }
      
  }

  public static function alert($type, $msg) 
  {
      if ($type == "success") {
        
        return $msg;

      } else if($type == 'error') {
        
        return $msg;
      
      }
  } 

  public static function debug($array) {
        echo "<pre>";
        $array = var_dump($array);
        exit();
        return $array;
    }

  public static function getValues($array) {
        
        for ($i=0; $i < count($array); $i++) { 

        reset($array[$i]);
        
        while (list($chave,$valor) = each($array[$i]))

        $result[] = $valor;
        $result = implode(', ', $result);
                   
       }
     
       return $result; 
  }

/*
  public static function listValues($array) {
        
        for ($i=0; $i < count($array); $i++) { 
        
        
        reset($array[$i]);
        while (list($chave,$valor) = each($array[$i]))

        if($chave == 'id') {
          $array[] = [
          $array['id'] => intval($valor),
          ];
             $array['id_user'] = intval($valor)
        }
       
        $array = implode(", ", $array[$i]);
           
       }
     
       return $array; 
  }
*/

function recursive_show_array($array)
{
     foreach($array as $value)
     {
          if(is_array($value))
          {
               recursive_show_array($value);
          }
          else
          {
               echo $value;
          }
     }
}

  public static function arrayRemove(array $array) {
        
      if (isset($array['array'])) {
          $value = $array['array'];
          unset($array['array']);
          
          return $value;         
        }           
  } 
      
/*
  public static function post($variable) {

      foreach ($variable as $value) {
      
      $post[] = [
      'id_post' => $value['id'],
      'id_user' => $value['id_user'],
      'id_category' => $value['id_category'],
      'title' => $value['title'],
      'description' => $value['description'],
      'address_line' => $address['address_line'],
      'city' => $address['city'],
      'state' => $address['state'],
      'zip' => $address['zip'],
      'country' => $address['country'],
      'category_name' => $category['title'],
      'main_image' => $value['url'],
      'img_slider' => $this->getImages($value['id']),
      'min_days' => $days['min_days'],
      'max_days' => $days['max_days'],
      'linguas' => $this->getLanguages($value['id']),
      'skill' => $this->getSkills($value['id']),
      'date_post' => $value['date_create']
       ];

      } 

    return $post;    
  } 


  public static function setValue($value) 

  {
     if (isset($value) && !empty($value) && $value != null) {
         
   //     $value 
     }
     
  }
*/
  public static function filterCheck($value) 
  {
    

    if (isset($value) && !empty($value)) {

      
      $value = filter_var($value, FILTER_DEFAULT);
    }
   
  return $value;
  }

  public static function postCheck($value)
  {
    if (isset($_POST['value']) && !empty($_POST['value'])) {
      
        return $value;   
      
      } 
    return false;  

  }

  public static function isValidMd5($md5 = null) {
  
    return strlen($md5) == 32 && ctype_xdigit($md5);
  
  }

  public function pagination($limit, $page) 
  {
      
      $offset = ($page * $limit - $limit) + 1;
      
      $this->limit = " LIMIT {$limit} OFFSET {$offset} ";

    return  $this->get();
  
  }
} 