<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Form</title>
    <link rel="stylesheet" href="stylef.css">


    <style>
        #preview {
            width: 50px;
            height: 70px;
        }
    </style>

</head>

<body>
    <div class="details-box">
        <h2 style="text-align: center;">Employee Details</h2>

        <div class="container">
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">

                    <!-- <div class="user-box">
                        <label for="id">Id</label>
                        <input type="number" id="id" name="id">
                    </div> -->

                    <div class="user-box">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="user-box">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="user-box">
                        <label for="number">Phone number:</label>
                        <input type="number" id="number" name="number" required pattern="[0-9]{10}">
                    </div>

                    <div class="user-box">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender" required>
                            <option value="" disabled selected>Select your Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="user-box">
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" required></textarea>
                    </div>

                    <div class="user-box">
                        <label for="hobbies">Hobbies:</label><br>
                        <div class="checkbox">

                            <div class="form-group">
                                <input type="checkbox" name="hobbies[]" id="Reading" value="Reading">
                                <label for="Reading">Reading</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id=" Traveling" name="hobbies[]" value="Traveling">
                                <label for=" Traveling"> Traveling</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="Cooking" name="hobbies[]" value="Cooking">
                                <label for="Cooking">Cooking</label>
                            </div>
                        </div>

                    </div>

                    <div class="user-box">
                        <label>Experience:</label>
                        <label><input type="radio" name="experience" value="beginner"> Beginner</label>
                        <label><input type="radio" name="experience" value="intermediate"> Intermediate</label>
                        <label><input type="radio" name="experience" value="expert"> Expert</label>
                    </div>

                    <div class="user-box">
                        <label for="image">Upload Image:</label>
                        <input type="file" accept="image/*" onchange="previewImage(event);" name="upload">

                    <img id="preview">

                    </div>

                    <!-- <div>
                    <img src="" id="pimage" alt="img">
                    </div> -->

                    <div class="user-box">
                        <button type="submit" class="full-width-button">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    


    <script type="text/javascript">
        function previewImage(event) {
            var input = event.target;
            var image = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>