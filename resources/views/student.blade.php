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

@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

    <script>


        let dataTable = new StudentController("", "");

    </script>

@endsection
