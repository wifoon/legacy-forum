<?php
    session_start();
    include('connect.php');
        if(isSet($_SESSION['username']))
        {
            $postDesc = $_POST['post-editor'];
            $user_id = $_SESSION['id'];
            $topic_id = $_SESSION['topic_id'];

            if(empty($postDesc))
            {
                header('Location: topic.php?id='.$topic_id);
                exit();
            }
            else {
                $sql = "INSERT INTO posts(description, user_id, topic_id) VALUES('$postDesc', '$user_id', '$topic_id')";
                $results = mysqli_query($connect, $sql);

                if($results)
                {
                    header("Location: topic.php?id=".$topic_id);
                    exit();
                }
                else {
                    header("Location: home.php");
                    exit();
                }
            }
        }
        else {
            header("Location: index.php?error=Musisz być zalogowany");
        }
    

    
?>