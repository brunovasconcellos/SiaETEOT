@extends("adminlte::page")
@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('content2')
<h3 class="ml-4">Inicio</h3>
@endsection

@section('js')



@stop


@section('content')
<span class='display-4'>Olá, Seja Bem Vindo {{Auth::user()->name}}</span>

<br>
<br>

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-header">Adicionar Funcionário</h5>
          <p class="card-text">Ingresse um novo funcionário como uma nova função.</p>
          <a href="{{url('dashboard/employee')}}" class="btn btn-primary">Adicionar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-header">Adicionar Aluno</h5>
          <p class="card-text">ingresse um novo aluno na grade escolar.</p>
          <a href="{{url('dashboard/student')}}" class="btn btn-primary">Adicionar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-header">Adicionar Responsável</h5>
            <p class="card-text">Adicione um novo responsável legítimo de um aluno ao sistema.</p>
            <a href="{{url('dashboard/responsible')}}" class="btn btn-primary">dicionar</a>
          </div>
        </div>
      </div>
  </div>
</div>
@stop
