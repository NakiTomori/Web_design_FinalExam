<?php session_start();
    error_reporting(0);

    if(!isset($_SESSION['Username'])){
        header("location:login.php");
    }
    elseif($_SESSION['Usertype'] == "Admin"){
        session_destroy();
        header("location:login.php");
    }
    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    $usern = $_SESSION['Username'];
    $sql = "SELECT * from usermanager WHERE Username = '$usern' ";
    $result = mysqli_query($data,$sql);

    $info = $result ->fetch_assoc();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\user.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>HIM</title>
</head>
<body background ="img\background_user.jpg" class = "body_deg">
    <nav>
        <label class="logo">HIM</label>
        <ul>
            <li><a href="userhome.php">Home</a></li>
            <li><a href="user_profile.php" class = "btn btn-info">Profile</a></li>
            <li><a href="user_race_join.php" class = "btn btn-info">Join</a></li>
            <li><a href="user_race_check.php" class = "btn btn-info">Check</a></li>
            <li><a href="logout.php" class = "btn btn-primary">Logout</a></li>
        </ul>
    </nav>
    
    <center>
        <div style= "padding-top: 100px;">
            <center class = "title_profile">
                <div>Profile</div>
                <div>
                    <?php
                    if($_SESSION['message']){
                        echo $_SESSION['message'];
                    }
                    unset($_SESSION['message']);
                    ?>
                </div>
            </center>
            <form action="#" method = "POST" class = "updateform">
                    <div>
                        <label class="label_profile">Name: </label>
                        <label class="label_profile"><?php echo "{$info['Name']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Best Record: </label>
                        <label class="label_profile"><?php echo "{$info['BestRecord']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Nationality: </label>
                        <label class="label_profile"><?php echo "{$info['Nationality']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Passport NO: </label>
                        <label class="label_profile"><?php echo "{$info['PassportNO']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Sex: </label>
                        <label class="label_profile"><?php echo "{$info['Sex']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Age: </label>
                        <label class="label_profile"><?php echo "{$info['Age']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Email: </label>
                        <label class="label_profile"><?php echo "{$info['Email']}";?></label>
                    </div>
                    
                    <div>
                        <label class="label_profile">Phone: </label>
                        <label class="label_profile"><?php echo "{$info['Phone']}";?></label>
                    </div>

                    <div>
                        <label class="label_profile">Address: </label>
                        <label class="label_profile"><?php echo "{$info['Address']}";?></label>
                    </div>
                    
                    <div>
                        <a href="user_profile_edit.php" class = "btn btn-primary">Update</a>
                    </div>
            </form>
        </div>
    </center>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>