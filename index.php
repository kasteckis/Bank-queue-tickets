<?php
    session_start();
    foreach (glob("includes/*.php") as $filename)
    {
        include $filename;
    }
?>
<!DOCTYPE html>
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
                <?php
                    $userHandler = new UserHandler();
                    $viewHandler = new ViewHandler();
                    if($_SESSION['loginStatus'] == "0")
                    {
                        $viewHandler->printClientLoginButton();
                        $viewHandler->printSpecialistLoginButton();
                    }
                    else
                    {
                       $viewHandler->printLogOutButton();
                       if($_SESSION['loginStatus'] == "client")
                            $viewHandler->printClientZoneButton();
                       else
                           $viewHandler->printSpecialistZoneButton();
                        if(isset($_GET['logout']))
                        {
                            $userHandler->logout();
                            $viewHandler->redirect_to_another_page("index.php", 0);
                        }
                    }
                    $viewHandler->printMainMenuButton();
                ?>
            </div>
        </nav>
        <main>
            <div class="wrapper">
                <div class="waiting-box">
                    <h1>Laukiančiųjų eilė ir apytikslis laukimo laikas</h1>
                    <?php
                        $dbModel = new DB_Model();
                        $dbModel->readAndPrintVisits();

                        if($_SESSION['loginStatus'] == "client")
                        {
                            $dbModel->calculateLeftTime();
                        }
                    ?>
                </div>
            </div>
        </main>
        <footer>
            <div class="wrapper">
                <a href="https://github.com/Tortonas/Bank-queue-tickets" target="_blank"><img class="icon" src="./img/github.png" alt="github logo"></a>
                <h4>Project was done by Valentinas Kasteckis 2019</h4>
            </div>
        </footer>
    </body>
</html>