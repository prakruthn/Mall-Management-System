<?php
	session_start();
	if(isset($_SESSION['staffLoggedIn'])){
		die(header("Location: staffPage.php"));
	}
?>

<html>
	<head>
		<title>Staff Manager</title>
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
    			<h1>Staff Manager</h1>
    			
					<a href="adminPage.php"><button type="button" class="btn btn-default">Admin Page</button></a>	
				      
  			</div>
			
  			<ul class="nav nav-tabs">
    			<li class="active"><a data-toggle="tab" href="#home">Staff</a></li>
    			<li><a data-toggle="tab" href="#menu1">Add/Remove Staff (trigger)</a></li>
    			<li><a data-toggle="tab" href="#menu2">Change Duty</a></li>
    			<li><a data-toggle="tab" href="#menu3">Update/Change</a></li>
  			</ul>
		
  			<div class="tab-content">
    			<div id="home" class="tab-pane fade in active">
      				<div class="page-header">
    					<h3>Staff Manager</h3>      
  					</div>
  					
  					<div>
  						<?php
  						
  							if(isset($_SESSION['succStaffAdd'])){
								if($_SESSION['succStaffAdd']){
									echo"
										<div class=\"alert alert-success\"><strong>{$_SESSION['staffID']}</strong> added succesfully</div>
									";	
								}
								else{
									if(isset($_SESSION['staffID'])){
										echo"
											<div class=\"alert alert-warning\"><h3><strong>{$_SESSION['staffID']} addition failed</strong></h3><br>
												<p> {$_SESSION['reason']}</p>
											
											</div>
										";
									}
								}
								unset($_SESSION['succStaffAdd']);
							}
							
							if(isset($_SESSION['succStaffRmv'])){
								if($_SESSION['succStaffRmv']){
									echo"
										<div class=\"alert alert-danger\"><strong>{$_SESSION['staffID']}</strong> removed succesfully</div>
										
									";	
								}
								elseif(!$_SESSION['succStaffRmv']){
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
								unset($_SESSION['succStaffRmv']);
							}
							else{
								
							}
							if(isset($_SESSION['succStaffUpd'])){
								if($_SESSION['succStaffUpd'] == 1){
									echo"
										<div class=\"alert alert-warning\"><strong>{$_SESSION['staffID']}</strong> Shift Changed</div>
									";
								}
								elseif($_SESSION['succStaffUpd'] == 0) {
									echo"
										<div class=\"alert alert-warning\"><strong></strong> Shift Change Failed</div>
									";
								}
								unset($_SESSION['succStaffUpd']);
							}
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
  						?>
  						
  					</div>
  					<div>
  						<?php
        						include 'mysql-init.php';
								
								$sql = "SELECT E.empId, S.storeName, E.empName, E.empSal, E.joinDate, E.dutyShift, E.phnNo FROM employeelist E join storelist S on E.storeId = S.storeId order by(empId)";
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
										$phn[$i] = $row['phnNo'];
										
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
									        <th>Contact</th>
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
									$temp7 = $phn[$j];
									
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
    					<h3>Add/Remove</h3>
  					</div>
  					<div class="panel-group" id="accordion">
    					<div class="panel panel-default">
      		 				<div class="panel-heading">
        						<h4 class="panel-title">
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Add Staff</a>
        						</h4>
      						</div>		
      			 			<div id="collapse1" class="panel-collapse collapse">
        						<div class="panel-body">
        							<form action="addStaffProcess.php" method="post">
        								<div class="input-group">
    										<!--<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="addStaff" placeholder="Staff ID">
    										
    										<label for="addStaffName"><span class="glyphicon glyphicon-user input-group-addon"></span>Name</label>
    										<input id="addStaffName" type="text" class="form-control" name="staffName" placeholder="Staff Name">
    										-->
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="staffId" placeholder="Staff ID">
    										
    										<span class="input-group-addon">Name </span>
    										<input id="msg" type="text" class="form-control" name="staffName" placeholder="Staff Name">
    									</div><br>
    									<div class="form-group">
    										<label for="staffGender">Gender:</label>
    										<select name = "staffGender" class="btn btn-default dropdown-toggle">
    											<option value="M">Male</option>
    											<option value="F">Female</option>
    										</select>
    										
    										<label for="storeId">Store Name:</label>
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
    										<span class="input-group-addon">Salary(₹)</span>
    										<input id="msg" type="text" class="form-control" name="staffSal" placeholder="₹">
    										
    										<span class="input-group-addon">Contact</span>
    										<input id="msg" type="text" class="form-control" name="staffPhn" placeholder="Mobile No">
    									</div><br>
    									
    									<div class="input-group">
    										<label for="staffShift">Shift:</label>
    										<select name = "staffShift" class="btn btn-default dropdown-toggle">
    											<option value="M">Morning(10.30am to 3.30pm)</option>
    											<option value="E">Evening(3.30pm to 9.30pm)</option>
    										</select>
    									</div><br>
    									<input name="addStaff" type="submit" value = "Add Staff" class="btn btn-default">
        							</form>
      							</div>
    						</div>
    					</div>
    					<div class="panel panel-default">
      						<div class="panel-heading">
        						<h4 class="panel-title">
          							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Remove Staff</a>
        						</h4>
      						</div>
      						<div id="collapse2" class="panel-collapse collapse">
        						<div class="panel-body">
									<form method="post" action="addStaffProcess.php">
										<div class="input-group">
    										<span class="input-group-addon">ID</span>
    										<input id="msg" type="text" class="form-control" name="rmvId" placeholder="Staff Id">
    									</div><br>
    									<input name="rmvStaff" type="submit" value = "Remove Staff" class="btn btn-danger">
									</form>
								</div>
      						</div>
    					</div>
  					</div> 
    			</div>
    			<div id="menu2" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Change Shift</h3>      
  					</div>
  					
  					<div class="panel-body">
        				<form action="updateStaffProcess.php" method="post">
        					<div class="form-group">
			    				<label for="staffId">Staff Id</label>
    							<input type="msg" class="form-control" id="staffId" name = "staffId" placeholder="Staff ID">
  							</div>		  			
  							<div class="input-group">
    							<label for="staffShift">Shift:</label>
    							<select name = "staffShift" class="btn btn-default dropdown-toggle">
    								<option value="M">Morning(10.30am to 3.30pm)</option>
    								<option value="E">Evening(3.30pm to 9.30pm)</option>
    							</select>
    						</div><br>				
  							<input name="updateStaff" type="submit" value = "Change" class="btn btn-default">        			
        				</form>
      				</div>
    			</div>
    			<div id="menu3" class="tab-pane fade">
      				<div class="page-header">
    					<h3>Update/Change</h3>      
  					</div>
  					<div class="panel-body">
        				<form action="changeStaffProcess.php" method="post">
        					<div class="form-group">
			    				<label for="staffId">Staff Id</label>
    							<input type="msg" class="form-control" id="staffId" name = "staffId" placeholder="Staff ID">
  							</div>
  							<div class="form-group">
			    				<label for="staffName">Staff Name</label>
    							<input type="msg" class="form-control" id="staffName" name = "staffName" placeholder="Staff Name" disabled>
    							<input type="checkbox" id = 'check1' onclick="myFunction('check1', 'staffName')">Update This<br>
  							</div>
  							
  							<div class="form-group">
			    				<label for="staffPhn">Contact No.</label>
    							<input type="msg" class="form-control" id="staffPhn" name = "staffPhn" placeholder="Staff Phone" disabled>
    							<input type="checkbox" id = 'check3' onclick="myFunction('check3', 'staffPhn')">Update This<br>
  							</div>
  							
  							<div class="form-group">
			    				<label for="staffSal">Salary(₹)</label>
    							<input type="msg" class="form-control" id="staffSal" name = "staffSal" placeholder="₹" disabled>
    							<input type="checkbox" id = 'check2' onclick="myFunction('check2', 'staffSal')">Update This<br>
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
  							<input name="updateStaff" type="submit" value = "Update" class="btn btn-default">        			
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
	//session_unset();
	//session_destroy();
?>
