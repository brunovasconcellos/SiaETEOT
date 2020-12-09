<?

@extends('layouts.dashboard')

@section('th')


<tr>
    <th width="10%">ID</th>
    <th width="10%">nome</th>
    <th width="10%">sobrenome</th>
    <th width="10%">e-mail</th>
    <th width="5%">genero</th>
    <th width="10%">tipo de estudante</th>
    <th width="10%">turma</th>
    <th width="8%">numero da chamada</th>
    <th width="7%">ano</th>
    <th width="8%">contato</th>
    <th width="17%">Ação</th>
    
</tr>

@endsection

@section("input")

name
<input name="name" class="form-control" type="text">
lastName
<input class="form-control" name="lastName" type="text">
email
<input name="email" class="form-control" type="text">
password
<input name="password" type="text" class="form-control">
password_confirmation
<input name="password_confirmation" type="text" class="form-control">
dateOfBirth
<input name="dateOfBirth" type="text" class="form-control">
gender
<input name="gender" type="text" class="form-control">
cellPhone
<input name="cellPhone" type="text" class="form-control">
identityRg
<input name="identityRg" type="text" class="form-control">
identityEmDt
<input name="identityEmDt" type="text" class="form-control">
identityAuthority
<input name="identityAuthority" type="text" class="form-control">
cpf
<input name="cpf" type="text" class="form-control">
userName
<input name="userName" type="text" class="form-control">
level
<input name="level" type="text" class="form-control">
numResidence
<input name="numResidence" type="text" class="form-control">
complementResidence
<input name="complementResidence" type="text" class="form-control">
cep
<input name="cep" type="text" class="form-control">
tpPublicPlace
<input name="tpPublicPlace" type="text" class="form-control">
publicPlace
<input name="publicPlace" type="text" class="form-control">
neighborhood
<input name="neighborhood" type="text" class="form-control">
city<input name="city" type="text" class="form-control">
federationUnit
<input name="federationUnit" type="text" class="form-control">
type
<input name="type" type="text" class="form-control">
contact
<input name="contact" type="text" class="form-control">
fatherName
<input name="fatherName" type="text" class="form-control">
matherName
<input name="matherName" type="text" class="form-control">
studentType
<input name="studentType" type="text" class="form-control">
actualSituation
<input name="actualSituation" type="text" class="form-control">
half
<input name="half" type="text" class="form-control">
modality
<input name="modality" type="text" class="form-control">
course
<input name="course" type="text" class="form-control">
ingressType
<input name="ingressType" type="text" class="form-control">
ingressForm
<input name="ingressForm" type="text" class="form-control">
vagacyType
<input name="vagacyType" type="text" class="form-control">
lastSchool
<input name="lastSchool" type="text" class="form-control">
identEducacenso
<input name="identEducacenso" type="text" class="form-control">
yearLastGrade
<input name="yearLastGrade" type="text" class="form-control">

@endsection

@section("scripts")

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>
    <script src="{{asset('js/controller/StudentController.js')}}"></script>

    <script>
        

        let dataTable = new StudentController("", "");

    </script>

@endsection