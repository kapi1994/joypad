<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wishlist_item_id = $_POST['wishlist_item'];
    $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : '';
    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        deleteWislistItems($user_id, $wishlist_item_id);
        echo json_encode(getWishlistItems($user_id));
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
