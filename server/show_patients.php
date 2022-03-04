<?php
    if(isset($_POST['search'])){
        $searchTerm = mysqli_real_escape_string($db, $_POST['search_term']) . '%';

        $show_query = "SELECT * FROM patients WHERE names LIKE '$searchTerm";
        $show_result = mysqli_query($db, $show_query);

        if($show_result-> num_rows > 0){
            while($pat = $show_result-> fetch_assoc()){
                echo 
                "<a href='patient_profile.php?id= " .$pat['id'] ."' style='color: black; '>
                    <div class='single-patient-con' style='width: 430px; height: 190px;'>
                        <div class='patient_profile_pic' style='width: 150px; height: 150px;'>
                            <img src='../patient_profiles/" .$pat['profile_pic']."' style='max-width: 100%; max-height: 100%; border-radius: 50%;'>
                        </div>

                        <div class='patient_information'>
                            <h1 class='patient_name' style='font-size: 30px;'>" . $pat['names'] ."</h1>
                            <p class='id_title' style='margin: 0; margin-top: -35px; font-size: 20px; font-weight: 700; display: inline-flex;'>Patient ID: </p><span style='font-size:18px; margin: 0; margin-top: -10px;' class='patient_id'>" . $pat['patient_id'] . "</span>
                            <p class='age_title' style='margin: 0; margin-top: 15px; font-size: 20px; font-weight: 700; display: inline-flex;'>Age: </p><span style='font-size:18px; margin: 0; margin-top: 122px; margin-left: 2px;' class='patient_age'>" .$pat['age'] ."</span>
                        </div>
                    </div>
                </a>";
            }
        }

    } else if(!isset($_POST['search'])) {
        $show_query = "SELECT * FROM patients";
        $show_result = mysqli_query($db, $show_query);

        if($show_result-> num_rows > 0){
            while($pat = $show_result-> fetch_assoc()){
                echo 
                "<a href='patient_profile.php?id= " .$pat['id'] ."' style='color: black; '>
                    <div class='single-patient-con' style='width: 430px; height: 190px;'>
                        <div class='patient_profile_pic' style='width: 150px; height: 150px;'>
                            <img src='../patient_profiles/" .$pat['profile_pic']."' style='max-width: 100%; max-height: 100%; border-radius: 50%;'>
                        </div>

                        <div class='patient_information'>
                            <h1 class='patient_name' style='font-size: 30px;'>" . $pat['names'] ."</h1>
                            <p class='id_title' style='margin: 0; margin-top: -35px; font-size: 20px; font-weight: 700; display: inline-flex;'>Patient ID: </p><span style='font-size:18px; margin: 0; margin-top: -10px;' class='patient_id'>" . $pat['patient_id'] . "</span>
                            <p class='age_title' style='margin: 0; margin-top: 15px; font-size: 20px; font-weight: 700; display: inline-flex;'>Age: </p><span style='font-size:18px; margin: 0; margin-top: 122px; margin-left: 2px;' class='patient_age'>" .$pat['age'] ."</span>
                        </div>
                    </div>
                </a>";
            }
        }
    }

    
?>





