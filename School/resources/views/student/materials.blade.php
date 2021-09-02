@extends('student.main')


@section('content')
<div class="container">
<h1 class="text-center">Shared Materials</h1>
<br>
    <table class="table text-center">

        <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
               <th>Options</th>
               
        </tr>
        @foreach ($data as $item)
            <tr>
                <th>{{$item->name}}</th>
                <th>{{$item->description}}</th>
                <th>{{$item->date}}</th>
                
                <th>
                    
                    <!--<a href="/student/materials/view/{{$item->id}}"><i class="fa fa-eye fa-2x"></i></a>&nbsp;&nbsp;&nbsp;-->
                    <a href="/student/materials/download/{{$item->file}}"><i class="fa fa-download fa-2x"></i> </a>
                </th>
            </tr>
           
        @endforeach
    </table>
</div>
@stop