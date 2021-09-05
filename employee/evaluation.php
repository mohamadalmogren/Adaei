<?php if(!isset($conn)){ include '../config.php'; } ?>
<?php include("e_header.php"); ?>


<div class="container bg-cont">
                
    <h2 class="h"> المهام المقيمة </h2>
    <?php
        $id=$_SESSION['id_employee'];
        $task=mysqli_query($conn,"SELECT * FROM task where id_employee='$id' && status='3'  ORDER BY `task`.`id_task` DESC");// اذا عكست السلكت ماراح يشتغل الكود اكتبه بهذي الصيغه تبدا بالسشن ايدي بعدها الطلب 
      
        if(mysqli_num_rows($task)>0){
            foreach($task as $row){?>
                <div class="box">
                    <div class="task">
                        <div class="right-task">
                            <p class="blue-blood">:اسم المهمة</p>
                            <?php echo $row['name_task']; ?><br>
                            <br>
                            <p class="blue-blood">:الوصف </p>
                            <?php echo $row['description'];?>
                        </div>

                        <div class="left-task">
                            <br>
                            <p class="blue-blood">النقاط المستحقة :  
                                <span style="color: black;"><?php echo $row['point_max']. " / ".$row['earned_point'];?></span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }
        }else{
            ?>
            <div class="box">
                <h3 style="text-align: center;">ليس لديك مهام مقيمة </h3>
            </div>
            
            <?php
        }
    ?>
</div>

<?php include("../footer.php"); ?>