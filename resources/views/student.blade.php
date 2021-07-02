<?

@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Alunos</h3>
@endsection

@section('th')


<tr>
    <th width="10%">Matricula</th>
    <th width="8%">Numero chamada</th>
    <th width="10%">Nome</th>
    <th width="10%">Sobrenome</th>
    <th width="10%">E-mail</th>
    <th width="12%">Gênero</th>
    <th width="10%">Turma</th>
    <th width="15%">Celular</th>
    <th width="10%">Ação</th>

</tr>

@endsection

@section("input")

<div class="row">
    <div class="col-6">

Nome <input name="name" class="form-control" type="text">
Sobrenome <input class="form-control" name="last_name" type="text">
E-mail <input name="email" class="form-control" type="text">
Senha <input name="password" type="password" class="form-control">
Confirmação da Senha <input name="password_confirmation" type="password" class="form-control">

Data de Nascimento <input name="date_of_birth" type="date" class="form-control">
Sexo <select name="gender" id="gender" class="form-control">
        <option value="" selected>Selecione</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
     </select>
Celular <input name="cell_phone" id='celular' type="text" class="form-control" data-mask="(00)00000-0000">
Identidade <input name="identity_rg" id='identityRg' type="text" class="form-control" data-mask="00.000.000-0">
Data da identidade <input name="identity_em_dt" type="date" class="form-control">

Orgão emissor <input name="identity_authority" type="text" class="form-control">
CPF <input name="cpf" id='cpf' type="text" class="form-control" data-mask="000.000.000-00">

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
</div>
    <div class="col-6">
CEP <input name="cep_user" id='cep' class="form-control" type="text" data-mask="00000-000">
Logradouro <input name="tpPublicPlace" class="form-control" type="text">
Número da residência <input name="num_residence" class="form-control" type="number">
Complemento <input name="complement_residence" class="form-control" type="text">
Bairro <input name="neighborhood" class="form-control" type="text">
Ponto de Referência <input name="publicPlace" class="form-control" type="text">
Cidade <input name="city" class="form-control" type="text">
Unidade de Federação <input name="federationUnit" class="form-control" type="text">

    Nome do Pai <input name="father_name" type="text" class="form-control">
    Nome da mãe <input name="mather_name" type="text" class="form-control">
    Tipo do estudante <input name="student_type" type="text" class="form-control">
    Situação atual <select name="actual_situation" id="situation" class="form-control">
                <option value="" selected>Selecione</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
    Turno <select name="half" id="half" class="form-control">
            <option value="">Selecione</option>
            <option value="1">Diurno</option>
            <option value="2">Noturno</option>
        </select>
    Modalidade <select name="modality" id="modality" class="form-control">
                    <option value="" selected>Selecione</option>
                    <option value="integral">Integral</option>
                    <option value="subsequently">Subsequente</option>
                </select>
    Curso <select name="course" id="course" class="form-control">
            <option value="" selected>Selecione</option>
            @foreach ($cursos as $key => $value)
            <option value="{{$value->course_id}}">{{$value->course_name}}</option>
            @endforeach
        </select>
    </div>
</div>


@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

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

        let dataTable = new StudentController("", "");

    </script>

@endsection
