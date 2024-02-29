<?php
    session_start();

    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    if($_GET['user_id']){
        $userid=$_GET['user_id'];

        $sql="DELETE FROM usermanager WHERE ID = '$userid' ";
        $result=mysqli_query($data,$sql);

        if($result){
            $_SESSION['message'] = 'Delete Successful';
            header("location:admin_userlist.php");
        }
    }
?>