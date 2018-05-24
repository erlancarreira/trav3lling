<?php 

namespace App\Lib;

class Image
{
  
    public function imgRed() {


      if(isset($_FILES['photos']) && !empty($_FILES['photos']['tmp_name'])) {
      if(count($photos) > 0) {
                              
        for($q=0;$q<count($photos['tmp_name']); $q++) {
          
          $tipo = $photos['type'][$q];        

          if(in_array($tipo, array('image/jpeg', 'image/png'))) {

            $images = md5(time().rand(0,9999)).'.jpg';
            
            move_uploaded_file($photos['tmp_name'][$q], $dir.$images);

            list($width_orig, $height_orig) = getimagesize($dir.$images);
            $ratio = $width_orig/$height_orig;

            $width = 500;
            $height = 500;
            
            if($width/$height > $ratio) {
            $width = $height*$ratio;
            } else {
            $height = $width/$ratio;
            }

            $img = imagecreatetruecolor($width, $height);

            if($tipo == 'image/jpeg') {
            $origi = imagecreatefromjpeg($dir.$images);
            } elseif($tipo == 'image/png') {
            $origi = imagecreatefrompng($dir.$images);
            }

            imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            imagejpeg($img, $dir.$images, 70);     
        
          /*  $sql = "INSERT INTO lugares_images SET id_lugares = '$lugaresId', url = '$images'";
           
            $sql = $this->db->query($sql);
          */ 

          }
        }
      }
    }   
  }

  public function oneRed() {
    $dir = 'public/assets/images/places/';


      if(isset($_FILES['photos']) && !empty($_FILES['photos']['tmp_name'])) {
              
          $perm = array('image/jpeg', 'image/jpg', 'image/png');
            
            if(in_array($_FILES['photos']['type'], $perm)) {

            $images = md5(time().rand(0,9999)).'.jpg';
            
            move_uploaded_file($_FILES['photos']['tmp_name'], $dir.$images);
        
          /*  $sql = "INSERT INTO lugares_images SET id_lugares = '$lugaresId', url = '$images'";
           
            $sql = $this->db->query($sql);
          */ 

          }
        }
      }

  }