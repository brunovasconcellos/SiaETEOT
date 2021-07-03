<?
@extends('layouts.dashboard')

@section('content2')
    <h3 class="ml-4"><i class="fa fa-caret-left" aria-hidden="true"></i> <a class="text-black-50" href="{{ route('schoolclass.index') }}">Voltar as Turmas</a></h3>
@endsection

@section('th')
<tr>
    <th width="15%">Número na Chamada</th>
    <th width="10%">Matrícula</th>

     <th width="10%">Nome</th>
     <th width="10%">Sobrenome</th>
     <th width="10%">E-mail</th>
     <th width="15%">CPF</th>

    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')
Número na chamada <input type="text" class="form-control" name="callNumber">
Matricula <input type="text" class="form-control" name="studentRegistration">
Nome <input type="text" class="form-control" name="name">
Sobrenome <input type="text" class="form-control" name="lastName">
E-mail <input type="text" class="form-control" name="email">
CPF <input type="text" class="form-control" name="cpf">
@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>
    let colunnsData = [
        {data:"call_number", name:"call_number"},
        {data:"student_registration", name:"student_registration"},
        {data:"name", name:"name"},
        {data:"last_name", name:"last_name"},
        {data:"email", name:"email"},
        {data:"cpf", name:"cpf"},
    ];

        @foreach ($turmas as $key => $value)
            new DataTableController(window.location.pathname, colunnsData, 'alunos da turma '+ {{$value->school_class_name}}+ " do ano de "+{{$value->school_year}});
        @endforeach

</script>


@endsection





?>
