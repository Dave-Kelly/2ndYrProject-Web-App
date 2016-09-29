<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Amends'STOCK ITEM' in 'STOCK' table
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>
<div class="main">
    <h1>amend stock item</h1>
<?php
$sql = "UPDATE Stock SET description = '$_POST[description]', 
		reOrderLevel = '$_POST[reOrderLevel]', 
		reOrderQty = '$_POST[reOrderQty]', 
		costPrice = '$_POST[costPrice]', 
		retailPrice = '$_POST[retailPrice]', 
		quantityInStock = '$_POST[quantityInStock]'
		WHERE stockID = '$_POST[stockID]'";

if (!mysqli_query($con,$sql)){
    die("<p class='result'>An error in the SQL Query : </p>" . mysql_error() . "<br><br> <form action = 'amendStock.html.php' method = 'POST' >
	<div id=divider></div><input type = 'submit' value = 'Return'/></form>");
}
echo "<br><br><p class='result'>The following stock item was updated:<br><br><b>" . $_POST['description']. " </b></p>";

mysqli_close($con);

?>
<form action = "amendStock.html.php" method = "POST" >
	<div id=divider></div>
    <input type = "button" class="amend" value = "View Stock" onClick="location.href='amendStock.html.php'"/>
</form>
</div>
