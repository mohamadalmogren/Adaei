<?php include ("../config.php");

    $id_department= $_GET['id_department'];
    $query="DELETE FROM department WHERE id_department= '$id_department'";
    if(mysqli_query($conn,$query)){
        header("Location: department.php");
        die;

    }else{
        echo "not deleted!!";
    }
?>