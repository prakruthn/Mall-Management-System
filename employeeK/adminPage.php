<html>
	<head>
		<title>Adminstrator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="jumbotron text-center">
			<h1>Our Mall</h1>
  			<p>Get everything u want</p>
		</div>
		
		<div class="container">
			<a href="homePage.php"><button type="button" class="btn btn-default">Log Out</button></a>	
		</div>
		
		<div class="container">
  			<div class="page-header">
    			<h1>Adminstrator Page</h1>      
  			</div>     
  			<div class="panel-group" id="accordion">
    			<div class="panel panel-default">
      				<div class="panel-heading">
        				<h4 class="panel-title">
          					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Stock Manager</a>
        				</h4>
      				</div>
      				<div id="collapse1" class="panel-collapse collapse">
        				<div class="panel-body">
        					<?php
        						include 'mysql-init.php';
								$sql = "select COUNT(*) * 10 as total, sum(price) as totalPrice from itemslist";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
 									   	$totalStocks = $row['total'];
										$totalPrice = $row['totalPrice'];
							 		}
								}
								
								$sql = "select categoryName,COUNT(*) as catCount from itemslist I, categorylist C where I.categoryId = C.categoryId group by (I.categoryId)";
								$result = mysqli_query($conn, $sql);
								$i = 1;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$categoryName[$i] = $row['categoryName'];
 									   	$categoryStock[$i] = $row['catCount'];
										$i = $i + 1;
							 		}
								}
								echo " 
										Total stocks in store: <strong>{$totalStocks}</strong>
										<br>Stocks Value: <strong>₹{$totalPrice}</strong>
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>Category Name</th>
									        <th>Stocks(in Nos.)</th>
									      </tr>
									    </thead>
									    <tbody>";
										$i--;
								while($i != 0){
									
									$catName = $categoryName[$i];
									$catStocks = $categoryStock[$i];
									$i = $i - 1;
									echo "
										<tr>
									        <td>{$catName}</td>
									        <td>{$catStocks}</td>
									       
									     </tr>
									";
								}
									      
								echo "
									  </tbody>
									  </table>
								";
							?>
							<a href = "stocksDisplay.php"><button type="button" class="btn btn-primary btn-block">Complete Stocks Management</button></a>
        				</div>
      				</div>
    			</div>
    			<div class="panel panel-default">
      				<div class="panel-heading">
        				<h4 class="panel-title">
          					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Store Manager</a>
        				</h4>
      				</div>
      				<div id="collapse2" class="panel-collapse collapse">
        				<div class="panel-body">
        					<?php
        						include 'mysql-init.php';
								$sql = "SELECT S.storeName, C.CategoryName, M.userId from storeList S, categoryList C, managerlist M where S.categoryId=C.categoryId and S.storeId=M.storeId";
								$result = mysqli_query($conn, $sql);
								$i = 1;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$storeName[$i] = $row['storeName'];
 									   	$categoryName[$i] = $row['CategoryName'];
										$mgrName[$i] = $row['userId'];
										$i = $i + 1;
							 		}
								}
								$i--;
								echo "
									<div class=\"alert alert-info\">
									  Total Stores: <strong>{$i}</strong>
									</div> 
									<table class=\"table table-striped\">
									    <thead>
									      <tr>
									        <th>Store Name</th>
									        <th>Category</th>
									        <th>Manager</th>
									      </tr>
									    </thead>
									    <tbody>";
								while($i != 0){
									
									$strName = $storeName[$i];
									$catName = $categoryName[$i];
									$mName = $mgrName[$i];
									$i = $i - 1;
									echo "
										<tr>
									        <td>{$strName}</td>
									        <td>{$catName}</td>
									        <td>{$mName}</td>									       
									     </tr>
									";
								}
									      
								echo "
									  </tbody>
									  </table>
								";
							?>
							<a href = "storeDisplay.php"><button type="button" class="btn btn-primary btn-block">Complete Store Management</button></a>
        				</div>
      				</div>
    			</div>
    			<div class="panel panel-default">
      				<div class="panel-heading">
        				<h4 class="panel-title">
	          				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Staff Manager</a>
        				</h4>
      				</div>
      				<div id="collapse3" class="panel-collapse collapse">
        				<div class="panel-body">
        					<?php
        						include 'mysql-init.php';
								$sql = "select COUNT(*) as total from employeelist";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
 									   	$totalStaff = $row['total'];
							 		}
								}
								
								$sql = "select COUNT(*) as total from employeelist where empSex='M'";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
 									   	$totalMaleStaff = $row['total'];
							 		}
								}
								
								$sql = "select COUNT(*) as total from employeelist where empSex='F'";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
 									   	$totalFemaleStaff = $row['total'];
							 		}
								}
								
								$sql = "select S.storeName, count(empId) as empCount from storelist S, employeelist E where S.storeId=e.storeId group by(S.storeId)";
								$result = mysqli_query($conn, $sql);
								$i = 1;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$storeName[$i] = $row['storeName'];
 									   	$empCount[$i] = $row['empCount'];
										$i = $i + 1;
							 		}
								}
								echo " 
									<div class=\"well\">
									  Total Staff: <strong>{$totalStaff}</strong>
									  Male Staff: <strong>{$totalMaleStaff}</strong>
									  Female Staff: <strong>{$totalFemaleStaff}</strong>
									</div> 
									
									<br><table class=\"table table-striped\">
									    <thead>
									      <tr>
									        <th>Store Name</th>
									        <th>No. of Staff</th>
									      </tr>
									    </thead>
									    <tbody>";
										$i--;
								while($i != 0){
									
									$temp1 = $storeName[$i];
									$temp2 = $empCount[$i];
									$i = $i - 1;
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp2}</td>
									       
									     </tr>
									";
								}
									      
								echo "
									  </tbody>
									  </table>
								";
							?>
							<a href = "staffDisplay.php"><button type="button" class="btn btn-primary btn-block">Complete Staff Management</button></a>
        				 </div>
      				</div>
			    </div>
			    <div class="panel panel-default" hidden>
      				<div class="panel-heading">
        				<h4 class="panel-title">
          					<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Lease Due Trigger</a>
        				</h4>
      				</div>
      				<div id="collapse4" class="panel-collapse collapse">
        				<div class="panel-body">
        					<?php
        						include 'mysql-init.php';
								$sql = "select storeName, leaseDate from storelist S, leasedue L where S.storeId = L.storeId order by leaseDate";
								$result = mysqli_query($conn, $sql);
								
								$i = 1;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$storeName[$i] = $row['storeName'];
 									   	$leaseDate[$i] = $row['leaseDate'];
										$i = $i + 1;
							 		}
								}
								echo " 
									<br><table class=\"table table-striped\">
									    <thead>
									      <tr>
									        <th>Store Name</th>
									        <th>Due On</th>
									      </tr>
									    </thead>
									    <tbody>";
										$i--;
								while($i != 0){
									
									$temp1 = $storeName[$i];
									$temp2 = $leaseDate[$i];
									$i = $i - 1;
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp2}</td>
									       
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
    			</div>
  			</div>  
 		</div>
		<footer class="container-fluid text-center">
  			<p>Copyright: Our Mall</p>  
		</footer>
	</body>
</html>
