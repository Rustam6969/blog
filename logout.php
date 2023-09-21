<?php

require_once 'config.php';

if (isset($_SESSION['user']) and !empty($_SESSION['user'])) {
    session_unset();
    session_destroy();
}

header('Location: main.php');
exit;
