<?php

namespace App\Utils;

class MediaUtile
{
    public function mediaExtentionControl($file){

        $extension = pathinfo($file, PATHINFO_EXTENSION);


      if ($extension==="mp4" | $extension==="3gp" | $extension==="avi" | $extension==="flv") {

        $typeFichier= "Vidéo";

      } elseif  ($extension==="png" | $extension==="jpeg" | $extension==="jpg"){

        $typeFichier= "Photo";

      }elseif  ($extension==="mp3" | $extension==="wav"){

        $typeFichier= "Audio";

      }else{

        $typeFichier= false;
      }
      return $typeFichier;
    }
}
