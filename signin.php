<?php
    include 'header.php';
?>
<body>
<div class="container">
    <h1 class="title">Sign In</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name= "password"  placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
    include("config.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $enteredUsername = mysqli_real_escape_string($conn,$_POST['username']);
        $enteredPassword = mysqli_real_escape_string($conn,$_POST['password']); 
        date_default_timezone_set('America/Denver');
        $time = date('Y-m-d')." ".date("h:i:sa");

        $query  = "SELECT * FROM users where username = '$enteredUsername'";
        $result = $conn->query($query);
        $password = "";
        $role = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $password = $row["password"];
                $role = $row["role"];
            }
        }                
    
        if(password_verify($enteredPassword, $password)) {
            $query = "UPDATE users SET lastlogin = '$time' WHERE username = '$enteredUsername';";
            mysqli_query($conn, $query);
            mysqli_close($conn);

            $count = mysqli_num_rows($result);
            if($count == 1) {
                $_SESSION['user'] = $enteredUsername;
                $_SESSION['role'] = $role;
                header("location: user.php");
            }
        }
        else {
            echo "<h4 class='text-center'>Login failed invalid username or password </h4>";
        }
    }
?>
</body>
</html>