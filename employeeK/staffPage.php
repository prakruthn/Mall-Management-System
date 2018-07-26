<?php
	session_start();
	$_SESSION['staffLoggedIn'] = TRUE;
?>

<html>
	<head>
		<title>Staff</title>
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
    			<h1>Staff Page</h1>      
  			</div>
  			
  			<ul class="nav nav-tabs">
    			<li class="active"><a data-toggle="tab" href="#home">Staff</a></li>
    			<li><a data-toggle="tab" href="#menu1">Update Personal Info</a></li>
    			<li><a data-toggle="tab" href="#menu2">Update Login Credentials</a></li>
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
							
							if(isset($_SESSION['succLoginCre'])){
								
								if($_SESSION['succLoginCre']){
									echo"
										<div class=\"alert alert-success\"><strong>{$_SESSION['staffID']}</strong> Updated</div>
									";
								}
								else{
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['staffID']}</strong> update failed<br> {$_SESSION['reason']}</div>
									";
								}	
								unset($_SESSION['succLoginCre']);
								unset($_SESSION['staffID']);
							}
  						?>
  						
  					</div>
  					<div>
  						<?php
        						include 'mysql-init.php';
								if(isset($_SESSION['empLoginUsr'])){
									$sql = "select empId from employeelogin where empUserName = '".$_SESSION['empLoginUsr']."'";
									//$sql = "select empId from employeelogin where empUserName = 'user1'";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
								    	while ($row = mysqli_fetch_assoc($result)) {
								    		$empId = $row['empId'];
								 		}
									}
									$_SESSION['empLoginId']= $empId;
								}
								if(isset($_SESSION['staffID'])){
									$empId = $_SESSION['staffID'];
									$_SESSION['empLoginId']= $empId;
								}
								$sql = "SELECT E.empId, S.storeName, E.empName, E.empSal, E.joinDate, E.dutyShift, E.phnNo FROM employeelist E join storelist S on E.storeId = S.storeId and E.empId = ".$empId." order by(empId)";
								$result = mysqli_query($conn, $sql);
								$i = 0;
								if (mysqli_num_rows($result) > 0) {
							    	while ($row = mysqli_fetch_assoc($result)) {
							    		$empId[$i] = $row['empId'];
 									   	$storeName[$i] = $row['storeName'];
										$empName[$i] = $row['empName'];
										$empSal[$i] = $row['empSal'];
										$joinDate[$i] = $row['joinDate'];
										$dutyShift[$i] = $row['dutyShift'];
										$phno[$i] = $row['phnNo'];
										
										$i = $i + 1;
							 		}
								}
								echo " 
										
										<br><table class=\"table table-striped\">
								
									    <thead>
									      <tr>
									        <th>ID</th>
									        <th>Store Name</th>
									        <th>Name</th>
									        <th>Salary</th>
									        <th>Join Date</th>
									        <th>Shift</th>
									        <th>Contact No.</th>
									      </tr>
									    </thead>
									    <tbody>";
										
										$j = 0;
								while($j != $i){
									
									$temp1 = $empId[$j];
									$temp2 = $storeName[$j];
									$temp3 = $empName[$j];
									$temp4 = $empSal[$j];
									$temp5 = $joinDate[$j];
									$temp6 = $dutyShift[$j];
									$temp7 = $phno[$j];
									
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
    					<h3>Update Personal Info</h3>
  					</div>
  					<div class="alert alert-warning">
  						<strong>To Change your Shift contact Store Manager</strong>
					</div>
  					
  					<div class="panel-body">
        				<form action="changeStaffProcess.php" method="post">
  							<div class="form-group">
			    				<label for="staffName">Staff Name</label>
    							<input type="msg" class="form-control" id="staffName" name = "staffName" placeholder="Staff Name">
    						</div>
    						<div class="form-group">
			    				<label for="staffPhn">Contact No.</label>
    							<input type="msg" class="form-control" id="staffPhn" name = "staffPhn" placeholder="Contact No.">
    						</div>
  							<input name="updateStaff" type="submit" value = "Update" class="btn btn-default">        			
        				</form>
      				</div> 
    			</div>
    			<div id="menu2" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Update Login Credentials</h3>      
  					</div>
  					
  					<div class="panel-body">
        				<form action="changeStaffProcess.php" method="post">
        					<div class="form-group">
			    				<label for="staffId">Staff Id</label>
    							<input type="msg" class="form-control" id="staffId" name = "staffId" placeholder="Enter ID to Confirm">
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
  							
  							<input name="updateStaffLogin" type="submit" value = "Update" class="btn btn-default">        			
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