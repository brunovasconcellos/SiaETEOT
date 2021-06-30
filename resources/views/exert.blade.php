<?
@extends("layouts.dashboard")

@section('content2')
<h3 class="ml-4">Atribui Função</h3>
@endsection

@section('th')
<tr>
    <th width='20%'>ID</th>
    <th width='20%'>Registro</th>
    <th width='20%'>Nome</th>
    <th width='20%'>Posição</th>
    <th width='20%'>Ação</th>
</tr>
@endsection

@section('input')

        <input type="text" class="form-control" name="registration">
        <input type="text" class="form-control" name="userName">
        <input type="text" class="form-control" name="positionName">

@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>

    let colunnsData = [
        {data:"id", name:"id"},
        {data:"registration", name:"registration"},
        {data:"user_name", name:"user_name"},
        {data:"position_name", name:"position_name"},
];

    let ruleExert = {

                registration: {
                    required: true,
                    minlength: 1,
                },

                userName: {
                    required: true,
                    minlength: 1,
                },

                positionName: {
                    required: true,
                    minlength: 1,
                },
}

let messagesExert = {

        registration: "O campo deve ser preenchido com no minimo 1 letra",
        userName: "O campo deve ser preenchido com no minimo 1 letra",
        positionName: "O campo deve ser preenchido com no minimo 1 letra",

}

new DataTableController("/dashboard/exert", colunnsData, 'Exert', ruleExert, messagesExert);

</script>
@endsection
