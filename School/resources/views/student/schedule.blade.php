@extends('student.main') @section('content')
<div class="container">
 <h1 class="text-center">Schedule</h1>
 <br />
 <table class="table table-bordered text-center">
  <tr>
   <th>Moday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==1)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
  <tr>
   <th>Tuesday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==2)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
  <tr>
   <th>Wednesday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==3)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
  <tr>
   <th>Thursday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==4)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
  <tr>
   <th>Friday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==5)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
  <tr>
   <th>Saturday</th>
   @foreach($schedule as $sched) @if ($sched->day_nb==6)
   <th>
    <p>{{$sched->subject}}</p>
    <p style="font-size:10px;">Dr.{{$sched->teacher}}</p>
    {{$sched->time_start}}-{{$sched->time_end}}
   </th>
   @endif @endforeach
  </tr>
 </table>
</div>
@stop
