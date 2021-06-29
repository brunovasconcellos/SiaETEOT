<?
@extends('layouts.dashboard')

@section('content2')
    <h3 class="ml-4"><a class="text-black-50" href="{{ route('schoolclass.index') }}">Voltar as Turmas</a></h3>
@endsection

@section('th')
<tr>
    <th width="10%">Student Registration</th>

     <th width="10%">Nome</th>
     <th width="10%">Sobrenome</th>
     <th width="10%">E-mail</th>
     <th width="15%">CPF</th>

    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')

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
    ];

        new DataTableController(window.location.pathname, colunnsData, 'SchoolClass');

</script>



@endsection





?>