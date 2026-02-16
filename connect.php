<?php
    $sname = getenv('DB_HOST');
    $uname = getenv('DB_USER');
    $pswd = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');

    $connect = mysqli_connect($sname, $uname, $pswd, $dbname);

    if(!$connect) {
        error_log("Połączenie nieudane: " . mysqli_connect_error());
        die("Problem z połączeniem z bazą danych.");
    }
?>