<?php
session_start();
header("Content-type:application/json");
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $user_id = isset($_SESSION["user"]) ?
  $_SESSION["user"]->id : "";
 $edition_id = $_POST['edition_id'];
 $rating = $_POST['rating'];
 $comment = $_POST['comment'];

 include "../validation.php";
 $commentValidation = commentFormValidation(   
$rating, $comment);

 if(count($commentValidation) > 0){
  foreach($commentValidation as $error){
    echo json_encode($error);
    http_response_code(422);
  }
 }
 else{
  try{

    require_once "../../config/connection.php";
    include "../functions.php";

    storeNewComment($user_id, $edition_id,
    $rating, $comment);
    echo json_encode(getallComments($edition_id));
  }
  catch(PDOException $th){
   echo json_encode($th->getMessage());
   http_response_code(500);
  }
 }
}
else{
   http_response_code(404);}