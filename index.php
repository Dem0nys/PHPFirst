<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once("style.php") ?>
    <title>Document</title>
</head>
<body>
<?php include_once("navbar.php") ?>
<div class="container">
<table class="table table-dark">
    <tr>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Image</th>
    </tr>
    <?php
    $connection = mysqli_connect('localhost', 'lomi', 'Qwerty-1', 'lomick');
    $sql = "SELECT Email, Password, Image FROM tbl_users";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'. $row['Email'] .'</td>';
            echo '<td>'. $row['Password'] .'</td>';
            echo '<td><img style="border-radius: 50%; height: 100px;width: 100px;" src="image/'.$row['Image'].'"></img></td>';
            echo '</tr>';
        }
    }
    ?>
</table>
</div>
<?php include_once("scripts.php") ?>
</body>
</html>
