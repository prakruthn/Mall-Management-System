<?php
	session_start();
	if(isset($_POST['updateStaff'])){
    	$id = $_POST['staffId'];
		$shift = $_POST['staffShift'];
					
		include 'mysql-init.php';
				
		$sql = "update employeelist set dutyShift = '".$shift."' where empId = $id";		
		$result = mysqli_query($conn, $sql);
		$rowsAffect = mysqli_affected_rows($conn);
		$_SESSION['aff'] = $rowsAffect;
		if($result && ($rowsAffect != 0)){
			$_SESSION['succStaffUpd'] = 1;
			$_SESSION['staffID'] = $id;
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: staffDisplay.php"));
		}
		else{
			$_SESSION['succStaffUpd'] = 0;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
			$_SESSION['aa'] = $rowsAffect;
			die(header("Location: staffDisplay.php"));
		}
	}
?>