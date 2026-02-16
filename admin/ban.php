<?php 
    session_start();
    include('../connect.php');
    $user_id = $_GET['id'];

    $sql = "UPDATE users SET ban='1' WHERE ID='$user_id'";
    $results = mysqli_query($connect, $sql);
    header("Location: ../home.php");
    exit();
?>