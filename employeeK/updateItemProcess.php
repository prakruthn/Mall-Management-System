<?php
	session_start();
	if(isset($_POST['updateItem'])){
    	$id = $_POST['itemId'];
        $updQuan = $_POST['updateQuan'];
					
		include 'mysql-init.php';
				
		$sql = "UPDATE `itemslist` SET quantity = ".$updQuan." where itemId = ".$id;	
		//$sql = "UPDATE `itemslist` SET quantity = $updQuan where itemId = $id";
		$result = mysqli_query($conn, $sql);
		if($result){
			$_SESSION['succItemUpd'] = TRUE;
			$_SESSION['itemID'] = $id;
			die(header("Location: stocksDisplay.php"));
		}
		else{
			$_SESSION['succItemUpd'] = FALSE;
		    $_SESSION['itemID'] = $itemId;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			die(header("Location: stocksDisplay.php"));
		}
	}
?>