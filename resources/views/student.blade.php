<?

@extends('layouts.dashboard')

@section('th')


<tr>
    <th width="10%">ID</th>
    <th width="10%">nome</th>
    <th width="10%">sobrenome</th>
    <th width="10%">e-mail</th>
    <th width="5%">genero</th>
    <th width="10%">tipo de estudante</th>
    <th width="5%">ano</th>
    <th width="10%">turma</th>
    <th width="10%">numero da chamada</th>
    <th width="10%">contato</th>
    <th width="15%">Ação</th>
    
</tr>

@endsection

@section("input")

    <input name="name" type="text">
    <input name="lastName" type="text">
    <input name="email" type="text">
    <input name="password" type="text">
    <input name="password_confirmation" type="text">
    <input name="dateOfBirth" type="text">
    <input name="gender" type="text">
    <input name="cellPhone" type="text">
    <input name="identityRg" type="text">
    <input name="identityEmDt" type="text">
    <input name="identityAuthority" type="text">
    <input name="cpf" type="text">
    <input name="userName" type="text">
    <input name="level" type="text">
    <input name="numResidence" type="text">
    <input name="complementResidence" type="text">
    <input name="cep" type="text">
    <input name="tpPublicPlace" type="text">
    <input name="publicPlace" type="text">
    <input name="neighborhood" type="text">
    <input name="city" type="text">
    <input name="federationUnit" type="text">
    <input name="type" type="text">
    <input name="contact" type="text">
    <input name="fatherName" type="text">
    <input name="matherName" type="text">
    <input name="studentType" type="text">
    <input name="actualSituation" type="text">
    <input name="half" type="text">
    <input name="modality" type="text">
    <input name="course" type="text">
    <input name="ingressType" type="text">
    <input name="ingressForm" type="text">
    <input name="vagacyType" type="text">
    <input name="lastSchool" type="text">
    <input name="identEducacenso" type="text">
    <input name="yearLastGrade" type="text">

@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>

    <script>
        
        let columnsData = [
            {data: "id", name: "id"},
            {data: "name", name: "name"},
            {data: "last_name", name: "last_name"},
            {data: "email", name: "email"},
            {data: "gender", name: "gender"},
            {data: "student_type", name: "student_type"},
            {data: "school_class_name", name: "school_class_name"},
            {data: "call_number", name: "call_number"},
            {data: "school_year", name: "school_year"},
            {data: "contact", name: "contact"},
        ];

        let button =  {
            text: "<i class='fa fa-plus'></i> Novo(Excel)",
            attr: {

                id: "new-excel",
                class: "btn btn-primary"

            }
        }

        let dataTable = new DataTableController("/dashboard/student", columnsData, "Student", "", "", button);
    
        dataTable.createDataExcel("student", "Estudante", "/excelcreate/student");

    </script>

@endsection