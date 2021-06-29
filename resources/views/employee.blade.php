<?

@extends("layouts.dashboard")

@section('content2')
<h3 class="ml-4">Funcionários</h3>
@endsection

@section("th")

<tr>
    <th width="5%">ID</th>
    <th width="10%">Matrícula</th>
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

    Nome <input name="name" class="form-control" type="text" value="Teste">
    Sobrenome <input name="last_name"  class="form-control" type="text" value="Teste">
    E-mail <input name="email"  class="form-control" type="email" value="Teste@teste.com">
    Senha <input name="password"  class="form-control" type="password" value="12341234">
    Confime a senha <input name="password_confirmation"  class="form-control" type="password" value="12341234">

    Aniversário <input name="dateOfBirth" class="form-control" type="date" value="1000-10-10">
    Gênero <input name="gender" class="form-control" type="text" value="M">
    Número de celular <input name="cellPhone" class="form-control" type="tel" value="12345678901">
    Identidade <input name="identityRg" class="form-control" type="number" value="123456789">
    Data identidade <input name="identityEmDt" class="form-control" type="date" value="1000-10-10">

    Autoridade Identidade <input name="identityAuthority" class="form-control" type="text" value="Teste">
    CPF <input name="cpf" class="form-control" type="number" value="12345678910">
    Nick <input name="userName" class="form-control" value="1234">
    Nivel permissão <input name="level" class="form-control" type="number" value="9">
    Número da residência <input name="numResidence" class="form-control" type="number" value="9">

    Complemento <input name="complementResidence" class="form-control" type="text" value="Teste">
    CEP <input name="cep" class="form-control" type="number" value="20010000">
    ID da Setor <input name="sectorId" class="form-control" type="text" value="19">

    Matricula <input name="registration" class="form-control" type="text" value="1000">
    Posição <input name="position_id" class="form-control" type="text" value="3">

@endsection

@section("increaseElements")

    <div>

    @component("layouts.components.modal", ["modalId" => "modal-occupation", "formId" => "form-occupation", "methodId" => "method-occupation", "buttonId" => "button-occupation"])

        @slot("inputs")

            <input type="date" class="form-control" name="startDate">
            <input type="date" class="form-control" name="finalDate">
            <select id="occupations" class="form-control"></select>

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
