

@extends('admin.main')
 @section('content')
<div class="container">
   <h1 class="text-center">Schedule</h1>
   <br />
   <div class="table-responsive">
      <table class="table table-bordered text-center">
         <tr>
            <th>Monday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==1)
            <th>

               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger">Delete</a>
            </th>
			 @endif
            @endforeach
         </tr>
         <tr>
            <th>Tuesday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==2)
            <th>
               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger"
                  >Delete</a
                  >
            </th>
			@endif
            @endforeach
         </tr>
         <tr>
            <th>Wednesday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==3)
            <th>
               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger"
                  >Delete</a
                  >
            </th>
			@endif
            @endforeach
         </tr>
         <tr>
            <th>Thursday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==4)
            <th>
               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger"
                  >Delete</a
                  >
            </th>
			@endif
            @endforeach
         </tr>
         <tr>
            <th>Friday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==5)
            <th>
               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger"
                  >Delete</a
                  >
            </th>
			@endif
            @endforeach
         </tr>
         <tr>
            <th>Saturday</th>
            @foreach($schedule as $sched)
			@if ($sched->day_nb==6)
            <th>
               <p>{{$sched->subject}}</p>
               <p style="font-size:10px;">{{$sched->teacher}}</p>
               {{$sched->time_start}}-{{$sched->time_end}}
               <br />
               <a href="/admin/schedule/delete/{{$sched->id}}" class="btn btn-danger"
                  >Delete</a>
            </th>
			@endif
            @endforeach
         </tr>
      </table>
   </div>
   <br />
   <h1 class="text-center">Add Session</h1>
   <br />
   <form method="post" action="/admin/schedule/addsession">
      @csrf
      <div class="row">
         <div class="form-group col-lg-2">
            <label for="course_1" class="font-weight-bold">Day:</label>
            <select class="custom-select" name="day" id="">
               <option value="1">Monday</option>
               <option value="2">Tuesday</option>
               <option value="3">Wednesday</option>
               <option value="4">Thursday</option>
               <option value="5">Friday</option>
               <option value="6">Saturday</option>
            </select>
			<small class="alert text-danger font-weight-bold">@error('day'){{$message}}@enderror</small>
         </div>
         <div class="form-group col-lg-2">
            <label for="from_1" class="font-weight-bold">From:</label>
            <input
               type="time"
               name="from_1"
               id="from_1"
               min="8:00"
               max="10:00"
               class="form-control"
               />
			   <small class="alert text-danger font-weight-bold">@error('from_1'){{$message}}@enderror</small>
         </div>
         <div class="form-group col-lg-2">
            <label for="to_1" class="font-weight-bold">To:</label>
            <input type="time" name="to_1" id="to_1" class="form-control" />
			<small class="alert text-danger font-weight-bold">@error('to_1'){{$message}}@enderror</small>
         </div>
         <div class="form-group col-lg-3">
            <label for="teacher_1" class="font-weight-bold">Teacher:</label>
            <select class="custom-select" name="teacher_1" id="teacher_1">
               @foreach($instructors as $ins)
               <!-- fill dropwdown by the name of instructors-->
               <option value="{{$ins->fn}}">
               {{$ins->fn}}
               </option>
               @endforeach
            </select>
			<small class="alert text-danger font-weight-bold">@error('instructor_1'){{$message}}@enderror</small>
         </div>
         <div class="form-group col-lg-3">
            <label for="course_1" class="font-weight-bold">Subject:</label>
            <select class="custom-select" name="subject_1" id="subject_1">
               @foreach($courses as $c)
               <option value="{{$c->Name}}">{{$c->Name}}</option>
               <!-- fill dropwdown by the name of courses-->
               @endforeach
            </select>
			<small class="alert text-danger font-weight-bold">@error('course_1'){{$message}}@enderror</small>
         </div>
      </div>
      <div class="text-center">
         <button type="submit" class="btn btn-primary" id="btn_1" name="btn_1">
         Save
         </button>
      </div>
   </form>
   <br />
   <br />
</div>
@stop

