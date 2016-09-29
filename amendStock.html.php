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
function populate(){ //when called populates the input fields by splitting the result of an SQL query
	var sel = document.getElementById("stocklist");
	var result;
	result = sel.options[sel.selectedIndex].value;
	var stockDetails = result.split('&'); //splits the concatinated result of the sql query by '&' symbol
	document.getElementById("stockID").value = stockDetails[0];
	document.getElementById("description").value = stockDetails[1];
	document.getElementById("quantityInStock").value = stockDetails[2];
	document.getElementById("retailPrice").value = stockDetails[3];
	document.getElementById("costPrice").value = stockDetails[4];
	document.getElementById("reOrderLevel").value = stockDetails[5];
	document.getElementById("reOrderQty").value = stockDetails[6];
	document.getElementById("supplierName").value = stockDetails[7];
	if(document.getElementById("amendViewButton").value != "Amend Details"){
		toggleLock();
	}
	
	}
function toggleLock(){ //when called toggles the disabled/enabled state of the input fields
	if(document.getElementById("amendViewButton").value == "Amend Details"){
		document.getElementById("description").disabled = false;
		document.getElementById("quantityInStock").disabled = false;
		document.getElementById("retailPrice").disabled = false;
		document.getElementById("costPrice").disabled = false;
		document.getElementById("reOrderLevel").disabled = false;
		document.getElementById("reOrderQty").disabled = false;
		document.getElementById("amendViewButton").value = "View Details";
		document.getElementById("description").focus(); //focus cursor to first editable stock input field
	}
	else{
		document.getElementById("description").disabled = true;
		document.getElementById("quantityInStock").disabled = true;
		document.getElementById("retailPrice").disabled = true;
		document.getElementById("costPrice").disabled = true;
		document.getElementById("reOrderLevel").disabled = true;
		document.getElementById("reOrderQty").disabled = true;
		document.getElementById("amendViewButton").value = "Amend Details";
	}
}
function confirmCheck(){ //when called prompts user with yes/no alert box
	var response;
	response = confirm('Are you sure you want to save these changes?');
	if(response){	
		document.getElementById("stockID").disabled = false;
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
		toggleLock();
		return false;
	}
}
</script>
<div class="main">
	<h1>Amend/View a Stock Item</h1>
		<form id=amendStock action="amendStock.php" onsubmit="return confirmCheck()" method="POST">
		
			<label class="align">Select Stock Item :</label><?php include 'stockList.php'; ?> <!-- A select list of all stock with corresponding supplier names-->
			
			<p class="space"><label for="stockId">Stock ID :</label><input style="background-image:url(img/icons/User.png);" class="inputFieldK" name = "stockID" id = "stockID" disabled  /></p>
			
			<p class="space"><label for="description">Stock Description :</label><input  style="background-image:url(img/icons/ID.png)" class="inputFieldK" type="text" name="description" id="description" placeholder="Item Description" title="Alpha/numerical values only! The use of special characters in 'Stock Description' is not permitted." disabled pattern="[a-zA-Z0-9 _]+"/></p>
			
			<p class="space"><label class="align" for="quantityInStock">Quantity. in Stock :</label><input style="background-image:url(img/icons/lvl.png)" class="inputFieldK" type="number" min="0" name="quantityInStock" id="quantityInStock" placeholder="Quantity in Stock" title="Enter the quantity that is currently in stock. Numerical value only." disabled  /></p>
			
			<p class="space"><label class="align" for="retailPrice">Retail Price :</label><input style="background-image:url(img/icons/tag.png);" class="inputFieldK" type="number" step="any" min="0" name="retailPrice" id="retailPrice" placeholder="Retail Price (&euro;)" title="Enter the retail price. Numerical value only." disabled /></p>
			
			<p class="space"><label class="align" for="costPrice">Cost Price :</label><input style="background-image:url(img/icons/tag.png);" class="inputFieldK" type="number" step="any" min="0" name="costPrice" id="costPrice" placeholder="Cost Price (&euro;)" title="Enter the cost (purchase) price. Numerical value only."  disabled /></p>
			
			<p class="space"><label class="align" for="reOrderLevel">Reorder Level :</label><input style="background-image:url(img/icons/lvl.png)" class="inputFieldK" type="number" min="0" name="reOrderLevel" id="reOrderLevel" placeholder="Reorder Level" title="Enter minimum quantity in stock level at which a new order should be initiated. Numerical value only." disabled /></p>
			
			<p class="space"><label class="align" for="reOrderQty">Reorder Quantity :</label><input style="background-image:url(img/icons/lvl.png)" class="inputFieldK" min="0" type="number" name="reOrderQty" id="reOrderQty" placeholder="Reorder Quantity" title="Enter the recommended reorder quantity. Numerical value only." disabled /></p>
			
			<p class="space"><label for="supplierName">Supplier Name :</label><input  style="background-image:url(img/icons/ID.png)" class="inputFieldK" type="text" name="supplierName" id="supplierName" placeholder="Supplier Name" disabled  /></p> <!--Supplier remains un-editable-->
			
			<div id = "divider"></div>
			<input type="submit" value="Save" name ="submit" /> 
			<input type = "button" value = "Amend" class="amend" id = "amendViewButton" onclick = "toggleLock()">
			<input type="reset" value="Clear" name ="reset" />
		</form>
</div>

