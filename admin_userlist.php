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

    $sql = "SELECT * from usermanager WHERE ID NOT LIKE '0'";

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
            <h1>User List</h1>

            <?php
                if($_SESSION['message']){
                    echo $_SESSION['message'];
                }

                unset($_SESSION['message']);
            ?>
        </center><br>
        
        <table id = "bootstrapdatatable" class="table table-striped table-bordered" width = "100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Best Record</th>
                <th>Nationality</th>
                <th>Passport NO</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Delete</th>
            </tr>
            <?php
                while($info = $result ->fetch_assoc()){
            ?>
            <tr>
                <td style="width: 50px;">
                    <?php echo "{$info['ID']}";?>
                </td>
                <td>
                    <?php echo "{$info['Name']}";?>
                </td>
                <td>
                    <?php echo "{$info['BestRecord']}";?>
                </td>
                <td>
                    <?php echo "{$info['Nationality']}";?>
                </td>
                <td>
                    <?php echo "{$info['PassportNO']}";?>
                </td>
                <td>
                    <?php echo "{$info['Sex']}";?>
                </td>
                <td>
                    <?php echo "{$info['Age']}";?>
                </td>
                <td>
                    <?php echo "{$info['Email']}";?>
                </td>
                <td>
                    <?php echo "{$info['Phone']}";?>
                </td>
                <td>
                    <?php echo "{$info['Address']}";?>
                </td>
                <td>
                    <?php echo "<a onClick=\"javascript:return confirm('ARE YOU SURE TO DELETE THIS USER???');\" href = 'user_delete.php?user_id={$info['ID']}' class = 'btn btn-danger'>Delete</a>";?>
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