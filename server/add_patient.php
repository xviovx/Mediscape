<?php

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

if(isset($_POST['add_patient'])){
    $patName = mysqli_real_escape_string($db, $_POST['patient_name']);
    $patAge = mysqli_real_escape_string($db, $_POST['patient_age']);
    $patGender = mysqli_real_escape_string($db, $_POST['patient_gender']);
    $patEmail = mysqli_real_escape_string($db, $_POST['patient_email']);
    $patNumber = mysqli_real_escape_string($db, $_POST['patient_number']);
    $patID = mysqli_real_escape_string($db, $_POST['patient_id']);
    $patMedical = mysqli_real_escape_string($db, $_POST['patient_medical']);

    $profileImage = time() . '_' . $_FILES['profileImage']['name'];
    $imageTarget = '../patient_profiles/' . $profileImage;
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);

    //form authentication
    if(empty($patName)){array_push($errors, "Name is required");}
    if(empty($patAge)){array_push($errors, "Age is required");}
    if(empty($patGender)){array_push($errors, "Gender is required");}
    if(empty($patEmail)){array_push($errors, "An email is required");}
    if(empty($patNumber)){array_push($errors, "A number is required");}
    if(empty($patID)){array_push($errors, "Please enter a patient ID");}
    if(empty($patMedical)){array_push($errors, "Your medical aid number is required");}

    $pat_check_query = "SELECT * FROM patients WHERE email = '$patEmail' OR number = '$patNumber' OR patient_id = '$patID' OR medical_aid = '$patMedical' LIMIT 1";
    $result = mysqli_query($db, $pat_check_query);
    $patient = mysqli_fetch_assoc($result);

    //form validataion
    if($patient){
        if($patient['email'] === $patEmail){array_push($errors, "Email is already in use");}
        if($patient['number'] === $patNumber){array_push($errors, "Phone number already in use");}
        if($patient['patient_id'] === $patID){array_push($errors, "That ID is already in use");}
        if($patient['medical_aid'] === $patMedical){array_push($errors, "That medical aid number already exists");}
    }

    if(count($errors) == 0){
        $password = md5($pass1);
        $query = "INSERT INTO patients (names, age, gender, email, number, patient_id, medical_aid, profile_pic) values ('$patName', '$patAge', '$patGender', '$patEmail', '$patNumber', '$patID', '$patMedical', '$profileImage')";
        mysqli_query($db, $query);
        $_SESSION['name'] = $patName;
        header("location: ../pages/patient_list.php");
    }
    
}