<?
@extends('layouts.dashboard')

@section('th')

<tr>
    <th width="15%">ID</th>
    <th width="35%">Nome</th>
    <th width="25%">Abreviação</th>
    <th width="25%">Ação</th>
</tr>

@endsection

@section('input')

        <input type="text" class="form-control" name="disciplineName">
        <input type="text" class="form-control" name="disciplineAbbreviation">  

@endsection

@section('scripts')

    <script src="{{ asset('js/controller/DataTableController.js') }}"></script>


    <script>

        let colunnsData = [
            {data:"id", name:"id"},
            {data:"discipline_name", name:"discipline_name"},
            {data:"discipline_abbreviation", name:"discipline_abbreviation"}
    ];

    
    let ruleDiscipline = {

        disciplineName: {
            required: true,
            minlength: 1,
        },

        disciplineAbbreviation: {
            required: true,
            minlength: 1,
        },

}

    let messagesSchoolClass = {

        disciplineName: "O campo deve ser preenchido com no minimo 1 letra",
        disciplineAbbreviation: "O campo deve ser preenchido com no minimo 1 letra",


    }



    
    new DataTableController("/dashboard/discipline", colunnsData, 'Discipline', ruleDiscipline, messagesSchoolClass);

    </script>

@endsection
