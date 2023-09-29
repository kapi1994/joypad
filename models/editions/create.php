<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $game_id = $_POST["game_id"];
  $platform = $_POST['platform'];
  $price = $_POST['price'];
  $image = $_FILES['image'];

  include "../validations.php";
  $editionValidation = editionFormValidation(
    $platform,
    $price,
    $image
  );

  if (count($editionValidation) > 0) {
    foreach ($editionValidation as $error) {
      http_response_code(422);
      echo json_encode($error);
    }
  } else {
    try {
      require_once "../../config/connection.php";
      include "../functions.php";

      $image_name = image_upload($image);
      $checkGameEdition = checkGameEdition(
        $game_id,
        $platform
      );

      if ($checkGameEdition) {
        echo json_encode("That edition allready exists");
        http_response_code(409);
      } else {
        insertNewEdition(
          $game_id,
          $platform,
          $price,
          $image_name
        );
        echo json_encode([
          "editions" => getAllGameEditions($game_id),
          "message" => "New edition has been added"
        ]);
      }
    } catch (PDOException $th) {
      echo json_encode($th->getMessage());
      http_response_code(500);
    }
  }
} else {
  http_response_code(404);
}
