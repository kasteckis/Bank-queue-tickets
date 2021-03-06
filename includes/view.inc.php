<?php
	class ViewHandler 
	{
		function __construct()
		{

		}

		public function redirect_to_another_page($urlDestination, $delay)
		{
            echo '<meta http-equiv="refresh" content="'.$delay.'; url='.$urlDestination.'" />';
		}

		public function printMainMenuButton()
        {
            echo '<form action="/">
                    <button>Pagrindinis</button>
                </form>';
        }

        public function printStatisticsButton()
        {
            echo '<form action="statistics.php">
                    <button>Statistika</button>
                </form>';
        }

        public function printClientLoginButton()
        {
            echo '<form action="client-login.php">
                        <button>Prisijungti kaip klientui</button>
                  </form>';
        }

        public function printSpecialistLoginButton()
        {
            echo '<form action="specialist-login.php">
                    <button>Prisijungti kaip specialistui</button>
                  </form>';
        }

        public function printLogOutButton()
        {
            echo '<form method="GET">
                                <button name="logout" value="logout">Atsijungti</button>
                              </form>';
        }

        public function printClientZoneButton()
        {
            echo '<form action="/main-client.php">
                                <button>Kliento zona</button>
                              </form>';
        }

        public function printSpecialistZoneButton()
        {
            echo '<form action="/main-specialist.php">
                                <button>Admin zona</button>
                              </form>';
        }

        public function printYouCannotAccess()
        {
            echo "Jūs negalite matyti šio puslapio! Vyksta autorizavimas!";
        }

        public function saluteMember()
        {
            echo "Sveiki prisijungę, ".$_SESSION['clientName'];
        }

        public function printFailedLogin()
        {
            echo "Prisijungimas nesėkmingas!";
        }

        public function printRandomError()
        {
            echo "<span style='color:red'>Nutiko klaida!</span>";
        }

        public function printSuccessfulRegister()
        {
            echo "Užregistruota sėkmingai";
        }

        public function printThisUsernameTaken()
        {
            echo "Šis slapyvardis jau užimtas. ";
        }

        public function printErrorWhileRegistering()
        {
            echo "Nutiko klaida, kreipkitės telefonu";
        }

        public function printWaitingPeopleList($peopleList)
        {
            if ($peopleList->num_rows > 0)
            {
                while($row = $peopleList->fetch_assoc())
                {
                    $lastName = $row['lastname'];
                    echo "<h3>".$row['id']." - ".$row['name']." ".$lastName[0].". (".$row['estimatedTime']."min)</h3>";
                }
            }
            else
            {
                echo "<h3>Laukiančių žmonių eilėje nėra!</h3>";
            }
        }

        public function informClientAboutHisQueueEnd()
        {
            echo "<h4 style='color:green'>Jūsų eilė atėjo! :)</h4>";
        }

        public function informAboutEstimatedLeftTime($time, $time2)
        {
            echo "<h4 style='color:#ff4643'>Likęs laikas: " .$time." minutės!</h4>";
            echo "<h4 style='color:#ff4643'>Likęs apytikslis pagal vidurki: " .$time2." minutės!</h4>";
        }

        public function informAboutEmptyQueue()
        {
            echo "<h4>Laukiančių žmonių eilėje kolkas nebėra :)</h4>";
        }

        public function printNextClientForm($name, $lastname, $visit_id, $estimatedTime)
        {
            echo "<form method='POST'>";
            echo "<h3>Sekantis klientas - <span style='color:#ff4251'>" .$name." ".$lastname."</span> su numeriu <span style='color:#ff4251'>".$visit_id
                ."</span> Skirtas laikas - <span style='color:#ff4251'>".$estimatedTime."</span> minutės.</h3>";
            echo "<button name='clientServicedStart' class='main-button'>Klientas pradėtas aptarnauti</button>";
            echo "<button name='clientServiced' class='main-button'>Klientas aptarnautas</button>";
            echo "</form>";
        }

        public function printYouCannotSkipClient()
        {
            echo "Kliento vizitas dar neprasidėjas, jo užbaigti negalima!";
        }

        public function printPreviousClientTime($time)
        {
            echo "Paskutinis vizitas truko - ".$time;
        }

        public function printTicketReceptionForm()
        {
            $dbModel = new DB_Model();
            $estimatedTime = NULL;
            if(isset($_GET['estimatedTime'])) { $estimatedTime = $_GET['estimatedTime']; $estimatedTime = $dbModel->real_escape_string($estimatedTime);}
            echo '<h1>Talonėlio išdavimo punktas</h1>
                    <form method="GET">
                        <span> Kiek laiko planuojate užtrukt? </span><input name="estimatedTime" type="text" placeholder="Laikas" value="'.$estimatedTime.'"></input><br>
                        <button name="registerReceipt" type="submit" class="main-button">Registruotis</button>
                    </form>';
        }

        public function printCheckStatusWithTicketForm()
        {
            $dbModel = new DB_Model();
            $ticketId = NULL;
            if(isset($_GET['ticketId'])) { $ticketId = $_GET['ticketId']; $ticketId = $dbModel->real_escape_string($ticketId);}
            echo "<h1>Pasitikrinkite apytiksli laukimo laiką</h1>";
            echo "<form method='GET'>";
            echo "Suveskite talonėlio NR <input name='ticketId' placeholder='Talonėlio numeris' value='".$ticketId."'><br>";
            echo "<button name='submitTicket' class='main-button'>Patikrinti</button>";
            echo "</form>";
        }

        public function printTicketIdNotFound()
        {
            echo "<span style='color:red'>Vizito numeris nerastas!</span>";
        }

        public function printNavigationBar()
        {
            $userHandler = new UserHandler();
            if($_SESSION['loginStatus'] == "0")
            {
                $this->printClientLoginButton();
                $this->printSpecialistLoginButton();
            }
            else
            {
                $this->printLogOutButton();
                if($_SESSION['loginStatus'] == "client")
                    $this->printClientZoneButton();
                else
                    $this->printSpecialistZoneButton();
                if(isset($_GET['logout']))
                {
                    $userHandler->logout();
                    $this->redirect_to_another_page("index.php", 0);
                }
            }
            $this->printStatisticsButton();
            $this->printMainMenuButton();
        }

        public function onlyClientCanSeeThis()
        {
            if($_SESSION['loginStatus'] != "client")
            {
                $this->printYouCannotAccess();
                $this->redirect_to_another_page("index.php", 0);
                die();
            }
        }

        public function onlySpecialistCanSeeThis()
        {
            if($_SESSION['loginStatus'] != "specialist")
            {
                $this->printYouCannotAccess();
                $this->redirect_to_another_page("index.php", 0);
                die();
            }
        }

        public function printFooterInformation()
        {
            echo '                <a href="https://github.com/Tortonas/Bank-queue-tickets" target="_blank"><img class="icon" src="./img/github.png" alt="github logo"></a>
                <h4>Project was done by Valentinas Kasteckis 2019</h4>';
        }

        public function printThatYouAlreadyHaveANumber($number)
        {
            echo "<span style='color:red'>Jūs jau esate užsiregistravę! Jūsų vizito numeris numeris - ".$number."</span>";
        }

        public function pleaseUseLimitedRanges($number)
        {
            echo "<span style='color:red'>Nutiko klaida, prašome pasirinkti minutes maksimaliai iki ".$number.".</span>";
        }

        public function printCancelVisitForm($ticketId)
        {
            echo "<form class='cancelVisitForm' method='POST'>
                <h3>Jūs esate užsiregistravę, jūsų talonėlio numeris yra - <span style='color:red'>$ticketId</span></h3>
                <button name='cancelVisit' class='main-button'>Atšaukti vizitą</button>
                </form>";
        }

        public function printDelayVisitForm()
        {
            echo "<form method='POST'>
                <h3>Manote nespėsite? Galite pavėlinti savo apsilankymo laiką!</h3>
                <button name='delayVisit' class='main-button'>Pavėlinti</button>
                </form>";
        }

        public function printBusiestStatistics()
        {
            echo '<h1>Kada labiausiai esame užimti</h1>';
        }

        public function printRegisterForm()
        {
            $dbModel = new DB_Model();
            $username = NULL;
            $name = NULL;
            $lastName = NULL;
            if(isset($_POST['username'])) { $username = $_POST['username']; $username = $dbModel->real_escape_string($username);}
            if(isset($_POST['name'])) { $name = $_POST['name']; $name = $dbModel->real_escape_string($name);}
            if(isset($_POST['lastName'])) { $lastName = $_POST['lastName']; $lastName = $dbModel->real_escape_string($lastName);}

            echo '<h1>Kliento registracija</h1>
                    <form method="POST">
                        <input name="username" type="text" placeholder="Vartotojo vardas" value="'.$username.'"></input><br> 
                        <input name="name" type="text" placeholder="Vardas" value="'.$name.'"></input><br> 
                        <input name="lastName" type="text" placeholder="Pavardė" value="'.$lastName.'"></input><br> 
                        <input name="password" type="password" placeholder="Slaptažodis"></input><br> 
                        <input name="password-repeat" type="password" placeholder="Pakartokite slaptažodį"></input><br> 
                        <button name="loginButton" class="main-button">Registruotis</button><br>
                    </form>';
        }

        public function printClientLoginForm()
        {
            $dbModel = new DB_Model();
            $username = NULL;
            if(isset($_POST['username'])) { $username = $_POST['username']; $username = $dbModel->real_escape_string($username);}
            echo '                    <h1>Kliento prisijungimo langas</h1>
                     <form method="POST">
                        <input name="username" type="text" placeholder="Vartotojo vardas" value="'.$username.'"></input><br> 
                        <input name="password" type="password" placeholder="Slaptažodis"></input><br> 
                        <button name="loginButton" class="main-button">Prisijungti</button><br>
                        <a href="register.php">Neesate užisiregistravę? Užsiregistruokite!</a>
                     </form>';
        }

        public function printSpecialistLoginForm()
        {
            $dbModel = new DB_Model();
            $username = NULL;
            if(isset($_POST['username'])) { $username = $_POST['username']; $username = $dbModel->real_escape_string($username);}
            echo '                    <h1>Specialisto prisijungimo langas</h1>
                    <form method="POST">
                        <input name="username" type="text" placeholder="Vartotojo vardas" value="'.$username.'"></input><br> 
                        <input name="password" type="password" placeholder="Slaptažodis"></input><br> 
                        <button name="loginButton" class="main-button">Prisijungti</button><br>
                    </form>';
        }

        public function visitCancelSuccessful()
        {
            echo "<span style='color:red'>Vizitas buvo sėkmingai atšauktas!</span>";
        }

        public function printSuccesfullDelay($number)
        {
            echo "Jūsų vizitas buvo pavėlintas, jūsų naujas vizito numeris - ".$number;
        }

        public function printYouCannotDelayVisit()
        {
            echo "<span style='color:red'>Kadangi jūs esate paskutinis eilėje, pavėlinti savo apsilankymo negalite.</span>";
        }

        public function printBusiestTime($hour, $percent)
        {
            $percent = round($percent);
            if($percent == 0)
            {
                echo "<h4>$hour valanda užimtumas yra - <span style='color:green'>$percent%</span></h4>";
            }
            else
            {
                echo "<h4>$hour valanda užimtumas yra - <span style='color:red'>$percent%</span></h4>";
            }
        }
	}

?>