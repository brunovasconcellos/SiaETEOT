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
@stop
