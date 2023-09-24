<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $limit = $_POST['limit'];

    include '../validations.php';

    $platformValidation = platformFormValidation($name);
    if (count($platformValidation) > 0) {
        foreach ($platformValidation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';

            $checkPlatformName = checkPlatformName($name);
            if ($checkPlatformName) {
                echo json_encode("Platform name is allready taken");
                http_response_code(409);
            } else {
                createNewPlatform($name);
                echo json_encode([
                    'platforms' => getAllPlatforms($limit),
                    'pages' => platformPagination(),
                    'elPerPage' => ADMIN_LIMIT,
                    'message' => "New platform has been inserted"
                ]);
                http_response_code(201);
            }
        } catch (PDOException $th) {
            echo json_encode($error);
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
