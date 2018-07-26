<?php

	session_start();
	if(isset($_POST['updateItem'])){
		$id = $_POST['itemId'];
		
		include 'mysql-init.php';
				
		if(isset($_POST['itemName'])){
			$itemName = $_POST['itemName'];
			$sql = "UPDATE `itemslist` SET itemName = '".$itemName."' where itemId = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['succItemChg'] = TRUE;
				$_SESSION['itemID'] = $id;
			}
			else{
				$_SESSION['succItemChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['itemID'] = $itemId;
			}
		}
		
		if(isset($_POST['color'])){
			$color = $_POST['color'];
			$sql = "UPDATE `itemslist` SET color = '".$color."' where itemId = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['succItemChg'] = TRUE;
				$_SESSION['itemID'] = $id;
			}
			else{
				$_SESSION['succItemChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['itemID'] = $itemId;
			}
		}
		if(isset($_POST['price'])){
			$price = $_POST['price'];
			$sql = "UPDATE `itemslist` SET price = ".$price." where itemId = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['succItemChg'] = TRUE;
				$_SESSION['itemID'] = $id;
			}
			else{
				$_SESSION['succItemChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['itemID'] = $itemId;
			}
		}
		if(isset($_POST['size'])){
			$size = $_POST['size'];
			$sql = "UPDATE `itemslist` SET size = ".$size." where itemId = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['succItemChg'] = TRUE;
				$_SESSION['itemID'] = $id;
			}
			else{
				$_SESSION['succItemChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['itemID'] = $itemId;
			}
		}
 		die(header("Location: stocksDisplay.php")); 
	}
?>