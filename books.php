<?php
session_start();
?>
<html>
    <head>
        <title>Books</title>
        
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
        
        <link rel="stylesheet" type="text/css" href="css/book.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        
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
        
        <h2>Books</h2>
        
        <nav class='nav'>
            <a href="index.php"><button class="news">News<br><i class="fa fa-newspaper"></i></button></a>
            <a href='complain.php'><button class="complain">Complain<br><i class='fa fa-pen'></i></button></a>
            <a href='books.php'><button class="book">Books<br><i class="fa fa-book"></i></button></a>
        </nav>
        
        <main>
            <p>Class:</p>
            <button class="class">1</button>
            <button class='class'>2</button>
            <button class='class'>3</button>
            <button class='class'>4</button>
            <button class='class'>5</button>
            <button class='class'>6</button>
            <button class='class'>7</button>
            <button class='class'>8</button>
            <button class='class'>9</button>
            <button class='class'>10</button>
            <button class='class'>11</button>
            <button class='class'>12</button>
        </main>
    </body>
</html>