<?php
header("Content-type:application/json");
if($_SERVER["REQUEST_METHOD"] == "POST"){

 $id = $_POST["id"];
 $status = $_POST["status"];

 try {
   require_once "../../config/connection.php";
   include "../functions.php";

   changeStatus("game_edition", $status, $id);
  echo json_encode(GrtGameEditionFullRow($id));

 }
 catch(PDOException $th){
   echo json_encode($th->getMessage());
   http_respinse_code(500);
}

}else
 http_response_code(404);
}