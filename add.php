<?php

require_once 'config.php';


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `authors`;";
$result = mysqli_query($conn, $sql);
$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!empty($_POST)) {

    $title = trim($_POST['title']);
    $author_id = intval(trim($_POST['author_id']));
    $year = intval(trim($_POST['year']));
    $sales = intval(trim($_POST['sales']));
    $price = doubleval(trim($_POST['price']));

    $sql = "INSERT INTO books (`author_id`, `title`, `year`, `sales`, `price`)
		VALUES ('" . $author_id . "', '" . $title . "', '" . $year . "', '" . $sales . "', '" . $price . "')";

    if (mysqli_query($conn, $sql)) {
        header('Location: main.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Книги</title>
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
        <h1>Книги</h1>

        <div class="row mb">
            <div class="col-50">
                <a class="delete" href="main.php">Отмена</a>
            </div>
        </div>

        <div class="list">
            <div class="item">
                <form class="form" method="post" action="">
                    <div class="field">
                        <input type="text" placeholder="Название" name="title">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Год выпуска" name="year">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Продаж" name="sales">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Цена" name="price">
                    </div>
                    <div class="field">
                        <select type="text" name="author_id">
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?php echo $author['id']; ?>">
                                    <?php echo $author['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="add">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>