<?
@extends('layouts.dashboard')

@section('content2')
<h3 class="ml-4">Cursos</h3>
@endsection

@section('th')

<tr>
    <th width="15%">ID</th>
    <th width="35%">Nome</th>
    <th width="25%">Carga Horária</th>
    <th width="25%">Ação</th>
</tr>

@endsection

@section('input')

        <input type="text" class="form-control" name="courseName">
        <input type="number" min="0" max="9999" class="form-control" name="courseWorkload">

@endsection

@section('scripts')

    <script src="{{ asset('js/controller/DataTableController.js') }}"></script>


    <script>

        let colunnsData = [
            {data:"id", name:"id"},
            {data:"course_name", name:"course_name"},
            {data:"course_workload", name:"course_workload"}
    ];

    let ruleCourse = {

        courseName: {
            required: true,
            minlength: 1,
        },

        courseWorkload: {
            required: true,
            number: true,
            minlength: 4,
        },

}

let messagesSchoolClass = {

    courseName: "O campo deve ser preenchido com no minimo 1 letra",
    courseWorkload: "O campo deve ser preenchido com um número de 4 digitos",


}



    new DataTableController("/dashboard/course", colunnsData, 'Course', ruleCourse, messagesSchoolClass);




    </script>



@endsection





?>
