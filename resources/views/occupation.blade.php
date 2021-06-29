<?
@extends("layouts.dashboard")

@section('content2')
<h3 class="ml-4">Ocupação</h3>
@endsection

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
        {data:"id", name:"id"},
        {data:"occupation_name", name:"occupation_name"},
];

    let ruleOccupation = {

                occupationName: {
                    required: true,
                    minlength: 1,
                },
}

let messagesOccupation = {

        occupationName: "O campo deve ser preenchido com no minimo 1 letra",

}

new DataTableController("/dashboard/occupation", colunnsData, 'Occupation', ruleOccupation, messagesOccupation);

</script>
@endsection
