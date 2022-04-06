<?php
session_start();
//we do not need to close the php tag because it is pure php if we had any html tags we should close the php
if(isset($_POST['sign-submit'])){
	require 'dbh.inc.php';

	$username = $_POST['sign-name'];
	$email = $_POST['sign-email'];
	$password = $_POST['sign-password'];
	$passwordRepeat = $_POST['sign-repassword'];

	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
		//this line will redirect the user if he or she did not filled the input and the code after the question mark will show the value that user had entered in the input before clicking the submit button so the user does not need to write all of them all over agian
		header("Location: ../signup.php?error=emptyfields&username=".$username);
		// we do not do this with password beacues it will be showen at the top of the page
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../index.php?");
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail&username=".$username);
		exit();
	}

	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invalidusername&mail=".$email);
		exit();
	}
	else if ($password !== $passwordRepeat) {
		header("Location: ../signup.php?error=passwordcheck&username=".$username);
		exit();
	}
	else{
		$sql = 'SELECT 	Name FROM user WHERE Name=?';
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s", $username);
			//I should check what this means
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows();
			if($resultCheck > 0){
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				exit();
			}else{
				$sql = "INSERT INTO user(Name, Email, Password) VALUES(?,?,?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../signup.php?error=sqlerror");
					exit();
				}else{
					$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt,"sss", $username,$email,$hashed_pwd);
					//I should check what this means
					mysqli_stmt_execute($stmt);
                    
                    $_SESSION['ID'] = $row['ID'];
					$_SESSION['username'] = $row['Name'];
					$_SESSION['logged'] = true;
					header("Location: ../index.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
    
}else{
	
	header("Location: ../index.php");
	exit();
}