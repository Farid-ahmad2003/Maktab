<?php
session_start();

require 'files/dbh.inc.php';

//if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
//	header("Location: index.php?login");
//	exit();
//}

//the above code is preventing the site from wroking

if (isset($_POST['upload-button'])) {

	$input = $_POST['post-input'];
	$input_err = "<p>Please write something and try again</p>";
	$name = $_SESSION['username'];
if(empty($input)){
	echo "Write something and try again!";

}if (strlen($input) > 500) {
	echo 'Your news must be less than 500 words';
}elseif(!empty($input) /* && $fileSize === 0*/){
	$sql = "INSERT INTO news(Name, News)
		VALUES('$name','$input')";
	if(mysqli_query($conn,$sql)){
		echo "Your news uploaded";
	}else{
		echo "<p style='color:red;'>Something is wrong please try again later</p>";
        // .mysqli_error($conn)
	}
}
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>News</title>
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

         <!-- Css files -->
         <link rel="stylesheet" type="text/css" href="css/News.css">
         <link rel="stylesheet" type="text/css" href="css/main.css">
        <style>
            .post-input{
                border: 1px solid wheat;
                min-height: 100px; 
            }
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
                <button type='submit' class='logout' title='logout' id='logout' onclick='logoutalert()'>Logout</button>
                </form>";
                
                if ($_SESSION['ID'] == 1){
                    echo "
                    <form method='post' enctype='multipart/form-data'>
                    <p style='font-size: 13px'>500 words</p>
                    <textarea class='post-input' name='post-input' id='input' placeholder='Write here'></textarea><br>
                    <button class='post-button' id='upload-button' name='upload-button'>Post</button><br>
                    </form>";
                }
            }
            ?>
        </header>
        <p id="alert" onclick="displayalert()">*To see news please login/signup <o style='color:red;cursor:pointer;'>(remove)</o></p>
        <h2>News</h2>
        <nav class='nav'>
            <a href="index.php"><button class="news">News<br><i class="fa fa-newspaper"></i></button></a>
            <a href='complain.php'><button class="complain">Complain<br><i class='fa fa-pen'></i></button></a>
            <a href='books.php'><button class="book">Books<br><i class="fa fa-book"></i></button></a>
        </nav>
        <main>

            <div class="news-div">
                <?php
                $code = 'SELECT * FROM news ORDER BY DATE DESC';
                $result = mysqli_query($conn,$code);
                if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        // $userId = $_SESSION['ID'] = $row['ID'];
                        $newsId = $_SESSION['NewsID'] = $row['ID'];
                        if(isset($_SESSION['logged'])){
                            $farid = $_SESSION['ID'] == 1;
                        if ($farid) {
                            echo "
                            <center><div class = 'userDiv'>
                            <form method='post'><button id='edit-button' name='delete-post'>Delete post</button></form>
                            <p class='User-Name'>".$row["Name"]."</p>
                            <p class='Post-date'>".$row['Date']."</p>
                            <p class='News-p'>".$row['News']."</p>
                            </div></center>";
                            
                            if (isset($_POST['delete-post'])) {
                                $delete_post_sql = "DELETE FROM news WHERE news.ID = '$newsId'";
                                if (mysqli_query($conn,$delete_post_sql)) {
                                    echo "<script>alert('Deleted')</script>";
                                }else{
                                    echo "Error: ".mysqli_error($conn);
                                }
                            }
                            //the above code deletes the news
                        }
                            if(isset($_SESSION['logged']) !== $farid) {
                            echo "
                            <center><div class = 'userDiv'>
                            <p class='User-Name'>".$row["Name"]."</p>
                            <p class='Post-date'>".$row['Date']."</p>
                            <p class='News-p'>".$row['News']."</p>
                            </div></center>";
                        }
                        }else{
                        }
                    }
                }
                
                ?>
            </div>
        </main>
        <script>
            
            function logoutalert(){
                var con = confirm('You logged out');
            }
            function displayalert(){
                var alr = document.getElementById('alert').style.display = 'none';
            }
        </script>
    </body>
</html>