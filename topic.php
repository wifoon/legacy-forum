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
    <script src="https://cdn.tiny.cloud/1/yd7a9zh5529c6im09xq1bc8x40abi36oqsgs156ppfjk4eon/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./admin-menu/main.js"></script>
    <script src="./text-editor/main.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./admin-menu/style.css">
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

        <article class="topic">
            <div class="container">
                <?php
                    $topic_id = $_GET['id'];
                    $user_rank = $_SESSION['rank'];
                    $_SESSION['topic_id'] = $topic_id;
                    $sql_topic = "SELECT * FROM topics WHERE ID='$topic_id'";
                    $results_topic = mysqli_query($connect, $sql_topic);
                    $row_topic = mysqli_fetch_array($results_topic);
                    $topic_date = $row_topic['date'];
                    $locked = $row_topic['locked'];
                    $_SESSION['locked'] = $locked;
                    $author_id = $row_topic['user_id'];
                    setlocale( LC_ALL, array( 'pl_PL',  'polish.utf8'));
                    $topic_date = strftime("%e %B %Y",strtotime($topic_date));

                    $sql_author = "SELECT * FROM users WHERE ID='$author_id'";
                    $results_author = mysqli_query($connect, $sql_author);
                    $row_author = mysqli_fetch_array($results_author);
                    $author_username = $row_author['username'];
                    $author_pfp = $row_author['pfp'];
                    $author_rank = $row_author['rank'];
                    if($author_rank === "Administrator") { $author_rank = "</i>Administrator"; $class = "rank-admin"; }
                    else { $class = "rank-user"; }


                    echo "
                    <div class='topic-top'>
                        <p class='topic-post-label'>".$row_topic['title']."</p>
                        <div class='dropdown'>
                            <i onclick='dropdown()' class='bx bx-dots-horizontal-rounded'></i>";
                            if($user_rank === 'Administrator') {
                        echo "<div id='menu' class='dropdown-content'>";
                    if($locked === '0') {
                        echo "<a href='./admin/lock.php?id=".$topic_id."'>Zamknij temat</a>";
                    }
                    else {
                        echo "<a href='./admin/lock.php?id=".$topic_id."'>Otwórz temat</a>";
                    }
                    echo "
                            <a id='edit-btn'>Edytuj</a>
                            <a class='delete' href='./admin/delete.php?id=".$topic_id."'>Usuń</a>
                        </div>";
                    }
                    echo "
                    </div>
                    </div>
                    <div class='topic-author'>
                    <a href='./user.php?id=".$row_author['ID']."'><img src='./pfp/".$author_pfp."'></a>
                        <div class='author-label'>
                            <p>Przez ".$author_username.",</p><span>".$topic_date."</span>
                        </div>
                    </div><hr>";
                        
                    echo "
                    <div class='post'>
                    <div class='post-author'>
                        <div>
                            <p>".$author_username."</p>
                            <img src='./pfp/".$author_pfp."'>
                            <p class='".$class."'>".$author_rank."</p>
                        </div>
                    </div>
                    <div class='post-content'>
                        <p class='post-date'>Opublikowano ".$topic_date."</p>
                        <div id='topic-content' class='content'>".$row_topic['description']."</div>
                    </div></div><hr>";

                    $sql_posts = "SELECT * FROM posts WHERE topic_id='$topic_id'";
                    $results_posts = mysqli_query($connect, $sql_posts);
                    while($row_posts = mysqli_fetch_array($results_posts)) {
                        $post_date = strftime("%e %B %Y",strtotime($row_posts['date']));
                        $post_author_id = $row_posts['user_id'];
                        $sql_post_user = "SELECT * FROM users WHERE ID='$post_author_id'";
                        $results_post_user = mysqli_query($connect, $sql_post_user);
                        $row_post_user = mysqli_fetch_array($results_post_user);
                        $author_rank = $row_post_user['rank'];
                        if($author_rank === "Administrator") { $class = "rank-admin"; }
                        else { $class = "rank-user"; }

                        echo "
                        <div class='post'>
                        <div class='post-author'>
                            <div>
                                <p>".$row_post_user['username']."</p>
                                <img src='./pfp/".$row_post_user['pfp']."'>
                                <p class='".$class."'>".$author_rank."</p>
                            </div>
                        </div>
                        <div class='post-content'>
                            <p class='post-date'>Opublikowano ".$post_date."</p>
                            <div class='content'>".$row_posts['description']."</div>
                        </div></div><hr>";
                    }


                    echo "<div class='add-post'>";
                    if($locked === '0') {
                        echo "<form method='POST' action='create-post.php'>";
                        echo "<div class='add-box'><img src='./pfp/".$_SESSION['pfp']."'>";
                        echo "<div id='replace'><button onClick='replace(this)'>Dodaj odpowiedź do tematu...</button></div></div></form>";
                    }
                    else {
                        echo "<div class='add-box'><img src='./pfp/".$_SESSION['pfp']."'>";
                        echo "<div class='locked'><i class='bx bxs-error'></i>Ten temat został zamknięty. Brak możliwości dodania odpowiedzi.</div></div>";
                    }
                    echo "</div>";
                ?>
                   
                
            </div>
        </article>
    </main>

    <footer>
        <?php 
            include("./footer/footer.html");
        ?>
    </footer>
<script>
    function edit() {
        var div = document.getElementById('topic-content');
        var content = `<?php echo $row_topic['description']; ?>`;
    div.outerHTML = `<?php echo '<form method="POST" action="./admin/edit.php?id='.$topic_id.'"><textarea class="post-editor" name="post-editor">'.$row_topic['description'].'</textarea><input type="submit" name="submit" class="save-button" value="Zapisz"></form>'; ?>`;
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        skin: "oxide-dark",
        content_css: "dark",
    });
    }

    var a = document.getElementById('edit-btn')
    a.addEventListener('click', edit);
</script>
</body>
</html>
<?php
    }
    else {
        header("Location: index.php?error=Musisz być zalogowany");
    }

?>