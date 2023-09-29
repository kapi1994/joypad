<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        echo json_encode([
            'numberOfRegistretedUsers' => getNumberOfUsers(),
            'numberOfProducts' => getNumberOfProducts(),
            'numberOfOrders' => numberOfOrders(),
            'votes' => votes(),
            'mostSoldProdcts' => mostSoldProducts()
        ]);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
    }
} else {
    http_response_code(404);
}
