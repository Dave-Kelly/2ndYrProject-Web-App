<?php
//C2P Project, Part 2: Garage System
//David Kelly C00193216
//Date: 26/02/2016
//Deletes Stock Item from Stock table (update mark for deletion field)
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
	document.getElementById("supplierName").value = stockDetails[7];
	}
function confirmCheck(){
	var response;
	response = confirm('Are you sure you want to permanently delete this item of stock ?');
	if(response){	
		document.getElementById("stockID").disabled = false;
		document.getElementById("description").disabled = false;
		return true;
	}
	else{
		populate();
		return false;
	}
}
</script>
<div class="main">
	<h1>Delete a Stock Item</h1>
	<p class="result">Delete stock that is not on order or out of stock.</p>
		<form id=deleteStock action="deleteStock.php" onsubmit="return confirmCheck()" method="POST">
			<label class="align">Select Stock Item :</label><?php include 'stockDeleteList.php'; ?>
			<p class="space"><label for="stockId">Stock ID :</label><input style="background-image:url(img/icons/User.png);" class="inputFieldK" name = "stockID" id = "stockID" disabled  /></p>
			
			<p class="space"><label for="description">Stock Description :</label><input  style="background-image:url(img/icons/ID.png)" class="inputFieldK" type="text" name="description" id="description" placeholder="Item Description" title="Alpha/numerical values only! The use of special characters in 'Stock Description' is not permitted." disabled pattern="[a-zA-Z0-9 _]+"/></p>
			
			<p class="space"><label for="supplierName">Supplier Name :</label><input  style="background-image:url(img/icons/ID.png)" class="inputFieldK" type="text" name="supplierName" id="supplierName" placeholder="Supplier Name" disabled  /></p>
			
			<div id = "divider"></div>
			<input type="submit" value="Delete" name ="submit" />
			<input type="reset" value="Cancel" name ="reset" />
		</form>
</div>

