class EmployeeController {

    "use strict";

    constructor (rule, message) {

        this.createDataTables();
        this.showModalCreate();
        this.createData(rule, message)
        this.showModalUpdate();
        this.updateData(rule, message);
        this.showModalOccupation();
        this.createOccupation();
        this.deleteData();
    }

    
    createDataTables() {

        let columsData = [
            {data: "id", name: "id"},
            {data: "registration", name: "registration"},
            {data: "name", name: "name"},
            {data: "last_name", name: "last_name"},
            {data: "email", name: "email"},
            {data: "gender", name: "gender", render: function (data, type, row) {

                if (data == "f") {

                    return "Feminino";

                }

                return "Masculino";

            }},
            {data: "contact", name: "contact"},
            {data: "sector_name", name: "sector_name"},
            {data: "occupation_names", name: "occupation_names", render: 
            function (data, type, row) {
                
                if (data) {

                    let dataArray = data.split(',');

                    return `<div class='col-12'>${dataArray[0]} e + ${dataArray.length - 1}</div>`

                }

                return `<button id="${row.id}" class="occupation btn btn-primary btn-sm">Adicionar</button>`

            }}
        ];

        columsData.push(
            {
                data: null,  orderable: false, searchable: false,
                render: function (data, type, row) {
                 
                    return `
                            <a href="/dashboard/course/${data.id}" title="Visualizar" class="view btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                            <button type="button" id="${data.id}" name="add-occupation" title="Adicionar Função" class="occupation btn btn-success btn-sm"><i class="fas fa-award"></i></button>
                            <button type="button" id="${data.id}" name="edit" title="Editar" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                            <button type="button" id="${data.id}" name="delete" title="Excluir" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>`
                }
            }
        );

        
        
        $(document).ready(function () {

             $("#list").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: "employee",
                    type: 'GET'
                },
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
                pagingType: "full_numbers",
                responsive: true,
                columns: columsData,
    
                dom: "<'row'<'col-sm-12 mb-3'B>>" +
                     "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: [

                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        exportOptions: {columns: 'th:not(:last-child)'},
                        attr: {
                            
                            id: "excel",
                            class: "btn btn-primary"

                        }
                    },

                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {columns: 'th:not(:last-child)'},
                        title: `Listar Funcionarios`,
                        attr: {
                            
                            id: "excel",
                            class: "btn btn-primary"

                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {columns: 'th:not(:last-child)'},
                        title: `Listar Funcionarios`,
                        attr: {
                            
                            id: "pdf",
                            class: "btn btn-primary"

                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Imprimir',
                        exportOptions: {columns: 'th:not(:last-child)'},
                        title: `Listar Funcionarios`,
                        attr: {

                            id: "print",
                            class: "btn btn-primary"

                        }
                    },

                    {

                        text: "<i class='fa fa-plus'></i> Novo",
                        attr: {

                            id: "new",
                            class: "btn btn-primary"

                        }

                    }

                ],
                    
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros.",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrando _MENU_ resultados",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "<i class='fas fa-angle-right'></i>",
                        "sPrevious": "<i class='fas fa-angle-left'></i>",
                        "sFirst": "<i class='fas fa-angle-double-left'></i>",
                        "sLast": "<i class='fas fa-angle-double-right'></i>"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    },
                    "buttons": {
                        "copyTitle": "Copiar para área de transferência",
                        "copySuccess": {
                            "_": "Copiou %d linhas para a área de transferência",
                            "1": "Copiou uma linha para a área de transferência"
                        }
                    }
                }
                
                
            });

        });


    }

    showModalCreate () {

        $(document).on("click", "#new", function (e) {

            e.preventDefault();

            let helper = new Helper();

            $("#modal").modal("show");

            $("#method").val("POST");

            $("#form-submit").addClass("create-data");

            $("#form-submit").removeClass("edit-data");

            helper.cleanInput("#input-box");

        });

    }

    createData(rule, message) {

        let helper = new Helper();

        $(document).on("submit", ".create-data", function (e) {

            e.preventDefault();

            let form  = $(this);

            helper.validationForm(rule, message, form);

            if (!form.valid()) return; 

            $("#modal").modal('hide');

            $.ajax({

                url: `employee`,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    helper.alertMessage("success", response.message);
                    
                    $("#modal").modal("hide");

                    $("#list").DataTable().ajax.reload();

                },
                error: function (error) {

                    let message = "";

                    $.each(error.responseJSON.message, function (key, value) {

                        message += value;

                    });

                    helper.alertMessage("error", message);

                    $("#modal").modal("hide");
                }

            });

        });

    }

   

    showModalUpdate() {

        $(document).on("click", ".edit", (e) => {

            e.preventDefault();

            let helper = new Helper();

            $("#method").val("PUT");

            $("#modal").modal("show");

            $("#form-submit").addClass("edit-data");

            $("#form-submit").removeClass("create-data");

            helper.cleanInput("#input-box");
            
        });
        

    }

    updateData(rule, message) {

        let helper = new Helper();

        let btnId;

        $(document).on("click", ".edit", function () {

            btnId = $(this).attr("id");

        });
        
        $(document).on("submit", ".edit-data", function (event) {

            event.preventDefault();

            let form  = $(this);

            helper.validationForm(rule, message, form);

            if (!form.valid()) return;

            $("#modal").modal("hide");

            $.ajax({

                url: `employee/${btnId}`,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    helper.alertMessage("success", response.message);
                    
                    $("#list").DataTable().ajax.reload();

                },
                error: function (error) {

                    let message = "";

                    $.each(error.message, function (key, value) {

                        message += value;

                    });

                    helper.alertMessage("error", message);
                }

            });

        });

    }

    showModalOccupation() {

        $(document).on("click", ".occupation", (e) => {

            e.preventDefault();

            let helper = new Helper();

            $("#method-occupation").val("POST");

            $("#modal-occupation").modal("show");

            $("#form-occupation").addClass("create-occupation");

            helper.cleanInput("#input-box");
            
        });    

    }

    createOccupation() {

        let helper = new Helper();

        let btnId;

        $(document).on("click", ".occupation", function () {

            btnId = $(this).attr("id");

        });

        $(document).on("submit", "#form-occupation", function (e) {

            e.preventDefault();

            console.log(btnId);

            $.ajax({

                url: `/dashboard/occupationemployee/${btnId}`,
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    helper.alertMessage("success", response.message);

                    $("#list").DataTable().ajax.reload();

                },
                error: function (error) {

                    let message = "";

                    $.each(error.responseJSON.message, function (key, value) {

                        message += value;

                    });

                    helper.alertMessage("error", message);

                    $("#modal").modal("hide");
                    
                }

            });

        });

    }

    deleteData() {

        let helper = new Helper();

        helper.ajaxCsrfSetting();

        $(document).on('click', ".delete", function (e) {

            e.preventDefault();
            
            let id = $(this).attr("id");

            Swal.fire({

                title: "Você realmente quer deletar isso?",
                text: "Essa alteração não poderá ser revertida.",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Deletar',
                type: "warning"

            }).then((result) => {

                if (result.value) {

                    $.ajax({

                        url: `/dashboard/employee/${id}`,
                        method: "DELETE",
                        success: function (response) {

                            helper.alertMessage("success", response.message);

                            $("#list").DataTable().ajax.reload();
        
                        },
                        error: function (error) {

                            let message;
                            
                            console.log(error)

                            $.each(error.responseJSON.response, function (key, value) {

                                message += value;

                            });

                            helper.alertMessage("error", message);
                            
                        }
                    });

                }

            });

        });

    }

}