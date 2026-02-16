<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="showpassword.js"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="background">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <main>
        <article class="box-login">
            <div class="login">
                <div class="label">
                    <span>Zarejestruj się</span>
                    <p>Dołącz do naszej społeczności i bądź na bieżąco z najnowszymi treściami</p>
                </div>
                <form class="form-login" method="POST" action="signup.php">
                    <?php if(isSet($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <?php if(isSet($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <img class="icon" src="./images/email.png">
                    <input class="input" name="email" type="text" placeholder="Adres e-mail" ><br>
                    <img class="icon" src="./images/user.png">
                    <input class="input" name="username" type="text" placeholder="Nazwa użytkownika" ><br>
                    <img class="icon" src="./images/pswd.png">
                    <label class="show" for="show"><i class='bx bx-low-vision' id="icon"></i></label><input class="checkbox" type="checkbox" onclick="showPassword()" id="show">
                    <input class="input" id="password" name="password" type="password" placeholder="Hasło" ><br>
                    <img class="icon" src="./images/pswd.png">
                    <label class="show" for="show1"><i class='bx bx-low-vision' id="icon1"></i></label><input class="checkbox" type="checkbox" onclick="showPassword1()" id="show1">
                    <input class="input" id="password1" name="repassword" type="password" placeholder="Powtórz hasło" ><br>
                    <input type="checkbox" class="checkbox" name="accept" id="accept"><label class="accept" for="accept">Zgadzam się z <a href="">Zasadami i warunkami</a></label>
                    <input type="submit" class="btn-login" value="Stwórz konto"><br>
                    <p>Masz już konto? <a href="login.php">Zaloguj się!</a></p>
                </form>
            </div>
        </article>
    </main>


</body>
</html>