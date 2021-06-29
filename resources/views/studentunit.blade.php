<?
@extends('layouts.dashboard')

@section('th')

<tr>
    <th width="10%">ID</th>

     <th width="15%">Nome</th>
     <th width="10%">Telefone</th>

    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')

        <input type="text" class="form-control" name="suName">
        <input type="text" class="form-control" name="suPhone">

@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>

    let colunnsData = [
        {data:"id", name:"id"},
        {data:"su_name", name:"su_name"},
        {data:"su_phone", name:"su_phone"},

];

    let ruleStudentUnit = {

                suName: {
                    required: true,
                    minlength: 1,
                },

                suPhone: {
                    required: true,
                    number: true,
                },

}

let messagesStudentUnit = {

        suName: "O campo deve ser preenchido com no minimo 1 letra",
        suPhone: "O campo deve ser preenchido com numeros",


}






new DataTableController("/dashboard/studentunit", colunnsData, 'StudentUnit', ruleStudentUnit, messagesStudentUnit);


    </script>



@endsection





?>