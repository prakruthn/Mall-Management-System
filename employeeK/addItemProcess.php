<?php
	
	session_start();
	
	if(isset($_POST['addItem'])){
		include 'mysql-init.php';
		
		$itemId = $_POST['addId']; 
		$catId = $_POST['catId'];
		$storeId = $_POST['storeId'];
		$itemName = $_POST['itemName'];
		$color = $_POST['itemColor'];
		$size = $_POST['itemSize'];
		$price = $_POST['itemRate'];
		$quant = $_POST['quantity'];
		
		$sql = "INSERT INTO `itemslist`(itemId, storeId, categoryId, itemName, color, size, price, quantity) VALUES (".$itemId.", ".$storeId.", ".$catId.", '".$itemName."', '".$color."', ".$size.", ".$price.", ".$quant." )";	
		$result = mysqli_query($conn, $sql);
		if($result){
			$_SESSION['succItemAdd'] = TRUE;
			$_SESSION['itemID'] = $itemId;
			die(header("Location: stocksDisplay.php"));
		}
		else{
			$_SESSION['succItemAdd'] = FALSE;
			$_SESSION['itemID'] = $itemId;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			die(header("Location: stocksDisplay.php"));
		}
	}
	
	elseif (isset($_POST['rmvItem'])) {
		include 'mysql-init.php';
		$itemId = $_POST['rmvId'];
		$sql = "DELETE FROM `itemslist` WHERE itemId =$itemId";
		$result = mysqli_query($conn, $sql);
		$rowsAffect = mysqli_affected_rows($conn);
		$_SESSION['aff'] = $rowsAffect;
		if($result && ($rowsAffect != 0)){
			$_SESSION['succItemRmv'] = TRUE;
			$_SESSION['itemID'] = $itemId;
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: stocksDisplay.php"));
		}
		else{
			$_SESSION['succItemRmv'] = FALSE;
			$_SESSION['reason'] = "Due to: No stock with ID ".$itemId;
			die(header("Location: stocksDisplay.php"));
		}
	}
	else{
	}
	

?>