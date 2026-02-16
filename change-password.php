<?php
    session_start();
    include('connect.php');
        if(isSet($_SESSION['username']))
        {
            function validation($input) {
                $input = preg_replace('/\s+/', '', $input);
                return $input;
            }

            $id = $_SESSION['id'];
            $oldpswd = validation($_POST['oldpswd']);
            $newpswd = validation($_POST['newpswd']);
            $renewpswd = validation($_POST['renewpswd']);

            if(empty($oldpswd)) {
                header("Location: settings.php?error=Musisz podać stare hasło");
                exit();
            }
            else if(empty($newpswd)) {
                header("Location: settings.php?error=Musisz podać nowe hasło");
                exit();
            }
            else if(empty($renewpswd)) {
                header("Location: settings.php?error=Musisz powtórzyć nowe hasło");
                exit();
            }
            else if($newpswd !== $renewpswd) {
                header("Location: settings.php?error=Hasła różnią się od siebie");
                exit();
            }
            else if($oldpswd == $newpswd) {
                header("Location: settings.php?error=Nowe hasło musi być inne");
                exit();
            }
            else {
                $oldpswd = md5($oldpswd);
                $newpswd = md5($newpswd);
                $renewpswd = md5($renewpswd);
                
                $sql = "SELECT * FROM users WHERE ID='$id' AND password='$oldpswd'";
                $results = mysqli_query($connect, $sql);

                if(mysqli_num_rows($results) === 1) {
                    $row = mysqli_fetch_assoc($results);
                    if($row['password'] === $oldpswd) {
                        $sql2 = "UPDATE users SET password='$newpswd' WHERE ID='$id'";
                        $result2 = mysqli_query($connect, $sql2);
                        header("Location: settings.php?success=Pomyślnie zmieniono hasło do konta!");
                    }
                    else {
                        header("Location: settings.php?error=Podaj poprawne hasło");
                        exit();
                    }
                }
                else {
                    header("Location: settings.php?error=Podaj poprawne hasło");
                    exit();
                }
            }
        }
        else {
            header("Location: index.php?error=Musisz być zalogowany");
        }
    

    
?>