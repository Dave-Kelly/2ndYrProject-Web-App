<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Adds new 'STOCK ITEM' to 'STOCK' table
session_start();
include 'garagedb.inc.php';//Connect to DB
include 'home.html.php'; //Include layout & menu
?>

<script>
function populate(){
	var sel = document.getElementById("listbox");
	var result;
	result = sel.options[sel.selectedIndex].value;
	var supplierDetails = result.split('&');
	document.getElementById("supplierID").value = supplierDetails[0];
	//document.getElementById("supplierName").value = supplierDetails[1];
	//document.getElementById("supplierAddress").value = supplierDetails[2];
	}
function confirmCheck(){
	var response;
	response = confirm('Are you sure you want to save these changes?');
	if(response){
		document.getElementById("description").disabled = false;
		document.getElementById("quantityInStock").disabled = false;
		document.getElementById("retailPrice").disabled = false;
		document.getElementById("costPrice").disabled = false;
		document.getElementById("reOrderLevel").disabled = false;
		document.getElementById("reOrderQty").disabled = false;
		return true;
	}
	else{
		populate();
		return false;
	}
}
function newID(){ //select highest id value from stock table - add 1 for use as new id
	document.getElementById("stockID").value ="<?php $sql = "SELECT MAX(stockID) as lastID FROM Stock" ;	
		if(!$result = mysqli_query($con,$sql)){
			die('Error in querying the database' . mysqli_error($con));
		} 
		$row = mysqli_fetch_assoc($result);
		$maxID = $row['lastID'];
		$_SESSION['stockID'] = $maxID + 1; 
		echo $_SESSION['stockID']?>"
	return true;
}

</script>
<div class="main">
	<h1>add stock item</h1>
		<form id=addStock action="addStock.php" onsubmit="return confirmCheck()" method="POST">
			<label for="stockID">Stock ID :</label><input style="background-image:url(img/icons/User.png);background-color : #c4c4c4;" class="inputFieldK" type="text" name="stockID" id="stockID"  readonly />
			<p class="space"><label for="description">Stock Description :</label><input  style="background-image:url(img/icons/ID.png)" class="inputFieldK" type="text" name="description" id="description" placeholder="Item Description" title="Alpha/numerical values only! The use of special characters in 'Stock Description' is not permitted." autocomplete=off required onchange="return newID()" pattern="[a-zA-Z0-9 _]+"/></p>
			<p class="space"><label class="align" for="retailPrice">Retail Price :</label><input style="background-image:url(img/icons/tag.png);" class="inputFieldK" type="number" step="any" min="0" name="retailPr" id="retailPr" placeholder="Retail Price (&euro;)" title="Enter the retail price. Numerical value only." autocomplete=off value = 0 /></p>
			<p class="space"><label class="align" for="costPrice">Cost Price :</label><input style="background-image:url(img/icons/tag.png);" class="inputFieldK" type="number" step="any" min="0" name="costPr" id="costPr" placeholder="Cost Price (&euro;)" title="Enter the cost (purchase) price. Numerical value only." autocomplete=off value = 0 /></p>
			<p class="space"><label class="align" for="reOrderLevel">Reorder Level :</label><input style="background-image:url(img/icons/lvl.png)" class="inputFieldK" type="number" min="0" name="reOrderLevel" id="reOrderLevel" placeholder="Reorder Level" title="Enter minimum quantity in stock level at which a new order should be initiated. Numerical value only." autocomplete=off value = 0 /></p>
			<p class="space"><label class="align" for="reOrderQty">Reorder Quantity :</label><input style="background-image:url(img/icons/lvl.png)" class="inputFieldK" min="0" type="number" name="reOrderQty" id="reOrderQty" placeholder="Reorder Quantity" title="Enter the recommended reorder quantity. Numerical value only." autocomplete=off value = 0 /></p>
			<p class="space"><label class="align">Select Supplier :</label><?php include 'stockSupplierList.php'; ?></p>
			<p class="space"><label class="align" for="supplierID">Supplier ID :</label><input style="background-image:url(img/icons/User.png);background-color : #c4c4c4;" class="inputFieldK" type="text" name="supplierID" id="supplierID" readonly /></p>
			<div id=divider></div>
			<input type="submit" value="Submit" name ="submit" />
			<input type="reset" value="Clear" name ="reset" />
		</form>
</div>

