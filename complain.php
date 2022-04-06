<?php
session_start();

require 'files/dbh.inc.php';

$email = 'user';

if(isset($_POST['submit-button'])){

	$subject = $_POST['subject'];
	$text = $_POST['complain'];
    $name = $_POST['name'];
    
	if (!empty($subject) && !empty($text)) {
		$sql = "INSERT INTO complain(UserName,UserEmail,Complain,Subject)
		VALUES('$username','$email','$text','$name')";
        
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('Your complaint sent')</script>";
        }else{
            mysqli_error($conn);
        }
        
        
	}else if(empty($subject) || empty($text) && empty($subject) && empty($text)){
		echo 'Please fill all of these inputs';
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Complain</title>
        <meta charset='utf-8'/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/brands.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/regular.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/solid.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/svg-with-js.min.css"/>
        <link rel="stylesheet" href="fontawesome/css/v4-shims.min.css"/>
        
        <link rel="stylesheet" type="text/css" href="css/complains.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <style>
        </style>
    </head>
    <body>
        <header class="header">
            <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
                echo "<a href='login.php'><button type='button' class='login' name='login'>Login</button></a>
                <a href='signup.php'><button type='button' class='signup' name='signup'>Sign up</button></a>";
            }else if(isset($_SESISON['logged']) || $_SESSION['logged'] == true){
                
                $username = $_SESSION['username'];
                echo "<p style='font-size:20px'>Welcome ".$username.'</p>';

                echo "<form action='files/logout.php'>
                <button type='submit' class='logout' title='logout'>Logout</button>
                </form>";
            }
            ?>
        </header>
        
        <h2>Complain</h2>
        
        <nav class='nav'>
            <a href="index.php"><button class="news">News<br><i class="fa fa-newspaper"></i></button></a>
            <a href='complain.php'><button class="complain">Complain<br><i class='fa fa-pen'></i></button></a>
            <a href='books.php'><button class="book">Books<br><i class="fa fa-book"></i></button></a>
        </nav>
        <main>
            <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
                echo "<p><br><br>Please Login/Sign up to send a complain<p/>";
            }else if(isset($_SESSION['logged']) || $_SESSION['logged'] == true){
                echo "
                <div><form method='post'>
                <input type='text' class='subject' placeholder='Subject:' name = 'subject'>
                <input type='text' class='who' placeholder='To who:' name='name'>
                <textarea placeholder='Write your complain here:' class='complain-text' name='complain'></textarea>
                <br><br><button type='submit' class='submit' name='submit-button'>Send</button>
                </form></div>";
            }
            ?>
        </main>
    </body>
</html>