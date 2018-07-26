<?php
	session_start();
	if(isset($_POST['updateStore'])){
    	$id = $_POST['storeId'];
		$date = date("y/m/d");
					
		include 'mysql-init.php';
			
		$sql = "call test4('".$date."', ".$id.")";			
		//$sql = "UPDATE `storelist` SET leaseStart = ".$date." where storeId = $id";	
		//$sql = "UPDATE `itemslist` SET quantity = $updQuan where itemId = $id";
		$result = mysqli_query($conn, $sql);
		$rowsAffect = mysqli_affected_rows($conn);
		$_SESSION['aff'] = $rowsAffect;
		if($result && ($rowsAffect != 0)){
			$_SESSION['succStoreUpd'] = TRUE;
			$_SESSION['storeID'] = $id;
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: storeDisplay.php"));
		}
		else{
			$_SESSION['succStoreUpd'] = FALSE;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: storeDisplay.php"));
		}
	}
?>