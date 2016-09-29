<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Retrieves all relevant stock suppliers from Supplier Table
include "garagedb.inc.php";//database connection

$sql = "SELECT supplierID, name, address FROM `Supplier` WHERE markForDeletion != 1";

if(!$result = mysqli_query($con, $sql)){
    die('Error in querying the database' . mysqli_error($con));
}
//result of sql statement echo out in html select element
echo "<select style='background-image:url(img/icons/ID.png)' class='selectDK' name = 'listbox' id = 'listbox' onclick = 'populate()'>";

while($row = mysqli_fetch_array($result)){
    $id = $row['supplierID'];
    $name = $row['name'];
    $address = $row['address'];
    $allText = "$id&$name&$address";
	//display supplier name followed by address in select element
    echo "<option value = '$allText'>$name : $address</option>";
}
echo "</select>";
mysqli_close($con);

?>