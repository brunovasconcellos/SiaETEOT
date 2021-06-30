<?

@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Alunos</h3>
@endsection

@section('th')


<tr>
    <th width="10%">ID</th>
    <th width="10%">Nome</th>
    <th width="10%">Sobrenome</th>
    <th width="10%">E-mail</th>
    <th width="5%">Gênero</th>
    <th width="7%">Tipo de Estudante</th>
    <th width="10%">Turma</th>
    <th width="8%">Numero chamada</th>
    <th width="5%">Ano</th>
    <th width="10%">Celular</th>
    <th width="10%">Ação</th>

</tr>

@endsection

@section("input")

Nome <input name="name" class="form-control" type="text">
Sobrenome <input class="form-control" name="last_name" type="text">
E-mail <input name="email" class="form-control" type="text">
Senha <input name="password" type="password" class="form-control">
Confirmação da Senha <input name="password_confirmation" type="password" class="form-control">

Data de nascimento <input name="date_of_birth" type="date" class="form-control">
Sexo <select name="gender" id="gender" class="form-control">
        <option value="" selected>Selecione</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
     </select>
Celular <input name="cell_phone" type="text" class="form-control">
Identidade <input name="identity_rg" type="text" class="form-control">
Data da identidade <input name="identity_em_dt" type="date" class="form-control">

Autoridade Identidade <input name="identity_authority" type="text" class="form-control">
CPF <input name="cpf" type="text" class="form-control">

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

Numero da casa <input name="num_residence" type="text" class="form-control" value="1">
Complemento <input name="complement_residence" type="text" class="form-control" value="1">
CEP <input name="cep_user" type="text" class="form-control" value="12345678">
Lugar Publico <input name="tpPublicPlace" type="text" class="form-control" value="1">
Lugar Publico <input name="publicPlace" type="text" class="form-control" value="1">
Vizinhança <input name="neighborhood" type="text" class="form-control" value="1">
Cidade <input name="city" type="text" class="form-control" value="1">
Federação <input name="federationUnit" type="text" class="form-control" value="1">

Nome do Pai <input name="father_name" type="text" class="form-control" value="1">
Nome da mãe <input name="mather_name" type="text" class="form-control" value="1">
Tipo do estudante <input name="student_type" type="text" class="form-control" value="1">
Situação atual <input name="actual_situation" type="text" class="form-control" value="1">
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
@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

    <script>


        let dataTable = new StudentController("", "");

    </script>

@endsection
