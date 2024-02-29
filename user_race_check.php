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
    $sql = "SELECT * from usermanager where Username = '$usern' ";
    $result = mysqli_query($data,$sql);
    $info = $result ->fetch_assoc();

    $query = "SELECT * from participate where UserID = '{$info['ID']}' ";
    $result2 = mysqli_query($data,$query);
    $info2 = $result2 ->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\user.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body  background ="img\background_user.jpg" class = "body_deg">
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
    <div>
        <h2>ádsadasdas</h2>
    </div><br>  
    <center style = "background-color: wheat; font-size:20px;">
            <?php
                if($_SESSION['message']){
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
            ?>
    </center>
    <div>
        <div class = "img_table_check">
        <table id = "bootstrapdatatable" class="table table-striped table-bordered" width = "100%" style = "background-color: wheat;">
            <tr>
                <th>Race ID</th>
                <th>Race Name</th>
                <th>Date</th>
                <th>Cancel</th>
            </tr>
            <?php
                while($info2 = $result2 ->fetch_assoc()){
                    $omg = "SELECT * from marathon where ID = '{$info2['MarathonID']}' ";
                    $result3 = mysqli_query($data,$omg);
                    $info3 = $result3 ->fetch_assoc();
            ?>
            <tr>
                <td style="width: 80px;">
                    <?php echo "{$info2['MarathonID']}";?>
                </td>
                <td>
                    <?php echo "{$info3['RaceName']}";?>
                </td>
                <td>
                    <?php echo "{$info3['Date']}";?>
                </td>
                <td>
                    <?php echo "<a onClick=\"javascript:return confirm('Do you sure to cancel this race ?');\" href = 'cancel_race.php?race_id={$info3['ID']} && user_id={$info['ID']}' class = 'btn btn-info'>Cancel</a>";?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>