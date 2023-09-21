<?php

require_once 'config.php';


$conn =  mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT `books`.*, `authors`.`id` AS a_id, `authors`.`name`
// FROM `books`
// LEFT JOIN `authors`
// ON `authors`.`id` = `books`.`author_id`
// ORDER BY `books`.`id` DESC;";

//$sql = "SELECT '*'
//FROM `books`
//where id=" . $_GET['id'];

$sql = "SELECT *
        FROM books
        WHERE id=" . $_GET['id'];


$result = $conn->query($sql);

$booklist = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $booklist[] = $row;
    }
} else {
    echo "0 results";
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Отрывок из книги</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h1>Отрывок из книги</h1>

        <div class="row mb">
        </div>
        <div class="list">
            <?php if (!empty($booklist)) : ?>
                <?php foreach ($booklist as $books) : ?>
                    <div class="item">
                        <h3><?php echo $books['overview']; ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Книга не найдена.</p>
            <?php endif; ?>
            <div class="item">
                <form class="form" method="post">
                    <a class="delete" href="main.php?id">Вернуться назад</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>