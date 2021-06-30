<?

@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Alunos</h3>
@endsection

@section('th')


<tr>
    <th width="10%">ID</th>
    <th width="10%">nome</th>
    <th width="10%">sobrenome</th>
    <th width="10%">e-mail</th>
    <th width="5%">genero</th>
    <th width="7%">tipo de estudante</th>
    <th width="10%">turma</th>
    <th width="8%">numero da chamada</th>
    <th width="5%">ano</th>
    <th width="10%">celular</th>
    <th width="10%">Ação</th>

</tr>

@endsection

@section("input")

<<<<<<< HEAD
<div class="row">
    <div class="col-6">
        
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
    </div>

    <div class="col-6">
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
    </div>
</div>

=======
name
<input name="name" class="form-control" type="text" value="nome">
lastName
<input class="form-control" name="last_name" type="text" value="sobrenome">
email
<input name="email" class="form-control" type="text" value="email@email.com">
password
<input name="password" type="text" class="form-control" value="12345678">
password_confirmation
<input name="password_confirmation" type="text" class="form-control" value="12345678">
dateOfBirth
<input name="date_of_birth" type="text" class="form-control" value="2000-01-01">
gender
<input name="gender" type="text" class="form-control" value="M">
cellPhone
<input name="cell_phone" type="text" class="form-control" value="12345678901">
identityRg
<input name="identity_rg" type="text" class="form-control" value="123456789">
identityEmDt
<input name="identity_em_dt" type="text" class="form-control" value="2000-01-01">
identityAuthority
<input name="identity_authority" type="text" class="form-control" alue="DETRAN">
cpf
<input name="cpf" type="text" class="form-control" value="12345678901">
level
<input name="level" type="text" class="form-control" value="1">
numResidence
<input name="num_residence" type="text" class="form-control" value="1">
complementResidence
<input name="complement_residence" type="text" class="form-control" value="1">
cep
<input name="cep_user" type="text" class="form-control" value="12345678">
tp_public_place
<input name="tpPublicPlace" type="text" class="form-control" value="1">
publicPlace
<input name="publicPlace" type="text" class="form-control" value="1">
neighborhood
<input name="neighborhood" type="text" class="form-control" value="1">
city
<input name="city" type="text" class="form-control" value="1">
federation_unit
<input name="federationUnit" type="text" class="form-control" value="1">
fatherName
<input name="father_name" type="text" class="form-control" value="1">
matherName
<input name="mather_name" type="text" class="form-control" value="1">
studentType
<input name="student_type" type="text" class="form-control" value="1">
actualSituation
<input name="actual_situation" type="text" class="form-control" value="1">
half
<input name="half" type="text" class="form-control" value="1">
modality
<input name="modality" type="text" class="form-control" value="integral">
course
<input name="course" type="text" class="form-control" value="computing" >
>>>>>>> parent of af046bd (Mudanças significativas em select e nas funcionalidades)

@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

    <script>


        let dataTable = new StudentController("", "");

    </script>

@endsection
