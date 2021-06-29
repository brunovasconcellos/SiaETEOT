<?

@extends("layouts.dashboard")

@section('th')
<tr>
    <th width='33%'>ID</th>
    <th width='34%'>Nome</th>
    <th width='33%'>Ação</th>
</tr>
@endsection

@section('input')

        <input type="text" class="form-control" name="occupationName">

@endsection

@section('scripts')

<script src="{{ asset('js/controller/DataTableController.js') }}"></script>


<script>

    let colunnsData = [
        {data:"occupationid", name:"occupationid"},
        {data:"occupation_name", name:"occupation_name"},
];

    let ruleOccupation = {

                occupationname: {
                    required: true,
                    minlength: 1,
                },
}

let messagesOccupation = {

        schoolClassName: "O campo deve ser preenchido com no minimo 1 letra",

}
