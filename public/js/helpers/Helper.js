"use strict"

class Helper {

    alertMessage (type, message) {

        Swal.fire({

            title: (type == "success")? "Tudo certo!": "Erro!",
            text: message,
            confirmButtonText:"<i class='fa fa-check'><i/> Confirmar!",
            confirmButtonAriaLabel: 'Thumbs up, great!',
            type: type

        });            

    }

    ajaxCsrfSetting() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    }

    cleanInput(inputFatherId) {

        let inputs = $(inputFatherId).children();

        $.each(inputs, (key, val) => {

            val.value = "";

        });
    }
    

}