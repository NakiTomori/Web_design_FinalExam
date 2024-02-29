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

    $id1 = $_GET['user_id'];
    $id2 = $_GET['race_id'];
    $sql = "SELECT * FROM participate WHERE UserID = '$id1' AND MarathonID = '$id2' ";
    $result = mysqli_query($data,$sql);
    $info = $result ->fetch_assoc();

    $error = "";
    if(isset($_POST['update'])){
        $entryno = $_POST['entryno'];
        $hotel = $_POST['hotel'];
        $timerecord = $_POST['timerecord'];
        $standings = $_POST['standings'];
        if(empty($entryno)||empty($hotel)||empty($timerecord)||empty($standings)){
            $error = "You need to fill in all the fields";
        }
        else{
            $query = "UPDATE participate SET EntryNO = '$entryno', Hotel = '$hotel', TimeRecord = '$timerecord', Standings = '$standings' WHERE UserID = '$id1' AND MarathonID = '$id2' ";
            $result2 = mysqli_query($data,$query); 
            if($result2){
                $_SESSION['message']='Update Successful';
                header("location:admin_participatelist.php");
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
    <div class = "content">       
        <center>
            <h1>Participate Update</h1>
            <div>
                <form action="#" method = "POST" class = "race_add_form">
                        <div>
                            <label class="label_race_add">Marathon ID</label>
                            <input type="text" name="marathonid" value="<?php echo "{$info['MarathonID']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">UserID</label>
                            <input type="text" name="userid" value="<?php echo "{$info['UserID']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">Entry NO</label>
                            <input type="text" name="entryno" value="<?php echo "{$info['EntryNO']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">Hotel</label>
                            <input type="text" name="hotel" value="<?php echo "{$info['Hotel']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">Time Record</label>
                            <input type="text" name="timerecord" value="<?php echo "{$info['TimeRecord']}";?>">
                        </div>

                        <div>
                            <label class="label_race_add">Standings</label>
                            <input type="text" name="standings" value="<?php echo "{$info['Standings']}";?>">
                        </div>

                        <div>
                            <input class = "btn btn-info" type="submit" name="update" value="Update">
                            <a href="admin_participatelist.php" class = "btn btn-secondary">Back</a>
                        </div>
                        <?php if($error != ""){?>
                            <p class="text-light fw-bold btn-danger"><span><?php echo $error;?></span></p>
                        <?php }?>
                </form>
            </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>