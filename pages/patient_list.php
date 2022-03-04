<?php
    include '../server/add_patient.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--local files-->
    <link rel="stylesheet" type="text/css" href="../css/patient_list.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Mediscape | Patients</title>

    <!--preview-image-->
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
    
            <a href="#">
                <div class="patients-tab-con">
                    <div class="patients-content-strap">
                        <div class="patients-icon-holder">
                            <img src="../assets/patient_list_white.png" width="23px" height="23px">
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

            <a href="recep_profile.php" class="anchor_recep" style="color: black">
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
    </div>

    <div class="right-side-panel">
        <div class="doc-top-panel">
            <h1>Patient list</h1>
            <span> | </span>
            <button class="add_new_patient">Add Patient</button>

            <div class="recep-email-display" style="margin-left: 980px; margin-top: -50px; font-size: 20px"><?php echo $email ?></div>
            <a href="../server/logout.php" style="float: right; margin-top: -32px; margin-right: 115px"><button style="width: 110px; border-radius: 10px;" class="sign_out">SIGN OUT</button></a>
        </div>

        <div class="add_patient_modal" style="height: 86%; margin-top:5px;">
            <h1>Add patient</h1>
            <img src="../assets/close_icon.png" width="20px" height="20px" id="close_icon" onclick="closePanelPatientList();">
            <hr>
            <br>
            <div class="patientImagePreview" style="object-fit: cover; background-color: #F0F0F0; border: 2px solid #8a8a8a8a">
                <img id="preview_profile_pic" src="../assets/profile_placeholder.png" style="width: 65px; height: 65px; border-radius: 50%; margin: bottom 10px;">
            </div>

            <form enctype="multipart/form-data" action="patient_list.php" method="post">
                <label>Profile image</label>
                <input type="file" class="add_patient_img" name="profileImage" onchange="previewImage(this);">

                <label>Patient name</label>
                <input type="text" class="add_patient_name" name="patient_name" placeholder="Jim Davis">

                <label class="age-label">Age</label>
                <input class="patient_age" name="patient_age" placeholder="Age" type="number">

                <label>Gender</label>
                <select class="add_patient_gender" name="patient_gender">
                    <option value="" disabled selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <label>Email</label>
                <input type="email" class="add_patient_email" placeholder="jimdavis@gmail.com" name="patient_email">

                <label>Phone number</label>
                <input type="number" class="add_patient_number" placeholder="0766667777" name="patient_number">

                <label>Patient ID</label>
                <input type="text" class="add_patient_id" placeholder="1234AZ" name="patient_id" maxlength="6">

                <label>Medical aid</label>
                <input type="number" class="add_patient_medical" placeholder="839491840" name="patient_medical">

                <br>

                <button class="patient_button" name="add_patient" style="margin-top: 10px;">ADD PATIENT</button>
            </form>

            <div class="error-block">
                <p style="margin: 0;"><?php include '../server/error.php'; ?></p>
            </div>
        </div>

        <div class="search-container">
            <form method="post">
              <input type="text" placeholder="Search patients by name" name="search_term">
              <button type="submit" name="search"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <hr>

        <div class="patient-body-panel">
            <?php include '../server/show_patients.php'?>
        </div>
    </div>
</body>
</html>