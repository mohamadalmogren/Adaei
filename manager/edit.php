<!-- edit task -->
<?php
    include ("../config.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id_task=$_POST['id_task'];
        $id_employee = $_POST['id_employee'];
        $name_task = $_POST['name_task'];
        $point_max = $_POST['point_max'];
        $end_date = $_POST['end_date'];
        $description = $_POST['description'];
        
        $query="UPDATE task SET id_employee='$id_employee',  name_task='$name_task', description='$description', point_max='$point_max', end_date='$end_date' where id_task='$id_task'";
        if(mysqli_query($conn,$query)){
            echo "confirm";
            header("Location: M_task.php");
            die;
        }else{
            echo "error";
        }
    }

?>