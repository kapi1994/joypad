<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    include '../validations.php';
    $publisherForm = publisherFormValidation($name);
    if (count($publisherForm) > 0) {
        foreach ($publisherForm as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';

            $checkPublisher = checkPublisherName($name);
            if ($checkPublisher && $checkPublisher->id != $id) {
                echo json_encode("Publisher with this name is allready taken!");
                http_response_code(409);
            } else {
                updatePublisher($name, $id);
                echo json_encode(getPublisherFullRow($id));
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
