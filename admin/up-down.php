<?php include("../config.php");?>

<?php include("a_header.php");?>

<div class="container bg-cont" style="width: 55%;">
    <h2 class="blue-blood">ادارة المدراء</h2>
    
    <br>
    <div class="box" style="  text-align: center; width: 65%; margin:auto;">
        <h3 class="blue-blood">الترقيه الى مدير</h3>
        <br><br>
        <form action="upgrade.php" method="post">
            <select name="upgrade" class="input-fild">
                <option disabled selected>اختر اسم الموظف</option>
                <?php
                    $resultset = $conn->query("SELECT * from employee where is_manager=0 order by full_name asc");
                    while($row= $resultset->fetch_assoc()):
                        $full_name=$row['full_name'];
                        $id_employee=$row['id_employee'];
                ?>
                <option value="<?php echo $id_employee ?>" >
                    <?php echo $full_name;?>
                </option>

                <?php endwhile; ?>
            </select>
        <br><br>
            <input type="submit" class="btn" value="ترقية">
        </form>
    </div>

    <br><br>
    <?php
        $managers = $conn->query("SELECT *,concat(full_name) as name FROM employee 
                                    where is_manager=1 order by concat(full_name) asc ");
        while($row= $managers->fetch_assoc()):?>
        <div class="box">
            <div class="task">
                <form action="" method="post">
                    <div class="right-task">
                        <p class="blue-blood"> :اسم المدير</p>
                            <p><?php echo ucwords($row['full_name']) ?></p>
                    </div>
                    <div class="left-task">
                        <br>
                        <a href="downgrade.php?id_employee=<?php echo $row['id_employee']?>" class="a-btn" onclick="return  confirm('هل تريد إزالة ترقية المدير؟')">إزالة المدير </a>   
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
</div>

<?php include("../footer.php");?>
