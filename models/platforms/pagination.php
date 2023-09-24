<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $limit = $_GET['limit'];
    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        echo json_encode([
            'platforms' => getAllPlatforms($limit),
            'pages' => platformPagination(),
            'elPerPage' => ADMIN_LIMIT
        ]);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
