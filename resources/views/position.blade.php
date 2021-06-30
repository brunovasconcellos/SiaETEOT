<?
@extends('layouts.dashboard')
@section('content2')
<h3 class="ml-4">Cargo</h3>
@endsection

@section('th')

<tr>
    <th width="10%">ID</th>

     <th width="15%">Nome</th>
     <th width="10%">Carga Horária</th>
     <th width="10%">Tipo</th>


    <th width="10%">Ação</th>
</tr>


@endsection

@section('input')

        Nome do Cargo <input type="text" class="form-control" name="positionName">
        Carga Horária <input type="text" class="form-control" name="workload">
        Tipo do Cargo <input type="text" class="form-control" name="type">


@endsection

@section('scripts')
as
<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>

    let colunnsData = [
        {data:"id", name:"id"},
        {data:"position_name", name:"position_name"},
        {data:"workload", name:"workload"},
        {data:"type", name:"type"},

];

    let rulePosition = {

                positionName: {
                    required: true,
                    minlength: 1,
                },

                workload: {
                    required: true,
                    minlength: 2,
                },
                type: {
                    required: true,
                    minlength: 1,
                },

}

let messagesPosition = {

        positionName: "O campo deve ser preenchido com no minimo 1 letra",
        workload: "O campo deve ser preenchido com numero",
        type: "O campo deve ser preenchido com no minimo 1 letra",

}






new DataTableController("/dashboard/position", colunnsData, 'Position', rulePosition, messagesPosition);


    </script>



@endsection
