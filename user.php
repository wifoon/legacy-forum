<?php
    session_start();
    $user_id = $_SESSION['id'];
    include("connect.php");
    if(isSet($_SESSION['id']) && isSet($_SESSION['username']))
    {

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./admin-menu/main.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./admin-menu/style.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./footer/style.css">
    <title>Forum</title>
</head>
<body>
    <?php
    if($_SESSION['ban'] !== '0')
        {
            echo "<div class='ban'><p>ZBANOWANY!</p><span>Ze względu na twoje działania na forum, dostęp został zablokowany.</span></div>";
        }
    ?>
    <header>
        <nav class="navbar">
            <div class="container-top">
                <div class="nav-top">
                    <a href="home.php"><img class="logo" alt="logo" src="./images/logo.png"></a>

                    <ul class="nav-profile">
                        <a href="user.php?id=<?php echo $user_id; ?>"><li><img class="pfp" alt="pfp" src="./pfp/<?php echo $_SESSION['pfp'];?>"></li>
                        <li><span>Cześć, <b><?php echo $_SESSION['username']; ?></b>!</span></li></a>
                        <div class="divider"></div>
                        <li><a href="settings.php"><i class='bx bx-cog bx-spin-hover'></i></a></li>
                        <li><a href="logout.php"><i class='bx bx-log-out'></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="container-bottom">
                <div class="nav-bottom">
                    <div class="nav-links">
                        <a class="nav-buttons" href="home.php">Home</a>
                        <a class="nav-buttons" href="doc.php">Dokumentacja</a>
                    </div>
                    <input type="text" class="search" onkeyup="search()" id="search" placeholder="Wyszukaj na naszym forum">
                </div>
            </div>
        </nav>
    </header>


    <main class="acc-main">
        <article class="user-profile">
            <div class="profile-label">
                <span>Profil użytkownika</span>
                <?php 
                $now_rank = $_SESSION['rank'];
                $user_id = $_GET['id']; 
                    echo "
                    <div class='dropdown'>
                            <i onclick='dropdown()' class='bx bx-dots-horizontal-rounded'></i>";
                            if($now_rank === 'Administrator' && $user_id !== $_SESSION['id']) {
                        echo "<div id='menu' class='dropdown-content'>
                        <a class='delete' href='./admin/ban.php?id=".$user_id."'>Zbanuj</a>
                        </div>";
                    }
                    echo "
                    </div>";
                ?>
            </div>
            <div class="container">
                <div class="profile">
                    <div class="profile-info">
                        <?php
                        $sql_user = "SELECT * FROM users WHERE ID='$user_id'";
                        $results_user = mysqli_query($connect, $sql_user);
                        $row_user = mysqli_fetch_array($results_user);
                        $sql_topcis = "SELECT * FROM topics WHERE user_id='$user_id'";
                        $results_topics = mysqli_query($connect, $sql_topcis);
                        $counter_topics = mysqli_num_rows($results_topics);
                        $sql_posts = "SELECT * FROM posts WHERE user_id='$user_id'";
                        $results_posts = mysqli_query($connect, $sql_posts);
                        $counter_posts = mysqli_num_rows($results_posts);
                        $user_pfp = $row_user['pfp'];
                        $user_name = $row_user['username'];
                        $user_rank = $row_user['rank'];
                        if($user_rank === "Administrator") { $user_rank = "</i>Administrator"; $class = "admin"; }
                        else { $class = "user"; }
                        echo "
                        <img src='./pfp/".$user_pfp."'>
                        <div>
                            <p>".$user_name."</p>
                            <span class='".$class."'>".$user_rank."</span>
                        </div>
                        </div>
                        <div class='profile-stats'>
                            <div>
                                <p>".$counter_posts."</p>
                                <span>odpowiedzi</span>
                            </div>
                            <div>
                                <p>".$counter_topics."</p>
                                <span>tematów</span>
                            </div>
                        </div>
                        </div>
                        <hr>
                        ";
                        ?>
            </div>
        </article>
    </main>


</body>
</html>
<?php
    }
    else {
        header("Location: index.php?error=Musisz być zalogowany");
    }

?>