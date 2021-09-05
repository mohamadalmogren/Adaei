<?php include("../config.php"); 
    include("a_header.php");
    $id_department= $_GET['id_department'];
    $qry=mysqli_query($conn,"SELECT * from department WHERE id_department='$id_department'");
    foreach($qry as $row){
        $arr=explode(", ",$row['employee_ids']);
        $id_manager=$row['manager_id'];
    }

    if(isset($_POST['update'])){
        $id_department=$_POST['id_department'];
        $name=$_POST['name'];
        $manager_id = implode(', ', $_POST['manager_id']);
        $employee_ids = implode(', ', $_POST['employee_ids']);
    
        $qry="UPDATE department set name='$name', manager_id='$manager_id', employee_ids='$employee_ids' where id_department='$id_department'";
        if(mysqli_query($conn, $qry)){
            header("Location: department.php");
            die;
        }else {
            echo"not updated!";
        }
    }

    ?>
    <div class="container bg-cont add-contianer">
        <div class="add">
            <h2>اعضاء القسم الحالين</h2>
            <br>
            <?php 
                $query=mysqli_query($conn,"select * from employee where id_employee='$id_manager'");
                $data=mysqli_fetch_array($query);
                $manager_name=$data['full_name'];
                
                echo "<b>مدير القسم : </b>".$manager_name;
            ?><br>
            <select class="input-fild">
            <option disabled selected >-- موظفين القسم --</option>
            <?php
                foreach($arr as $id_employee){
                    $result=$conn->query("SELECT * from employee where id_employee='$id_employee'");
                    
                    while($row=$result->fetch_assoc()):?>
                        <option value="<?php echo $row["id_employee"];?>"><?php echo $row['full_name'];?></option>
                    <?php endwhile;
                }
            ?>
            </select>
        </div>
    </div>
    <div class="container bg-cont add-contianer">
        <div class="box" style="text-align: center;">
            <h2>تعديل القسم</h2><br>
            <form action="" method="post">
                <input type="hidden" name="id_department" value="<?php echo $id_department; ?>">
                <input type="text" class="input-fild" name="name" placeholder=" اسم القسم الجديد" required>     
                <br><br>
                <select name="manager_id[]" class="input-fild multiple-select" required>
                    <option disabled selected>اختر اسم المدير</option>
                    <?php
                        $qry=mysqli_query($conn,"select * from employee where is_manager=1");
                        if(mysqli_num_rows($qry)>0){
                            foreach($qry as $row){
                                ?>
                                <option value="<?php echo $row['id_employee']?>">
                                    <?php echo $row['full_name'];?>
                                </option>
                                <?php
                            }
                        }else{
                            echo "<option disabled selected>no managers</option>";
                        }
                    ?>
                </select>
                <br><br>
                <select name="employee_ids[]" class="input-fild multiple-select2"  multiple required>
                    <?php
                        $query="select * from employee where is_manager=0";
                        $query_run=mysqli_query($conn,$query);
                        if(mysqli_num_rows($query_run)>0){
                            foreach($query_run as $row){
                                ?>
                                <option value="<?php echo $row['id_employee']?>">
                                    <?php echo $row['full_name'];?>
                                </option>
                                <?php
                            }
                        }else{
                            echo"no record found";
                        }
                    ?>    
                </select>
                <br><br>
                <input type="submit" name="update" class="btn" value="تعديل القسم" onclick="return confirm('هل انت متاكد من تعديل القسم؟')">

            </form>                
        </div>
    </div>

<?php include("../footer.php"); ?>

<script>
    $(document).ready(function(){
        $(".multiple-select2").select2({
                placeholder: "اختر الموظفين", //placeholder
                tags: true,
                tokenSeparators: ['/',',',';'," "] 
            });
    })
</script>