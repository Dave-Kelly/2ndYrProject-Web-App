<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Change password
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>

<script>
	function confirmCheck(){ //function to first check passwords match then confirm with user
		var response;
		var pw1 = document.getElementById('pwd1').value; //first password input - get value
		var pw2 = document.getElementById('pwd2').value; //second password input - get value
		if(pw1 == pw2){ //if passwords match - continue to confirm check
			response = confirm('Are you sure you want to save these changes?');
			if(response){	
				document.getElementById("loginName").disabled = false;
				return true;
			}
			else{
				return false;
			}
		}
		else{
			alert("Passwords do not match");
			return false;
			
		}
	}
</script>
<div class="main">
<h1>Change Password</h1>

<?php
//if password is successfully set, do the sql statement
if(isset($_POST['loginName']) && isset($_POST['pwd1'])){

    $sql = "UPDATE Users Set password = '$_POST[pwd1]' WHERE login = '$_POST[loginName]'";

    if(!mysqli_query($con, $sql)){
        echo "Error in query to password/username" . mysqli_error($con);
    }
    else{//iff successfully updated - build Change Password: success screen
		$user = $_POST['loginName'];
		echo "<p class='result'><br><i>'$user'</i><br><br> Your password was successfully updated.";
        
    }
}
else{
    //building page for initial display
    echo"<p class='result'>Enter your new password.</p>";
	buildPage($_SESSION['user']); // parameter passed so that a heading can display the number of attempts
}
function buildPage($user){
    echo"
         <form action = 'changePassword.php' onsubmit='return confirmCheck()' method = 'POST' >
		 <label for='loginName'>User ID :</label><input style='background-image:url(img/icons/User.png);' class='inputFieldK' type='text' name='loginName' id='loginName' value='$user' disabled />
		 <p class='space'><label for='password'>Password :</label><input style='background-image:url(img/icons/lock.png);' class='inputFieldK' type = 'password' name = 'pwd1' id = 'pwd1' placeholder='Enter new password' title='Alpha/numerical values only! The use of special characters in Password is not permitted.' Description'pattern='[a-zA-Z0-9 _]+'/></p>
		 <p class='space'><label for='passwordCon'>Password :</label><input style='background-image:url(img/icons/lock.png);' class='inputFieldK' type = 'password' name = 'pwd2' id = 'pwd2' placeholder='Confirm new password' title='Confirm password by re-entering correctly' pattern='[a-zA-Z0-9 _]+'/></p>
		 <div id = 'divider'></div>
		 <input type = 'submit' value = 'Submit'>
		 <input type='reset' value='Clear' name ='reset' />
		 </form>";
}
mysqli_close($con);
?>

</div>

