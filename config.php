<?php

define('DB_HOST','localhost' );
define('DB_NAME','rustamdb' );
define('DB_USER','root' );
define('DB_PASS','' );

session_start();
if (!isset($_SESSION['user'])){
    $_SESSION['user'] = false;
}
