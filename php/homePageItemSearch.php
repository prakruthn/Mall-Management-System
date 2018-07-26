<?php
	session_start();
?>

<html>
	<head>
  		<title>Welcome</title>
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<link rel="stylesheet" href="../css/homePage.css">
	</head>
	<body>
		<div class="jumbotron text-center">
  			<h1>Our Mall</h1>
  			<p>Get everything u want</p> 
		</div>
		<div class="container">
  			<div class="row">
    			<div class="col-sm-6">
      				<h3>Wecome Customer</h3>
      				<p>One stop for all your queries, searchings and also Bill yourself</p>
    			</div>
    			<div class="col-sm-4">
	      			<h3>Login</h3>
      				<form action = "../php/homePageCustomerLoginProcess.php" method = "post" class="forms" id = "login">
      					<div class="form-group">
    						User ID:
    						<input type="text" name = "userId" class="form-control" placeholder="example123" id="usr">
  						</div>
  						<div class="form-group">
    						Password:
    						<input type="password" name = "passwd" class="form-control" placeholder="password" id="passwd">
  						</div>
  						<input type="submit" class="btn btn-default" name = "submit">
  						<a href = "../php/homePageCustomerLogOut.php"><button type="submit" class="btn btn-default">Logout</button></a>
  						<div class="alert alert-info alert-dismissable">
  							<p>New User? Contact Customer Desk at 2nd Floor</p>
						</div>
      				</form>
    			</div>
    		</div>
		</div>
		<div>
			<div class="container">
  				<div class="row">
  					<a href = "#">
    					<div class="col-sm-4 self-bill" hidden>
    						<img src="../images/pos.jpg" alt="" class="pos-image img-responsive" style="width:100%">
    						<div class="middle">
      							<div class="text no-mobile"><h3>Bill Your Self</h3>
					    			<p>Fed up of waiting in long Qs'.....</p>
      								<p>Does your bag contain less than 4 items</p>
      								<p>Then bill here....By your self....</p>
      								<p>Pay by any method you wish....</p>
      							</div>
    						</div>
    					</div>	
    				</a>
    				<div class="col-sm-4">
      					<h3>Search what you want</h3>
	      					<form action="../php/homePageItemSearchProcess.php" method="post">
	      						<div class="input-group">
	    							<span class="input-group-addon"><i class = "glyphicon glyphicon-shopping-cart"></i></span>
	    							<input id="msg" type="text" class="form-control" name="item-search" placeholder="Search Item">
	  							</div>      						
	      					</form>
      					<div class="alert alert-warning">
  						<?php
  							if(isset($_SESSION['no-item-to-search'])){
  								echo "Please enter an item to search";
  							}
  							elseif(isset($_SESSION['ERRMSG_ARR'])){
								echo $_SESSION['ERRMSG_ARR'];
								
							}
							elseif(isset($_SESSION['noItem'])){
								echo $_SESSION['noItem'];
								
							}
							else{					
							}
  						?>
						</div>
						<form action="../php/homePageItemSearchProcess.php" method="post">
      						<div class="input-group">
    							<button type="submit" class="btn btn-default">Advanced Search</button>
  							</div>      						
      					</form>
      					<p></p>
    				</div>
    				<div class="col-sm-4" hidden>
      					<h3>Want to Exchange stuff? Fill in the Details</h3> 
      					<div class = "input-group">
      						<form action="../php/homePageExchangeProcess.php" method="post">
	      						<div class="input-group">
	    							<span class="input-group-addon"><i class = "glyphicon glyphicon-repeat"></i></span>
	    							<input id="msg" type="text" class="form-control" name="exchange" placeholder="Enter Bill No.">
	  							</div>      						
	      					</form>
      					</div>
    				</div>
  				</div>
			</div>			
		</div>
		<footer>
			<div class="well well-lg">
				<div class="col-sm-6">
					<span class=""><i class = "glyphicon glyphicon-copyright-mark"></i></span>
					<span>Copyright2017 Our Mall</span>
				</div>			
				<div class="col-sm-6">
					<a href = "#"><img class="img-responsive" alt = "facebook/OurMall" src = "../images/facebook-icon.png" height=4% width=4%></a>
					<a href = "#"><img class="img-responsive" alt = "instagram/OurMall" src = "../images/instagram-icon.jpg" height=6% width=6%></a>
					<a href = "#"><img class="img-responsive" alt = "youtube/OurMall" src = "../images/youtube-icon.ico" height=6% width=6%></a>
					
				</div>				
			</div>
		</footer>
		<?php
			session_unset(); 
			session_destroy();
		?>
	</body>	
</html>