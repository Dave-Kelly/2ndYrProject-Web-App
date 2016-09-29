<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/03/2016
//Adds new 'BOOKING' to 'Bookings' table
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>
<div class="main">
    <h1>add booking</h1>
<?php
include 'garagedb.inc.php';
date_default_timezone_set("UTC");
$markForDeletion = 0;

$sql = "Insert into Bookings (bookingID, customerID, date, time, markForDeletion)
VALUES ( '$_POST[bookingID]', '$_POST[customerID]','$_POST[formDate]','$_POST[timeList]','$markForDeletion')";

if (!mysqli_query($con,$sql)){
    die("<p class='result'>An error in the SQL Query : </p>" . mysql_error() . "<br><br> <form action = 'bookings.php' method = 'POST' >
	<div id=divider></div><input type = 'submit' value = 'Return'/></form>");
}
echo "<br><br><p class='result'>A new record has been added for booking ID :<br><br><b>" . $_POST['bookingID']. " </b></p>";

mysqli_close($con);

?>
<form action = "bookings.php" method = "POST" > <!--On submit return to add booking screen-->
<div id=divider></div>
    <input type = "button" class="amend" value = "Bookings" onClick="location.href='bookings.php'"/>
</form>  
</div>
