<?php include '../server/reg_user.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--library-files-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varta:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!--local files-->
    <link rel="stylesheet" type="text/css" href="../css/register.css">

    <title>Mediscape | Register</title>

    <!--change-preview-pic-on-select-->
    <script>
        function previewImage(input){
            var file = $("input[type=file").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $('#preview_profile_pic').attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    
</head>
<body>

    <div class="body-con">
        <div class="left-side-display">
            <h1>REGISTER</h1>
            <h3>Mediscape Management Portal</h3>
            <div class="register-image-holder"></div>
        </div>

        <div class="register-con">
            <div class="form-info-container">
                <form enctype="multipart/form-data" action="register.php" method="post">
                    <label for="profileImage">Profile image</label>
                    <br>
                    <input type="file" class="profileImageSection" name="profileImage" onchange="previewImage(this);">

                    <div class="profileImageDisplay">
                        <img id="preview_profile_pic" src="../assets/profile_placeholder.png" style="object-fit: cover; width: 70px; height: 70px; border-radius: 50%;">
                    </div>

                    <br>

                    <label for="names">Name & Surname</label>
                    <br>
                    <input type="text" name="names" placeholder="Jim Johnson">

                    <label for="email">Email address</label>
                    <br>
                    <input type="email" name="email" placeholder="jj@gmail.com">

                    <label for="age">Age</label>
                    <br>
                    <input type="number" name="age" placeholder="Age">

                    <label for="rank">Rank</label>
                    <br>
                    <select name="rank" id="rank">
                        <option value="Head receptionist" disabled selected>Head receptionist</option>
                        <option value="Receptionist">Receptionist</option>
                    </select>

                    <label for="gender">Gender</label>
                    <br>
                    <select name="gender" id="gender">
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <br>

                    <label for="phone_number">Phone number</label>
                    <br>
                    <input type="number" name="phone_number" placeholder="0763486022">

                    <label for="password">Password</label>
                    <br>
                    <input type="password" name="pass_1" placeholder="easypassword123">

                    <label for="confirm_password">Confirm password</label>
                    <br>
                    <input type="password" name="pass_2" placeholder="easypassword123">

                    <br>
                    <button type="submit" name="register_btn">REGISTER</button>

                    <p>Or <span> sign In <a href="sign_in.php">here</a></span></p>

                </form>
            </div><!--form-info-container-->
            
        </div>

        <div class="error-block" style="margin-top: 760px; height: 100px; width: 310px;">
            <p style="margin: 0; margin-top: 1px; text-align: left;"><?php include '../server/error.php'; ?></p>
        </div>
    </div>
</body>
</html>