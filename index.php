<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="showpassword.js"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Zaloguj się</title>
</head>
<body>
    <main>
        <article class="box-login">
            <div class="login">
                <div class="label">
                    <span>Zaloguj się</span>
                    <p>Aby przeglądać forum musisz być zalogowany</p>
                </div>
                <form class="form-login" method="POST" action="login.php">
                    <?php if(isSet($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <img class="icon" src="./images/user.png">
                    <input class="input" name="username" type="text" placeholder="Nazwa użytkownika" ><br>
                    <img class="icon" src="./images/pswd.png">
                    <label class="show" for="show"><i class='bx bx-low-vision' id="icon"></i></label><input class="checkbox" type="checkbox" onclick="showPassword()" id="show">
                    <input class="input" name="password" id="password" type="password" placeholder="Hasło" ><br>
                    <input type="submit" class="btn-login" value="Zaloguj się"><br>
                    <p>Nie masz konta? <a href="register.php">Dołącz do nas!</a></p>
                </form>
            </div>
        </article>
    </main>


</body>
</html>