<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Delete 'STOCK ITEM' in 'STOCK' table (update markForDeletion field)
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>
<div class="main">
    <h1>delete stock item</h1>
<?php
$sql = "UPDATE Stock SET markForDeletion = '1'
		WHERE stockID = '$_POST[stockID]'";

if (!mysqli_query($con,$sql)){
    die("<p class='result'>An error in the SQL Query (delete stock item): </p>" . mysql_error() . "<br><br> <form action = 'amendStock.html.php' method = 'POST' >
	<div id=divider></div><input type = 'submit' value = 'Return'/></form>");
}
echo "<br><br><p class='result'>The following stock item was removed:<br><br><b>" . $_POST['description']. " </b></p>";

mysqli_close($con);

?>
<form action = "deleteStock.html.php" method = "POST" >
	<div id=divider></div>
	<input type = "button" class="amend" value = "View Stock" onClick="location.href='deleteStock.html.php'"/>
</form>
</div>
