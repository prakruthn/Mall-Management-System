<?php
	
	if(!isset($_POST['submit'])){
		die(header("Location: ../html/homePage.html"));
	}
	
	if(isset($_POST['logout'])){
		$_SESSION['logout'] = TRUE;
		die(header("Location: .homePageCustomerLogin.php"));
		session_destroy();
	}

	session_start();

	$userId = $_POST['userId'];
	$passwd = $_POST['passwd'];
	$errflag = NULL;
	//$errmsg_arr[] = NULL;
	
	if($userId == '') {
		$errmsg_arr['usrPasswdMissing'] = 'UserID or Password missing';
		$errflag = true;
	}
	if($passwd == '') {
		$errmsg_arr['usrPasswdMissing'] = 'UserID or Password missing';
		$errflag = true;
	}
	
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr['usrPasswdMissing'];
		session_write_close();
		die(header("Location: homePageCustomerLogin.php"));
		exit();
	}
	
	include 'mysql-init.php';
	
	$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	if (!$conn) {
 	   die("Access Denied Contact Technical Officer: " . mysqli_connect_error());
	}
	$sql = "SELECT userId, passwd FROM CustomerList";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    	while($row = mysqli_fetch_assoc($result)) {
    		if(isset($userId) && isset($passwd)){
    			if(($row['userId'] == $userId) && ($row['passwd'] == $passwd)) {
    				$_SESSION['SUCCESS-LOGIN'] = TRUE;
					$_SESSION['userId'] = $userId;
    				die(header("Location: homePageCustomerLogin.php"));
				}
			}
	    }
		
		$_SESSION['wrongDataFlag'] = TRUE;
		$_SESSION['wrongData'] = "Please Check user name and password";
		die(header("Location: homePageCustomerLogin.php"));
	}
	else {
	   	$noUser = "Please Check user name and password";
		$_SESSION['noUser'] = $noUser;
    			die(header("Location: homePageCustomerLogin.php"));
	}
?>