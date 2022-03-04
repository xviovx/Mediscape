<?php
    $show_query = "SELECT * FROM appointments";
    $show_result = mysqli_query($db, $show_query);

    if($show_result-> num_rows > 0){
        while($app = $show_result-> fetch_assoc()){
            echo 
            "<div class='single-appointment-container'>
                <div class='date-and-time-con'>
                    <h4 class='date-text-display'>Appointment date & Time</h4>
                    <h1 class='appointment-day' style='font-size: 24px;'>".$app['date']."</h1>
                    <span class='splitter' style='font-weight: 500;'>|</span>
                    <span class='appointment-time' style='font-size: 24px; font-weight: 500'>".$app['time']."</span>
                </div>
                <div class='appointment-type-con'>
                    <h4>Appointment type</h4>
                    <h1 class='appointment-type'>".$app['appointment_type']."</h1>
                </div>
                <div class='doctor-for-appointment-con'>
                    <h4>Doctor</h4>
                    <h1 class='appointment-doctor'>".$app['doctor']."</h1>
                </div>
                <div class='patient-for-appointment-con'>
                    <h4>Patient</h4>
                    <h1 class='appointment-patient'>".$app['patient']."</h1>
                </div>
                <div class='delete-appointment-con'>
                    <div class='delete-appointment-holder'></div>
                </div>
            </div> ";
        }
    }
?>

