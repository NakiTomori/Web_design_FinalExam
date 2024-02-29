<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login Form</title>
</head>
<body background="img\background_login.jpg" class = "body_deg">
    <?php
        error_reporting(0);
        $err = "";
        $user = "root";
        $password = "";
        $dbName = "hanoimarathon";
        $host = "localhost:3306";
        $data = mysqli_connect($host,$user,$password,$dbName);

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["username"])||empty($_POST["password"])){
                $err = "You need to fill in all the fields";
            }
            else{
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM usermanager WHERE username='".$username."' AND 
                        password = '".$password."' ";
                $result = mysqli_query($data,$sql);
                $row = mysqli_fetch_array($result);
                if($row["Usertype"]=="Admin"){
                    $_SESSION['Username'] = $username;
                    $_SESSION['Usertype'] = "Admin";
                    header("location:adminhome.php");
                }
                elseif($row["Usertype"]=="User"){
                    $_SESSION['Username'] = $username;
                    $_SESSION['Usertype'] = "User";
                    header("location:userhome.php");
                }
                else{
                    $err = "Username or Password doesn't exist";
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
            <center class = "title_deg">Login</center>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" class = "login_form">
                    <div>
                        <label class="label_login">Username</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                        <label class="label_login">Password</label>
                        <input type="Password" name="password">
                    </div>
                    <div>
                        <input class = "btn btn-success" type="submit" name="submit" value="Login">
                    </div>
                    <a href="register_form.php" class = "text-info">Don't have account yet?</a>
                    <?php if($err!= ""){?>
                        <p class="text-light fw-bold btn-danger"><span><?php echo $err;?></span></p>
                    <?php }?>
            </form>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>