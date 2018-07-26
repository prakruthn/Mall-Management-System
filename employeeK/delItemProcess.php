<?php
	
	session_start();

	if (isset($_POST['rmvItem'])) {
		include 'mysql-init.php';
		$itemId = $_POST['rmvId'];
		$sql = "DELETE FROM `itemslist` WHERE itemId =$itemId";
		$result = mysqli_query($conn, $sql);
		if($result){
			$_SESSION['succItemRmv'] = 1;
			$_SESSION['itemID'] = $itemId;
			die(header("Location: stocksDisplay.php"));
		}
		else{
			$_SESSION['succItemRmv'] = 0;
			die(header("Location: stocksDisplay.php"));
		}
	}
	else{
		$_SESSION['succItemRmv'] = 0;
		die(header("Location: stocksDisplay.php"));
	}

?>