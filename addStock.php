<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Adds new 'STOCK ITEM' to 'STOCK' table
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>
<div class="main">
    <h1>add stock item</h1>
<?php
include 'garagedb.inc.php';
date_default_timezone_set("UTC");
$markForDeletion = 0; //set mark for deletion to 0
$quantityInStock = 0; //set quantity in stock to 0

$sql = "Insert into Stock (stockID, supplierID, description, reOrderLevel, reOrderQty, costPrice, retailPrice, quantityInStock, markForDeletion)
VALUES ( '$_POST[stockID]', '$_POST[supplierID]','$_POST[description]','$_POST[reOrderLevel]','$_POST[reOrderQty]','$_POST[costPr]','$_POST[retailPr]','$quantityInStock','$markForDeletion')";

if (!mysqli_query($con,$sql)){
    die("<p class='result'>An error in the SQL Query : </p>" . mysql_error() . "<br><br> <form action = 'addStock.html.php' method = 'POST' >
	<div id=divider></div><input type = 'submit' value = 'Return'/></form>");
}
echo "<br><br><p class='result'>A new record has been added for stock item :<br><br><b>" . $_POST['description']. " </b></p>";

mysqli_close($con);

?>
<form action = "addStock.html.php" method = "POST" >
	<div id=divider></div>
     <input type = "button" class="amend" value = "Add Stock" onClick="location.href='addStock.html.php'"/>
</form>
</div>
