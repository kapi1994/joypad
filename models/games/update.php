<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $publisher =  $_POST['publisher'];
    $pegi_rating = $_POST['pegi_rating'];
    $genres = $_POST['selectedGenres'];
    $release_date = $_POST['date'];
    $trailer = $_POST['trailer'];

    include '../validations.php';
    $game_validation = gameFormValidation(
        $name,
        $short_description,
        $long_description,
        $publisher,
        $pegi_rating,
        $genres,
        $release_date,
        $trailer
    );

    if (count($game_validation) > 0) {
        foreach ($game_validation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';

            $checkGame = checkGameName($name);
            if ($checkGame && $checkGame->id != $id) {
                echo json_encode("Game with this name allready exists");
                http_response_code(409);
            } else {
                updateGame($id, $name, $short_description, $long_description, $publisher, $pegi_rating, $genres, $release_date, $trailer);
                echo json_encode(getGameFullRow($id));
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
