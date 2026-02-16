<?php
    session_start();
    include("connect.php");
    $user_id = $_SESSION['id'];
    setlocale( LC_ALL, array('pl_PL',  'polish.utf8'));
    if(isSet($_SESSION['id']) && isSet($_SESSION['username']))
    {

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

    <main class="forum">
        <article class="hero-banner">
            <div class="container">
                <p class="hero-label">Witaj na forum</p>
                <p class="hero-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
            <div class="right"></div>
            <div class="left"></div>
        </article>


        <article class="topics">
            <div class="container">
                <div class="topics-main">

                    <?php
                        $cat_id = $_GET['id'];
                        $_SESSION['cat_id'] = $cat_id;
                        $sql_cat = "SELECT * FROM category WHERE ID='$cat_id'";
                        $results_cat = mysqli_query($connect, $sql_cat);
                        $row_cat = mysqli_fetch_array($results_cat);

                        echo "<div class='category-name-label'>";
                        echo "<span>".$row_cat['title']."</span><a href='new-topic.php?id=".$_SESSION['cat_id']."'>Dodaj nowy temat</a>";
                        echo "</div>";
                        $sql = "SELECT * FROM topics WHERE cat_id='$cat_id'";
                        $results = mysqli_query($connect, $sql);
                        while($row = mysqli_fetch_array($results)) {
                            $user_id = $row['user_id'];
                            $topic_id = $row['ID'];
                            $topic_name = $row['title'];
                            $locked = $row['locked'];
                            
                            $sql_users = "SELECT * FROM users WHERE ID='$user_id'";
                            $results_users = mysqli_query($connect, $sql_users);
                            $row_users = mysqli_fetch_array($results_users);
                            $author_rank = $row_users['rank'];
                            if($author_rank === "Administrator") { $class = "rank-admin"; }
                            else { $class = "username"; }

                            $date = $row['date'];
                            if(strftime("%Y",strtotime($date)) === '2023') { $date = strftime("%e %B",strtotime($date)); }
                            else { $date = strftime("%e %B %Y",strtotime($date)); }

                            $sql_counter = "SELECT * FROM posts WHERE topic_id='$topic_id'";
                            $results_counter = mysqli_query($connect, $sql_counter);
                            $counter = mysqli_num_rows($results_counter);
                            if($counter === 1) { $odpowiedz = " odpowiedź"; }
                            else { $odpowiedz = " odpowiedzi"; }


                            echo "<div value='".$topic_name."' class='topics-display'>";
                            echo "<div class='container'>";
                            echo "<div class='topics-display-label'>";
                            if($locked === '1') {
                                echo "<p><i title='Ten temat jest zamknięty' class='bx bxs-lock-alt'></i><a href='topic.php?id=".$topic_id."'>".$topic_name."</a></p>";
                            }
                            else {
                                echo "<p><a href='topic.php?id=".$topic_id."'>".$topic_name."</a></p>";
                            }
                            echo "<span>Przez </span><span class='".$class."'>".$row_users['username']."</span><span>, ".$date."</div>";
                            echo "<div class='topics-display-info'><span class='posts-counter'>".$counter.$odpowiedz."</span><div class='topic-divider'></div><a href='./user.php?id=".$row_users['ID']."'><img src='./pfp/".$row_users['pfp']."'></a></div>";
                            echo "</div></div>";
                        }
                    ?>
                </div>

                <div class="topics-panel">
                </div>
            </div>
        </article>
    </main>

    <footer>
        <?php 
            include("./footer/footer.html");
        ?>
    </footer>

    <script>
        function search() {
            var search = document.getElementById('search').value.toUpperCase();
            var name = document.getElementsByClassName('topics-display');

            for(var i=0; i<name.length; i++) {
                a = name[i].getAttribute("value");
                if(a.toUpperCase().indexOf(search) > -1) {
                    name[i].style.display = "";
                }
                else {
                    name[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
<?php
    }
    else {
        header("Location: index.php?error=Musisz być zalogowany");
    }

?>