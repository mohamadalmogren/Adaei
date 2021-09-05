<?php   include ("../config.php");

    $id_employee= $_GET['id_employee'];
    $query="update employee set is_manager=0 where id_employee='$id_employee'";
    if(mysqli_query($conn,$query)){
        header("Location: up-down.php");
        die;
        
    }else{
        echo "not downgraded!!";
    }
?>