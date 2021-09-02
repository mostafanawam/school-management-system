@extends('teacher.main') 
@section('content')
<script>
    function SubmitAttendance() {
       
        var attend = [];
        var id=[];
        $.ajaxSetup({ //if method == post
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $(".ch-attend").each(function () {
            attend.push($(this).is(':checked'));//fill all the grades in array
        });

        $(".txt-id").each(function () {
            id.push($(this).val());//fill all ids in array
        });
  for (let index = 0; index < attend.length; index++) {
    if(attend[index]==true){
    $.ajax ({
     url:"{{url('/teacher/attendance/submit')}}",
     method:'post',
     data:{
       id: id[index],//set the selected value
       present:attend[index],
       room:$(".txt-idroom").val()
     },
     success:function(output){
        document.getElementById('alert').style.visibility="visible";
        $(".alert").html(output.res);
     }
   });
    }
  }
   

        
    }
</script>
<div class="container">
 <h1 class="text-center">Submit Attendance</h1>
 <br />
 <form action="/teacher/attendance/create" method="POST" class="">
  @csrf

  
  <div class="row justify-content-center">

   <!-- <div class="col-lg-4">
        <select name="type_lecture" class="custom-select" id="type" >
         <option value="" disabled selected>Choose lecture type</option>
         <option value="Course">Course</option>
         <option value="TD">TD</option>
        </select>
     </div>-->
     <div class="form-group col-lg-2">
        <h5 class="font-weight-bold text-center">Create New Lecture:</h5>
     </div> 
<div class="form-group col-lg-4">
    <select name="id_room"  class="custom-select" id="room" >
        <option value="" disabled selected>Choose Room</option>
        @foreach ($room as $r)
            <option value="{{ $r->IdR }}">{{ $r->NameR }}</option>
        @endforeach
       </select>
</div>
<div class="form-group col-lg-4">
    <select name="subject_id"  class="custom-select" id="subject" >
        <option value="" disabled selected>Choose Subject</option>
        @foreach ($subjects as $c)
            <option value="{{ $c->SubjectId }}" >{{ $c->Name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-lg-2 text-center">
    <input type="submit" class="btn btn-primary" value="Create" onclick=""/>
</div>
  </div>
  
<br><br>
@isset($students)
<input type="hidden" value="{{ $students->room}}" name="room" class="txt-idroom">  
<div id="alert" class="alert alert-success text-center" style="visibility: hidden" ></div>
<table class="table table-bordered text-center"  id="table">
    <tr>
        <th>StudentID</th>
        <th>StudentName</th>
        <th>IsPresent</th>
    </tr>
    <tbody id="tbody">
        @foreach ($students as $item)
            <tr>
                <td>{{ $item->StudentId }} <input type="hidden" class="txt-id" value="{{ $item->StudentId }}"></td>
                <td>{{ $item->fn }} </td>
                <td><input type="checkbox" class="ch-attend" style='width:25px;height:25px;'></td>
            </tr>
        @endforeach
    </tbody>
</table> 
<div class="text-center">
    <input type="button" class="btn btn-primary" value="Submit" onclick="SubmitAttendance()"> 
</div>

@endisset

 </form>
</div>
@stop
