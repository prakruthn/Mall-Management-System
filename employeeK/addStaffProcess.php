<?php
	
	session_start();
	
	if(isset($_POST['addStaff'])){
		include 'mysql-init.php';
		
		$staffId = $_POST['staffId']; 
		$staffName = $_POST['staffName'];
		$gender = $_POST['staffGender'];
		$storeName = $_POST['storeId'];
		$salary = $_POST['staffSal'];
		$shift = $_POST['staffShift'];
		$phn = $_POST['staffPhn'];
		$date = date("y/m/d");
		
		$sql = "INSERT INTO employeelist VALUES (".$staffId.", '".$staffName."', '".$gender."', ".$salary.	", ".$storeName.", '".$date."', '".$shift."', ".$phn." )";	
		$result = mysqli_query($conn, $sql);
		//triggered here
		/*$sql = "INSERT INTO `employeelogin` VALUES (".$staffId." ,'".$phn."', '".$staffName."')";	
		$result2 = mysqli_query($conn, $sql);
		*/
		$sql = "update `employeelist` set joinDate = '".$date."' where empId=".$staffId;	
		$result3 = mysqli_query($conn, $sql);
		
		if($result){
			$_SESSION['succStaffAdd'] = TRUE;
			$_SESSION['staffID'] = $staffId;
			die(header("Location: staffDisplay.php"));
		}
		else{
			$_SESSION['succStaffAdd'] = FALSE;
			$_SESSION['staffID'] = $staffId;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			die(header("Location: staffDisplay.php"));
		}
	}
	
	elseif (isset($_POST['rmvStaff'])){
		include 'mysql-init.php';
		$staffId = $_POST['rmvId'];
		$sql = "DELETE FROM `employeelist` WHERE empId = $staffId";
		$result = mysqli_query($conn, $sql);
		$rowsAffect = mysqli_affected_rows($conn);
		$_SESSION['aff'] = $rowsAffect;
		if($result && ($rowsAffect != 0)){
			$_SESSION['succStaffRmv'] = TRUE;
			$_SESSION['staffID'] = $staffId;
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: staffDisplay.php"));
		}
		else{
			$_SESSION['succStaffRmv'] = FALSE;
			$_SESSION['reason'] = "Due to: No satff with ID ".$staffId;
			die(header("Location: staffDisplay.php"));
		}
	}
	else{
	}
	

?>