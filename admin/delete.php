<?php 
    session_start();
    include('../connect.php');
    $topic_id = $_GET['id'];
    $new_desc = $_POST['post-editor'];

    $sql = "DELETE FROM topics WHERE ID='$topic_id'";
    $results = mysqli_query($connect, $sql);
    header("Location: ../home.php");
    exit();
?>