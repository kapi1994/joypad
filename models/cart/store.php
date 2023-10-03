<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edition_id = $_POST['edition_id'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    $user_id  = isset($_SESSION['user']) ? $_SESSION['user']->id : '';

    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        insertCart($user_id, $edition_id, $quantity);
        echo json_encode("Item has been added to the cart");
        http_response_code(201);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
