<?

@extends("layouts.dashboard")

@section('content2')
<h3 class="ml-4">Funcionários</h3>
@endsection

@section("th")

<tr>
    <th width="5%">ID</th>
    <th width="10%">ID Funcional</th>
    <th width="10%">Nome</th>
    <th width="10%">Sobrenome</th>
    <th width="10%">E-mail</th>
    <th width="5%">Gênero</th>
    <th width="10%">Contato</th>
    <th width="9%">Setor</th>
    <th width="10%">Funções</th>
    <th width="10%">Cargos</th>
    <th width="11%">Ação</th>
</tr>

@endsection

@section("input")
<div class="row">
    <div class="col-6">
    ID Funcional <input name="registration" class="form-control" type="text">
    Nome <input name="name" class="form-control" type="text">
    Sobrenome <input name="last_name"  class="form-control" type="text">
    E-mail <input name="email"  class="form-control" type="email">
    Senha <input name="password"  class="form-control" type="password">
    Confime a senha <input name="password_confirmation"  class="form-control" type="password">

    Aniversário <input name="dateOfBirth" class="form-control" type="date">
    Sexo <select name="gender" id="gender" class="form-control">
            <option value="" selected>Selecione</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
    Número de celular <input name="cellPhone" class="form-control" type="tel">
    Identidade <input name="identityRg" id="identityRg" class="form-control" type="text" data-mask="00.000.000-0" data-mask-clearifnotmatch="true">
    Data identidade <input name="identityEmDt" class="form-control" type="date">

    Orgão emissor <input name="identityAuthority" class="form-control" type="text">
    CPF <input name="cpf" class="form-control" type="text" data-mask="000.000.000-00">
    </div>
    <div class="col-6">
    Nick <input name="userName" class="form-control">
    Nivel permissão <select name="level" id="level" class="form-control">
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
    CEP <input name="cep" id="cep" class="form-control" type="text" data-mask="00000-000">
    Logradouro <input name="tpPublicPlace" class="form-control" type="text">
    Número da residência <input name="numResidence" class="form-control" type="number">
    Complemento <input name="complementResidence" class="form-control" type="text">
    Bairro <input name="neighborhood" class="form-control" type="text">
    Ponto de Referência <input name="publicPlace" class="form-control" type="text">
    Cidade <input name="city" class="form-control" type="text">
    Unidade de Federação <input name="federationUnit" class="form-control" type="text">
    Setor <select name="sectorId" id="sectorId" class="form-control">
                    <option value="" selected>Selecione</option>
                    @foreach ($setor as $key => $value)
                    <option value="{{$value->sector_id}}">{{$value->sector_name}}</option>
                    @endforeach
            </select>
    Cargo <select name="position_id" id="position_id" class="form-control">
                <option value="" selected>Selecione</option>
                @foreach ($posicao as $key => $value)
                <option value="{{$value->position_id}}">{{$value->position_name}}</option>
                @endforeach
            </select>

    </div>
</div>



@endsection

@section("increaseElements")
    $("#identityRg").cleanVal();
    <div>

    @component("layouts.components.modal", ["modalId" => "modal-occupation", "formId" => "form-occupation", "methodId" => "method-occupation", "buttonId" => "button-occupation"])

        @slot("inputs")

            Data do Começo <input type="date" class="form-control" name="startDate">
            Data final <input type="date" class="form-control" name="finalDate">
            Ocupação  <select name="occupations" id="occupations" class="form-control">
                        <option value="" selected>Selecione</option>
                        @foreach ($ocupacao as $key => $value)
                        <option value="{{$value->occupation_id}}">{{$value->occupation_name}}</option>
                        @endforeach
                    </select>

        @endslot
    @endcomponent

    </div>

@endsection

@section("scripts")

    <script src="{{asset('js/controller/EmployeeController.js')}}"></script>

    <script>
        let rulesOccupation = {

            startDate: {
                required: true,
                date: true
            },
            endDate: {

                required: true,
                date: true

            }

        }

        let messagesOccupation = {

            startDate: "O campo deve ser preenchido com  uma data válida.",
            endDate: "O campo deve ser preenchido com  uma data válida."

        }

        new EmployeeController("", "", rulesOccupation, messagesOccupation);

    </script>

@endsection
