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

    <input name="registration" class="form-control" type="text">
    <input name="positionId" class="form-control" type="text">


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

    $("#occupations").select2({

        ajax: {

            url: "/dashboard/occupationformated",
            method: "GET",
            dataType: "json",
            processResults: (response) => {
                return {"results": response}
            },
            cache: true

        }

    });


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