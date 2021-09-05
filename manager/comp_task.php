<?php include("../config.php");
 include("m_header.php"); ?>

<div class="container bg-cont">
    <h2 class="h">المهام المنجزة</h2>
    <?php
    $id=$_SESSION['id_employee'];
    $task=mysqli_query($conn,"SELECT * FROM task where manager_id='$id' && status='2'  ORDER BY `task`.`id_task` DESC"); 
        
    if(mysqli_num_rows($task)>0){
        foreach($task as $row){?>
        <div class="box">
            <div class="task">
                <div class="right-task">
                    <p class="blue-blood">:اسم الوظف</p>
                    <?php
                    $id_emp = $row['id_employee'];
                    $query =mysqli_query($conn,"select full_name FROM employee where id_employee='$id_emp'");
                    foreach($query as $full_name){
                        echo $full_name['full_name'];
                    }
                    ?>
                    <br><br>
                    <p class="blue-blood">:اسم المهمة</p>
                    <?php echo $row['name_task'];?>

                    <br><br>
                    <p class="blue-blood">: وصف المهمة </p>
                    <?php echo $row['description'];?><br><br>
                </div>

                <div class="left-task">
                    <p class="blue-blood"> النقاط :
                    <span style="color: black;"><?php echo $row['point_max'];?></span></p>
                    <br>

                    <p class="blue-blood">: تاريخ انتهاء المهمة</p>
                    <?php echo $row['end_date']; ?><br><br><!-- اشيلها ولا لا -->
                    <a href="evalute_task.php?id_task=<?php echo $row['id_task'];?>" class="a-btn">التقييم</a>
                    <br><br>
                </div>

            </div>
        </div>
        <?php
        }
    }else{ ?>
        <div class="box">
            <h3 style="text-align: center;">لم يصلك اية مهام </h3>
        </div>
    <?php
    } ?>
</div>

<div class="container bg-cont">
        <h2 class="h">المهام المقيمة</h2>
        <?php
        $id2=$_SESSION['id_employee'];
        $task2=mysqli_query($conn,"SELECT * FROM task where manager_id='$id2' && status='3'  ORDER BY `task`.`id_task` DESC");
        
        if(mysqli_num_rows($task2)>0){
            foreach($task2 as $row2){?>
            <div class="box">
                <div class="task">
                
                    <div class="right-task">
                        <div style="float: right;   width:50%;">
                            <p class="blue-blood" style="padding-bottom: 5px;">:اسم الوظف</p>
                            <p>
                                <?php
                                $id_emp2 = $row2['id_employee'];
                                $query2 =mysqli_query($conn,"select full_name FROM employee where id_employee='$id_emp2'");
                                foreach($query2 as $full_name2){
                                    echo $full_name2['full_name'];
                                }
                                ?>
                            </p>
                        </div>
                        <div style="float: left; width:40%;">
                            <p class="blue-blood" style="padding-bottom: 5px;">: اسم المهمة</p>
                            <p><?php echo $row2['name_task']; ?></p>
                        </div>
                    </div>

                    <div class="left-task">
                        <br>
                        <p class="blue-blood"> النقاط المكتسبة : 
                        <span style="color: black;"><?php echo $row2['point_max'] ." / ".$row2['earned_point'];?> </span>
                        </p>
                        
                        
                    </div>
                </div>
            </div>
        <?php
            }
        }else{
            ?>
            <div class="box">
                <h3 style="text-align: center;">لم تقيم اي مهام </h3>
            </div>
            <?php
        } ?>
</div>

<div class="container bg-cont">
        <h2 class="h">المهام المتعثره</h2>
        <?php
        $id2=$_SESSION['id_employee'];
        $task2=mysqli_query($conn,"SELECT * FROM task where manager_id='$id2' && status='4'  ORDER BY `task`.`id_task` DESC");
        
        if(mysqli_num_rows($task2)>0){
            foreach($task2 as $row2){?>
            <div class="box">
                <div class="task">
                
                    <div class="right-task">
                        <div style="float: right; width:50%;">
                            <p class="blue-blood" style="padding-bottom: 5px;">:اسم الوظف</p>
                            <p>
                                <?php
                                $id_emp2 = $row2['id_employee'];
                                $query2 =mysqli_query($conn,"select full_name FROM employee where id_employee='$id_emp2'");
                                foreach($query2 as $full_name2){
                                    echo $full_name2['full_name'];
                                }
                                ?>
                            </p>
                        </div>
                        <div style="float: left; width:40%;">
                            <p class="blue-blood" style="padding-bottom: 5px;">: اسم المهمة</p>
                            <p><?php echo $row2['name_task']; ?></p>
                        </div>
                    </div>

                    <div class="left-task">
                        <br>
                        <p class="blue-blood"> النقاط المكتسبة : 
                        <span style="color:black;"><?php echo $row2['point_max'] ." / ".$row2['earned_point'];?></span>
                        </p>
                        
                        
                    </div>
                </div>
            </div>
        <?php
            }
        }else{
            ?>
            <div class="box">
                <h3 style="text-align: center;">لاتوجد مهام متعثره</h3>
            </div>
            <?php
        } ?>
</div>



<?php include("../footer.php");?>