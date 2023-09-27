<?php
header("Content-type:application/json");
if($_SERVER["REQUEST_METHOD"] == "POST"){

 $id = $_POST["id"];
 $game_id = $_POST["game_id"];
 $platform = $_POST["platform"];
 $price = $_POST["price"];
 $image = isset($_FILES["image"]) ? 
     $_FILES["image"] ? "";
 $cover = $_POST["cover"];
 
 include "../validation.php";
 $editionValidation =  editionFormValidation($platform, $price, $image);

 if(count($editionValidation) > 0){
  foreach($editionValidation  as $error){
   echo json_encode($error);
   http_response_code(422);
  }
 }
 else{
   try{
   require_once "../../config/connection.php";
   include "../functions.php";
   
   $checkGameEdition  = checkGameEdition($game_id, $platform);
   
   if($checkGameEdition && $checkGameEdition-> id != $id){
     echo json_encode("That ge edition allready exusts");
    http_response_code(409);
   }else{
      
      $new_image_name = "";
      if($image !=""){
        $new_image_name = upload_image($image);
        remove_image($cover);
      }

      updateEdition($id,$platform,$price,$image);

       echo json_encode(getEditionFullRow($id));

     }
   } 
   catch(PDOException $th){
    echo json_encode($th->getMessage());
    http_response_code(500);
   }
 }
}
else{
 http_response_code(404);
}