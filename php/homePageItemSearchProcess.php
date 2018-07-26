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
      				<h3>Wecome <?php
      						if(isset($_SESSION['userId'])) 
      							echo $_SESSION['userId'];
							else 
								echo "Customer";
      				?></h3>
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
	
				if(!isset($_POST['item-search'])){
					$_SESSION['no-item-to-search'] = "Please enter what you want to search";
					die(header("Location:homePageItemSearch.php"));	
				}
				
				$itemName = $_POST['item-search'];
				$errflag = null;
				if($itemName == ''){
						
					$errmsg_arr['itemNameMissing'] = 'Enter item name';
					$errflag = true;
				}
		
				if($errflag) {
					$_SESSION['ERRMSG_ARR'] = $errmsg_arr['itemNameMissing'];
					session_write_close();
					die(header("Location: homePageItemSearch.php"));
					exit();
				}
			
				include 'mysql-init.php';
					
				$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
				if (!$conn) {
 	   				die("Access Denied Contact Technical Officer: " . mysqli_connect_error());
				}
				$sql = "SELECT I.itemName, I.color, I.size, S.storeName, S.floor FROM itemslist I, storelist S where I.storeId = S.storeId && itemName LIKE '%".$itemName."%'";
				//$sql = "SELECT I.itemName, I.color, I.size, S.storeName, S.floor FROM itemslist I, storelist S where I.storeId = S.storeId && I.itemName LIKE '%formal%'";
				//$sql = "SELECT I.itemName, I.color, I.size, S.storeName, S.floor FROM itemslist I, storelist S where I.storeId = S.storeId ";
				$result = mysqli_query($conn, $sql);
				
				$rowcount=mysqli_num_rows($result);
				echo "
					<br>
					<div class=\"alert alert-success\">
  						<h4>Obatined <strong>{$rowcount}</strong> items based on your wish</h4>
					</div>
				";
				if ($rowcount > 0) {
    				echo "
    					<table class=\"table table-striped table-responsive\">
    						<thead>
      							<tr>
        							<th>ItemName</th>
        							<th>Color</th>
        							<th>Size</th>
        							<th>Store Name</th>
        							<th>Floor</th>
      							</tr>
    						</thead>
    						<tbody>
    					";	
    				while($row = mysqli_fetch_assoc($result)) {
				    		echo "
				    			<tr>
        							<td>{$row['itemName']}</td>
        							<td>{$row['color']}</td>
        							<td>{$row['size']}</td>
        							<td>{$row['storeName']}</td>
							        <td>{$row['floor']}</td>
      							</tr>
				    		";
	    			}
				}	
				else {
	   				$noItem = "Item Not Found. Try Advanced Search Options";
					$_SESSION['noItem'] = $noItem;
    				die(header("Location: homePageItemSearch.php"));
				}
			?>
		</tbody>
		</table> 
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
