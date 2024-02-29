<?php
    $user = "root";
    $password = "";
    $dbName = "hanoimarathon";
    $host = "localhost:3306";
    $data = mysqli_connect($host,$user,$password,$dbName);

    $sql = "SELECT * from marathon";

    $result = mysqli_query($data,$sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css\style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hanoi International Marathon</title>
</head>
<body background="img\background_base.jpg" class = "body_deg">
    <nav>
        <label class="logo">HIM</label>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>

    <div class="picture">
        <label class="img_text">Welcome to Hanoi International Marathon</label>
        <label class = "img_table">
            <center><h3>Race List</h3></center>
            <table id = "bootstrapdatatable" class="table table-striped table-bordered" width = "100%">
                <tr>
                    <th>ID</th>
                    <th>Race Name</th>
                    <th>Date</th>
                </tr>
                <?php
                    while($info = $result ->fetch_assoc()){
                ?>
                <tr>
                    <td style="width: 50px;">
                        <?php echo "{$info['ID']}";?>
                    </td>
                    <td>
                        <?php echo "{$info['RaceName']}";?>
                    </td>
                    <td>
                        <?php echo "{$info['Date']}";?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </label>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>