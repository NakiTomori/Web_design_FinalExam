<?php session_start();
    if(!isset($_SESSION['Username'])){
        header("location:login.php");
    }
    elseif($_SESSION['Usertype'] == "User"){
        session_destroy();
        header("location:login.php");
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
        $racename = $date = "";
        $error = "";
        $noti = "";
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
                    $noti = "Adding Successful";
                    $user = "root";
                    $password = "";
                    $dbName = "hanoimarathon";
                    $host = "localhost:3306";
                    $data = mysqli_connect($host,$user,$password,$dbName);
    
                    $sql = "INSERT INTO marathon(RaceName, Date)
                            VALUES ('$racename', '$date');";
    
                    $result=mysqli_query($data,$sql);
                }
            }
        }
    ?>
    <div class = "content">       
        <center>
            <h1>Marathon Race Add</h1>
            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" class = "race_add_form">
                        <div>
                            <label class="label_race_add">Race Name</label>
                            <input type="text" name="racename">
                        </div>

                        <div>
                            <label class="label_race_add">Date</label>
                            <input type="date" name="date">
                        </div><br>

                        <div>
                            <input class = "btn btn-info" type="submit" name="submit" value="Add">
                            <a href="marathonlist.php" class = "btn btn-secondary">Back</a>
                        </div>
                        <?php if($error != ""){?>
                            <p class="text-light fw-bold btn-danger"><span><?php echo $error;?></span></p>
                        <?php }?>
                        <?php if($noti != ""){?>
                            <p class="text-ligt fw-bold btn-success"><span><?php echo $noti;?></span></p>
                        <?php }?> 
                </form>
            </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>