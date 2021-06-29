"use strict"

class Helper {
    
    alertMessage (type, message) {

        Swal.fire({

            title: (type == "success") ? "Tudo certo!" : "Erro!",
            html: message,
            confirmButtonText:"<i class='fa fa-check'><i/> Confirmar!",
            confirmButtonAriaLabel: 'Thumbs up, great!',
            icon: type

        });            

    }

    ajaxCsrfSetting() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    }

    cleanInput(divFatherId) {

        let inputs = $(divFatherId).children();

        $.each(inputs, (key, val) => {

            val.value = "";

        });
    }

    validationForm (rule, message, form) {

        var helper = new Helper;

        helper.validationSettings();

        $(form).validate({
    
            rules: rule,
            messages: message,

        });

    }

    validationSettings () {

        jQuery.validator.setDefaults({
            errorElement: "label",
            errorPlacement: function (error, element) {
    
                error.addClass("text-danger");
                element.closest(".form-group").append(error);
    
            }, 
            highlight: function (element, errorClass, validClass) {
    
                $(element).addClass("is-invalid");
                $(element).removeClass("is-valid");
    
            },
            unhighlight: function (element, errorClass, validClass) {
    
                $(element).removeClass("is-invalid");
                $(element).addClass("is-valid");
    
            }
    
        });

    }
    

}