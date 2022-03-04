<?php

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

if(isset($_POST['add_appointment_button'])){
    $appDate = mysqli_real_escape_string($db, $_POST['date']);
    $appType = mysqli_real_escape_string($db, $_POST['appointment_type']);
    $appDoctor = mysqli_real_escape_string($db, $_POST['doctor']);
    $appPatient = mysqli_real_escape_string($db, $_POST['patient']);
    $appTime = mysqli_real_escape_string($db, $_POST['appointment_time']);

    //form authentication
    // if(empty($appDate)){array_push($errors, "Please select a date");}
    // if(empty($appTime)){array_push($errors, "Please choose a time");}
    // if(empty($appType)){array_push($errors, "Please choose appointment type");}
    // if(empty($appDoctor)){array_push($errors, "Please select doctor");}
    // if(empty($appPatient)){array_push($errors, "Please select patient");}
    

    // $app_check_query = "SELECT * FROM appointments WHERE time = '$appTime' LIMIT 1";
    // $result = mysqli_query($db, $app_check_query);
    // $appointment = mysqli_fetch_assoc($result);

    //form validataion
    if($appointment){
        // if($patient['time'] === $appTime){array_push($errors, "There is already an appointment booked for that time");}
    }

    if(count($errors) == 0){
        $query = "INSERT INTO appointments (date, time, appointment_type, doctor, patient) values ('$appDate', '$appTime', '$appType', '$appDoctor', '$appPatient')";
        mysqli_query($db, $query);
        $_SESSION['time'] = $appTime;
        header("location: ../pages/landing_page.php");
    }
}
