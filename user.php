<?php
    include 'header.php';
?>
<body>
    <div class="container">
        <br></br>
    <div class="row">
        <div class="col">
            <img class="" src="img/user.png" class="news1"/>
        </div>
        <div class="col">
            <div>
                <h3>User Information</h3>
                <?php
                include('config.php');
                if(!isset($_SESSION['user'])){
                    header("location:signin.php");
                }
                else{
                    $username = $_SESSION['user'];
                    $query  = "SELECT * FROM users where username = '$username'";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                        $data = array($row["username"],$row["fName"],$row["lName"],$row["accountCreation"],$row["lastLogin"], $row["role"]);
                    }
                    echo "<strong>Username:</strong>&ensp;         $data[0]<br></br>";
                    echo "<strong>First Name:</strong>&ensp;       $data[1]<br></br>";
                    echo "<strong>Last Name:</strong>&ensp;        $data[2]<br></br>";
                    echo "<strong>Account Creation:</strong>&ensp; $data[3]<br></br>";
                    echo "<strong>Last Login:</strong>&ensp;       $data[4]<br></br>";
                    echo "<strong>Role:</strong>&ensp;             $data[5]<br></br>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>
</html>