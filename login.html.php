<html>
<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Login Screen/Change Password
session_start();
include 'garagedb.inc.php';//Connect to DB
?>
<head>
<LINK REL=StyleSheet href="/css/myStyle.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet href="/css/loginStyle.css" TYPE="text/css" MEDIA=screen>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="styles.css">
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
</head>
<body style="background: url('/img/icons/bg_door.jpg') fixed no-repeat; background-size: cover;"><!--background image inlinle style-->
<div class="loginMain">
<h1>Login</h1>

<?php
//When username/password is set
if(isset($_POST['loginName']) && isset($_POST['password'])){
    $attempts = $_SESSION['attempts'];

    $sql = "SELECT * FROM Users WHERE login = '$_POST[loginName]' AND password = '$_POST[password]' AND markForDeletion = 0 ";

    if(!mysqli_query($con, $sql)){
        echo "Error in query to password/username (username and password select)" . mysqli_error($con);
    }
    else{
		//If not found, decrement attempts, rebuild login form
        if (mysqli_affected_rows($con) == 0){
            $attempts--;
            if($attempts > 0){
                $_SESSION['attempts'] = $attempts;
                echo"<p class='attempt'>No records found with this login name and password combination - Please try gain.</p>";
				buildPage($attempts);
            }
            else{
				//If all attempts used, build shutdown screen
                echo "<p class='attempt'>Sorry - You have used all attempts<br><br>Shutting down...</p>";
            }

        }
        else{
			//If username and password found, build login success screen
            $_SESSION['user'] = $_POST['loginName']; //Session variable to keep track of the login name
			$user = $_POST['loginName'];
			echo "<p class='login'><br>Login successful. Welcome to Garage Manager <i>'$user'</i>.
				<br><br>Do you want to change your password or continue using the system?</p><div id='divider'></div>
                <input style='width: 180px;'type = 'submit' value = 'Change Password' onclick = 'window.location = \"changePassword.php\"'>
				<input style='width: 180px;' type = 'reset' value = 'Main Menu' onclick = 'window.location = \"home.html.php\"'>";
        }
    }
}
else{
    //building page for initial display
	$attempts = 3; //Max attempts allowed is three
    $_SESSION['attempts'] = $attempts;//set session variables so that the number of attempts can be counted
    echo"<p class='result'>Welcome to Garage Manager. Login to start.</p>";
	buildPage($attempts); // parameter passed so that a heading can display the number of attempts
}
function buildPage($att){ //build login form
    echo"<h7>$att attempts remaining</h7>
         <form action = 'login.html.php' method = 'POST'>
		 <label for='loginName'>User ID :</label><input style='background-image:url(img/icons/User.png);' class='inputFieldK' type='text' name='loginName' id='loginName'/>
		 <p class='space'><label for='password'>Password :</label><input style='background-image:url(img/icons/lock.png);' class='inputFieldK' type = 'password' name = 'password' id = 'password'/></p>
		<div id='divider'></div>
		 <input type = 'submit' value = 'Submit'>
		 <input type='reset' value='Clear' name ='reset' />
		 </form>";
}
mysqli_close($con);
?>
</div>
</body>
</html>