<?php 
    session_start();
    include('../connect.php');
    $topic_id = $_GET['id'];
    $sql = "SELECT * FROM topics WHERE ID='$topic_id'";
    $results = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($results);
    if($row['locked'] === '0') {
        $sql2 = "UPDATE topics SET locked='1' WHERE ID='$topic_id'";
        $results2 = mysqli_query($connect, $sql2);
        header("Location: ../topic.php?id=".$topic_id);
        exit();
    }
    else {
        $sql2 = "UPDATE topics SET locked='0' WHERE ID='$topic_id'";
        $results2 = mysqli_query($connect, $sql2);
        header("Location: ../topic.php?id=".$topic_id);
        exit();
    }
?>