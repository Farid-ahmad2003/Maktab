<?php
session_start();

if(isset($_GET['error'])){
    if($_GET['error'] == "emptyfields"){
        echo "<p>Fill in all fields!</p>";
    }else if($_GET['error'] == "wrongpassword"){
        echo "<p>Try again</p>";
    }else if($_GET['error'] == "nouser"){
        echo "<p>No user</p>";
    }else if($_GET['error'] == "sqlerror"){
        echo "<p>Something is wrong please try again later</p>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style>
            .back{
                width: 40%;
                height: 30px;
                transition: 0.4s;
                cursor: pointer;
                border: 1px solid white;
                border-radius: 5px;
                outline: none;
                margin: 5px;
            }.back:hover{
                color: white;
                background-color: black;
            }a{
                color: black;
            }
        </style>
    </head>
    <body>
        <header>
            <h2>Login</h2>
        </header>
        <main>  
            <form method='post' action="files/login.inc.php">
                <input type='text' name="emailname" class="email" placeholder="  Email/Username"/>
                <input type='password' name="password" class="password" placeholder="  Password"/>
                <button type="submit" name="submit" class="button">Login</button>
            </form>
        </main>
        
        <footer>
            <a href='index.php'><button class="back">Back</button></a><br>
            <a href="#">Forgot Password</a>,
            <a href="aboutme.html">About the developer</a>
        </footer>
    </body>
</html>