<?php
    include '../server/add_appointment.php';

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

    <!--local files-->
    <link rel="stylesheet" type="text/css" href="../css/landing_page.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Mediscape | Register</title>

    <style> 
    .yes-btn:hover{
        cursor: pointer;
        background: #418d459c;
        font-weight: bolder;
        border: 4px solid #ffffffd0;
    }

    .no-btn:hover{
        cursor: pointer;
        font-weight: bolder;
        border: 3px solid #ffffffd0;
    }
    </style>

    <script>
       $(() => {
           $('.delete-appointment-con').click(function(){
               $(".are-you-sure-modal").css("display", "block");
               $(this).parent().addClass("active");

               $('.yes-btn').click(function(){
                   if($('.single-appointment-container').hasClass("active")){
                        $(".active").fadeOut();
                        $(".are-you-sure-modal").css("display", "none");
                   };            
               });

               $('.no-btn').click(function(){
                   $(".are-you-sure-modal").css("display", "none");
               });

           });
       })
    </script>
</head>
<body>
    <div class="left-side-panel">
        <div class="mediscape-logo-con">
            
        </div>

        <div class="navigation-container">
            <div class="appointments-tab-con">
                <div class="appointments-content-strap">
                    <div class="app-icon-holder">
                        <img src="../assets/appointment_white.jpg" width="30px" height="30px">
                    </div>
                    <div class="app-text-holder">
                        <p>Appointments</p>
                    </div>
                </div>
            </div>
    
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

    </div>

    <div class="right-side-panel">
        <div class="top-detail-panel">
            <h1 style="float: left; position:absolute; font-family: 'Varta', 'sans-serif'; font-size: 26px; margin-left: 35px; margin-top: 22px; font-weight: 600; color:rgba(0, 0, 0, 0.6)">Welcome back, <span style="font-size: 25px; font-style:italic; font-weight:700"><?php echo $names ?></span></h1>
            <div class="recep-email-display" style="margin-left: 1000px;"><?php echo $email ?></div>
            <a href="../server/logout.php"><button class="sign_out">SIGN OUT</button></a>
        </div><!--top detail panel end-->

        <div class="daily-appointment-showcase-panel">
            <div class="add-appointment-modal">
                <h1>Add appointment</h1>
                <img src="../assets/close_icon.png" width="20px" height="20px" id="close_icon" onclick="closePanelApp();">
                <hr>
                <form enctype="multipart/form-data" action="landing_page.php" method="post">
                    <label>Date</label>
                    <input type="date" name="date">

                    <label>Time</label>
                    <select name="appointment_time" class="appointment_time">
                        <option value="" disabled selected>00:00</option>
                        <option value="00:00">00:00</option>
                        <option value="01:00">01:00</option>
                        <option value="02:00">02:00</option>
                        <option value="03:00">03:00</option>
                        <option value="04:00">04:00</option>
                        <option value="05:00">05:00</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                        <option value="24:00">24:00</option>
                    </select>

                    <label>Appointment type</label>
                    <input type="text" name="appointment_type" placeholder="Consultation">

                    <label>Doctor</label>
                    <input type="text" name="doctor" placeholder="Dr Lee">

                    <label>Patient</label>
                    <input type="text" name="patient" placeholder="Jim Davis">

                    <br>

                    <button name="add_appointment_button" class="add_appointment_button" style="height: 38px; width: 410px; padding: 7px; margin-left: 100px; margin-top: 35px;">Add appointment</button>

                    <div class="error-block" style="width: 550px; height: 30px; color: red; font-size: 16px; text-align: center; margin: 0 auto; margin-top: 15px;">
                        <p><?php include '../server/error.php'; ?></p>
                    </div>
                </form>
            </div>            

            <div class="daily-appointment-heading-con">
                <div class="add-patient-content-con">
                    <h1>Daily appointments</h1>
                    <span>|</span>
                    <a href="#">
                        <button class="add_new_appointment">Add appointment</button>
                    </a>
                </div>
            </div>
            
            <div class="are-you-sure-modal" style="display: none; position: absolute; width: 430px; height: 230px; background-color: #cccccc; margin-left: 460px; margin-top: 100px; border-radius: 25px;">
                <div class="text-holder" style="width: 100%; height: 60%; background-color:rgba(0, 0, 0, 0.7); border-radius: 25px 25px 0px 0px;">
                    <p style="margin: 0; font-family: 'Encode Sans', 'sans-serif'; color: white; text-align: center; font-size: 28px; padding: 30px 30px 0px;">Are you sure you want to delete that appointment?</p>
                </div>
                <div class="button-choice" style="width: 100%; height: 40%; background-color:rgba(0, 0, 0, 0.7); border-radius: 0px 0px 25px 25px;">
                    <button class="yes-btn" style="margin-left: 100px; width: 100px; height: 50px; font-family: 'Encode Sans', 'sans-serif'; background: #418d45; color: white; font-size: 20px; border: 2px solid #ffffffd0; border-radius: 25px;">Yes</button>
                    <button class="no-btn" style="margin-left: 25px; width: 100px; height: 50px; font-family: 'Encode Sans', 'sans-serif'; background: #b45454; color: white; font-size: 20px; border: 2px solid #ffffffd0; border-radius: 25px;">No</button>
                </div>
            </div>

            <div class="daily-appointments-main-holder">
                 <?php include '../server/show_appointments.php'?>
            </div>
        </div>
    </div>
</body>
</html>