<?php
	session_start();
	$_SESSION['staffLoggedIn'] = TRUE;
?>

<html>
	<head>
		<title>Store</title>
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
    			<h1>Store Page</h1>      
  			</div>
  			
  			<ul class="nav nav-tabs">
    			<li class="active"><a data-toggle="tab" href="#home">Store Info</a></li>
    			<li><a data-toggle="tab" href="#menu1">Update Login Credentials</a></li>
  			</ul>
  			
  			<div class="tab-content">
    			<div id="home" class="tab-pane fade in active">
      				<div class="page-header">
    					<h3>Staff</h3>      
  					</div>
  					
  					<div>
  						<?php
  						
							if(isset($_SESSION['succStaffChg'])){
								if($_SESSION['succStaffChg']){
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['staffID']}</strong> Updated</div>
									";
								}
								else{
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['staffID']}</strong> Update failed</div>
									";
								}
								unset($_SESSION['succStaffChg']);
							}
							
							if(isset($_SESSION['succLoginStoreCre'])){
								
								if($_SESSION['succLoginStoreCre']){
									echo"
										<div class=\"alert alert-success\"><strong></strong> Updated</div>
									";
								}
								else{
									echo"
										<div class=\"alert alert-warning\"><strong></strong> update failed<br> {$_SESSION['reason']}</div>
									";
								}	
								unset($_SESSION['succLoginStoreCre']);
								unset($_SESSION['storeID']);
							}
  						?>
  						
  					</div>
  					<div>
  						<?php
        						include 'mysql-init.php';
								if(isset($_SESSION['empLoginStore'])){
									$sql = "select storeId from managerlist where userId = '".$_SESSION['empLoginStore']."'";
									//$sql = "select empId from employeelogin where empUserName = 'user1'";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
								    	while ($row = mysqli_fetch_assoc($result)) {
								    		$storeId = $row['storeId'];
								 		}
									}
									$_SESSION['storeLoginId']= $storeId;
								}
								if(isset($_SESSION['staffID'])){
									$empId = $_SESSION['staffID'];
									$_SESSION['empLoginId']= $empId;
								}
								$sql = "SELECT S.storeId, C.categoryName, S.storeName, S.floor, S.leaseStart, M.userId FROM storelist S, categorylist C, managerlist M where S.categoryId = C.categoryId and S.storeId = M.storeId and S.storeId = ".$storeId." order by(storeId)";
								$result = mysqli_query($conn, $sql);
								$i = 0;
								
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$storeId[$i] = $row['storeId'];
										$categoryName[$i] = $row['categoryName'];
 									   	$storeName[$i] = $row['storeName'];
										$floor[$i] = $row['floor'];
										$leaseStart[$i] = $row['leaseStart'];
										$mgr[$i] = $row['userId'];
										
										$i = $i + 1;
							 		}
								}
								echo " 
										
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>ID</th>
									        <th>Category</th>
									        <th>Store Name</th>
									        <th>Floor</th>
									        <th>Lease Start</th>
									        <th>Manager Incharge</th>
									      </tr>
									    </thead>
									    <tbody>";
										
										$j = 0;
								while($j != $i){
									
									$temp1 = $storeId[$j];
									$temp2 = $categoryName[$j];
									$temp3 = $storeName[$j];
									$temp4 = $floor[$j];
									$temp5 = $leaseStart[$j];
									$temp6 = $mgr[$j];
									
									$j++;
									echo "
										<tr>
									        <td>{$temp1}</td>
									        <td>{$temp2}</td>
									        <td>{$temp3}</td>
									        <td>{$temp4}</td>
									        <td>{$temp5}</td>
									        <td>{$temp6}</td>
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
    					<h3>Update Login Credentials</h3>      
  					</div>
  					
  					<div class="panel-body">
        				<form action="changeStoreProcess.php" method="post">
        					<div class="form-group">
			    				<label for="storeId">Store Id</label>
    							<input type="msg" class="form-control" id="storeId" name = "storeId" placeholder="Enter ID to Confirm">
  							</div>
  							<div class="input-group">
    							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    							<input id="usrName" type="text" class="form-control" name="usrName" placeholder="User Name">
  							</div><br>
  							<div class="input-group">
    							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    							<input id="passwd" type="password" class="form-control" name="passwd" placeholder="Password">
    						</div><br>
    						<div class="input-group">
    							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    							<input id="confirmPasswd" type="password" class="form-control" name="confirmPasswd" placeholder="Confirm Password">
    						</div><br>
  							
  							<input name="updateStoreLogin" type="submit" value = "Update" class="btn btn-default">        			
        				</form>
      				</div>  					
    			</div>
  			</div>
		</div>
		<footer class="container-fluid text-center">
  			<p>Copyright: Our Mall</p>  
		</footer>
	</body>
</html>