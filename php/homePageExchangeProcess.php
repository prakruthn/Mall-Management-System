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
    		</div>
		</div>
		<div class="container">
  			<div class="jumbotron">
    			<h3>Your Searched for</h3> 
    			<p>With the input you gave us, we have found your items at</p> 
  			</div>
  			<?php
  				if(!isset($_POST['exchange'])){
					$_SESSION['exchange'] = "Enter the necessary details";
					die(header("Location: homePageExchange.php"));	
				}

				session_start();
				
				$billNo = $_POST['exchange'];
				
				if($billNo == ''){
						
					$errmsg_arr['billNoMissing'] = 'Enter the necessary details';
					$errflag = true;
				}
		
				if($errflag) {
					$_SESSION['ERRMSG_ARR'] = $errmsg_arr['billNoMissing'];
					session_write_close();
					die(header("Location: homePageExchange.php"));
					exit();
				}
				
				include 'mysql-init.php';
					
				$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
				if (!$conn) {
 	   				die("Access Denied Contact Technical Officer: " . mysqli_connect_error());
				}
				$sql = "SELECT T.billNo, T.itemId, T.itemName, T.shopName, T.buyDate, T.Cost FROM Transactions T, ItemsList I where T.itemId = I.itemId && T.billNo = ".$billNo;
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
    				echo "
    					<table class=\"table table-striped table-responsive\">
    						<thead>
      							<tr>
      								<th>BillNo</th>
      								<th>Item No</th>
        							<th>Item Name</th>
        							<th>Store Name</th>
        							<th>Purchase Date</th>
        							<th>Exchange</th>
      							</tr>
    						</thead>
    						<tbody>
    					";
						while($row = mysqli_fetch_assoc($result)) {
				    		echo "
				    			<form action = \"exchangeConfirm.php\" method = \"post\">
				    				<tr>
	        							<td>{$row['billNo']}</td>
        								<td>{$row['itemNo']}</td>
							        	<td>{$row['itemName']}</td>
							        	<td>{$row['storeName']}</td>
							        	<td>{$row['purchaseDate']}</td>
							        	<td><input type = \"checkbox\" name = \"exchange\" value = \"{$itemNo}\"></td>
      								</tr>
				    		";
	    			}
				}	
				else {
	   				$noItem = "Wrong Bill No.";
					$_SESSION['wrongBill'] = $noItem;
    				die(header("Location: homePageExchange.php"));
				}
			?>
			</tbody>
			</table>
			<button type="submit" class="btn btn-default">Exchange</button> 
		</form>		
		</div>
		<a href="../html/homePage.html"><div class="well well-sm">Search Another</div></a
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
	</body>	
</html>
						
				 