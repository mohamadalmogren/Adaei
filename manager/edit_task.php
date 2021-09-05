<?php include ("../config.php"); 
include ("m_header.php");
?>


<!-- task information -->
<div class="container bg-cont add-contianer">
    <div class="add">
        <h2 class="h"> : معلومات المهمة الحالية</h2>
        <br>
        <?php 
            $id_task=$_GET['id_task'];
            $query=mysqli_query($conn,"select * from task where id_task='$id_task'");
            foreach($query as $row){
                $id_emp=$row['id_employee'];
                $full_name=mysqli_query($conn,"select full_name from employee where id_employee='$id_emp'");
                $data=mysqli_fetch_array($full_name);
                ?>

                <p class="blue-blood">: اسم الموظف
                <br>
                <span style="color: black;"><?php echo $data['full_name']; ?></span>
                </p>

                <p class="blue-blood">: اسم المهمة
                <br>
                <span style="color: black;"><?php echo $row['name_task']; ?></span>
                </p>

                <p class="blue-blood">: الوصف
                <br>
                <span style="color: black;"><?php echo $row['description']; ?></span>
                </p>

                <p class="blue-blood">: النقاط
                <br>
                <span style="color: black;"><?php echo  $row['point_max']; ?></span>
                </p>

                <p class="blue-blood"> بداية المهمة
                <span style="color: black;"><?php echo $row['start_date']; ?></span>
                </p>
                <br>
                <p class="blue-blood"> نهاية المهمة
                <span style="color: black;"><?php echo $row['end_date']; ?></span>
                </p>
                <?php

            }
        ?>
    </div>
</div>

<div class="container bg-cont add-contianer" style="margin-top: 1px;">
        <div class="add">
            <h2 class="h">:تعديل المهمة</h2>
            <br>
            <form action="edit.php" method="POST">
                <input type="hidden" name="id_task" value="<?php echo $id_task ?>">
                <select name="id_employee" class="input-fild" required>
                    <option disabled selected>--اختر اسم الموظف--</option>
                    <?php 
                        $id_man=$_SESSION['id_employee'];
                        $data=mysqli_query($conn, "SELECT * from department where manager_id='$id_man'");
                        foreach($data as $row){
                            $arr=explode(", ",$row['employee_ids']);
                        }
                        foreach($arr as $id_employee){
                            $result=$conn->query("SELECT * from employee where id_employee='$id_employee'");
                            
                            while($row=$result->fetch_assoc()):?>
                                <option value="<?php echo $row["id_employee"];?>"><?php echo $row['full_name'];?></option>
                            <?php endwhile;
                        }?>
                </select>
                <br><br>

                <input type="text" name="name_task" class="input-fild" placeholder="أسم المهمة " required>
                <br><br>

                <input type="number" name="point_max" class="input-fild" min="1" max="10" placeholder="عدد النقاط" required>
                <br><br>

                <p>: وقت بداية المهمة</p>
                <input type="datetime-local" class="input-fild" name="start_date" id="" required>
                <br><br>

                <p>: وقت نهاية المهمة</p>
                <input type="datetime-local" class="input-fild" name="end_date" id="" required>
                <br><br>

                <textarea name="description" class="input-fild " cols="30" rows="10" placeholder="وصف المهمه" required></textarea>
                <br><br>
                
                <input type="submit" name="edit" class="btn" value="تعديل المهمة">
            
            </form>
        </div>
    </div>

<script>

    function split_at_index(value, index){
        return value.substring(0, index) + "," + value.substring(index);
        }

    var today = new Date().toISOString();
    var now=split_at_index(today,16);

    document.getElementsByName("start_date")[0].setAttribute('min', now.split(',')[0]);
    document.getElementsByName("end_date")[0].setAttribute('min', now.split(',')[0]);
</script>

<?php include("../footer.php");?>