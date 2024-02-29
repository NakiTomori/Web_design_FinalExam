<?php session_start();
    error_reporting(0);

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

    $sql = "SELECT * from participate";

    $result = mysqli_query($data,$sql);

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
        <center style = "font-size:20px;">
            <h1>Participate List</h1>

            <?php
                if($_SESSION['message']){
                    echo $_SESSION['message'];
                }

                unset($_SESSION['message']);
            ?>
        </center>
        
        <table id = "bootstrapdatatable" class="table table-striped table-bordered" width = "100%">
            <tr>
                <th>Race ID</th>
                <th>User ID</th>
                <th>Entry NO</th>
                <th>Hotel</th>
                <th>Time Record</th>
                <th>Standings</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
                while($info = $result ->fetch_assoc()){
            ?>
            <tr>
                <td style="width: 50px;">
                    <?php echo "{$info['MarathonID']}";?>
                </td>
                <td>
                    <?php echo "{$info['UserID']}";?>
                </td>
                <td>
                    <?php echo "{$info['EntryNO']}";?>
                </td>
                <td>
                    <?php echo "{$info['Hotel']}";?>
                </td>
                <td>
                    <?php echo "{$info['TimeRecord']}";?>
                </td>
                <td>
                    <?php echo "{$info['Standings']}";?>
                </td>
                <td>
                    <?php echo "<a onClick=\"javascript:return confirm('ARE YOU SURE TO DELETE THIS PARTICIPATE???');\" href = 'participate_delete.php?race_id={$info['MarathonID']} && user_id={$info['UserID']}' class = 'btn btn-danger'>Delete</a>";?>
                </td>
                <td>
                    <?php echo "<a href = 'participate_update.php?race_id={$info['MarathonID']} && user_id={$info['UserID']}' class = 'btn btn-info'>Update</a>";?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>