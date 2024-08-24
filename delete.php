<?php

include("connection.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "DELETE FROM `employee_details` WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result){
        header("Location: " . "fetch_data.php");
    }else{
        echo "failed to delete" . mysqli_error($conn);
    }
}
else{
    header("Location: " . "fetch_data.php");
}





?>