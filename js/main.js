$(function(){
    $(".add_new_appointment").click(function(){
        $(".add-appointment-modal").css("display", "block");
    });

    $(".add_appointment_modal_btn").click(function(){
        $(".add-appointment-modal").css("display", "none");
    });

    $(".edit_receptionist_details").click(function(){
        $(".edit_details_modal").css("display", "block");
    });

    $(".save_recep_edit").click(function(){
        $(".edit_details_modal").css("display", "none");
    });

    $(".add_new_doc").click(function(){
        $(".add_doctor_modal").css("display", "block");
    });

    $(".add_doctor_button").click(function(){
        $(".add_doctor_modal").css("display", "none");
    });

    $(".add_new_patient").click(function(){
        $(".add_patient_modal").css("display", "block");
    });

    $(".edit_patient_details").click(function(){
        $(".edit_patient_details_modal").css("display", "block");
    });

    $(".edit_doctor_details").click(function(){
        $(".edit_doctor_details_modal").css("display", "block");
    })

    $(".edit_doctor_details_submit_button").click(function(){
        $(".edit_doctor_details_modal").css("display", "none");
    });
});

function closePanelDoc(){
    $(".add_doctor_modal").css("display", "none");
};

function closePanelRecep(){
    $(".edit_details_modal").css("display", "none");
};

function closePanelApp(){
    $(".add-appointment-modal").css("display", "none");
}

function closePanelPatient(){
    $(".edit_patient_details_modal").css("display", "none");
};

function closePanelPatientList(){
    $(".add_patient_modal").css("display", "none");
};

function closePanelDocModal(){
    $(".edit_doctor_details_modal").css("display", "none");
};