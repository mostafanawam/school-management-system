@extends('teacher.main')


@section('content')
<script>
    
    function getval() {
        var grades = [];
        var id=[];

  $(".txt-val").each(function () {
    grades.push($(this).val());//fill all the grades in array
  });

  $(".txt-id").each(function () {
    id.push($(this).val());//fill all ids in array
  });
  $.ajaxSetup({ //if method == post
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  for (let index = 0; index < grades.length; index++) {
      //alert(id[index]);
      //alert(grades[index]);
      $.ajax ({
     url:"{{url('/teacher/grades/submit')}}",
     method:'post',
     data:{
       id: id[index],//set the selected value
       grade:grades[index],
        idexam:$(".txt-idexam").val()
     },
     success:function(output){
         document.getElementById('alert').style.visibility="visible";
        $(".alert").html(output.res);
     }
   });

  }

}

</script>
<div class="container">
    <h1 class="text-center">Submit Grades</h1>
<br>
<form action="/teacher/grades/submit" method="POST">
    @csrf
    <div id="alert" class="alert alert-success text-center" style="visibility: hidden" ></div>
<table class="table text-center">
<tr class="bg-dark text-light" >
    <th>StudentID</th>
    <th>Student Name</th>
    <!--<th>Date Exam</th>-->
    <th>Grade</th>
</tr>
@isset($list)
    

@foreach ($list as $item)
<tr>
    <th>{{$item->IdStudent}}  <input type="hidden" class="txt-idexam" value="{{$item->IdExam}}"></th>
    <th>{{$item->fn}}</th>
    <!--<th>//$item->Date</th>-->
    <th> <input type="text" name="grade"  class="form-control txt-val" placeholder="Exam Grade">
    <input type="hidden" class="txt-id" value="{{ $item->IdStudent }}"></th>
</tr>
@endforeach

</table>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <input type="button" class="btn btn-primary btn-block" value="Submit" onclick="getval()">
    </div>
</div>
@endisset
</form>
</div>
@stop