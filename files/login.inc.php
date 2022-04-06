<?php
session_start();

if(isset($_POST['submit'])){
	require 'dbh.inc.php';

	$email = $_POST['emailname'];
	$password = $_POST['password'];

	$_SESSION['username'] = $email;
	if(empty($email) || empty($password)){
		header("Location: ../login.php?error=emptyfields");
		exit();
	}else{
		$sql = "SELECT * FROM user WHERE Name = ? OR Email = ?; ";
		$stmt = mysqli_stmt_init($conn);
		//if the database does not run
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../login.php?error=sqlerror");
			exit();
		}else{
			//in this line we are trying to pass the information that user gave to us to the database
			//there is two email so if the user want to login with his or her they can do with and if they want to do it with email they can do that as well;
			//we added double s because it checks two thing in this line see the line 11
			mysqli_stmt_bind_param($stmt,'ss', $email, $email);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);
			// checking if we have any result from the database
			if($row = mysqli_fetch_assoc($result)){
				//this line will change the password from hash and checks if the password matches or not
				$pwd_check = password_verify($password, $row['Password']);
				if($pwd_check == false){
					header("Location: ../login.php?error=wrongpassword");
					exit();
				}else if($pwd_check == true){
					session_start();
					$_SESSION['ID'] = $row['ID'];
					$_SESSION['username'] = $row['Name'];
					$_SESSION['logged'] = true;
//to the main page
					header("Location: ../index.php?login=success");
					exit();
				}else{
					header("Location: ../login.php?error=nouser");
					exit();
				}
			}else{
				header("Location: ../login.php?error=nouser");
				exit();
			}
		}
	}
}else{
	header("Location: ../index.php");
	exit();
}