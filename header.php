<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/all.css"/>
<link rel="shortcut icon" type="image/jpg" href="img/colts.ico"/>
<title>Main Page</title>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
        <a href="./mainpage.php"><img class="nav-link" src="img/icon.png"></img>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./mainpage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./user.php">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./admin.php">Admin</a>
        </li>
        <?php
            session_start();
            if(!isset($_SESSION['user'])){
                echo <<< SIGNIN
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Sign In</a>
                    </li>
                SIGNIN;
            }
            else{
                echo <<< SIGNOUT
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Sign Out</a>
                    </li>
                SIGNOUT;
            }
        ?>
        </ul>
    </div>
</nav>