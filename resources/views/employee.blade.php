<?

@extends("layouts.dashboard")


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
    ID do usuário <input type="text" class="form-control" type="text">
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
    ID da Seção <input name="sectorId" class="form-control" type="text">

    Registro <input name="registration" class="form-control" type="text">
    Posição id<input name="positionId" class="form-control" type="text">


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