@extends("adminlte::page")
@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('content2')
<h3 class="ml-4">Inicio</h3>
@endsection

@section('js')

    <script src="{{asset('js/app.js')}}"></script>

<script>

    $(document).ready(function () {

        $("#discipline").select2({})

    });

</script>

@stop


@section('content')

<select name="" id="discipline"></select>
@stop
