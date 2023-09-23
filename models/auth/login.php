<?php
session_start();
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include '../validations.php';
    $loginValidation = loginFormValidation($email, $password);
    if (count($loginValidation) > 0) {
        foreach ($loginValidation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';
            $checkAccount = checkEmail($email);
            if ($checkAccount) {
                $user = login($email, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    echo json_encode($user->role_id);
                } else {
                    echo json_encode("Invalid password");
                    http_response_code(401);
                }
            } else {
                echo json_encode("Account don't exists");
                http_response_code(401);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
