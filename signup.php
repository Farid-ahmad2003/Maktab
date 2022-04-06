<?php
session_start();

if(isset($_GET['error'])){
    if($_GET['error'] == "emptyfields"){
        echo "Fill in all fields!";
    }else if($_GET['error'] == "invalidmail"){
        echo "Invalid Mail";
    }else if($_GET['error'] == 'invalidusername'){
        echo "Invalid Username";
    }else if($_GET['error'] == "passwordcheck"){
        echo "Your passwords doesn't match";
    }else if($_GET['error'] == "sqlerror"){
        echo "Something is wrong please try again later";
    }
//    else if($_GET['error'] == "usertaken"){
//        echo "Username is already taken";
//    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <link rel="stylesheet" type='text/css' href="css/signupstyle.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
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
            <h2>Sign up</h2>
        </header>
        <main>
            <form method="post" action="files/signup.inc.php">
                
                <input  type='text' name='sign-email' class="email" placeholder='  Email'/>
                <input type="text" name="sign-name" class="name" placeholder="  Username"/>
                <input type="password" name="sign-password" class="password" placeholder="  Password"/>
                <input type="password" name="sign-repassword" class="password" placeholder="  Repeat Password"/>

                <button type="submit" name='sign-submit' class="button">Sign up</button>
                <br>
                
                <footer>
                    <a href='index.php'><button class="back">Back</button></a><br>
                    <a href="aboutme.html">About the developer</a>
                </footer>
            </form>
        </main>
    </body>
</html>