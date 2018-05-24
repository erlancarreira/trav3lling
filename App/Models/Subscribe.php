<?php  


namespace App\Models;

use App\Core\Model;
use App\Models\Account;
use App\Models\Relations;

class Subscribe extends Model 
{
    public function getId() {
        
        $this->relations = new Relations();
    	
    	$value = $this->relations->getRequisicoes();
        
        for ($i=0; $i < count($value); $i++) {         	

            $val[] = $value[$i]['id'];
       }

       return $val;

    }

	public function getPostId() {
	    
	    $this->a = new Account();

	    $id_post = self::getId();

	    if (!empty($id_post) && $id_post != null) {        
        
        $id_post = array_values($id_post);

        $id_post = implode(",", $id_post);
        
        }

       
	    
	    $id_user = $_SESSION['user'];

	    $sql = "SELECT * FROM posts_pl WHERE id IN ($id_post)";

	    $sql = $this->db->prepare($sql);

	    
	                 
	    //$sql->bindValue(':id_post', $id_post);                                  

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
	                         // $result = $array['id'];
	            return $array;
	            
	        }
	    } catch (PDOException $e) {
	        die($e->getMessage());
	    }

  } 


}
