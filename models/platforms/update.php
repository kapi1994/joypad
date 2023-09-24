<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];

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

            $checkPlatform = checkPlatformName($name);
            if ($checkPlatform && $checkPlatform->id != $id) {
                echo json_encode("Name is allready taken!");
                http_response_code(409);
            } else {
                updatePlatform($name, $id);
                echo json_encode(getPlatformFullRow($id));
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
