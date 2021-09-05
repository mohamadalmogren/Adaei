<!-- employee header -->
<?php
    include("../config.php");
    session_start();
    $idemployee=$_SESSION['id_employee'];
    $querry=mysqli_query($conn,"select full_name from employee where id_employee='$idemployee'");
    $d=mysqli_fetch_array($querry);
    $fullname=$d['full_name'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أدائي</title>
    <link rel="stylesheet" href="../css/style.css">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <div class="big-container">

        <div class="right-page">
            <div id="sidebar">
                <header><a href="../employee/task.php">أدائي</a></header>
                <header><i class="fas fa-user"></i><?php echo " ".$fullname;?></header>
                <ul>
                    <li><a href="../employee/task.php">المهام</a></li>
                    <li><a href="../employee/evaluation.php">التقيم</a></li>
                    <li><a href="../employee/leaderboard.php">لائحة المتصدرين</a></li>
                    <li><a href="../employee/about.php">حول الموقع</a></li>
                    <li><a href="../login-sginup/signout.php">تسجيل الخروج</a></li>
                </ul>
            </div> 
        </div>
    <div class="left-page">
