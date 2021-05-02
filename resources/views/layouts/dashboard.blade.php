<?
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
    
    .select2-container {

        z-index: 99999;
        width: 100% !important;
    }

    </style>

@stop

@section('content')
    
<div class="list-div p-4">
<table id="list" class="table table-striped table-bordered" style="width:100%">

    <thead>

    
    @yield('th')


    </thead>

</table>
</div>

@component("layouts.components.modal", ["modalId" => "modal", "formId" => "form-submit", "methodId" => "method", "buttonId" => "modal-button"])

    @slot("inputs")

    @yield('input')

    @endslot
@endcomponent

@yield("increaseElements")

@stop

@section('js')

    <script src="{{asset('js/helpers/Helper.js')}}"></script>
    <script src="{{asset('js/modal_stepbystep.js')}}"></script>
    
    @yield('scripts')

@stop
