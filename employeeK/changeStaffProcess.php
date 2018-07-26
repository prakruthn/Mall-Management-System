<?php

	session_start();
	if(isset($_POST['updateStaff'])){
		if(isset($_SESSION['empLoginId']))
			$id = $_SESSION['empLoginId'];
		else {
			$id = $_POST['staffId'];
		}
		
		include 'mysql-init.php';
				
		if(isset($_POST['staffName'])){
			$staffName = $_POST['staffName'];
			$staffPhn = $_POST['staffPhn'];
			$sql = "UPDATE `employeelist` SET empName = '".$staffName."' where empId = ".$id;
			$result1 = mysqli_query($conn, $sql);
			$sql = "UPDATE `employeelist` SET phnNo = ".$staffPhn." where empId = ".$id;	
			$result2 = mysqli_query($conn, $sql);
			if($result1 || $result2){
				$_SESSION['succStaffChg'] = TRUE;
				$_SESSION['staffID'] = $id;
			}
			else{
				$_SESSION['succStaffChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['staffID'] = $id;
			}
		}
		
		if(isset($_POST['staffSal'])){
			$staffSal = $_POST['staffSal'];
			$sql = "UPDATE `employeelist` SET empSal = '".$staffSal."' where empId = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['succStaffChg'] = TRUE;
				$_SESSION['staffID'] = $id;
			}
			else{
				$_SESSION['succStaffChg'] = FALSE;
				$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		    	$_SESSION['staffID'] = $id;
			}
		}
	
 		die(header("Location: staffDisplay.php")); 
	}
	if(isset($_POST['updateStaffLogin'])){
		include 'mysql-init.php';
		$id = $_POST['staffId'];
		//$_SESSION['empLoginId'] = $id;
		$name = $_POST['usrName'];
		$passwd = $_POST['passwd'];
		$passwdConfirm = $_POST['confirmPasswd'];
		
		if($passwd != $passwdConfirm){
			$_SESSION['succLoginCre'] = FALSE;
		    $_SESSION['staffID'] = $id;
			$_SESSION['reason'] = "Passwords Don't Match";
			die(header("Location: staffPage.php"));
		}
		
		$sql = "UPDATE `employeelogin` SET empUserName = '".$name."' where empId = ".$id;	
		$result1 = mysqli_query($conn, $sql);
		$sql = "UPDATE `employeelogin` SET passwd = '".$passwd."' where empId = ".$id;	
		$result2 = mysqli_query($conn, $sql);
		if($result1 && $result2){
			$_SESSION['succLoginCre'] = TRUE;
			$_SESSION['staffID'] = $id;
			$_SESSION['empLoginUsr'] = $name;
		}
		else{
			$_SESSION['succLoginCre'] = FALSE;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		   	$_SESSION['staffID'] = $id;
		}
		die(header("Location: staffPage.php"));	
	}
?>