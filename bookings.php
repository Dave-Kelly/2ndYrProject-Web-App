<!--
Name: David Kelly C00193216
Date: 02/03/2016
Display bookings report based on selected date, allow user to enter add booking information for input into booking table
-->
<?php  
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
date_default_timezone_set('UTC');
$_SESSION['date'] = date("Y/m/d");
?>
<script>
function searchTime() { //search bookings table for selected time
    var cells = document.getElementsByTagName("td"); //collection of all td elements to search
	var search = document.getElementById('timeList').selectedOptions[0].value; //the search time - selected index of time list
    var i;
	var select = document.getElementById('timeList').selectedIndex;
  	if (select != 0){
  		for (i = 0; i < cells.length; i++) {
			if(cells[i].innerHTML.match(search)){ //if the value of a td element matches that of the selected time
				alert("A booking exists for the selected time, choose a different time to continue.");
				break; //stop the search, break from code block
			}
		}  
  	}
  	else{ //if user attempts to submit without choosing a time
  		alert("You have to choose a valid time!");
  	}
}
    
function dateOrder(){
	document.reportForm.choice.value = "New";
	document.reportForm.submit();
}
function populate(){
	var sel = document.getElementById("customerList");
	var result;
	result = sel.options[sel.selectedIndex].value;
	var customerDetails = result.split('&');
	document.getElementById("customerID").value = customerDetails[0];
	newID();
	getDate();
	}
function confirmCheck(){
	var response;
	response = confirm('Are you sure you want to save these changes?');
	if(response){
		return true;
	}
	else{
		populate();
		return false;
	}
}
function newID(){ //retrieves the highest id from booking table - add 1 to it for use as new booking id
	document.getElementById("bookingID").value ="<?php $sql = "SELECT MAX(bookingID) as lastID FROM Bookings" ;	
		if(!$result = mysqli_query($con,$sql)){
			die('Error in querying the database(@ bookingID)' . mysqli_error($con));
		} 
		$row = mysqli_fetch_assoc($result);
		$maxID = $row['lastID'];
		$_SESSION['bookingID'] = $maxID + 1; 
		echo $_SESSION['bookingID']?>"
	return true;
	
}function getDate(){ //get the selected date from view bookings datepicker and input to add booking form: date 
	document.getElementById("formDate").value ="<?php session_start(); echo $_SESSION['date'];?>"
	return true;
}
</script>
<div class="main"> <!-- Main content-->
	<h1>add a booking</h1>
<!--FORM: select date to display report on bookings by day-->
<form action = "bookings.php" method = "Post" name = "reportForm">
<input type = "hidden" name = "choice">
	<label class="align" for=bookingDate>View Booking by Date :</label><input style="background-image:url(img/icons/date.png)"  class="inputFieldK" type=date name=bookingDate id=bookingDate onchange = "dateOrder()"/>
</form>

<?php
session_start();
$choice = "todayOrder"; //In case this is the first time through and $_POST[choice] hasn't been set
if (ISSET($_POST['choice'])){
	$choice = $_POST['choice'];
}
if ($choice == "New"){ //if date other than today's date is selected
	
	//$_SESSION['date'] = date("Y/m/d", strtotime($_POST['bookingDate'])); 
	$dbDate = date("Y/m/d", strtotime($_POST['bookingDate']));//to match db date format
	$_SESSION['date'] = $dbDate; //override session variable with new date
	$sql = "SELECT * FROM Bookings INNER JOIN Customers ON Bookings.customerID = Customers.customerID
		WHERE date = '$dbDate' ORDER BY time";
	produceReport($con,$sql);
}
else{ //if choice is equal to "todayOrder" / default display - first time through
	
		$today = date("Y/m/d");
		$sql = "SELECT name, time FROM Bookings INNER JOIN Customers ON Bookings.customerID = Customers.customerID
		WHERE Bookings.markForDeletion!=1
		AND date = '$today'
		ORDER BY time";
		produceReport($con,$sql);
		
		if(!$result = mysqli_query($con, $sql)){
			die('Error in querying the database (booking table)' . mysqli_error($con));
		}
}
function produceReport($con,$sql){ //build the table to display bookings for selected date
	$result = mysqli_query($con, $sql);
	
	echo "<div class='container'><table class='bookingTB'>
	<thead><tr><th class='bookingTH'>TIME</th><th class='bookingTH'>NAME</th></tr></thead>
	<tbody>";
	
	while($row = mysqli_fetch_array($result)){		
		echo "<tr>
		<td class='bookingTD'>".$row['time']."</td>
		<td class='bookingTD' name = name>".$row['name']."</td>
		</tr>";
	}
	echo "</tbody></table></div>";
}
mysqli_close($con);
?>
<!--FORM-->
<form action="addBooking.php" onsubmit="return confirmCheck()" method="POST">

	<label class="align" for="bookingID">Booking ID :</label><input  style="background-image:url(img/icons/User.png);background-color : #c4c4c4;" class="inputFieldK"   type="text" name="bookingID" id="bookingID"  readonly />
		
	<p class="space"><label class="align" for="customerID">Customer ID :</label><input  style="background-image:url(img/icons/User.png);background-color : #c4c4c4;" class="inputFieldK"  type="text" name="customerID" id="customerID" required readonly /></p>

	<p class="space"><label class="align">Select Customer :</label><?php include 'bookingCustomerList.php'; ?></p>

	<label class="align">Date :</label><input style="background-image:url(img/icons/date.png)" class="inputFieldK"  type=text name=formDate id=formDate /></p>

	<p class="space"><label class="align">Time :</label><?php include 'timeList.php'; ?></p>
	
	<div id=divider></div>
			<input type="submit" value="Submit" name ="submit" />
			<input type="reset" value="Clear" name ="reset" />
</form>


</div>

