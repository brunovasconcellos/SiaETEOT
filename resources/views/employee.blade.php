<?

@extends("layouts.dashboard")


@section("th")
<tr>
    <th width="10%">ID</th>
    <th width="15%">Nome</th>
    <th width="15%">Sobrenome</th>
    <th width="10%">E-mail</th>
    <th width="10%">Gênero</th>
    <th width="10%">Contato</th>
    <th width="10%">Setor</th>
    <th width="64px">Ação</th>
</tr>

@endsection

@section("input")



        <input name="name" class="form-control" type="text">
        <input name="lastName"  class="form-control" type="text">
        <input name="email"  class="form-control" type="email">
        <input name="password"  class="form-control" type="password">
        <input name="password_confirmation"  class="form-control" type="password">
   
        <input name="dateOfBirth" class="form-control" type="date">
        <input name="gender" class="form-control" type="text">
        <input name="cellPhone" class="form-control" type="tel">
        <input name="identityRg" class="form-control" type="number">
        <input name="identityEmDt" class="form-control" type="date">

        <input name="identityAuthority" class="form-control" type="text">
        <input name="cpf" class="form-control" type="number">
        <input name="userName" class="form-control" type="text">
        <input name="level" class="form-control" type="number">
        <input name="numResidence" class="form-control" type="number">

        <input name="complementResidence" class="form-control" type="text">
        <input name="cep" class="form-control" type="number">
        <input name="tpPublicPlace" class="form-control" type="text">
        <input name="publicPlace" class="form-control" type="text">
        <input name="neighborhood" class="form-control" type="text">

        <input name="city" class="form-control" type="text">
        <input name="federationUnit" class="form-control" type="text">
        <input name="type" class="form-control" type="text">
        <input name="contact" class="form-control" type="text">
        <input name="sectorId" class="form-control" type="text">



@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>

    <script>
    
        $(document).ready(function () {

            let columnsData = [
                {data: "id", name: "id"},
                {data: "name", name: "name"},
                {data: "last_name", name: "last_name"},
                {data: "email", name: "email"},
                {data: "gender", name: "gender"},
                {data: "contact", name: "contact"},
                {data: "sector_name", name: "sector_name"},
            ];

            new DataTableController("/dashboard/employee", columnsData, "Funcionarios");

        });
    
    </script>

@endsection