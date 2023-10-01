<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $publisher = $_POST['publisher'];
    $pegi_rating = $_POST['pegi_rating'];
    $genres = $_POST['selectedGenres'];
    $release_date =  $_POST['date'];
    $trailer = $_POST['trailer'];

    include '../validations.php';
    $gameValidation = gameFormValidation($name, $short_description, $long_description, $publisher, $pegi_rating, $genres, $release_date, $trailer);

    if (count($gameValidation) > 0) {
        foreach ($gameValidation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';
            $checkGameName = checkGameName($name);
            if ($checkGameName) {
                echo json_encode("Game with this name allready exists");
                http_response_code(409);
            } else {
                createNewGame($name, $short_description, $long_description, $publisher, $pegi_rating, $genres, $release_date, $trailer);
                echo json_encode([
                    'games' => getAllGames(),
                    'message' => "New game has been inserted",
                    'elPerPage' => ADMIN_LIMIT
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
