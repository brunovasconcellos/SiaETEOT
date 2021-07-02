<?
@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Responsável</h3>
@endsection

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
<div class="row">
<div class="col-6">
Nome <input name="name" class="form-control" type="text">
    Sobrenome <input name="lastName"  class="form-control" type="text">
    E-mail <input name="email"  class="form-control" type="email">
    Senha <input name="password"  class="form-control" type="password">
    Confime a senha <input name="password_confirmation"  class="form-control" type="password">

    Aniversário <input name="dateOfBirth" class="form-control" type="date">
    Sexo <select name="gender" id="gender" class="form-control">
        <option value="" selected>Selecione</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
     </select>
    Número de Celular <input name="cellPhone" class="form-control" id='celular' type="text" data-mask="(00)00000-0000">
    Identidade <input name="identityRg" class="form-control" type="text" id='identityRg' data-mask="00.000.000-0">
    Data da identidade <input name="identityEmDt" class="form-control" type="date">

    Orgão emissor <input name="identityAuthority" class="form-control" type="text">
    CPF <input name="cpf" id='cpf' class="form-control" type="text" data-mask="000.000.000-00">
</div>
<div class="col-6">
Nivel <select name="level" id="level" class="form-control">
        <option value="" selected>Selecione</option>
        <option value="1">Aluno</option>
        <option value="2">Responsável</option>
        <option value="3">Orientação Educacional</option>
        <option value="4">Setor Pessoal</option>
        <option value="5">Inspetoria</option>
        <option value="6">Supervisão</option>
        <option value="7">Coordenação</option>
        <option value="8">Corpo Docente</option>
        <option value="9">Secretaria</option>
        <option value="10">Diretoria</option>
        <option value="11">Administrador</option>
    </select>

CEP <input name="cep" class="form-control" type="text" id='cep' data-mask="00000-000">
Logradouro <input name="tpPublicPlace" class="form-control" type="text">
Número da residência <input name="numResidence" class="form-control" type="number">
Complemento <input name="complementResidence" class="form-control" type="text">
Bairro <input name="neighborhood" class="form-control" type="text">
Ponto de Referência <input name="publicPlace" class="form-control" type="text">
Cidade <input name="city" class="form-control" type="text">
Unidade de Federação <input name="federationUnit" class="form-control" type="text">

Tipo <input name="type" class="form-control" type="text">
Contato <input name="contact" class="form-control" type="text">


Estudante   <select name="userId" id="userId" class="form-control">
                <option value="" selected>Selecione</option>
                @foreach ($estudante as $key => $value)
                <option value="">{{$value->name}} {{$value->last_name}}</option>
                @endforeach
            </select>
</div>
@endsection



@section('scripts')

    <script src="{{ asset('js/controller/DataTableController.js') }}"></script>

    <script>
        function hideDot(){
            cep = document.getElementById('cep').value
            celular = document.getElementById('celular').value
            cpf = document.getElementById('cpf').value
            identidade = document.getElementById('identityRg').value

            document.getElementById('identityRg').value = identidade.replace(/[^\dX]/g,'')
            document.getElementById('cep').value = cep.replace(/[^\dX]/g,'')
            document.getElementById('celular').value = celular.replace(/[^\dX]/g,'')
            document.getElementById('cpf').value = cpf.replace(/[^\dX]/g,'')
        }

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
