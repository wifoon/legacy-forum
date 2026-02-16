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
    <script defer src="./prism/prism.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./footer/style.css">
    <link rel="stylesheet" href="./documentation/style.css">
    <link rel="stylesheet" href="./prism/prism.css">
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
        <article class="instruction">
            <div>
                <p>Instrukcja</p>
                <span>Do poprawnego działania forum stwórz bazę danych o nazwie <b>forum_db</b>. Następnie zaimportuj możliwy do pobrania plik forum_db.sql aby utworzyć tabele wewnątrz bazy. Korzystając z podanych poniżej, wymaganych do poprawnego działania plików stwórz własne forum i zmodyfikuj je według własnych upodobań.</span>
                <div id="download"><a class="download" href="./db/forum_db.sql" download="forum_db.sql">Pobierz <i class='bx bxs-download' ></i></a><div>
            </div>
        </article>
        
        <article class="documentation">
            
            <div class="doc-panel">
                <div class="doc-label">
                    <p>Wykorzystane pliki</p>
                </div>
                <button onclick="index()" class="doc-button">index.php</button>
                <button onclick="login()" class="doc-button">login.php</button>
                <button onclick="register()" class="doc-button">register.php</button>
                <button onclick="signup()" class="doc-button">signup.php</button>
                <button onclick="home()" class="doc-button">home.php</button>
                <button onclick="settings()" class="doc-button">settings.php</button>
                <button onclick="category()" class="doc-button">category.php</button>
                <button onclick="topic()" class="doc-button">topic.php</button>
                <button onclick="changename()" class="doc-button">change-name.php</button>
                <button onclick="changepassword()" class="doc-button">change-password.php</button>
                <button onclick="changephoto()" class="doc-button">change-photo.php</button>
                <button onclick="connect()" class="doc-button">connect.php</button>
                <button onclick="createtopic()" class="doc-button">create-topic.php</button>
                <button onclick="createpost()" class="doc-button">create-post.php</button>
                <button onclick="newtopic()" class="doc-button">new-topic.php</button>
                <button onclick="user()" class="doc-button">user.php</button>
                <button onclick="showpss()" class="doc-button">show-password.js</button>
                <button onclick="logout()" class="doc-button">logout.php</button>
                <button onclick="footer()" class="doc-button">footer.html</button>
            </div>
            <div class="doc-content">
                <pre><code class="language-php" id="content"></code></pre>
            </div>
        </article>
        <article class="instruction">
            <div>
                <p>Informacje dodatkowe</p>
                <span>Wszystkie ikony na stronie pochodzą ze strony https://boxicons.com. Czcionka użyta na forum to Titillium Web. Szyfrowanie hasła odbywa się za pomocą funkcji md5. Forum jest całkowicie zsynchronizowane z bazą danych. Konto użytkownika można nadać poprzez kolumnę rank w tabeli users. Administrator ma kontrolę nad innymi użytkownikami i tematami znajdującymi się na forum. Dodatkowymi pluginami są TinyMCE (edytor tekstu) oraz Prism.JS.</span>
            </div>
        </article>
    </main>

    <footer>
        <?php 
            include("./footer/footer.html");
        ?>
    </footer>

<script>
let content = document.getElementById('content');
function index(){
    content.innerHTML = `<?php include_once './documentation/index.txt'?>`;
    Prism.highlightAll()
}
function login(){
    content.innerHTML = `<?php include_once './documentation/login.txt'?>`;
    Prism.highlightAll()
}
function register(){
    content.innerHTML = `<?php include_once './documentation/register.txt'?>`;
    Prism.highlightAll()
}
function signup(){
    content.innerHTML = `<?php include_once './documentation/signup.txt'?>`;
    Prism.highlightAll()
}
function home(){
    content.innerHTML = `<?php include_once './documentation/home.txt'?>`;
    Prism.highlightAll()
}
function settings(){
    content.innerHTML = `<?php include_once './documentation/settings.txt'?>`;
    Prism.highlightAll()
}
function category(){
    content.innerHTML = `<?php include_once './documentation/category.txt'?>`;
    Prism.highlightAll()
}
function topic(){
    content.innerHTML = `<?php include_once './documentation/topic.txt'?>`;
    Prism.highlightAll()
}
function changename(){
    content.innerHTML = `<?php include_once './documentation/change-name.txt'?>`;
    Prism.highlightAll()
}
function changepassword(){
    content.innerHTML = `<?php include_once './documentation/change-password.txt'?>`;
    Prism.highlightAll()
}
function changephoto(){
    content.innerHTML = `<?php include_once './documentation/change-photo.txt'?>`;
    Prism.highlightAll()
}
function connect(){
    content.innerHTML = `<?php include_once './documentation/connect.txt'?>`;
    Prism.highlightAll()
}
function createtopic(){
    content.innerHTML = `<?php include_once './documentation/create-topic.txt'?>`;
    Prism.highlightAll()
}
function createpost(){
    content.innerHTML = `<?php include_once './documentation/create-post.txt'?>`;
    Prism.highlightAll()
}
function newtopic(){
    content.innerHTML = `<?php include_once './documentation/new-topic.txt'?>`;
    Prism.highlightAll()
}
function user(){
    content.innerHTML = `<?php include_once './documentation/user.txt'?>`;
    Prism.highlightAll()
}
function showpss(){
    content.innerHTML = `<?php include_once './documentation/showpassword.txt'?>`;
    Prism.highlightAll()
}
function logout(){
    content.innerHTML = `<?php include_once './documentation/logout.txt'?>`;
    Prism.highlightAll()
}
function footer(){
    content.innerHTML = `<?php include_once './documentation/footer.txt'?>`;
    Prism.highlightAll()
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