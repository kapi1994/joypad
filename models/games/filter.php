<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $text = isset($_GET['text']) ? trim($_GET['text']) : '';
    try {
        require_once '../../config/connection.php';
        include '../functions.php';
        echo json_encode([
            'games' => getAllGames($limit, $text),
            'pages' => gamePagination($text),
            'elPerPage' => ADMIN_LIMIT,
            'countGames' => countGames($text)
        ]);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
