<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Retrieves all relevant stock items from Stock table, echo out in form of html select element
include "garagedb.inc.php";//database connection

$sql = "SELECT * FROM Stock INNER JOIN Supplier
		ON Stock.supplierId = Supplier.supplierID 
		WHERE Stock.markForDeletion != 1";

if(!$result = mysqli_query($con, $sql)){
    die('Error in querying the database (stock table)' . mysqli_error($con));
}
echo "<select style='background-image:url(img/icons/ID.png)' class='selectDK' name = 'stocklist' id = 'stocklist' onclick = 'populate()';>";

while($row = mysqli_fetch_array($result)){
    $id = $row['stockID'];
    $desc = $row['description'];
	$quantityInStock = $row['quantityInStock'];
	$retailPrice = $row['retailPrice'];
	$costPrice = $row['costPrice'];
    $reorderLvl = $row['reOrderLevel'];
	$reorderQty = $row['reOrderQty'];
	$supplier = $row['name'];
	
    $allText = "$id&$desc&$quantityInStock&$retailPrice&$costPrice&$reorderLvl&$reorderQty&$supplier";

    echo "<option value = '$allText'>$desc : $supplier</option>";
}
echo "</select>";
mysqli_close($con);

?>