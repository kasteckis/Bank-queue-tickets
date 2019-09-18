<?php
    session_start();
    foreach (glob("includes/*.php") as $filename)
    {
        include $filename;
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bank queue tickets</title>
        <meta name="description" content="Banking queue tickets allows you to track the time until your queue is over.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style/style.css">
    </head>
    <body>
        <nav>
            <div class="wrapper">
                <img class="main-icon" src="./img/bank.png" alt="github logo">
                <form action="client-login.php">
                    <button>Prisijungti kaip klientui</button>
                </form>
                <form action="specialist-login.php">
                    <button>Prisijungti kaip specialistui</button>
                </form>
                <form action="/">
                    <button>Pagrindinis</button>
                </form>
            </div>
        </nav>
        <main>
            <div class="wrapper">
                <div class="login-screen">
                    <h1>Kliento prisijungimo langas</h1>
                     <form method="POST">
                        <input name="username" type="text" placeholder="Vartotojo vardas"></input><br> 
                        <input name="password" type="password" placeholder="Slaptažodis"></input><br> 
                        <button name="loginButton">Prisijungti</button><br>
                        <a href="register.php">Neesate užisiregistravę? Užsiregistruokite!</a>
                     </form>
                </div>
            </div>
        </main>
        <footer>
            <div class="wrapper">
                <a href="https://github.com/Tortonas/Bank-queue-tickets" target="_blank"><img class="icon" src="./img/github.png" alt="github logo"></a>
                <h4>Project was done by Valentinas Kasteckis 2019</h2>
            </div>
        </footer>
    </body>
</html>