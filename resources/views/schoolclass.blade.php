<?
@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Turmas</h3>
@endsection

@section('th')

<tr>
    <th width="10%">ID</th>

     <th width="15%">Nome</th>
     <th width="10%">Tipo</th>
     <th width="10%">Ano</th>
     <th width="15%">Situação</th>
     <th width="10%">Turno</th>
     <th width="10%">Curso</th>

    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')

        <input type="text" class="form-control" name="schoolClassName">
        <input type="text" class="form-control" name="schoolClassType">
        <input type="number" class="form-control" name="schoolYear">
        <input type="text" class="form-control" name="situation">
        <input type="text" class="form-control" name="shift">
        <input type="number" class="form-control" name="course">

@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>

    let colunnsData = [
        {data:"id", name:"id"},
        {data:"school_class_name", name:"school_class_name"},
        {data:"school_class_type", name:"school_class_type"},
        {data:"school_year", name:"school_year"},
        {data:"situation", name:"situation"},
        {data:"shift", name:"shift"},
        {data:"course_name", name:"course_name"},
];

    let ruleSchoolClass = {

                schoolClassName: {
                    required: true,
                    minlength: 1,
                },

                schoolClassType: {
                    required: true,
                },
                schoolYear: {
                    required: true,
                    number: true,
                },
                situation: {
                    required: true,
                    minlength: 1,
                },
                shift: {
                    required: true,
                },

}

let messagesSchoolClass = {

        schoolClassName: "O campo deve ser preenchido com no minimo 1 letra",
        schoolClassType: "O campo deve ser preenchido com no minimo 1 letra",
        schoolYear: "O campo deve ser preenchido com um ano",
        situation: "O campo deve ser preenchido com no minimo 1 letra",
        shift: "O campo deve ser preenchido com no minimo 1 letra",

}






new DataTableController("/dashboard/schoolclass", colunnsData, 'SchoolClass', ruleSchoolClass, messagesSchoolClass);


    </script>



@endsection





?>
