@extends('teacher.main')


@section('content')



<div class="container">
    <h1 class="text-center">Upload Materials</h1>
    <br>

    <form action="/teacher/materials/upload" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="row justify-content-center">
        <div class="form-group col-lg-6">
            <label for="" class="font-weight-bold"> File Name:</label>
            <input type="text" class="form-control"  name="file_name" id="" placeholder="File Name" value="{{old('file_name')}}">
            <small class="text-danger font-weight-bold"> @error('file_name')
                {{$message}}
            @enderror </small>
        </div>
    </div>

    <div class="row justify-content-center"> 
        <div class="form-group col-lg-6">
            <label for="" class="font-weight-bold">File Description:</label>
            <input type="text" class="form-control" name="file_description" placeholder="File Description" value="{{old('file_description')}}">
            @error('file_description')<small class="text-danger font-weight-bold"> 
                
                {{$message}}</small>
            @enderror 
        
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="form-group col-lg-6">
           <p class="font-weight-bold">Upload file(<2Mb):</p>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="upload_file">
      <label class="custom-file-label" for="customFile">Choose File: 
    </label>
      
           @error('upload_file')
           <small class="text-danger font-weight-bold ">
                    {{$message}}
                </small>
           @enderror 
     
    </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-primary btn-block" value="Upload">
        </div>
    </div>

</form>
</div>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
@stop