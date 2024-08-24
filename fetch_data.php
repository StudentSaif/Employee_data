<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displaying Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="displaystyle.css">
</head>

<body>
    <div class="container">
        <div class="table-container">
            <div class="title">
                <h1>ALL RECORDS</h1>
            </div>

            <a href="index.php" class="add-new button btn-success btn-md">ADD EMPLOYEE</a>

            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Number</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Hobbies</th>
                        <th>Experience</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    include("connection.php");

                    $query = "SELECT * FROM `employee_details`";
                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['hobbies']; ?></td>
                                <td><?php echo $row['experience']; ?></td>
                                <td>
                                    <?php if ($row['image']) { ?>
                                        <img height="70px" width="50px" src="<?php echo $row['image']; ?>">
                                    <?php } ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm editBtn" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-email="<?php echo $row['email']; ?>" data-number="<?php echo $row['number']; ?>" data-gender="<?php echo $row['gender']; ?>" data-address="<?php echo $row['address']; ?>" data-hobbies="<?php echo $row['hobbies']; ?>" data-experience="<?php echo $row['experience']; ?>" data-image="<?php echo $row['image']; ?>">Edit</button>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <!-- updating the data -->

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Employee Details</h2>
            <form id="updateForm" action="update.php" method="POST" enctype="multipart/form-data">
            
            <!-- <input type="" name="id" value="<?php // echo $row['id']; ?>">
            <input name="existing_image" value="<?php  // echo $row['image']; ?>"> -->

                <input type="hidden" name="id" id="updateId">
                <div class="form-row">
                    <div class="user-box">
                        <label for="name">Name:</label>
                        <input type="text" id="updateName" name="name" required>
                    </div>
                    <div class="user-box">
                        <label for="email">E-mail:</label>
                        <input type="email" id="updateEmail" name="email" required>
                    </div>
                    <div class="user-box">
                        <label for="number">Phone number:</label>
                        <input type="number" id="updateNumber" name="number" required pattern="[0-9]{10}">
                    </div>
                    <div class="user-box">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="updateGender" required>
                            <option value="" disabled selected>Select your Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <div class="user-box">
                        <label for="address">Address:</label>
                        <textarea name="address" id="updateAddress" required></textarea>
                    </div>
                    <div class="user-box">
                        <label for="hobbies">Hobbies:</label><br>
                        <div class="checkbox">
                            <div class="form-group">
                                <input type="checkbox" name="hobbies[]" id="updateReading" value="Reading">
                                <label for="updateReading">Reading</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="updateTraveling" name="hobbies[]" value="Traveling">
                                <label for="updateTraveling">Traveling</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="updateCooking" name="hobbies[]" value="Cooking">
                                <label for="updateCooking">Cooking</label>
                            </div>
                        </div>
                    </div>
                    <div class="user-box">
                        <label>Experience:</label>
                        <label><input type="radio" name="experience" value="beginner"> Beginner</label>
                        <label><input type="radio" name="experience" value="intermediate"> Intermediate</label>
                        <label><input type="radio" name="experience" value="expert"> Expert</label>
                    </div>

                    <div>
                        
                    </div>

                    <div class="user-box">
                        <label for="image">Upload Image:</label>
                        <input type="file" accept="image/*" onchange="previewUpdateImage(event);" name="upload">
                        <img height="100px" width="80px" id="updatePreview">
                    </div>
                    <div class="user-box">
                        <a href="fetch_data.php" class="full-width-button">Cancel</a>
                        <button type="submit" class="full-width-button" name="update">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Modal script
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        document.querySelectorAll('.editBtn').forEach(button => {
            button.onclick = function() {
                document.getElementById('updateId').value = this.dataset.id;
                document.getElementById('updateName').value = this.dataset.name;
                document.getElementById('updateEmail').value = this.dataset.email;
                document.getElementById('updateNumber').value = this.dataset.number;
                document.getElementById('updateGender').value = this.dataset.gender;
                document.getElementById('updateAddress').value = this.dataset.address;
                document.getElementById('updateReading').checked = this.dataset.hobbies.includes("Reading");
                document.getElementById('updateTraveling').checked = this.dataset.hobbies.includes("Traveling");
                document.getElementById('updateCooking').checked = this.dataset.hobbies.includes("Cooking");
                document.querySelector(`input[name="experience"][value="${this.dataset.experience}"]`).checked = true;

                if (this.dataset.image) {
                    document.getElementById('updatePreview').src = this.dataset.image;
                }

                modal.style.display = "block";
            };
        });

        span.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        function previewUpdateImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('updatePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>