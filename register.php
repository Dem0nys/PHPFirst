<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $email = $_POST["email"];
    $password = $_POST['password'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        $error="Занадто слабкий пароль";
    }else{
        $error="";
        $error1="";
        $user = "lomi";
        $pass = "Qwerty-1";
        $dbh = new PDO('mysql:host=localhost;dbname=lomick', $user, $pass);
        $stmt = $dbh->query("SELECT * FROM `tbl_users`");
        while ($row = $stmt->fetch()) {
            if($row['Email']==$email){
                $error="Данний юзер вже зареєстрований";
            }
            //echo $row['email']."<br />\n";
        }


        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "image/".$filename;
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $error1= "Image uploaded successfully";
        }else{
            $error1= "Failed to upload image";
        }
        if($error=="")
        {

            $sql = "INSERT INTO `tbl_users` (`email`, `password`, `image`) VALUES (?, ?, ?);";
            $stmt= $dbh->prepare($sql);
            $stmt->execute([$email, $password, $filename]);
            header("Location:  index.php");
            exit();
        }
        //echo "<script>alert('POST JS".$email."'); </script>";
    }
}
else{
    $email="";
    $password="";
    $error="";
    $error1="";
}
?>
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
    <div class="row">
        <h1 class="col-12 text-center">Реєстрація</h1>
    </div>
    <div class="row">
        <form class="col-12 " action="register.php" method="post" enctype="multipart/form-data">
            <label class="offset-3 col-6 " style="color: #ff0000"><?php echo $error ?></label>
            <div class="offset-3 col-6 form-group">
                <label for="email">Електронна пошта</label>
                <input required type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" aria-describedby="emailHelp">
            </div>
            <div class="offset-3 col-6 form-group">
                <label for="password">Пароль</label>
                <input required type="password" value="<?php echo $password ?>" class="form-control" id="password" name="password">
            </div>
            <div class="offset-3 col-6 form-group">
                <label class="offset-3 col-6 " style="color: red"><?php echo $error1 ?></label>
                <label class="col-6 ">Select Image File:</label>
                <input required type="file" name="image" id="image"/>
            </div>
            <div class="offset-3 form-group form-check">
                <input required type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Перевірочка</label>
            </div>

            <button type="submit" class="offset-8 btn btn-primary">Реєстрація</button>
        </form>
    </div>
</div>

<?php include_once("scripts.php") ?>
</body>
</html>