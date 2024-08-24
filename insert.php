<?php

include("connection.php");

// else {
//     echo "database connect successfully";
//     }


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    

    $hobbies = $_POST['hobbies'];
    $hobbies_s = implode(', ', $hobbies);
    

    // echo ($hobbies);


    $experience = $_POST['experience'];


    $filename = $_FILES["upload"]["name"];
    $tempname = $_FILES["upload"]["tmp_name"];
    $folder = "images/" . $filename;

    move_uploaded_file($tempname, $folder);



    // echo '<pre>';
    // print_r($hobbies);
    // die();


    $stmt = $conn->prepare("INSERT INTO employee_details (name, email, number, gender, address, hobbies, experience, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $number, $gender, $address, $hobbies_s, $experience, $folder);

    if ($stmt->execute()) {
        header("Location: " . "fetch_data.php");
        exit();
    } else {
        echo "not";
    }
    $stmt->close();
}
?>