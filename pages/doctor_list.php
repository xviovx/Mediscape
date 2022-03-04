<?php
    include '../server/add_doctor.php';

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
    <link rel="stylesheet" type="text/css" href="../css/doctor_list.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Mediscape | Doctors</title>

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

            <a href="#">
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
        <div class="add_doctor_modal" style="height: 95%;">
            <h1>Add doctor</h1>
            <img src="../assets/close_icon.png" width="20px" height="20px" id="close_icon" onclick="closePanelDoc();">
            <hr style="margin-top: -10px;">
            <br>
            <div class="doctorImagePreview" style="object-fit: cover; background-color: #F0F0F0; border: 2px solid #8a8a8a8a">
                <img id="preview_profile_pic" src="../assets/profile_placeholder.png" style="width: 60px; height: 60px; border-radius: 50%; margin: bottom 10px;">
            </div>

            <form enctype="multipart/form-data" action="doctor_list.php" method="post">
                <label>Profile image</label>
                <input type="file" class="add_doc_img" name="profileImage" onchange="previewImage(this);">

                <label>Doctor name</label>
                <input type="text" class="add_doc_name" name="doc_name" placeholder="Dr Lee">

                <label class="age-label">Age</label>
                <input class="doc_age" name="doc_age" type="number" placeholder="Age">

                <label class="gender-label">Gender</label>
                <select class="add_doc_gender" name="doc_gender">
                    <option value="" disabled selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <label class="room-label">Room number</label>
                <select class="add_doc_room" name="doc_room">
                    <option value="" disabled selected>0</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="A4">A4</option>
                    <option value="A5">A5</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="B3">B3</option>
                    <option value="B4">B4</option>
                    <option value="B5">B5</option>
                    <option value="C1">C1</option>
                    <option value="C2">C2</option>
                    <option value="C3">C3</option>
                    <option value="C4">C4</option>
                    <option value="C5">C5</option>
                </select>

                <label>Email</label>
                <input type="email" class="add_doc_email" placeholder="drlee@gmail.com" name="doc_email">

                <label>Phone number</label>
                <input type="number" class="add_doc_number" placeholder="076 666 7777" name="doc_number">

                <label>Doctor ID</label>
                <input type="text" class="add_doc_id" placeholder="1234AZ" name="doc_id">

                <label>Specialisation</label>
                <input type="text" class="add_doc_spec" placeholder="Surgeon" name="doc_spec">

                <br>

                <button class="add_doctor_button" name="add_doc_btn" style="margin-top: 15px;">ADD DOCTOR</button>
            </form>

            <div class="error-block" style="margin-top: -8px;">
                <p><?php include '../server/error.php'; ?></p>
            </div>
        </div>
        
        <div class="doc-top-panel">
            <h1>Doctor list</h1>
            <span> | </span>
            <button class="add_new_doc">Add Doctor</button>

            <div class="recep-email-display" style="margin-left: 980px; margin-top: -50px; font-size: 20px"><?php echo $email ?></div>
            <a href="../server/logout.php" style="float: right; margin-top: -32px; margin-right: 115px"><button style="width: 110px; border-radius: 10px;" class="sign_out">SIGN OUT</button></a>
        </div>

        <div class="search-container">
            <form>
              <input type="text" placeholder="Search doctors" name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <hr>

        <div class="doc-body-panel">
            <?php include '../server/show_doctors.php'?>
        </div>
    </div>
</body>
</html>