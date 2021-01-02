<?

@extends('layouts.dashboard')

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
<input name="name" class="form-control" type="text">
lastName
<input class="form-control" name="last_name" type="text">
email
<input name="email" class="form-control" type="text">
password
<input name="password" type="text" class="form-control">
password_confirmation
<input name="password_confirmation" type="text" class="form-control">
dateOfBirth
<input name="date_of_birth" type="text" class="form-control">
gender
<input name="gender" type="text" class="form-control">
cellPhone
<input name="cell_phone" type="text" class="form-control">
identityRg
<input name="identity_rg" type="text" class="form-control">
identityEmDt
<input name="identity_em_dt" type="text" class="form-control">
identityAuthority
<input name="identity_authority" type="text" class="form-control">
cpf
<input name="cpf" type="text" class="form-control">
level
<input name="level" type="text" class="form-control">
numResidence
<input name="num_residence" type="text" class="form-control">
complementResidence
<input name="complement_residence" type="text" class="form-control">
cep
<input name="cep_user" type="text" class="form-control">
fatherName
<input name="father_name" type="text" class="form-control">
matherName
<input name="mather_name" type="text" class="form-control">
studentType
<input name="student_type" type="text" class="form-control">
actualSituation
<input name="actual_situation" type="text" class="form-control">
half
<input name="half" type="text" class="form-control">
modality
<input name="modality" type="text" class="form-control">
course
<input name="course" type="text" class="form-control">

@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

    <script>
        

        let dataTable = new StudentController("", "");

    </script>

@endsection