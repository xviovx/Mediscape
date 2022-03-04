<?php
    // include '../server/edit_recep_details.php';

    session_start();

    $db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

    // $user_id = htmlspecialchars($_GET["id"]);
    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "Please login first";
        header('location: sign_user.php');
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];

        $check_query = "SELECT * FROM receptionists WHERE email = '$email'";
        $result = mysqli_query($db, $check_query);
        $user = mysqli_fetch_assoc($result);

        $rank = $user['pos'];
        $userProfile = $user['profile_pic'];
        $names = $user['names'];
        $current_id = $user['id'];
        $number = $user['number'];
        $gender = $user['gender'];
        $age = $user['age'];
    }
?>

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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!--local files-->
    <link rel="stylesheet" type="text/css" href="../css/recep_profile_styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Mediscape | Receptionist Profile</title>

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
    <div class="left-side-panel">
        <div class="mediscape-logo-con">
            
        </div>

        <div class="navigation-container">
            <a href="landing_page.php" style="text-decoration: none;">
                <div class="appointments-tab-con">
                    <div class="appointments-content-strap">
                        <div class="app-icon-holder">
                            <img src="../assets/appointment_black.png" width="30px" height="30px">
                        </div>
                        <div class="app-text-holder">
                            <p>Appointments</p>
                        </div>
                    </div>
                </div>
            </a>
    
            <a href="patient_list.php">
                <div class="patients-tab-con">
                    <div class="patients-content-strap">
                        <div class="patients-icon-holder">
                            <img src="../assets/patient_list_black.png" width="32px" height="32px">
                        </div>
                        <div class="patients-text-holder">
                            <p>Patient list</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="doctor_list.php">
                <div class="doctors-tab-con">
                    <div class="doctors-content-strap">
                        <div class="doctors-icon-holder">
                            <img src="../assets/doc_list_black.png" width="26px" height="26px">
                        </div>
                        <div class="doctors-text-holder">
                            <p>Doctor list</p>
                        </div>
                    </div>
                </div>
            </a>
                
            </div>

            <a href="#" class="anchor_recep">
            <div class="receptionist-profile-con">
                    <div class="recep-pic-con">
                        <div class="recep-image">
                            <img src="../profiles/<?php echo $userProfile ?>" style="object-fit: cover; width: 70px; height: 70px; border-radius: 50%;">
                        </div>
                    </div>
                    <div class="recep-info-con">
                        <div class="recep-name">
                            <?php echo $names ?>
                        </div>
                        <div class="recep-position">
                            <?php echo $rank ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div><!--end of left side panel-->

    <div class="right-side-panel">
        
        <div class="heading-panel">
            <h1>Receptionist Profile</h1>
        </div>

        <div class="details-panel">
            <div class="edit_details_modal">
                <h1>Edit details</h1>
                <img src="../assets/close_icon.png" width="20px" height="20px" id="close_icon" onclick="closePanelRecep();">
                <hr>
                <form>
                    <div class="updateProfilePic">
                        <img id="preview_profile_pic" src="../assets/profile_placeholder.png" style="max-width: 100%; max-height: 100%; border-radius: 50%;">
                    </div>
                    <label>Profile picture</label>
                    <input type="file" class="profileImageSection" name="updateProfileImage" onchange="previewImage(this);">

                    <label>Email</label>
                    <input type="email" class="update_recep_email" placeholder="janedoe@gmail.com">

                    <label>Phone Number</label>
                    <input type="number" class="update_recep_number" placeholder="082 546 8726">

                    <br>

                    <button name="save_button" class="save_recep_edit">SAVE</button>
                </form>
            </div>

            <div class="receptionist-profile-container">
                <div class="profile-pic" style="background-color: #ECECEC;">
                    <img id="preview_profile_pic" src="../profiles/<?php echo $userProfile ?>" style="max-width: 100%; max-height: 100%; border-radius: 50%; border: 2px solid black">
                </div>

                <div class="details-con">
                    <div class="title-stream">
                        <h2 class="receptionist_name"><?php echo $names ?></h2>
                        <span> | </span>
                        <h3 class="receptionist_position"><?php echo $rank ?></h3>
                        <button class="edit_receptionist_details">Edit details</button>
                    </div>
                    <h2 class="e_heading" style="margin: 0; display: inline-block; margin-top: 5px; font-size: 23px;">Email: </h2><span class="receptionist_profile_email" style="display: inline-block; font-size: 20px; margin-left: 10px;"><?php echo $email ?></span>
                    <br>
                    <h2 class="phone_heading" style="margin: 0; margin-top: 15px; font-size: 23px; display: inline-block;">Phone number: </h2><span class="receptionist_profile_number" style="display: inline-block; font-size: 20px; margin-left: 10px;"><?php echo $number ?></span>
                    <br>
                    <h2 class="gender_heading" style="margin: 0; margin-top: 15px; font-size: 23px; display: inline-block;">Gender: </h2><span class="receptionist_gender" style="display: inline-block; font-size: 20px; margin-left: 10px;"><?php echo $gender ?></span>
                    <br>
                    <h2 class="age_heading" style="margin: 0; margin-top: 15px; font-size: 23px; display: inline-block;">Age: </h2><span class="receptionist_age" style="display: inline-block; font-size: 20px; margin-left: 10px;"><?php echo $age ?></span>
                </div>
            </div>
        </div>
    </div><!--end of right-side-panel-->
</body>
</html>