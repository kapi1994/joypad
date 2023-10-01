<?php
session_status();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : '';
    $edition_id = $_POST['edition_id'];

    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        insertWishlist($user_id, $edition_id);
        echo json_encode("Item has been added into your wishlist");
        http_response_code(201);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
