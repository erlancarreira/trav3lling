<?php

namespace App\Models;

use App\Core\Model;

class Slider extends Model 
{   
     
    public static function getSliders($variable) {

     	
        foreach ($variable as $key => $value) {
            
            $value[] = $value;
        }
         
        return $value; 
	
            
    } 




}        