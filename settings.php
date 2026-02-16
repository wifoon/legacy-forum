<?php
    session_start();
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
                        <li><img class="pfp" alt="pfp" src="./pfp/<?php echo $_SESSION['pfp'];?>"></li>
                        <li><span>Cześć, <b><?php echo $_SESSION['username']; ?></b>!</span></li>
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
        <article class="acc-settings">
            <div class="label">
                <span>Ustawienia konta</span>
                <p>Zarządzanie ustawieniami profilu użytkownika</p>
            </div>
            
            <div class="acc-change">
                <form method="POST" action="change-name.php">
                <div>
                    <p class="acc-label">Zmień nazwę użytkownika<br>
                        <input type="text" class="acc-input" name="newname" placeholder="Nazwa użytkownika" value="<?php echo $_SESSION['username'];?>">
                    </p>
                    <input type="submit" class="acc-button" value="Zmień"></form>
                </div>
                
                <hr>

                <form method="POST" action="change-password.php">
                <div>
                    <p class="acc-label">Zmień hasło<br>
                        <input type="password" name="oldpswd" class="acc-input" placeholder="Podaj aktualne hasło"><br>
                        <input type="password" name="newpswd" class="acc-input" placeholder="Podaj nowe hasło"><br>
                        <input type="password" name="renewpswd" class="acc-input" placeholder="Powtórz nowe hasło">
                    </p>
                    <input type="submit" class="acc-button" value="Zmień"></form>
                </div>

                <hr>

                <form method="POST" action="change-photo.php" enctype="multipart/form-data">
                <div>
                    <p class="acc-label">Zmień zdjęcie<br>
                        <input type="file" name="image">
                    </p>
                    <input type="submit" name="submit" class="acc-button" value="Zmień"></form>
                </div>
            </div>
            <?php if(isSet($_GET['success'])) { ?>
                    <p class="acc-success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <?php if(isSet($_GET['error'])) { ?>
                    <p class="acc-error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
        </article>
    </main>

    <footer>
        <?php 
            include("./footer/footer.html");
        ?>
    </footer>

</body>
</html>
<?php
    }
    else {
        header("Location: index.php?error=Musisz być zalogowany");
    }

?>