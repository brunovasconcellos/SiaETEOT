<?
@extends('layouts.dashboard')

@section('th')

<tr>
    <th width="15%">ID</th>
    <th width="35%">nome</th>
    <th width="25%">abreviação</th>
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

    
    new DataTableController("/dashboard/discipline", colunnsData, 'Discipline', "", "");




    </script>



@endsection





?>