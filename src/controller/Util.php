<?php 

function checkFieldPOST(array $fields) {
    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            return [
                "status" => false,
                "err" => "Missing or empty POST field: $field"
            ];
        }
    }
    return [
        "status" => true,
        "err" => null
    ];
}

function checkFieldGET(array $fields) {
    foreach ($fields as $field) {
        if (!isset($_GET[$field]) || $_GET[$field] === '') {
            return [
                "status" => false,
                "err" => "Missing or empty GET field: $field"
            ];
        }
    }
    return [
        "status" => true,
        "err" => null
    ];
}

function redirectWith($path, array $params = []) {
    if (!empty($params)) {
        $query = http_build_query($params);
        $path .= "?" . $query;
    }
    header("Location: " . $path);
    exit;
}

?>