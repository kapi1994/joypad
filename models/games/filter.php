<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET['limit'];
    $text = isset($_GET['text']) ? trim('') : '';
} else {
    http_response_code(404);
}
