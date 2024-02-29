<?php session_start();
    if(!isset($_SESSION['Username'])){
        header("location:login.php");
    }
    elseif($_SESSION['Usertype'] == "User"){
        session_destroy();
        header("location:login.php");
    }
    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    $id = $_GET['race_id'];
    $sql = "SELECT * FROM marathon WHERE ID = '$id' ";
    $result = mysqli_query($data,$sql);
    $info = $result ->fetch_assoc();

    if(isset($_POST['update'])){
        $racename = $date = "";
        $error = "";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["racename"])||empty($_POST["date"])){
                $error = "You need to fill in all the fields";
            }
            else{
                $racename = $_POST["racename"];
                $date = $_POST["date"];
                if(preg_match("/[^a-z0-9 _]+$/i", $racename)){
                    $error = "No special characters in name";
                }
                else{
                    $query = "UPDATE marathon SET RaceName = '$racename', Date = '$date' WHERE ID = '$id'";
                    $result2 = mysqli_query($data,$query);
                    if($result2){
                        $_SESSION['message']='Update Successful';
                        header("location:marathonlist.php");
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\admin.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
    <?php
        include 'admin_sidebar.php';
    ?>
    <?php
        error_reporting(0);
    ?>
    <div class = "content">       
        <center>
            <h1>Marathon Race Update</h1>
            <div>
                <form action="#" method = "POST" class = "race_add_form">
                        <div>
                            <label class="label_race_add">Race Name</label>
                            <input type="text" name="racename" value="<?php echo "{$info['RaceName']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">Date</label>
                            <input type="date" name="date" value="<?php echo "{$info['Date']}";?>">
                        </div><br>

                        <div>
                            <input class = "btn btn-info" type="submit" name="update" value="Update">
                            <a href="marathonlist.php" class = "btn btn-secondary">Back</a>
                        </div>
                        <?php if($error != ""){?>
                            <p class="text-light fw-bold btn-danger"><span><?php echo $error;?></span></p>
                        <?php }?>
            </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>