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
<span class='text-welcome-home display-4'>Olá, Seja Bem Vindo {{Auth::user()->name}}</span>

<br>
<br>

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-4">
      <div class="card card-scss">
        <div class="card-body">
          <h5 class="card-header">Adicionar Funcionário</h5>
          <p class="card-text">Ingresse um novo funcionário como uma nova função.</p>
          <a href="{{url('dashboard/employee')}}" class="btn btn-primary">Adicionar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card card-scss">
        <div class="card-body">
          <h5 class="card-header">Adicionar Aluno</h5>
          <p class="card-text">Ingresse um novo aluno na grade escolar.</p>
          <a href="{{url('dashboard/student')}}" class="btn btn-primary">Adicionar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-scss">
          <div class="card-body">
            <h5 class="card-header">Adicionar Responsável</h5>
            <p class="card-text">Ingresse um novo responsável legítimo de um aluno ao sistema.</p>
            <a href="{{url('dashboard/responsible')}}" class="btn btn-primary">Adicionar</a>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
        <div class="card card-scss">
          <div class="card-body">
            <h5 class="card-header">Visualizar Turmas</h5>
            <p class="card-text">Visualize todas as turmas da ETEOT.</p>
            <a href="{{url('dashboard/schoolclass')}}" class="btn btn-primary">Visualizar</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card card-scss">
          <div class="card-body">
            <h5 class="card-header">Visualizar Disciplinas</h5>
            <p class="card-text">Visualize todas as disciplinas da ETEOT.</p>
            <a href="{{url('dashboard/discipline')}}" class="btn btn-primary">Visualizar</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card card-scss">
          <div class="card-body">
            <h5 class="card-header">Visualizar Cargos</h5>
            <p class="card-text">Visualize todos os cargos da ETEOT.</p>
            <a href="{{url('dashboard/position')}}" class="btn btn-primary">Visualizar</a>
          </div>
        </div>
      </div>
  </div>
</div>
@stop
