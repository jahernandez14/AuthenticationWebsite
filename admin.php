<?php
    include 'header.php';
?>
<body>
        <?php
            if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
                header("location:signin.php");
            }
            else{
                echo <<< CREATEUSER
                    <div class="container">
                    <h1 class="title">Create User</h1>
                    <form action="admin.php" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="fName" name="fName">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="lName" name="lName">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select type= "text" class="form-control" id = "role" name = "role">
                                <option>admin</option>
                                <option>user</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name= "password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                CREATEUSER;
                include("config.php");
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = mysqli_real_escape_string($conn,$_POST['username']);
                    $fName = mysqli_real_escape_string($conn,$_POST['fName']);
                    $lName = mysqli_real_escape_string($conn,$_POST['lName']);
                    $role = mysqli_real_escape_string($conn,$_POST['role']);
                    date_default_timezone_set('America/Denver');
                    $time = date('Y-m-d')." ".date("h:i:sa");
                    $password = mysqli_real_escape_string($conn,$_POST['password']);

                    $salt = [
                        'salt' => "qjtgaoisdjfoiasjfdoiasdf", 
                        'cost' => 10
                    ];

                    $password = password_hash($password, PASSWORD_DEFAULT, $salt);
                    $query  = "SELECT * FROM users where username = '$username'";
                    $result = $conn->query($query);
                    $count = mysqli_num_rows($result);

                    if($count < 1){
                        $query = "INSERT INTO users VALUES ('$fName','$lName','$username','$role','$time','','$password');";
                        $result = $conn->query($query);
                        
                        if ($result){
                            echo "<h5 class='text-center'>User created successfully.</h5>";
                        } 
                        else {
                            echo "Error, user not added";
                        }
                        mysqli_close($conn);
                    }
                    else{
                        echo "<h5 class='text-center'>User already exists!</h5>";
                    }
                }
                echo <<< TABLE
                <br></br>
                <h2 class = "text-center">User List</h2>
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Account Creation Date</th>
                        <th scope="col">Last Login Date</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                    <tbody>
                TABLE;
                include("config.php");

                $query  = "SELECT * FROM users";
                $result = $conn->query($query);
                $table = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $data = array($row["username"],$row["fName"],$row["lName"],$row["accountCreation"],$row["lastLogin"], $row["role"]);
                        array_push($table,$data);
                    }
                }   
                $i = 0;
                while($i < count($table)){
                    echo '<tr>';
                    echo '<td>' . $table[$i][0] . '</td>';
                    echo '<td>' . $table[$i][1] . '</td>';
                    echo '<td>' . $table[$i][2] . '</td>';
                    echo '<td>' . $table[$i][3] . '</td>';
                    echo '<td>' . $table[$i][4] . '</td>';
                    echo '<td>' . $table[$i][5] . '</td>';
                    echo '</tr>';
                    $i++;
                }
                echo <<< TABLEB
                </tbody>
                </table>
                TABLEB;
            }
        ?>
    </div>
</body>
</html>