<?php

require_once 'config.php';



$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST)) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);

    $sql = "SELECT * FROM users
			WHERE
			    login='" . $login . "'
			AND
			    pass='" . $pass . "'";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);


    if (isset($user)) {
        $_SESSION['user'] = $user;
        header('Location: main.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

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
        <h1>Аторизация</h1>

        <div class="row mb">
            <div class="col-50">
                <a class="delete" href="main.php">Отмена</a>
            </div>
        </div>
        <div class="list">
            <div class="item">
                <form class="form" method="post">
                    <div class="filed">
                        <input type="text" placeholder="Логин" name="login">
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Пароль" name="pass">
                    </div>
                    <button class="edid">Войти</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>