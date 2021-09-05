<?php include ("../config.php");

    $id_task= $_GET['id_task'];
    $query="DELETE FROM task WHERE id_task= '$id_task'";
    if(mysqli_query($conn,$query)){
        header("Location: M_task.php");
        die;

    }else{
        echo "not deleted!!";
    }
?>