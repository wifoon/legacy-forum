<?php
session_start();
include('connect.php');

    if(isSet($_POST['username']) && isSet($_POST['password'])) {

        function validation($input) {
            $input = preg_replace('/\s+/', '', $input);
            return $input;
        }

        $username = validation($_POST['username']);
        $password = validation($_POST['password']);

        if(empty($username)) {
            header("Location: index.php?error=Musisz podać nazwę użytkownika!");
            exit();
        }
        else if(empty($password)) {
            header("Location: index.php?error=Musisz podać hasło!");
            exit();
        }
        else {
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

            $results = mysqli_query($connect, $sql);
            if(mysqli_num_rows($results) === 1) {
                $row = mysqli_fetch_assoc($results);

                if($row['username'] === $username && $row['password'] === $password) {
                    $_SESSION['id'] = $row['ID'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['rank'] = $row['rank'];
                    $_SESSION['pfp'] = $row['pfp'];
                    $_SESSION['ban'] = $row['ban'];
                    header("Location: home.php");
                    exit();
                }
                else {
                    header("Location: index.php?error=Niepoprawne hasło lub nazwa użytkownika!");
                    exit();
                }
            }
            else {
                header("Location: index.php?error=Niepoprawne hasło lub nazwa użytkownika!");
                exit();
            }
        }
    }

    else {
        header("Location: index.php");
        exit();
    }

?>