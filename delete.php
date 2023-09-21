<?php

require_once 'config.php';


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    
    $id = intval(trim($_GET['id']));
    // sql to delete a record
    $sql = "DELETE FROM books WHERE id=" . $id;
    
    if (mysqli_query($conn, $sql)) {
        header('Location: main.php');
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
}

mysqli_close($conn);
?>