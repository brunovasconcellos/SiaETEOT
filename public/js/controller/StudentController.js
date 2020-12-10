"use strict";
class StudentController 
{

    constructor (rule, message) {

        let route = "/dashboard/student";

        this.createDataTables(route);
        this.showModalCreate();
        this.createDataExcel( "/excelcreate/student");
        this.createData(route, rule, message);
        this.showModalUpdate();
        this.updateData(route, rule, message);
        this.matriculateStudent();
        this.deleteData(route);
    }

    
    createDataTables(route) {
        
        let columsData = [
            {data: "id", name: "id"},
            {data: "name", name: "name"},
            {data: "last_name", name: "last_name"},
            {data: "email", name: "email"},
            {data: "gender", name: "gender",  render: function (data, type, row) {

                if (data == "f") {

                    return "Feminino";

                }

                return "Masculino";

            }},
            {data: "student_type", name: "student_type"},
            {data: "school_class_name", name: "school_class_name", render: function (data, type, row) {

                if (data) {

                    return data;

                }

                return `<p>Não registrado.</p>`

            }},
            {data: "call_number", name: "call_number", render: function (data, type, row) {

                if (data) {

                    return data;

                }

                return `<p>Não registrado.</p>`

            }},
            {data: "school_year", name: "school_year", render: function (data, type, row) {

                if (data) {

                    return data;

                }

                return `<p>Não registrado.</p>`

            }},
            {data: "contact", name: "contact"},
        ];
        
        columsData.push(
            {
                data: null,  orderable: false, searchable: false,
                render: function (data, type, row,) {
                    
                    return `<a href="${route}/${data.id}" title="Visualizar" class="view btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                            <button type="button" data-id="${data.id}" name="edit" title="Editar" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                            <button type="button" data-id="${data.id}" name="delete" title="Excluir" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            <button type="button" data-id="${data.id}" name="delete" title="matricular" class="matriculate btn btn-warning btn-sm"><i class="fas fa-plus"></i></button>`
                }
            }
        );

            
        let buttonsTable = [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                exportOptions: {columns: 'th:not(:last-child)'},
                title: `Listar Estudantes`,
                attr: {
                    
                    id: "excel",
                    class: "btn btn-primary"

                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                exportOptions: {columns: 'th:not(:last-child)'},
                title: `Listar Estudantes`,
                attr: {
                    
                    id: "pdf",
                    class: "btn btn-primary"

                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimir',
                exportOptions: {columns: 'th:not(:last-child)'},
                title: `Listar Estudantes`,
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

            },

            {
                text: "<i class='fa fa-plus'></i> Novo(Excel)",
                attr: {

                    id: "new-excel",
                    class: "btn btn-primary"

                }
            }

        ];

        $(document).ready(function () {
            

            $("#list").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: route,
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

                buttons: buttonsTable,
                    
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

    createDataExcel (routeExcel, routeExcelPost) {

       $(document).on("click", "#new-excel", () => {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            Swal.fire({
                title: `Criar Estudantes`,
                text: `Insira uma planilha excel para criar um(a) novo(a) Estudantes`,
                html: ` <a href='/dashboard/download/excel/student' download>Baixar modelo.</a>
                <form id="form-excel" enctype="multipart/form-data">
                    <input type="file" id="excel-file" name="excel-file"> 
                </form>`,
                confirmButtonText: 'Confirmar',
                showCancelButton: true,
                cancelButtonText: "Fechar",
            }).then((result) => {

                if (result.value) {   

                    $.ajax({

                        url: `/dashboard/excelcreate/student`,
                        method: "POST",
                        data: new FormData(document.querySelector("#form-excel")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {

                            Swal.fire({

                                title: "Sucesso!",
                                text: `Estudante criado(a).`,
                                icon: "success"

                            });

                            $("#list").DataTable().ajax.reload();

                        },
                        error: function (error) {

                            console.log(error);

                            Swal.fire({

                                title: "Erro!",
                                icon: "error"

                            });

                        }
                    });

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

    createData(route, rule, message) {

        let helper = new Helper();

        $(document).on("submit", ".create-data", function (e) {

            e.preventDefault();

            let form  = $(this);

            helper.validationForm(rule, message, form);

            if (!form.valid()) return;

            $("#modal").modal('hide');

            $.ajax({

                url: `dashboard/student/create`,
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

    matriculateStudent() {

        $(document).on("click", ".matriculate", () => {

            Swal.fire({

                title: "Matricular aluno",
                text: "Preencha o formulario para matricular o aluno em uma matéria.",
                html: `<input type='date'>
                        <input type='number'>
                        <input type='text'>
                        <input type='text'>
                        <select id="discipline"></select>
                        <select id="school_class"></select>`,
                confirmButtonText: 'Confirmar',
                didOpen: () => {

                    $("#discipline").select2({

                        ajax: {

                            url: "/dashboard/disciplineformated",
                            dataType: "json",
                            processResults: (response) => {

                                console.log(response);  

                                return {
                                    "results": response 
                                };
                                
                            }

                        }

                    });;

                    $("#school_class").select2({

                        ajax: {

                            url: "/dashboard/schoolclassformated",
                            dataType: "json",
                            processResults: (response) => {

                                console.log(response);  

                                return {
                                    "results": response 
                                };
                                
                            }

                        }

                    });;

                }

            }).then(() => {

                $.ajax({



                });

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

    updateData(route, rule, message) {

        let helper = new Helper();

        let btnId;

        $(document).on("click", ".edit", function () {

            btnId = $(this).attr("data-id");

        });
        

        $(document).on("submit", ".edit-data", function (event) {

            event.preventDefault();

            let form  = $(this);

            helper.validationForm(rule, message, form);

            if (!form.valid()) return;

            $("#modal").modal("hide");

            $.ajax({

                url: `dashboard/student/${btnId}`,
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

                    $.each(error.responseJSON.message, function (key, value) {

                        message += value;

                    });

                    helper.alertMessage("error", message);
                }

            });

        });

    }

    deleteData(route) {

        let helper = new Helper();

        helper.ajaxCsrfSetting();

        $(document).on('click', ".delete", function (e) {

            e.preventDefault();
            
            let id = $(this).attr("data-id");

            Swal.fire({

                title: "Você realmente quer deletar isso?",
                text: "Essa alteração não poderá ser revertida.",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Deletar',
                icon: "warning"
            }).then((result) => {

                if (result.value) {

                    $.ajax({

                        url: `dashboard/student/${id}`,
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