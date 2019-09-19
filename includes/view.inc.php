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
            echo "Jūs negalite matyti šio puslapio!";
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
            echo "Nutiko klaida!";
        }

        public function printSuccessfulRegister()
        {
            echo "Jūsų laikas sėkmingai užregistruotas!";
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

        public function informAboutEstimatedLeftTime($time)
        {
            echo "<h4 style='color:#ff4643'>Likęs laikas: " .$time." minutės!</h4>";
        }
	}

?>