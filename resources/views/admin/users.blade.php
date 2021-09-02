@extends('admin.main')
 @section('content')


 <div class="container">

    <h1 class="text-center">User List</h1>
<br>
<div class="table-responsive">


    <table class="table text-center">
        <tr>
            <th>ID</th>
            <th>Password</th>
            <th>Type</th>
            <th></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th>{{$user->password}}</th>
                <th>{{$user->type}}</th>
                <th>    
                        <a href="deleteuser/{{$user->id}}" class="btn btn-danger">Delete</a>
                        <a href="viewuser/{{$user->id}}" class="btn btn-primary">View</a>
                 </th>
            </tr>
        @endforeach

    </table>
</div>
 </div>
 @stop

