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

    if(isset($_POST['update'])){
        $error = "";
        $name = $_POST['name'];
        $bestrecord = $_POST['bestrecord'];
        $nationality = $_POST['nationality'];
        $passportno = $_POST['passportno'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        if(empty($name)||empty($bestrecord)||empty($nationality)||empty($passportno)||empty($sex)||empty($age)||empty($email)||empty($phone)||empty($address)){
            $error = "You need to fill in all the fields";
        }
        elseif(preg_match("/[^a-z _]+$/i", $name)){
            $error = "No special characters in name";
        }
        else{
            $query = "UPDATE usermanager SET Name = '$name', BestRecord = '$bestrecord',
                                             Nationality = '$nationality',PassportNO = '$passportno',
                                             Sex = '$sex',Age = '$age',
                                             Email = '$email',Phone = '$phone',
                                             Address = '$address' WHERE ID = '{$info['ID']}'";
            $result2 = mysqli_query($data,$query); 
            if($result){
                $_SESSION['message']='Update Successful';
                header("location:user_profile.php");
            }  
        }
    }
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
            <center class = "title_profile">Edit Profile</center>
            <form action="#" method = "POST" class = "updateform">
                    <div>
                        <label class="label_update">Name</label>
                        <input type="text" name="name" value="<?php echo "{$info['Name']}";?>">
                    </div>

                    <div>
                        <label class="label_update">Best Record</label>
                        <input type="text" name="bestrecord" placeholder="2:30:40" value="<?php echo "{$info['BestRecord']}";?>">
                    </div>

                    <div>
                        <label class="label_update">Nationality</label>
                        <input type="text" name="nationality" value="<?php echo "{$info['Nationality']}";?>">
                    </div>

                    <div>
                        <label class="label_update">Passport NO</label>
                        <input type="text" name="passportno" value="<?php echo "{$info['PassportNO']}";?>">
                    </div>
                    <div>
                        <label class="label_update">Age</label>
                        <input type="age" name="age" value="<?php echo "{$info['Age']}";?>">
                    </div>

                    <div>
                        <label class="label_update">Sex</label>
                        <input type="sex" name="sex" placeholder="male/female/other"  value="<?php echo "{$info['Sex']}";?>">
                    </div>

                    <div>
                        <label class="label_update">Email</label>
                        <input type="email" name="email" value="<?php echo "{$info['Email']}";?>">
                    </div>
                    <div>
                        <label class="label_update">Phone</label>
                        <input type="phone" name="phone" value="<?php echo "{$info['Phone']}";?>">
                    </div>
                    <div>
                        <label class="label_update">Address</label>
                        <input type="text" name="address" value="<?php echo "{$info['Address']}";?>">
                    </div>
                    <div>
                        <input class = "btn btn-primary" type="submit" name="update" value="Update">
                    </div>
                    <?php if($error != ""){?>
                        <p class="text-light fw-bold btn-danger"><span><?php echo $error;?></span></p>
                    <?php }?>
        </div>
    </center>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>