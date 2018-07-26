<?php

	session_start();
	if(isset($_POST['updateStoreLogin'])){
		include 'mysql-init.php';
		$id = $_POST['storeId'];
		//$_SESSION['empLoginId'] = $id;
		$name = $_POST['usrName'];
		$passwd = $_POST['passwd'];
		$passwdConfirm = $_POST['confirmPasswd'];
		
		if($passwd != $passwdConfirm){
			$_SESSION['succLoginStoreCre'] = FALSE;
		    $_SESSION['storeID'] = $id;
			$_SESSION['reason'] = "Passwords Don't Match";
			die(header("Location: strPage.php"));
		}
		
		$sql = "UPDATE `managerlist` SET userId = '".$name."' where storeId = ".$id;	
		$result1 = mysqli_query($conn, $sql);
		$sql = "UPDATE `managerlist` SET passwd = '".$passwd."' where storeId = ".$id;	
		$result2 = mysqli_query($conn, $sql);
		if($result1 && $result2){
			$_SESSION['succLoginStoreCre'] = TRUE;
			$_SESSION['storeID'] = $id;
			$_SESSION['empLoginStore'] = $name;
		}
		else{
			$_SESSION['succLoginCreStore'] = FALSE;
			$_SESSION['reason'] = "Due to ".mysqli_error($conn);
		   	$_SESSION['storeID'] = $id;
		}
		die(header("Location: strPage.php"));	
	}
?>