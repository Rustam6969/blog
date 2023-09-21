<?php

require_once 'config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST)) {
    $title = trim($_POST['title']);
    $year = intval(trim($_POST['year']));
    $sales = intval(trim($_POST['sales']));
    $price = doubleval(trim($_POST['price']));
    $bookId = intval(trim($_POST['id']));
    $authorId = intval(trim($_POST['author_id']));

    $sql = "UPDATE books
			SET
			    title='" . $title . "',
			    year='" . $year . "',
			    sales='" . $sales . "',
			    price='" . $price . "',
                content='" . $content . "',
			    author_id='" . $authorId . "'
			WHERE id=" . $bookId;




    if (mysqli_query($conn, $sql)) {
        header('Location: main.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM `authors`;";
$result = mysqli_query($conn, $sql);
$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

$bookId = intval(trim($_GET['id']));

$sql = "SELECT `books`.*, `authors`.`id` AS a_id, `authors`.`name`
		FROM `books`
		LEFT JOIN `authors`
		ON `authors`.`id` = `books`.`author_id`
		WHERE `books`.`id` = " . $bookId;

$result = mysqli_query($conn, $sql);
$book = mysqli_fetch_assoc($result);




mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Изменение книги</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        h1 {
            text-align: center;
        }

        .container {
            margin: 30px auto;
            width: 100%;
            max-width: 980px;
        }

        .item {
            background-color: #ededed;
            padding: 30px;
            box-shadow: 0 0 25px gray;
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 4px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-50 {
            width: 50%;
        }

        .add, .edit, .delete {
            padding: 4px 12px;
            box-shadow: 0 0 3px rgb(241, 2, 2);
            border-radius: 4px;
            display: inline-block;
            margin-right: 8px;
            color: white;
            text-decoration: none;

        }

        .add {
            background-color: #27bf27;
        }

        .edit {
            background-color: #f87a04;
        }

        .delete {
            background-color: #d60000;
        }

        .mb {
            margin-bottom: 10px;
        }

        .mt {
            margin-top: 10px;
        }

        .actions {
            border-top: 1px solid gray;
            padding-top: 12px;
        }


        .field {
            margin: 5px 0 15px;
        }

        input, select, option {
            width: 100%;
            padding: 5px;
        }
    </style>
        <h1>Изменение книги</h1>

        <div class="row mb">
            <div class="col-50">
                <a class="delete" href="main.php">Отмена</a>
            </div>
        </div>
        <div class="list">
            <div class="item">
                <form class="form" method="post">
                    <div class="filed">
                        <input type="text" placeholder="Название книги" name="title" value="<?php echo $book['title']; ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Год выпуска" name="year" value="<?php echo $book['year']; ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Продажи" name="sales" value="<?php echo $book['sales']; ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Цена" name="price" value="<?php echo $book['price']; ?>">
                    </div>
                    <div class="filed">
                        <input type="text" placeholder="Описание" name="content" value="<?php echo $book['content']; ?>">
                    </div>
                    <div class="field">
                        <select type="text" name="author_id">
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?php echo $author['id']; ?>" <?php if ($author['id'] == $book['a_id']) echo 'selected' ?>>
                                    <?php echo $author['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                    <button class="edid">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>