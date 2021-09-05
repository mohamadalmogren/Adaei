<?php if(!isset($conn)){ include '../config.php'; } ?>
<?php include("e_header.php"); 
date_default_timezone_set('Asia/Riyadh');
?>

<div class="container bg-cont">       
    <h2 class="h"> المهام المطلوب تنفيذها </h2>

    <?php
        $id=$_SESSION['id_employee'];
        $task=mysqli_query($conn,"SELECT * FROM task where status='0' ORDER BY `task`.`id_task` DESC");
        foreach($task as $data){

            $id_task=$data['id_task'];
            $start_date=$data['start_date']; 
            $end_date=$data['end_date'];
            $now = strtotime('now');  

            if( $start_date < date('Y-m-d h:i:s',$now)){ // if date greater than start_date change status to '1' 
                mysqli_query($conn,"UPDATE task  SET status=1 where id_task='$id_task'");// trun task from '0' to '1'    
            }
            

        }
    ?>     

    <?php
        $tasks=mysqli_query($conn,"SELECT * FROM task where id_employee='$id' && status='1'  ORDER BY `task`.`id_task` DESC");// اذا عكست السلكت ماراح يشتغل الكود اكتبه بهذي الصيغه تبدا بالسشن ايدي بعدها الطلب 
        
        if(mysqli_num_rows($tasks)>0){
            $now = strtotime('now');  
            foreach($tasks as $row){
                $id_task=$row['id_task'];
                $end_date=$row['end_date'];
                if($end_date < date('Y-m-d h:i:s',$now)){ // if date less than end_date change status to '4'
                    mysqli_query($conn,"UPDATE task  SET status=4 where id_task='$id_task'");                      
                }
                
                ?>
                
                <div class="box">
                    <div class="task">
                        <div  class="left-task">
                            <p class="blue-blood">النقاط:
                                
                                <span style="color: black;"><?php echo $row['point_max'];?> </span>
                            </p>
                            <br>
                            <p class="blue-blood">:النهاية </p>
                            <?php echo $row['end_date']; ?><br>
                            <br>
                            <a href="complete.php?id_task=<?php echo $row['id_task'];?>" class="a-btn" onclick="return  confirm('هل تريد انهاء المهمة؟')">انهاء المهمة</a>
                            <br><br>
                        </div>

                        <div class="right-task">
                            <p class="blue-blood" style="padding-bottom: 5px;">:اسم المهمة</p>
                            <?php echo $row['name_task'] ; ?><br>
                            <br>
                            <p class="blue-blood" style="padding-bottom: 5px;">:الوصف </p>
                            <?php echo $row['description'];?>
                            
                        </div>
                    </div>
                </div>

            <?php
            }
        }else{
            ?>
            <div class="box">
                <h3>ليس لديك مهام </h3>
            </div>
            
            <?php
        }
    ?>
    
</div>

<?php include("../footer.php"); ?>