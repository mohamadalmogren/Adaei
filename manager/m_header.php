<!-- manager header -->
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
    <div class="big-continer">
        
        <div class="right-page">
            <div id="sidebar">
                
                <header><a href="../manager/M_task.php">أدائي</a></header>
                <header><i class="fas fa-user"></i><?php echo " ".$fullname;?></header>
                <ul>
                    <li><a href="../manager/M_task.php">المهام المرسلة</a></li>
                    <li><a href="../manager/comp_task.php">المهام المنجزة</a></li>
                    <li><a href="../manager/add.php">إنشاء مهمة</a></li>
                    <li><a href="../manager/leaderboard.php">لائحة المتصدرين</a></li>
                    <li><a href="../manager/about.php">حول الموقع</a></li>
                    <li><a href="../login-sginup/signout.php">تسجيل الخروج</a></li>
                </ul>
            </div> 
        </div>
        <!-- للجزء اليسار في الصفحه التي تحتوي على كل شي ماعدا السايد بار -->

    <div class="left-page">