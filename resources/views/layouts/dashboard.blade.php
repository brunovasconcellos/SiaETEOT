<?
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    
<div class="list-div p-4">
<table id="list" class="table table-striped table-bordered" style="width:100%">

    <thead>

    
    @yield('th')


    </thead>

</table>
</div>

@component("layouts.components.modal")

    @slot("inputs")

    @yield('input')

    @endslot
@endcomponent

@stop

@section('js')

    <script src="{{asset('js/helpers/Helper.js')}}"></script>
    
    @yield('scripts')

@stop