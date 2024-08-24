<!-- 
include("connection.php");

if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];



    $hobbies = $_POST['hobbies'];
    $hobbies_s = implode(', ', $hobbies);



    $experience = $_POST['experience'];



    $image = $_FILES["uploadfile"]["name"];
    $exist = $_POST['existing_image'];

    if (isset($_FILES['uploadfile'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "images/" . ($image);
        if (move_uploaded_file("$tempname", "$folder")) {
            $image = $filename;
        } else {
            $image = $exist;
        }

        // $stmt = $conn->prepare("UPDATE employee_details SET (name, email, number, gender, address, hobbies, experience, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        // $stmt->bind_param("ssssssssi", $name, $email, $number, $gender, $address, $hobbies_s, $experience, $folder, $id);

        // if ($stmt->execute()) {
        //     header("Location: " . "fetch_data.php");
        //     exit();
        // } else {
        //     echo "not";
        // }
        // $stmt->close();



        // Update query with prepared statement

        $sql = "UPDATE employee_details SET name=?, email=?, number=?, gender=?, address=?, hobbies=?, experience=?, image=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi",  $name, $email, $number, $gender, $address, $hobbies_s, $experience, $folder, $id);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to show.php with the id to see the updated data

            header("Location: fetch_data.php?id=$id");

            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
} -->



<?php
include('connection.php');
// echo "<pre>";
// var_dump($_POST);
// die();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

    $id = $_POST['id'];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $hobbies = $_POST['hobbies'];
    $hobbies_s = implode(', ', $hobbies);


    $experience = $_POST['experience'];
    
    $image = $_FILES["upload"]["name"];

    $query = "SELECT * FROM `employee_details` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // echo '<pre>';
    // var_dump($data);
    // die();

    if($image == ""){
     $image = $data['image'];
    }else{
        $filename = $_FILES["upload"]["name"];
        $tempname = $_FILES["upload"]["tmp_name"];
        $image = "images/" . $filename;
        move_uploaded_file($tempname, $image);
    }
  
    // echo '<pre>';
    // var_dump($image);
    // die();


    $stmt = $conn->prepare("UPDATE employee_details SET name = ?, email = ?, number = ?, gender = ?, address = ?, hobbies = ?, experience = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $name, $email, $number, $gender, $address, $hobbies_s, $experience, $image, $id);

    if ($stmt->execute()) {
        //  echo "Record updated successfully.";
        $stmt->close();
        $conn->close();
        header("Location: " . "fetch_data.php?id=$id");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

}
?>