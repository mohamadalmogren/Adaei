<?php   include ("../config.php");
    
    $id_task=$_GET['id_task'];
    $comp_task="UPDATE task  SET status=2 where id_task='$id_task'";
    if(mysqli_query($conn,$comp_task)){
        header("Location: task.php");
        die;

    }else{
        echo"not compledted";
    } 
?>