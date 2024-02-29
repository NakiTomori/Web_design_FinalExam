<?php
    session_start();

    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    if($_GET['race_id']){
        $raceid=$_GET['race_id'];

        $sql="DELETE FROM marathon WHERE ID = '$raceid' ";
        $result=mysqli_query($data,$sql);

        if($result){
            $_SESSION['message'] = 'Delete Successful';
            header("location:marathonlist.php");
        }
    }
?>