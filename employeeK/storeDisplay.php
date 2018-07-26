<?php
	session_start();
?>

<html>
	<head>
		<title>Store Manager</title>
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
    			<h1>Store Manager</h1>
    			
					<a href="adminPage.php"><button type="button" class="btn btn-default">Admin Page</button></a>	
				      
  			</div>
			
  			<ul class="nav nav-tabs">
    			<li class="active"><a data-toggle="tab" href="#home">Stores</a></li>
    			<li><a data-toggle="tab" href="#menu1">Add/Remove Store</a></li>
    			<li><a data-toggle="tab" href="#menu2">Renew Lease(stored Procedure)</a></li>
    			<!--<li><a data-toggle="tab" href="#menu3" hidden>Update/Change</a></li>-->
  			</ul>
		
  			<div class="tab-content">
    			<div id="home" class="tab-pane fade in active">
      				<div class="page-header">
    					<h3>Store Manager</h3>      
  					</div>
  					
  					<div>
  						<?php
  						
  							if(isset($_SESSION['succStoreAdd'])){
								if($_SESSION['succStoreAdd']){
									echo"
										<div class=\"alert alert-success\"><strong>{$_SESSION['storeID']}</strong> added succesfully</div>
									";	
								}
								else{
									if(isset($_SESSION['storeID'])){
										echo"
											<div class=\"alert alert-warning\"><h3><strong>{$_SESSION['storeID']} addition failed</strong></h3><br>
												<p> {$_SESSION['reason']}</p>
											
											</div>
										";
									}
								}
							}
							
							if(isset($_SESSION['succStoreRmv'])){
								if($_SESSION['succStoreRmv']){
									echo"
										<div class=\"alert alert-danger\"><strong>{$_SESSION['storeID']}</strong> removed succesfully</div>
										
									";	
								}
								elseif(!$_SESSION['succStoreRmv']){
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
							if(isset($_SESSION['succStoreUpd'])){
								if($_SESSION['succStoreUpd']){
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['storeID']}</strong> Lease Renewed</div>
									";
								}
								else{
									echo"
										<div class=\"alert alert-warning\"><strong></strong> Lease Renew Failed {$_SESSION['aa']}</div>
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
								
								$sql = "select S.storeId, C.categoryName, S.storeName, S.floor, S.leaseStart from storelist S, categorylist C where S.categoryId=C.categoryId order by(storeId)";
								$result = mysqli_query($conn, $sql);
								$i = 0;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$storeId[$i] = $row['storeId'];
										$categoryName[$i] = $row['categoryName'];
 									   	$storeName[$i] = $row['storeName'];
										$floor[$i] = $row['floor'];
										$leaseStart[$i] = $row['leaseStart'];
										
										$i = $i + 1;
							 		}
								}
								echo " 
										
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>ID</th>
									        <th>Category Name</th>
									        <th>Store Name</th>
									        <th>Floor Name</th>
									        <th>Lease End Date(yyyy-mm-dd)</th>
									      </tr>
									    </thead>
									    <tbody>";
										
										$j = 0;
								while($j != $i){
									
									$temp1 = $storeId[$j];
									$temp2 = $storeName[$j];
									$temp3 = $categoryName[$j];
									$temp4 = $floor[$j];
									$temp5 = $leaseStart[$j];

									$j++;
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp3}</td>
									        <td>{$temp2}</td>
									        <td>{$temp4}</td>
									        <td>{$temp5}</td>									       
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
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Add New Store</a>
        						</h4>
      						</div>		
      			 			<div id="collapse1" class="panel-collapse collapse">
        						<div class="panel-body">
  									<strong>Ensure Employee is added before Promoting to manager</strong>
        							<!--<form action="./../addStoreProcess.php" method="POST">-->
        							<form method="post" action="addStoreProcess.php">
        								<div class="input-group">
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="storeId" placeholder="Store Id">
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
    										
    										<label for="catId">Floor:</label>
    										<select name = "floor" class="btn btn-default dropdown-toggle">
    											<option value="1">1st Floor</option>
    											<option value="2">2nd Floor</option>
    											<option value="3">3rd Floor</option>
    											<option value="4">4th Floor</option>
    										</select>
    										
  										</div>
  										<div class="input-group">
    										<span class="input-group-addon">Store Name</span>
    										<input id="msg" type="text" class="form-control" name="storeName" placeholder="Store Name">
    								</div><br>
    									<div class="input-group">
    										<span class="input-group-addon">Emp Id</span>
    										<input id="msg" type="text" class="form-control" name="empId" placeholder="EmployeeID">
    										
    										<span class="input-group-addon">Manager Id</span>
    										<input id="msg" type="text" class="form-control" name="mgrId" placeholder="EmployeeID">
    										
    										<span class="input-group-addon">Manager Name</span>
    										<input id="msg" type="text" class="form-control" name="mgrName" placeholder="Manager Name">
    									</div><br>
    									<div class="form-group">
              								<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              								<input type="password" class="form-control" id="psw" placeholder="Enter password" name = "mgrPasswd">
            							</div>
    									<!--<input name="addStore" type="submit" value = "Add Store" class="btn btn-default">-->
    									<input name="addStore" type="submit" value = "Add Store" class="btn btn-default">
        							</form>
      							</div>
    						</div>
    					</div>
    					<div class="panel panel-default">
      						<div class="panel-heading">
        						<h4 class="panel-title">
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Remove Store</a>
        						</h4>
      						</div>
      						<div id="collapse2" class="panel-collapse collapse">
        						<div class="panel-body">
									<form method="post" action="addStoreProcess.php">
										<div class="input-group">
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="rmvId" placeholder="Item Id">
    									</div><br>
    									<input name="rmvStore" type="submit" value = "Remove Store" class="btn btn-danger">
									</form>
								</div>
      						</div>
    					</div>
  					</div> 
    			</div>
    			<div id="menu2" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Renew Lease</h3>      
  					</div>
  					
  					<div class="panel-body">
        				<form action="updateStoreProcess.php" method="post">
        					<div class="form-group">
			    				<label for="storeId">Store Id</label>
    							<input type="msg" class="form-control" id="storeId" name = "storeId" placeholder="Store ID">
  							</div>		
  							
  							<input name="updateStore" type="submit" value = "Renew" class="btn btn-default">        			
        				</form>
      				</div>
    			</div>
    			<div id="menu3" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Update/Change(not working)</h3>      
  					</div>
  					<div class="panel-body">
        				<form action="changeStoreProcess.php" method="post">
        					<div class="form-group">
			    				<label for="storeId">Store Id</label>
    							<input type="msg" class="form-control" id="storeId" name = "storeId" placeholder="Store ID">
  							</div>
  							<div class="form-group">
			    				<label for="storeName">Store Name</label>
    							<input type="msg" class="form-control" id="storeName" name = "storeName" placeholder="Store Name" disabled>
    							<input type="checkbox" id = 'check1' onclick="myFunction('check1', 'storeName')">Update This<br>
  							</div>
  							<div class="form-group">
			    				<label for="catId">Floor(check for disabel):</label>
    							<select name = "floor" class="btn btn-default dropdown-toggle">
    								<option value="1">1st Floor</option>
    								<option value="2">2nd Floor</option>
    								<option value="3">3rd Floor</option>
    								<option value="4">4th Floor</option>
    							</select>
    							<input type="checkbox" id = 'check2' onclick="myFunction('check2', 'floor')">Update This<br>
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
  							<input name="updateStore" type="submit" value = "Update" class="btn btn-default">        			
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
