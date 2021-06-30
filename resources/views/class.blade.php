<?
@extends('layouts.dashboard')

@section('content2')
    <h3 class="ml-4"><i class="fa fa-caret-left" aria-hidden="true"></i> <a class="text-black-50" href="{{ route('schoolclass.index') }}">Voltar as Turmas</a></h3>
@endsection

@section('th')
<tr>
    <th width="10%">Matrícula</th>

     <th width="10%">Nome</th>
     <th width="10%">Sobrenome</th>
     <th width="10%">E-mail</th>
     <th width="15%">CPF</th>
    <th width="15%">Número na Chamada</th>
    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')
Matricula <input type="text" class="form-control" name="studentRegistration">
Nome <input type="text" class="form-control" name="name">
Sobrenome <input type="text" class="form-control" name="lastName">
E-mail <input type="text" class="form-control" name="email">
CPF <input type="text" class="form-control" name="cpf">
Número na chamada <input type="text" class="form-control" name="callNumber">
@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>
    let colunnsData = [
        {data:"student_registration", name:"student_registration"},
        {data:"name", name:"name"},
        {data:"last_name", name:"last_name"},
        {data:"email", name:"email"},
        {data:"cpf", name:"cpf"},
        {data:"call_number", name:"call_number"},
    ];

        new DataTableController(window.location.pathname, colunnsData, 'Alunos');

</script>


@endsection





?>
