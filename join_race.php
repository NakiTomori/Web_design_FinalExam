<?php
    session_start();

    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    $userid=$_GET['user_id'];
    $raceid=$_GET['race_id'];

    $sql="SELECT  FROM usermanager WHERE ID = '$userid' ";
    $sql = "INSERT INTO participate(MarathonID, UserID)
                            VALUES ('$raceid', '$userid');";
    $result=mysqli_query($data,$sql);

    if($result){
        $_SESSION['message'] = 'Join Successful';
        header("location:user_race_join.php");
    }
?>