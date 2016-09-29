<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Retrieves all relevant customer id/name/address from Customers table
include "garagedb.inc.php";//database connection

$sql = "SELECT customerID, name, address FROM Customers WHERE markForDeletion != 1";

if(!$result = mysqli_query($con, $sql)){
    die('Error in querying the database (@customer table)' . mysqli_error($con));
}//html select 
echo "<select style='background-image:url(img/icons/ID.png)' class='selectDK' name = 'customerList' id = 'customerList' onclick = 'populate()';>";

while($row = mysqli_fetch_array($result)){ //populate the html select with sql query result
    $id = $row['customerID'];
    $name = $row['name'];
	$address = $row['address'];

    $allText = "$id&$name&$address";

    echo "<option value = '$allText'>$name : $address</option>"; //display customer name and address in html select
}
echo "</select>";
mysqli_close($con);

?>