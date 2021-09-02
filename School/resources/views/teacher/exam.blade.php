@extends('teacher.main')


@section('content')

<div class="container">
    <h1 class="text-center">Assign Exams</h1>
    <br>
    <form action="/teacher/exams/assign" method="POST">
        @csrf


        <div class="row justify-content-center"><!-- select the type of exam partial or final -->
            <div class="form-group col-lg-6">   
                <label for="exam_type">Exam Type:</label>
                <select name="exam_type" class="custom-select">
                    <option value="" disabled selected> Choose Exam type</option>
                    <option value="Midterm" @if(old('exam_type')=="Midterm") selected @endif>Midterm</option>
                    <option value="Final" @if(old('exam_type')=="Final") selected @endif>Final</option>
                </select>
                @error('exam_type')
                <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
            </div>
        </div>
        

        <div class="row justify-content-center"><!-- select the code of the exam assigned -->
            <div class="form-group col-lg-6"> 
                <label for="">Subject</label>  
                <select name="subject_id" class="custom-select">
                    <option value="" disabled selected>Choose Course</option>
                    @foreach ($subjects as $c)
                        <option value="{{$c->id}}" @if(old('subject_id')==$c->id) selected @endif >{{$c->Name}}</option>
                    @endforeach
                </select>
                @error('subject_id')
                <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
            </div>
        </div>


        <div class="row justify-content-center"><!-- input take time and date of the exam -->
            <div class="form-group col-lg-3">
                <label for="">Exam Date</label> 
                <input type="date" name="exam_date"  class="form-control">
                @error('exam_date')
                <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group col-lg-3">
                <label for="">Exam Time</label> 
                <input type="time" name="exam_time"  class="form-control">
                @error('exam_time')
                <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="form-group col-lg-6"> 
                <button class="btn btn-primary btn-block">Assign</button>
            </div>
        </div>
                
        
    </form>
</div>
@stop