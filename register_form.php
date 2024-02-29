<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register Form</title>
</head>
<body background="img\background_login.jpg" class = "body_deg">
    <?php
        error_reporting(0);
        $username = $email = $name = $password1 = $password2 = "";
        $error = "";
        $noti = "";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["username"])||empty($_POST["password1"])||empty($_POST["password2"])||empty($_POST["email"])||empty($_POST["name"])){
                $error = "You need to fill in all the fields";
            }
            else{
                $username = $_POST["username"];
                $email = $_POST["email"];
                $name = $_POST["name"];
                $password1 = $_POST["password1"];
                $password2 = $_POST["password2"];

                $user = "root";
                $password = "";
                $dbName = "hanoimarathon";
                $host = "localhost:3306";
                $data = mysqli_connect($host,$user,$password,$dbName);
                $query = "SELECT * FROM usermanager WHERE Username ='$username'";
                $result2 = mysqli_query($data,$query);
                $info = $result2 ->fetch_assoc();

                if(preg_match("/[^a-z0-9 _]+$/i", $username)){
                    $error = "No special characters in username";
                }
                elseif((preg_match("/[^a-z _]+$/i", $name))){
                    $error = "No special characters in name";
                }
                elseif($username == "admin"){
                    $error = "Something went wrong";
                }
                elseif($password2 != $password1){
                    $error = "Wrong re-enter password";
                }
                elseif($info == true){
                    $error = "This Username Already Exist";
                }
                else{
                    $noti = "Register success, please login";
                    $sql = "INSERT INTO usermanager(Username, Password, Name, Email)
                            VALUES ('$username', '$password1', '$name', '$email');";

                    $result=mysqli_query($data,$sql);
                }      
            }
        }
    ?>
    <nav>
        <label class="logo">HIM</label>
        <ul>
            <li><a href="home.php">Home</a></li>
        </ul>
    </nav>
    <center>
        <div class = "form_deg">
            <center class = "title_deg">Register</center>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" class = "registerform">
                    <div>
                        <label class="label_login">Username</label>
                        <input type="text" name="username">
                    </div>

                    <div>
                        <label class="label_login">Name</label>
                        <input type="text" name="name">
                    </div>

                    <div>
                        <label class="label_login">Email</label>
                        <input type="email" name="email">
                    </div>

                    <div>
                        <label class="label_login">Password</label>
                        <input type="Password" name="password1">
                    </div>
                    <div>
                        <label class="label_login">Re-enter Password</label>
                        <input type="Password" name="password2">
                    </div>
                    <div>
                        <input class = "btn btn-primary" type="submit" name="submit" value="Submit">
                    </div><br>
                    <a href="login.php" class = "text-info">Already have account?</a>
                    <?php if($error != ""){?>
                        <p class="text-light fw-bold btn-danger"><span><?php echo $error;?></span></p>
                    <?php }?>
                    <?php if($noti != ""){?>
                        <p class="text-ligt fw-bold btn-success"><span><?php echo $noti;?></span></p>
                    <?php }?> 
            </form>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>