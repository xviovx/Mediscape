<?php
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
    <link rel="stylesheet" type="text/css" href="../css/doctor_profile.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Mediscape | Doctor Profile</title>
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
                            <img src="../assets/doc_list_white.png" width="26px" height="26px">
                        </div>
                        <div class="doctors-text-holder">
                            <p>Doctor list</p>
                        </div>
                    </div>
                </div>
            </a>
                
            </div>

            <a href="recep_profile.php" class="anchor_recep">
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
            <a href="doctor_list.php"><img src="../assets/back_icon.png" width="31px" height="31px"></a>
            <h1>Doctor profile</h1>
        </div>

        <div class="edit_doctor_details_modal">
            <h1>Edit doctor details</h1>
            <img src="../assets/close_icon.png" width="20px" height="20px" id="close_icon" onclick="closePanelDocModal();">
            <hr>
            <form>
                <div class="updateProfilePic">
                    <img id="preview_profile_pic" src="../assets/profile_placeholder.png" style="max-width: 100%; max-height: 100%; border-radius: 50%;">
                </div>
                <label>Profile picture</label>
                <input type="file" class="edit_doctor_picture" name="edit_doctor_picture">

                <label>Doctor name</label>
                <input type="text" class="edit_doctor_name" value="Dr Lee">

                <label>Email</label>
                <input type="email" class="edit_doctor_email" value="lee@gmail.com">

                <label>Phone number</label>
                <input type="number" class="edit_doctor_number" value="0766666666">

                <label>Doctor ID</label>
                <input type="text" class="edit_doctor_id" value="123142AB">

                <label>Specialisation</label>
                <input type="text" class="edit_doctor_spec" value="Surgeon">

                <button class="edit_doctor_details_submit_button">UPDATE DETAILS</button>
            </form>

            <div class="error-block">
                Doctor ID in use
            </div>
        </div>

        <div class="details-panel">
            <div class="doctor-profile-container">
                <div class="profile-pic">
                    <img src="../assets/profile_placeholder.png" style="max-width: 100%; max-height: 100%; border-radius: 50%;">
                </div>

                <div class="details-con">
                    <div class="title-stream">
                        <h2 class="doctor_name">Dr Wilson</h2>
                        <span> | </span>
                        <span style="font-size: 22px; font-weight: 700; padding-left: -25px;">Doctor ID:</span><h3 class="doctor_id">12345A</h3>
                        <button class="edit_doctor_details">Edit details</button>
                        <div class="delete_doctor"></div>
                    </div>
                    <h2 class="e_heading">Email: </h2><span class="doctor_profile_email">sarahadams@gmail.com</span>
                    <br>
                    <h2 class="phone_heading">Phone number: </h2><span class="doctor_profile_number">076 349 6543</span>
                    <br>
                    <h2 class="specialisation">Specialisation: </h2><span class="doctor_specialisation">General Practitioner</span>
                    <br>
                    <h2 class="room_number">Room number: </h2><span class="doctor_room_number">A2</span>
                </div>
            </div>
        </div>
    </div><!--end of right-side-panel-->
</body>
</html>