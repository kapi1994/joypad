<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    include '../validations.php';
    $registerValidation = registerValidation($first_name, $last_name, $email, $password);

    if (count($registerValidation) > 0) {
        foreach ($registerValidation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';
            if (checkEmail($email)) {
                echo json_encode("This email is allready taken!");
                http_response_code(409);
            } else {
                insertNewUser($first_name, $last_name, $email, $password);
                echo json_encode("New account has been created");
                http_response_code(201);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
