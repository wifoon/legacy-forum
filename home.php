<?php
    session_start();
    include("connect.php");
    setlocale( LC_ALL, array('pl_PL',  'polish.utf8'));
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
                        <li><span>Hi, <b><?php echo $_SESSION['username']; ?></b>!</span></li></a>
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
                        <a class="nav-buttons" href="doc.php">Docs</a>
                    </div>
                    <input type="text" class="search" onkeyup="search()" id="search" placeholder="Search">
                </div>
            </div>
        </nav>
    </header>

    <main class="forum">
        <article class="hero-banner">
            <div class="container">
                <p class="hero-label">Welcome!</p>
                <p class="hero-text">We are a community of developers who have a universal passion - creating new things with code. For us, programming is a way to get to know ourselves and learn something new every day. Our forum also has many valuable discussions about various programming languages, frameworks, tools and technologies, as well as interesting projects in which you can participate. You can meet people with different interests and replace them with other developers from all over the world. Stay with us and you will see that programming is not only work, but also an adventure!</p>
            </div>
            <div class="right"></div>
            <div class="left"></div>
        </article>


        <article class="topics">
            <div class="container">
                <div class="topics-main">
                    

                    <?php
                        $sql_section = "SELECT * FROM section";
                        $results_section = mysqli_query($connect, $sql_section);
                        while($row_section = mysqli_fetch_array($results_section)) {
                            $section_id = $row_section['ID'];
                            $section_title = $row_section['title'];
                            echo "
                                <button class='collapsible'>
                                    <div class='category-label'>
                                        <span><i class='bx bxs-dashboard'></i>".$section_title."</span>
                                    </div>
                                    <i class='bx bx-chevron-down'></i>
                                </button>
                                <div class='coll-content'>";
                            $sql_cat = "SELECT * FROM category WHERE section='$section_id'";
                            $results_cat = mysqli_query($connect, $sql_cat);
                            while($row_cat = mysqli_fetch_array($results_cat)) {
                                $cat_id = $row_cat['ID'];
                                $cat_title = $row_cat['title'];
                                $cat_desc = $row_cat['description'];
                                $cat_type = $row_cat['type'];
                                if($cat_type === '0') { $i_class = 'bx bxs-chat'; } 
                                else if($cat_type === '1') { $i_class = 'bx bx-info-circle'; }
                                else if($cat_type === '10') { $i_class = 'bx bxl-html5'; }
                                else if($cat_type === '11') { $i_class = 'bx bxl-css3'; }
                                else if($cat_type === '12') { $i_class = 'bx bxl-javascript'; }
                                else if($cat_type === '13') { $i_class = 'bx bxl-php'; }

                                $sql_topic =  "SELECT * FROM topics WHERE cat_id='$cat_id' ORDER BY ID DESC LIMIT 1";
                                $results_topic = mysqli_query($connect, $sql_topic);
                                if(mysqli_num_rows($results_topic) <= 0 ) {
                                    echo "
                                    <section class='topic-category'>
                                        <div class='cat'>
                                            <div class='cat-left'>
                                            <div class='cat-icon'>
                                                <i class='".$i_class."'></i>
                                            </div>
                                            <div class='cat-label'>
                                                <a href='category.php?id=".$cat_id."'><p>".$cat_title."</p><span>".$cat_desc."</span></a>
                                            </div></div>
                                            
                                        </div>
                                    </section>";
                                }
                                else {
                                $row_topic = mysqli_fetch_array($results_topic);
                                $topic_id = $row_topic['ID'];
                                $topic_title = $row_topic['title'];
                                $topic_date = $row_topic['date'];
                                $topic_user = $row_topic['user_id'];
                                if(strftime("%Y",strtotime($topic_date)) === '2023') { $topic_date = strftime("%e %B",strtotime($topic_date)); }
                                else { $topic_date = strftime("%e %B %Y",strtotime($topic_date)); }
                                $sql_user = "SELECT * FROM users WHERE ID='$topic_user'";
                                $results_user = mysqli_query($connect, $sql_user);
                                $row_user = mysqli_fetch_array($results_user);
                                $username = $row_user['username'];
                                $pfp = $row_user['pfp'];
                                $rank = $row_user['rank'];
                                    if($rank === "Administrator") { $class = "rank-admin"; }
                                    else { $class = "username"; }
                                

                                echo "
                                <section class='topic-category'>
                                    <div class='cat'>
                                        <div class='cat-left'>
                                        <div class='cat-icon'>
                                            <i class='".$i_class."'></i>
                                        </div>
                                        <div class='cat-label'>
                                            <a href='category.php?id=".$cat_id."'><p>".$cat_title."</p><span>".$cat_desc."</span></a>
                                        </div></div>
                                        <div class='cat-right'>
                                            <div class='cat-last-topic'><img src='./pfp/".$pfp."'>
                                            <a href='topic.php?id=".$topic_id."'>
                                            <p>".$topic_title."</p><span>Przez <span class=".$class.">".$username."</span>, ".$topic_date."</span></a></div>
                                        </div>
                                    </div>
                                </section>";
                            }
                        }
                        echo "</div>";
                    }
                    ?>
                    


                    <button class="collapsible">
                        <div class="category-label">
                            <span><i class='bx bxs-dashboard'></i>Stats</span>
                        </div>
                        <i class='bx bx-chevron-down' id="arrow"></i>
                    </button>
                    <div class='coll-content'>
                        <section class="forum-stats">
                            <div class="stats">
                                <?php
                                $sql_counter1 = "SELECT ID FROM users";
                                $results1 = mysqli_query($connect, $sql_counter1);
                                $sql_counter2 = "SELECT ID FROM topics";
                                $results2 = mysqli_query($connect, $sql_counter2);
                                $users_counter = mysqli_num_rows($results1);
                                $topics_counter = mysqli_num_rows($results2);
                                echo "<p>".$users_counter."</p><span>Users</span>";
                                ?>
                            </div>
                            <div class="stats">
                                <?php echo "<p>".$topics_counter."</p><span>Topics</span>"; ?>
                            </div>
                        </section>
                    </div>
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
var coll = document.getElementsByClassName("collapsible");
// var icon = document.querySelector(".collapsible .bx-chevron-down");
var i;

for (i = 0; i < coll.length; i++) {
    
    let current = coll[i];
    current.addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        let icon;
        
        let icons = current.getElementsByClassName("bx");
        icon = icons[1];
        
        content.classList.toggle("coll-active")
        icon.className = icon.className == "bx bx-chevron-down" ? "bx bx-chevron-left" : "bx bx-chevron-down"
    });
}
</script>

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
        header("Location: index.php?error=You must be logged in");
    }

?>