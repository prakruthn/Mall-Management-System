<?php
	session_start();
?>

<html>
	<head>
		<title>Stocks Manager</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<link rel="stylesheet" href="./homePage.css">
  		<link rel="stylesheet" href="./stocksPage.css">
	</head>
	<body>
		<div class="jumbotron text-center">
			<h1>Our Mall</h1>
  			<p>Get everything u want</p>
		</div>
		
		<div class="container">
  			<div class="page-header">
    			<h1>Stocks Manager</h1>
    			
					<a href="adminPage.php"><button type="button" class="btn btn-default">Admin Page</button></a>	
				      
  			</div>
			
  			<ul class="nav nav-tabs">
    			<li class="active"><a data-toggle="tab" href="#home">Stocks</a></li>
    			<li><a data-toggle="tab" href="#menu1">Add/Remove Stock</a></li>
    			<li><a data-toggle="tab" href="#menu2">Refill Stocks</a></li>
    			<li><a data-toggle="tab" href="#menu3">Check stocks</a></li>
    			<li><a data-toggle="tab" href="#menu4">Update/Change</a></li>
  			</ul>
		
  			<div class="tab-content">
    			<div id="home" class="tab-pane fade in active">
      				<div class="page-header">
    					<h3>Stocks Manager</h3>      
  					</div>
  					
  					<div>
  						<?php
  						
  							if(isset($_SESSION['succItemAdd'])){
								if($_SESSION['succItemAdd']){
									echo"
										<div class=\"alert alert-success\"><strong>{$_SESSION['itemID']}</strong> added succesfully</div>
									";	
								}
								else{
									if(isset($_SESSION['itemID'])){
										echo"
											<div class=\"alert alert-warning\"><h3><strong>{$_SESSION['itemID']} addition failed</strong></h3><br>
												<p> {$_SESSION['reason']}</p>
											
											</div>
										";
									}
								}
							}
							
							if(isset($_SESSION['succItemRmv'])){
								if($_SESSION['succItemRmv']){
									echo"
										<div class=\"alert alert-danger\"><strong>{$_SESSION['itemID']}</strong> removed succesfully</div>
										
									";	
								}
								elseif(!$_SESSION['succItemRmv']){
									//if(isset($_SESSION['itemID'])){
										echo"
											<div class=\"alert alert-warning\"><strong></strong> deletion failed<br>
											{$_SESSION['reason']}
											</div>
											
										";
									//}	
								}
								else{
									echo "{$_SESSION['aff']}";
								}
							}
							else{
								
							}
							if(isset($_SESSION['succItemUpd'])){
								if($_SESSION['succItemUpd']){
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['itemID']}</strong> quantity Updated</div>
									";
								}
							}
							if(isset($_SESSION['succItemChg'])){
								if($_SESSION['succItemChg']){
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['itemID']}</strong> Updated</div>
									";
								}
							}
  						?>
  						
  					</div>
  					<div>
  						<?php
        						include 'mysql-init.php';
								
								$sql = "SELECT I.itemId, S.storeName, C.categoryName, I.itemName, I.color, I.size, I.price, I.quantity from itemslist I, storelist S, categorylist C where I.storeId=S.storeId and I.categoryId=C.categoryId order by(itemId)";
								$result = mysqli_query($conn, $sql);
								$i = 0;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$itemId[$i] = $row['itemId'];
 									   	$storeName[$i] = $row['storeName'];
										$categoryName[$i] = $row['categoryName'];
										$itemName[$i] = $row['itemName'];
										$color[$i] = $row['color'];
										$size[$i] = $row['size'];
										$price[$i] = $row['price'];
										$quantity[$i] = $row['quantity'];
										
										$i = $i + 1;
							 		}
								}
								echo " 
										
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>ID</th>
									        <th>Store Name</th>
									        <th>Category Name</th>
									        <th>Item Name</th>
									        <th>Color</th>
									        <th>Size</th>
									        <th>Rate</th>
									        <th>In Stock</th>
									      </tr>
									    </thead>
									    <tbody>";
										
										$j = 0;
								while($j != $i){
									
									$temp1 = $itemId[$j];
									$temp2 = $storeName[$j];
									$temp3 = $categoryName[$j];
									$temp4 = $itemName[$j];
									$temp5 = $color[$j];
									$temp6 = $size[$j];
									$temp7 = $price[$j];
									$temp8 = $quantity[$j];
									
									$j++;
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp2}</td>
									        <td>{$temp3}</td>
									        <td>{$temp4}</td>
									        <td>{$temp5}</td>
									        <td>{$temp6}</td>
									        <td>{$temp7}</td>
									        <td>{$temp8}</td>
									       
									     </tr>
									";
								}
									      
								echo "
									  </tbody>
									  </table>
								";
							?>
  					</div>
    			</div>
    			<div id="menu1" class="tab-pane fade">	
      				<div class="page-header">
    					<h3>Add/Remove</h3>
  					</div>
  					<div class="panel-group" id="accordion">
    					<div class="panel panel-default">
      		 				<div class="panel-heading">
        						<h4 class="panel-title">
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Add Stock</a>
        						</h4>
      						</div>		
      			 			<div id="collapse1" class="panel-collapse collapse">
        						<div class="panel-body">
        							<form action="addItemProcess.php" method="post">
        								<div class="input-group">
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="addId" placeholder="Item Id">
    									</div><br>
    									<div class="form-group">
    										
    										<label for="catId">Category:</label>
    										<select name = "catId" class="btn btn-default dropdown-toggle">
    											<option value="101">Fabric</option>
    											<option value="102">Footwear</option>
    											<option value="103">Electronic</option>
    											<option value="104">HomeStore</option>
    											<option value="105">Cosmetics</option>
    										</select>
    										
    										<label for="storeId">StoreId:</label>
    										<select name = "storeId" class="btn btn-default dropdown-toggle">
    											<option value="201">John Miller</option>
    											<option value="202">Aurelia</option>
    											<option value="203">Levi's</option>
    											<option value="204">Hush Pippies</option>
    											<option value="205">Carlton London</option>
    											<option value="206">Red Tape</option>
    											<option value="207">E-Zone</option>
    											<option value="208">Samsung Store</option>
    											<option value="209">Relience-Digital</option>
    											<option value="210">Home Zone</option>
    											<option value="211">Bigg Bazar</option>
    											<option value="212">Future Homes</option>
    											<option value="213">Baby Lips</option>
    											<option value="214">L-Oreal</option>
    											<option value="215">Maybelline</option>
    										</select>
  										</div>
  										<div class="input-group">
    										<span class="input-group-addon">Item Name</span>
    										<input id="msg" type="text" class="form-control" name="itemName" placeholder="Item Name">
    										
    										<span class="input-group-addon">Item Color</span>
    										<input id="msg" type="text" class="form-control" name="itemColor" placeholder="Item Color">
    									</div><br>
    									
    									<div class="input-group">
    										<span class="input-group-addon">Size</span>
    										<input id="msg" type="text" class="form-control" name="itemSize" placeholder="Size">
    										
    										<span class="input-group-addon">Rate</span>
    										<input id="msg" type="text" class="form-control" name="itemRate" placeholder="Price">
    										
    										<span class="input-group-addon">Quantity</span>
    										<input id="msg" type="text" class="form-control" name="quantity" placeholder="In nos.">
    									</div><br>
    									<input name="addItem" type="submit" value = "Add Item" class="btn btn-default">
        							</form>
      							</div>
    						</div>
    					</div>
    					<div class="panel panel-default">
      						<div class="panel-heading">
        						<h4 class="panel-title">
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Remove Stock</a>
        						</h4>
      						</div>
      						<div id="collapse2" class="panel-collapse collapse">
        						<div class="panel-body">
									<form method="post" action="addItemProcess.php">
										<div class="input-group">
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="rmvId" placeholder="Item Id">
    									</div><br>
    									<input name="rmvItem" type="submit" value = "Remove Item" class="btn btn-danger">
									</form>
								</div>
      						</div>
    					</div>
  					</div> 
    			</div>
    			<div id="menu2" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Refill</h3>      
  					</div>
  					
  					<div class="panel-body">
        				<form action="updateItemProcess.php" method="post">
        					<div class="form-group">
			    				<label for="itemId">Item Id</label>
    							<input type="msg" class="form-control" id="itemId" name = "itemId" placeholder="Item ID">
  							</div>		
  							<div class="form-group">
			    				<label for="itemQuantity">Update Quantity</label>
    							<input type="msg" class="form-control" id="itemQuantity" name = "updateQuan" placeholder="Update Quantity">
  							</div>  							
  							<input name="updateItem" type="submit" value = "Update" class="btn btn-default">        			
        				</form>
      				</div>
    			</div>
    			<div id="menu3" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Check Stocks</h3>      
  					</div>
  					<div class="panel-body">
        				<form action="" method="post">
        					<div class="form-group">
			    				<label for="itemId">Item Id</label>
    							<input type="msg" class="form-control" id="itemId" name = "itemId" placeholder="Item ID">
  							</div>		  							
  							<input name="checkStock" type="submit" value = "Check Stock" class = "btn btn-default">        			
        				</form>
        				
        				<?php
        					if(isset($_POST['checkStock'])){
								include 'mysql-init.php';	
								
								$id = $_POST['itemId'];
								
								$sql = "SELECT I.itemId, S.storeName, I.itemName, I.quantity from itemslist I, storelist S, categorylist C where I.storeId=S.storeId and I.categoryId=C.categoryId and I.itemId = ".$id." order by(itemId)";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$itemId = $row['itemId'];
 									   	$storeName = $row['storeName'];
										$itemName = $row['itemName'];
										$quantity = $row['quantity'];
							 		}
								}
								echo " 
										
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>ID</th>
									        <th>Store Name</th>
									        <th>Item Name</th>
									        <th>In Stock</th>
									      </tr>
									    </thead>
									    <tbody>";
																		
									$temp1 = $itemId;
									$temp2 = $storeName;
									$temp4 = $itemName;
									$temp8 = $quantity;
									
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp2}</td>
									        <td>{$temp4}</td>
									        <td>{$temp8}</td>
									       
									     </tr>
									";
								}
									      
								echo "
									  </tbody>
									  </table>
								";
        				?>
      				</div>
    			</div>
    			<div id="menu4" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Update/Change</h3>      
  					</div>
  					<div class="panel-body">
        				<form action="changeItemProcess.php" method="post">
        					<div class="form-group">
			    				<label for="itemId">Item Id</label>
    							<input type="msg" class="form-control" id="itemId" name = "itemId" placeholder="Item ID">
  							</div>
  							<div class="form-group">
			    				<label for="itemName">Item Name</label>
    							<input type="msg" class="form-control" id="itemName" name = "itemName" placeholder="Item Name" disabled>
    							<input type="checkbox" id = 'check1' onclick="myFunction('check1', 'itemName')">Update This<br>
  							</div>
  							<div class="form-group">
			    				<label for="color">Color</label>
    							<input type="msg" class="form-control" id="color" name = "color" placeholder="Item Color" disabled>
    							<input type="checkbox" id = 'check2' onclick="myFunction('check2', 'color')">Update This<br>
  							</div>
  							<div class="form-group">
			    				<label for="size">Size</label>
    							<input type="msg" class="form-control" id="size" name = "size" placeholder="Item Size" disabled>
    							<input type="checkbox" id = 'check3' onclick="myFunction('check3', 'size')">Update This<br>
  							</div>
  							<div class="form-group">
			    				<label for="price">Price</label>
    							<input type="msg" class="form-control" name="price" id = "price" placeholder="Item Price" disabled>
  								<input type="checkbox" id = 'check4' onclick="myFunction('check4', 'price')">Update This<br>    							
  							</div>
  							<script>
								function myFunction(check, comp){
									if (document.getElementById(check).checked == true){
										document.getElementById(comp).removeAttribute('disabled');
  									}
									else{
  										document.getElementById(comp).setAttribute('disabled','disabled');
  									}
								}
							</script>
  							<input name="updateItem" type="submit" value = "Update" class="btn btn-default">        			
        				</form>
      				</div>
    			</div>
  			</div>
		</div>	
		<footer>
			
		</footer>
	</body>
</html>
<?php
	session_unset();
	session_destroy();
?>
