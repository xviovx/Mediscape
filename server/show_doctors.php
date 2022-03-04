<?php
    $show_query = "SELECT * FROM doctors";
    $show_result = mysqli_query($db, $show_query);

    if($show_result-> num_rows > 0){
        while($doc = $show_result-> fetch_assoc()){
            echo"<a href='doctor_profile.php?id=" . $doc['id'] ."' style='color: black;'>
                    <div class='single-doctor-con'>
                        <div class='doctor_profile_pic'>
                            <img src='../doc_profiles/". $doc['profile_pic'] ."' style='max-width: 100%; max-height: 100%; border-radius: 50%;'>
                        </div>
    
                        <div class='doctor_information'>
                            <h1 class='doctor_name'>". $doc['names'] . "</h1>
                            <h4 class='doctor_type'>" . $doc['specialisation'] . "</h4>
                            <p class='id_title'>Doctor ID: </p><span class='doctor_id'>" . $doc['doctor_id'] . "</span>
                            <p class='room_title'>Room: </p><span class='doctor_room'>" . $doc['room_number'] . "</span>
                        </div>
                    </div>
                </a>";
        }
    }
?>

