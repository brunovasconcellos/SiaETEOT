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
<<<<<<< HEAD
<div class="row">
    <div class="col-6">
    Turma <input type="text" class="form-control" name="schoolClassName">
    Modalidade <select name="schoolClassType" id="schoolClassType" class="form-control">
            <option value="" selected>Selecione</option>
            <option value="Integral">Integral</option>
            <option value="Subsequente">Subsequente</option>
        </select>
    Ano Escolar <input type="number" class="form-control" name="schoolYear">
    Situação <select name="situation" id="situation" class="form-control">
                <option value="" selected>Selecione</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
    </div>
    <div class="col-6">
    Turno <select name="shift" id="shift" class="form-control">
                <option value="">Selecione</option>
                <option value="Diurno">Diurno</option>
                <option value="Noturno">Noturno</option>
            </select>
        Curso <select name="course" id="course" class="form-control">
                <option value="" selected>Selecione</option>
                @foreach ($cursos as $key => $value)
                <option value="{{$value->course_id}}">{{$value->course_name}}</option>
                @endforeach
            </select>
            Tipo <select name="modality" id="modality" class="form-control">
                <option value="" selected>Selecione</option>
                <option value="Técnico">Técnico</option>
            </select>
            <div class="row">
                <div class="col-6">Ano de inicio <input type="date" name="startDate" id="startDate" class="form-control"></div>
                <div class="col-6">Ano de Término <input type="date" name="endDate" id="endDate" class="form-control"></div>
            </div>
            
            
    </div>
</div>

       
        
            
=======

        <input type="text" class="form-control" name="schoolClassName">
        <input type="text" class="form-control" name="schoolClassType">
        <input type="number" class="form-control" name="schoolYear">
        <input type="text" class="form-control" name="situation">
        <input type="text" class="form-control" name="shift">
        <input type="number" class="form-control" name="course">

>>>>>>> parent of af046bd (Mudanças significativas em select e nas funcionalidades)
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
