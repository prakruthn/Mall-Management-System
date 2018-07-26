<?php
	session_start();
?>

<html>
	<head>
		<title>Employee Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<link rel="stylesheet" href="./homePage.css">
  		<script>
			$(document).ready(function(){
    			$("#adminBtn").click(function(){
        			$("#adminModal").modal();
    			});
			});
			
			$(document).ready(function(){
    			$("#staffBtn").click(function(){
        			$("#staffModal").modal();
    			});
			});
			
			$(document).ready(function(){
    			$("#strBtn").click(function(){
        			$("#strModal").modal();
    			});
			});
		</script>
	</head>
	<body>
		<div class="jumbotron text-center">
			<h1>Our Mall</h1>
  			<p>Get everything u want</p>
		</div>
		
		<div class="container">
  			<center><h2>Employee Login</h2></center>
  			<button type="button" class="btn btn-default btn-lg" id="adminBtn">Admin</button>
  			<div class="modal fade" id="adminModal" role="dialog">
    			<div class="modal-dialog">
      				<div class="modal-content">
        				<div class="modal-header" style="padding:35px 50px;">
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
          					<h4><span class="glyphicon glyphicon-lock"></span>Admin</h4>
        				</div>
        				<div class="modal-body" style="padding:40px 50px;">
          					<form action = "empLoginProcessAdmin.php" method = "post">
            					<div class="form-group">
              						<label for="usrname"><span class="glyphicon glyphicon-user"></span> Admin</label>
              						<input type="text" class="form-control" id="usrname" placeholder="Enter user name" name = "adminName">
            					</div>
            					<div class="form-group">
              						<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              						<input type="password" class="form-control" id="psw" placeholder="Enter password" name = "adminPasswd">
            					</div>
            		  			<input name="submit" type="submit" value = "Log In" class="btn btn-success btn-block">
				          </form>
        				</div>
        				<div class="modal-footer">
          					<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
        				</div>		      
    				</div>		
  				</div> 
			</div>
	
			<button type="button" class="btn btn-default btn-lg" id="staffBtn">Staff</button>
			<div class="modal fade" id="staffModal" role="dialog">
    			<div class="modal-dialog">
      				<div class="modal-content">
        				<div class="modal-header" style="padding:35px 50px;">
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
          					<h4><span class="glyphicon glyphicon-lock"></span>Staff</h4>
        				</div>
        				<div class="modal-body" style="padding:40px 50px;">
          					<form action = "empLoginProcessStaff.php" method = "post">
            					<div class="form-group">
              						<label for="usrname"><span class="glyphicon glyphicon-user"></span>Staff</label>
              						<input type="text" class="form-control" id="usrname" placeholder="Enter user name" name = "staffName">
            					</div>
            					<div class="form-group">
              						<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              						<input type="password" class="form-control" id="psw" placeholder="Enter password" name = "staffPasswd">
            					</div>
            		  			<input name="submit" type="submit" value = "Log In" class="btn btn-success btn-block">
				          </form>
        				</div>
        				<div class="modal-footer">
          					<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
        				</div>		      
    				</div>		
  				</div> 
			</div>
  			<button type="button" class="btn btn-default btn-lg" id="strBtn">Store Manager</button>
  			<div class="modal fade" id="strModal" role="dialog">
    			<div class="modal-dialog">
      				<div class="modal-content">
        				<div class="modal-header" style="padding:35px 50px;">
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
          					<h4><span class="glyphicon glyphicon-lock"></span>Store Manager</h4>
        				</div>
        				<div class="modal-body" style="padding:40px 50px;">
          					<form action = "empLoginProcessStore.php" method = "post">
            					<div class="form-group">
              						<label for="usrname"><span class="glyphicon glyphicon-user"></span>Manager ID</label>
              						<input type="text" class="form-control" id="usrname" placeholder="Enter user name" name = "mgrName">
            					</div>
            					<div class="form-group">
              						<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              						<input type="password" class="form-control" id="psw" placeholder="Enter password" name = "mgrPasswd">
            					</div>
            		  			<input name="submit" type="submit" value = "Log In" class="btn btn-success btn-block">
				          </form>
        				</div>
        				<div class="modal-footer">
          					<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
        				</div>		      
    				</div>		
  				</div> 
			</div>
		</div>	
		<br>
		<br>
		<div class="">
  			<?php if(isset($_SESSION['userId'])){}
						elseif(isset($_SESSION['ERRMSG_ARR'])){
							echo "<p class = \"alert alert-danger\">". $_SESSION['ERRMSG_ARR'] ."</p>";
							
						} 
						elseif(isset($_SESSION['wrongDataFlag']) && ($_SESSION['wrongDataFlag'])){ 
								echo "<p class = \"alert alert-danger\">". $_SESSION['wrongData'] ."</p>";
						}
						elseif(isset($_SESSION['noUser'])){
							echo "<p class = \"alert alert-danger\">ka</p>";
						}
      		?>	
  			
		</div>
		<footer>
			
		</footer>
		<?php
			session_unset(); 
			session_destroy();
		?>
	</body>
</html>
