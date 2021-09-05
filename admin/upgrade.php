<?php include ("../config.php");

    $id_employee=$_POST['upgrade'];

    $query="update employee set is_manager=1 where id_employee='$id_employee'";
    if(mysqli_query($conn,$query)){
        header("Location: up-down.php");
        die;
    }else {
        echo"not downgrade!";
    }
?>