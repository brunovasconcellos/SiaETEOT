<?

@extends('adminlte::page')
 
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="list-div">

    <div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width: 10%">ID</th>
                <th>Curso</th>
                <th>Carga Horaria</th>
                <th style="width: 64px">Ação</th>
            </tr>
        </thead>
    </table>
</div>

@component("layouts.components.modal")

    @slot("inputs")
        <input type="text" id="courseName" name="courseName" class="form-control my-2">
        <input type="number" id="courseWorkload" name="courseWorkload"  class="form-control my-2">
    @endslot

@endcomponent

@endsection

@section('js')

    <script src="{{asset('js/helpers/helper.js')}}"></script>

    <script src="{{asset('js/controller/DataTableController.js')}}"></script>

    <script>

        $(document).ready(function () {

            let columnsData = [
                {data: "id", name: "id"},
                {data: "course_name", name: "course_name"},
                {data: "course_workload", name: "course_workload"},
            ];

            let rule = {
                courseName: {
                    required: true,
                    minlength: 1,
                },

                courseWorkload: {
                    required: true,
                }
            }

            let message = {
                
                courseName: "O nome do curso deve ser preenchido.",
                courseWorkload: "A carga horaria deve ser preenchida."

            }

            new DataTableController("/dashboard/course", columnsData, "Course", rule, message);
    
        });

    </script>
@stop