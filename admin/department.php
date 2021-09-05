<?php if(!isset($conn)){ include '../config.php'; } ?>

<?php include("a_header.php");?>
<style>

</style>
<div class="container bg-cont" style="width: 70%;">
    <h2 class="blue-blood">ادارة الاقسام</h2>
    <br>
    <div class="box" style="  text-align: center; width: 65%; margin:auto;">
        <h3 class="blue-blood">انشاء قسم</h3>

        <br>
        <form action="create_dept.php" method="post">
            <input type="text" class="input-fild" name="name" placeholder="اسم القسم" required>     
            <br><br>
            <select name="manager_id[]" class="input-fild multiple-select" required>
                <option disabled selected>اختر اسم المدير</option>
                <?php
                    $query="select * from employee where is_manager=1";
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
                        echo "<option disabled selected>لايوجد مديرين</option>";
                    }
                ?>
            </select>

            <br><br>
            <select name="employee_ids[]" class="input-fild multiple-select2 "   multiple required>
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

            <input type="submit" class="btn" style="width: 90%;" value="إنشاء">
        </form>
    </div>
    <br><br>
    

    <?php
        $department=$conn->query("SELECT * FROM `department` ORDER BY `department`.`id_department` DESC");
        while($row=$department->fetch_assoc()):?>
        <div class="box">
            <div class="task">
                <div class="right-task">
                    <div style="float: right;   width:50%;">
                        <p class="blue-blood"> :اسم القسم </p>
                            <span style="color: black;"><?php echo $row['name']; ?></span>
                        <br>
                        <p class="blue-blood">:اسم المدير</p>
                        <?php 
                            $manager_id=$row['manager_id'];
                            
                            $qry1=mysqli_query($conn,"SELECT full_name from employee where id_employee='$manager_id'");
                            $data=mysqli_fetch_array($qry1);
                            $name_manager=$data['full_name'];
                            echo $name_manager;
                        ?>
                        <br>
                    </div>
                    <div style="float: left; width:40%;">
                        <p class="blue-blood">:اسماء الموظفين</p>
                        
                        <?php 

                            $id_department= $row['id_department'];
                            $qry=mysqli_query($conn,"SELECT * from department WHERE id_department='$id_department'");
                            foreach($qry as $roww){
                                $arr=explode(", ",$roww['employee_ids']);
                                
                            }
                        ?> 
                        <select class="input-fild" style="width: 80%;">
                            <option disabled selected>اسماء الموظفين</option>
                            <?php
                                foreach($arr as $id_employee){
                                    $result=$conn->query("SELECT * from employee where id_employee='$id_employee'");
                                    
                                    while($row1=$result->fetch_assoc()):?>
                                        <option value="<?php echo $row1["id_employee"];?>"><?php echo $row1['full_name'];?></option>
                                        <?php endwhile;
                                } 
                            ?>
                        </select>
                    </div>
                    
                </div>

                <div class="left-task">
                <br>
                <a href="edit_dept.php?id_department= <?php echo $row['id_department']?>" class="a-btn ">تعديل</a>
                <br><br> 
                <a href="delete_dept.php?id_department= <?php echo $row['id_department']?>" class="a-btn" 
                onclick="return  confirm('هل تريد حذف القسم؟')">حذف</a>
                <br><br>
                </div>
            </div>
        </div>
    <?php endwhile;?>

</div>

<?php include("../footer.php");?>

<script>
        $(document).ready(function(){
            $(".multiple-select").select2({
                    placeholder: "اختر المدراء", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "] 
                });
            })
    </script>
    
    <script>
        $(document).ready(function(){
            $(".multiple-select2").select2({
                    placeholder: "اختر الموظفين", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "] 
                });
            })
    </script>