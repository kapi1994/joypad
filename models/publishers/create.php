<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $limit = $_POST['limit'];

    include '../validations.php';
    $publisherValidation = publisherFormValidation($name);

    if (count($publisherValidation) > 0) {
        foreach ($publisherValidation as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../functions.php';

            $checkPublisherName = checkPublisherName($name);
            if ($checkPublisherName) {
                echo json_encode("Publisher with this name allready exists");
                http_response_code(409);
            } else {
                createNewPublisher($name);
                echo json_encode([
                    'publishers' => getAllPublishers($limit),
                    'pages' => publisherPagination(),
                    'elPerPage' => ADMIN_LIMIT,
                    'message' => "New publisher has been created"
                ]);
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
