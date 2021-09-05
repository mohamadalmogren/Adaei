<?php include("m_header.php");
      include("../config.php"); 
?>
<?php
$id_task=$_GET['id_task'];
$query=mysqli_query($conn,"select * from task where id_task='$id_task'");
$row=mysqli_fetch_array($query);
$name_task=$row['name_task'];
$id_employee=$row['id_employee'];
if(isset($_POST['submit'])){
    $id_task=$_POST['id_task'];

    $crit1=$_POST['e1'];
    $crit2=$_POST['e2'];
    $crit3=$_POST['e3'];
    $crit4=$_POST['e4'];
    $id_employee=$_POST['id_employee'];

    $qry=mysqli_query($conn,"select point_max from task where id_task='$id_task'");
    $data=mysqli_fetch_array($qry);
    $max_point=$data['point_max'];

    $total=$crit1+$crit2+$crit3+$crit4;
    $result=$total / 20 * $max_point;
    ?>
    <div class="container" style="width: 18%;">
        <div class="box">
            <form action="" method="post">
                <p style="text-align: center;"><b>القيمه النهائية: </b><?php echo $result ?></p>
                <br>
                <input type="hidden" name="id_employee" value="<?php echo $id_employee ?>">
                <input type="hidden" name="id_task" value="<?php echo $id_task ?>">
                <input type="hidden" name="result" value="<?php echo $result ?>">
                <input type="submit" name="final" value="اعتماد" class="btn" style="width: 48%;">
                <input type="submit" name="cancel" value="تغيير" class="btn" style="width: 48%;">
            </form>
        </div>
    </div>
    <?php
}

if(isset($_POST['final'])){
    $id_employee=$_POST['id_employee'];
    $result=$_POST['result'];
    $id_task=$_POST['id_task'];

    $qry1=mysqli_query($conn,"select point from employee where id_employee='$id_employee'");
    $data1=mysqli_fetch_array($qry1);
    $current_point=$data1['point'];

    $point=$current_point + $result;
    
    $leaderboard="update employee set point='$point' where id_employee='$id_employee'";//update point of the employee 
    $earned_point="update task set status=3, earned_point='$result' where id_task='$id_task'"; //update status=3 (evaluated) and store earned_point=result

    if(mysqli_query($conn,$earned_point) && mysqli_query($conn,$leaderboard)){
        header("Location: comp_task.php");
    }else{
        echo "erorr insert";
    }
}
if(isset($_POST['cancel'])){
    header("Refresh:0");
    die;
}
?>
<style>
    p{
        font-size: 20px;
    }
</style>
<div class="container bg-cont add-contianer" style="width: 35%;">
    <div class="add" style="text-align: center; margin:auto;">

        <h2 class="h" style="text-align: center;"><?php echo $name_task; ?></h2>
        <br>
        <form action="" method="POST">
            <p> :اداء الموظف</p>
            <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
            <input type="hidden" name="id_employee" value="<?php echo $id_employee ?>">

            <input type="number" name="e1" class="input-fild" step="0.1" min=0 max=5 placeholder="0 ~ 5" required>
            <br><br>
            <p>:تحسين اسلوب العمل</p>
            <input type="number" name="e2" class="input-fild" step="0.1" min=0 max=5 placeholder="0 ~ 5" required>
            <br><br>
            <p>:معرفة طرق العمل</p>
            <input type="number" name="e3" class="input-fild" step="0.1" min=0 max=5 placeholder="0 ~ 5" required>
            <br><br>
            <p>:رضا المدير</p>
            <input type="number" name="e4" class="input-fild" step="0.1" min=0 max=5 placeholder="0 ~ 5" required>
            <br><br>
            <input type="submit" name="submit" class="btn " value="تقيم">
        </form>
    </div>
</div>
<?php include("../footer.php");?>

