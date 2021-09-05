<?php include("../config.php"); 
include("m_header.php");


if($_SERVER['REQUEST_METHOD'] == "POST") // انشاء مهمة جديدة
{
    $manager_id = $_SESSION['id_employee'];
    
	$id_employee = $_POST['id_employee'];
	$name_task = $_POST['name_task'];
	$point_max = $_POST['point_max'];
	$description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    

    $quary="insert into task (manager_id, id_employee, name_task, point_max, description, start_date, end_date) values('$manager_id','$id_employee','$name_task','$point_max','$description','$start_date','$end_date')";
    if(mysqli_query($conn,$quary)){
        header("Location: M_task.php");
    }else{
        echo "erorr";
    }
    
}

?>
    <div class="container add-contianer">
    <div class="add">
        <h2 class="h">:إنشاء مهمة</h2>
        <br>
        <form action="add.php" method="POST">

            <select name="id_employee" class="input-fild" required>
                <option disabled selected>--اختر اسم الموظف--</option>
                <?php 
                    $id=$_SESSION['id_employee'];
                    $data=mysqli_query($conn, "SELECT * from department where manager_id='$id'");
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
            
            <input type="datetime-local" class="input-fild"  name="start_date" id="" required>
            <br><br>
                    
            <p>: وقت نهاية المهمة</p>
            <input type="datetime-local" class="input-fild" name="end_date" id="" required>
            <br><br>

            <textarea name="description" class="input-fild " cols="30" rows="10" placeholder="وصف المهمه" required></textarea>
            <br><br>
            
            <input type="submit" class="btn" value="إرسال المهمة">
          
        </form>
    </div>
</div>
<?php include("../footer.php");?>

<script>

    function split_at_index(value, index){
        return value.substring(0, index) + "," + value.substring(index);
    }

    var today = new Date().toISOString();
    var now=split_at_index(today,16);

    document.getElementsByName("start_date")[0].setAttribute('min', now.split(',')[0]);
    document.getElementsByName("end_date")[0].setAttribute('min', now.split(',')[0]);
     
</script>