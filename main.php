<?php

require_once 'config.php';

// Create connection
$conn =  mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `books`.*, `authors`.`id` AS a_id, `authors`.`name`
FROM `books`
LEFT JOIN `authors`
ON `authors`.`id` = `books`.`author_id`
ORDER BY `books`.`id` DESC;";
$result = $conn->query($sql);

$booklist = [];

if ($result->num_rows > 0) {
    // output data of each row
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
    <title>Книги</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Книги</h1>
        <div class="row mb">
            <div class="col-50">
                <a class="add" href="add.php">Добавить</a>
            </div>
            <div class="col-50 text-right">
                <?php if ($_SESSION['user']) : ?>
                    <span>Приветствуем, <?php echo $_SESSION['user']['login']; ?>.</span>
                    <a class="delete mr-0" href="logout.php">Выход</a>
                <?php else : ?>
                    <a class="add" href="login.php">Авторизация</a>
                    <a class="add" href="register.php">Регистрация</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="list">
            <?php foreach ($booklist as $key => $item) : ?>
                <div class="item">
                    <h2 class="title"><?php echo $item["title"]; ?> </h2>
                    <div class="row">
                        <div class="col-20">
                            <img class="book-image" src="img/<?php echo $item['img'] ?? "noimg.jpg"; ?>" alt="Обложка <?php echo $item["title"]; ?>">
                        </div>
                        <div class="col-80">
                            <h2 class="left-aligned mt-0" style="font-size: 20px;">Описание</h2>
                            <div class="left-aligned" class="content"></div>
                            <?php
                            $description = $item["content"];
                            $trimmedDescription = mb_strimwidth($description, 0, 150, "...");
                            echo $trimmedDescription;
                            ?>
                        </div>
                    </div>
                    <div class="year"> Год выпуска <?php echo $item["year"]; ?> </div>
                    <div class="sales"> Продажи <?php echo $item["sales"]; ?> </div>
                    <div class="price"> Цена <?php echo $item["price"]; ?> </div>
                    <div class="author"> Автор <?php echo $item["name"]; ?> </div>
                    <div class="actions mt">
                        <a class="content" href="view.php?id=<?php echo $item['id'] ?>">Предпросмотр</a>
                        <?php if ($_SESSION['user']) : ?>
                            <a class="edit" href="edit.php?id=<?php echo $item['id'] ?>">Изменить</a>
                            <a class="delete" href="delete.php?id=<?php echo $item['id'] ?>">Удалить</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>