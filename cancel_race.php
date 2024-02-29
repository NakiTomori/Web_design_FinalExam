<?php
    session_start();

    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    $id1 = $_GET['user_id'];
    $id2 = $_GET['race_id'];

    $sql="DELETE FROM participate WHERE UserID = '$id1' AND MarathonID = '$id2' ";
    $result=mysqli_query($data,$sql);

    if($result){
        $_SESSION['message'] = 'Cancel Successful';
        header("location:user_race_check.php");
    }
?>