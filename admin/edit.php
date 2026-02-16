<?php 
    session_start();
    include('../connect.php');
    $topic_id = $_GET['id'];
    $new_desc = $_POST['post-editor'];

    $sql = "UPDATE topics SET description='$new_desc' WHERE ID='$topic_id'";
    $results = mysqli_query($connect, $sql);
    header("Location: ../topic.php?id=".$topic_id);
    exit();
?>