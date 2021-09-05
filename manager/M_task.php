<?php include("../config.php");
include("m_header.php");
date_default_timezone_set('Asia/Riyadh');
?>
<div class="container bg-cont">

    <h2 class="h"> المهام المرسلة </h2>
    <br>
    <hr>
    <?php 
        $id=$_SESSION ['id_employee'];
        $task=mysqli_query($conn, "SELECT * FROM task where manager_id='$id' && status='0' OR manager_id='$id' && status='1' ORDER BY task. id_task DESC ");
        if(mysqli_num_rows($task)>0){
            $now = strtotime('now');  
            foreach($task as $row){

                $id_task=$row['id_task'];
                $end_date=$row['end_date'];
                $start_date=$row['start_date'];
                
                if( $start_date < date('Y-m-d h:i:s',$now)){ // if date greater than start_date change status to '1' 
                    mysqli_query($conn,"UPDATE task  SET status=1 where id_task='$id_task'");
                     
                }
                if($end_date < date('Y-m-d h:i:s',$now)){ // if date less than end_date change status to '4'
                    mysqli_query($conn,"UPDATE task  SET status=4 where id_task='$id_task'");                      
                }
                ?>
                <div class="box">
                    <div class="task">
                        <div class="right-task">
                            <p class="blue-blood">: اسم الموظف</p>
                            <?php 
                                $id_emp= $row['id_employee'];
                                $query=mysqli_query($conn,"select full_name from employee where id_employee='$id_emp'");
                                $full_name=mysqli_fetch_array($query);
                                echo  $full_name['full_name'];
                            ?>
                            <br><br>
                            <p class="blue-blood">: اسم المهمة</p>
                            <?php echo $row['name_task'] ; ?><br>
                            <br>
                            <p class="blue-blood">:الوصف </p>
                            <?php echo $row['description'];?>
                        </div>
                        <div class="left-task ">
                            <p class="blue-blood"> النقاط :
                            <span style="color: black;"><?php echo $row['point_max'];?></span>
                            </p>
                            <br>

                            <p class="blue-blood">:بداية المهمة </p>
                            <?php echo $row['start_date']; ?><br>
                            <p class="blue-blood" style="padding-top:10px ;">:نهاية المهمة</p>
                            <?php echo $row['end_date']; ?>
                            <br>
                            <a href="edit_task.php?id_task=<?php echo $row['id_task']?>" class="a-btn" style="float: left; width: 49%;"> تعديل</a>
                            <a href="delete_task.php?id_task= <?php echo $row['id_task']?>" class="a-btn" style="float: right; width:49%;" onclick="return  confirm('هل تريد حذف المهمة؟')">حذف</a>
                            <br><br>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else{
        ?>
        <div class="box">
        <h3>لا يوجد لديك اية مهام مرسلة حاليا</h3>
        </div>

        <?php
         } ?>
</div>
<?php include("../footer.php");?>
