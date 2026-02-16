<?php
    session_start();
    $user_id = $_SESSION['id'];
    if(isSet($_SESSION['id']) && isSet($_SESSION['username']))
    {

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/yd7a9zh5529c6im09xq1bc8x40abi36oqsgs156ppfjk4eon/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

    <main>
        <article class="new-topic">
            <div class="container">
                <div class="label">
                    <span>Dodaj nowy temat</span>
                </div>
                <?php if(isSet($_GET['success'])) { ?>
                    <p class="acc-success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <?php if(isSet($_GET['error'])) { ?>
                    <p class="acc-error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <form class="topic-form" action="create-topic.php" method="POST">
                    <label for="topic-title">Tytuł tematu</label><input class="topic-input" type="text" name="topic-title" id="topic-title">
                    <label for="editor">Treść</label><textarea id="file-picker" class="editor" name="editor"></textarea>
                    <input type="submit" name="submit" class="acc-button" value="Wyślij"></form>
                </form>
            </div>
        </article>
    </main>

    <footer>
        <?php 
            include("./footer/footer.html");
        ?>
    </footer>

<script src='./text-editor/main.js'></script>
</body>
</html>
<?php
    }
    else {
        header("Location: index.php?error=Musisz być zalogowany");
    }

?>