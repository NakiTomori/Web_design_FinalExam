<?php session_start();
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

    $sql = "SELECT * from marathon";

    $result = mysqli_query($data,$sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\user.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>HIM</title>
</head>
<body>
    <nav>
        <label class="logo">HIM</label>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="user_profile.php" class = "btn btn-info">Profile</a></li>
            <li><a href="user_race_join.php" class = "btn btn-info">Join</a></li>
            <li><a href="user_race_check.php" class = "btn btn-info">Check</a></li>
            <li><a href="logout.php" class = "btn btn-primary">Logout</a></li>
        </ul>
    </nav>
    
    <div class="picture">
        <label class = "img_table">
            <center><h3>Race List</h3></center>
            <table id = "bootstrapdatatable" class="table table-striped table-bordered" width = "100%">
                <tr>
                    <th>ID</th>
                    <th>Race Name</th>
                    <th>Date</th>
                </tr>
                <?php
                    while($info = $result ->fetch_assoc()){
                ?>
                <tr>
                    <td style="width: 50px;">
                        <?php echo "{$info['ID']}";?>
                    </td>
                    <td>
                        <?php echo "{$info['RaceName']}";?>
                    </td>
                    <td>
                        <?php echo "{$info['Date']}";?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </label>
        <img class="base_img" src="img\background_user.jpg">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>