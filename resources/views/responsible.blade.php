<?
@extends('layouts.dashboard')

@section('th')

<tr>
    <th width="16%">ID</th>
    <th width="18%">Nome</th>
    <th width="16%">Sobrenome</th>
    <th width="18%">E-mail</th>
    <th width="16%">Gênero</th>
    <th width="16%">Ação</th>
</tr>

@endsection



@section('input')

    Nome <input name="name" class="form-control" type="text">
    Sobrenome <input name="lastName"  class="form-control" type="text">
    E-mail <input name="email"  class="form-control" type="email">
    Senha <input name="password"  class="form-control" type="password">
    Confime a senha <input name="password_confirmation"  class="form-control" type="password">

    Aniversário <input name="dateOfBirth" class="form-control" type="date">
    Gênero <input name="gender" class="form-control" type="text">
    Número de celular <input name="cellPhone" class="form-control" type="tel">
    Identidade <input name="identityRg" class="form-control" type="number">
    Data identidade <input name="identityEmDt" class="form-control" type="date">

    Autoridade Identidade <input name="identityAuthority" class="form-control" type="text">
    CPF <input name="cpf" class="form-control" type="number">
    Nick <input name="userName" class="form-control">
    Nivel permissão <input name="level" class="form-control" type="number">
    Número da residência <input name="numResidence" class="form-control" type="number">

    Complemento <input name="complementResidence" class="form-control" type="text">
    CEP <input name="cep" class="form-control" type="number">
    Lugar Publico<input name="tpPublicPlace" class="form-control" type="text">
    Lugar <input name="publicPlace" class="form-control" type="text">
    Vizinho <input name="neighborhood" class="form-control" type="text">

    Cidade <input name="city" class="form-control" type="text">
    Unidade de Federação <input name="federationUnit" class="form-control" type="text">
    Tipo <input name="type" class="form-control" type="text">
    Contato <input name="contact" class="form-control" type="text">


    ID do Usuário <input type="number" class="form-control" name="userId">

    
@endsection



@section('scripts')

    <script src="{{ asset('js/controller/DataTableController.js') }}"></script>

    <script>

        columsData = [
            {data:"id", name:"id"},
            {data:"name", name:"name"},
            {data:"last_name", name:"last_name"},
            {data:"email", name:"email"},
            {data: "gender", name: "gender", render: function (data, type, row) {

                if (data == "f") {

                    return "Feminino";

                }

                    return "Masculino";

                }},
            ];
        
        let button = {
            text: "<i class='fa fa-plus'></i> Novo(Excel)",
            attr: {
                id: "new-excel",
                class: "btn btn-primary"
            }
        }
        
        let dataTable = new DataTableController("/dashboard/responsible", columsData, 'Responsible', "", "", button);

        dataTable.createDataExcel("responsible", "Responsável", "excelcreate/responsible");
    </script>

@endsection
?>