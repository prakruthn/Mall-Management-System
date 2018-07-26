<?php
	
	session_start();
	
	if(isset($_POST['addStore'])){
		include 'mysql-init.php';
		
		$storeId = $_POST['storeId']; 
		$catId = $_POST['catId'];
		$storeName = $_POST['storeName'];
		$floor = $_POST['floor'];
		$mgr = $_POST['mgrName'];
		$empId = $_POST['empId'];
		$mgrId = $_POST['mgrId'];
		$mgrPasswd = $_POST['mgrPasswd'];
		$date = date("y/m/d");
		
		$sql = "INSERT INTO `storelist`(storeId, categoryId, storeName, floor, leaseStart) VALUES (".$storeId.", ".$catId.", '".$storeName."', ".$floor.	", '".$date."' )";	
		$result1 = mysqli_query($conn, $sql);
		
		$sql = "INSERT INTO `managerlist` VALUES (".$mgrId.", '".$mgr."', '".$mgrPasswd."', ".$storeId.	", ".$empId." )";	
		$result2 = mysqli_query($conn, $sql);
		
		//$sql = "update `storelist` set leaseStart = DATE_ADD('".$date."', INTERVAL 12 MONTH) where storeId=".$storeId;
		//stored precedure here
		$sql = "call test4('".$date."', ".$storeId.")";	
		$result3 = mysqli_query($conn, $sql);
		
		if($result1 && $result2){
			$_SESSION['succStoreAdd'] = TRUE;
			$_SESSION['storeID'] = $storeId;
			die(header("Location: storeDisplay.php"));
		}
		
		else{
			$_SESSION['succStoreAdd'] = FALSE;
			$_SESSION['storeID'] = $storeId;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			die(header("Location: storeDisplay.php"));
		}
	}
	
	elseif (isset($_POST['rmvStore'])){
		include 'mysql-init.php';
		$storeId = $_POST['rmvId'];
		$sql = "DELETE FROM `storelist` WHERE storeId = $storeId";
		$result = mysqli_query($conn, $sql);
		$rowsAffect = mysqli_affected_rows($conn);
		$_SESSION['aff'] = $rowsAffect;
		if($result && ($rowsAffect != 0)){
			$_SESSION['succStoreRmv'] = TRUE;
			$_SESSION['storeID'] = $itemId;
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: storeDisplay.php"));
		}
		else{
			$_SESSION['succStoreRmv'] = FALSE;
			$_SESSION['reason'] = "Due to: No store with ID ".$storeId;
			die(header("Location: storeDisplay.php"));
		}
	}
	else{
	}
	

?>