
@extends('admin.main')

@section('content')


<div class="container">


<h1 class="text-center">Add User</h1>
<br>
<form class="" action="/admin/user/adduser" method="post">
@csrf

  <div class="form-row justify-content-center">

    <div class="form-group col-md-6 col-lg-6">
      <?php
  $id=floor(time()-999999999);
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';
for ($i = 0; $i < 6; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

?>
<label for="">User ID:</label>
      <input type="text" class="form-control" readonly id=userid name="userid" value="{{$id}}" placeholder="User ID">
@error('userid'){{$message}}@enderror

      </div>

    </div>
    <div class="form-row justify-content-center">

      <div class="form-group col-md-6 col-lg-6">
        <label for="">Password:</label>
        <input type="text" class="form-control" name="password" value="{{$randomString}}" placeholder="User Password">
@error('password'){{$message}}@enderror

        </div>
      </div>

      <div class="form-row justify-content-center">
        <div class="form-group col-md-6 col-lg-6 ">
          <label for="">Type:</label>

          <select class="custom-select" name='type' id='type' onchange="get()" >
            <option value="" disabled selected>Select User Type</option>
            <option value="Student">Student</option>
            <option value="Teacher">Teacher</option>
            <option value="Admin">Admin</option>
          </select>
@error('type'){{$message}}@enderror

          <!--<div class="invalid-feedback">Example invalid custom select feedback</div>-->
        </div>
      </div>
<div class="form-row justify-content-center">
  <div class="form-group col-lg-6">
    <input type="text" name="fullname" placeholder="fullname" id='fn' class="form-control">
    @error('fullname'){{$message}}@enderror
  </div>

</div>

      <div class="form-row justify-content-center">
        <div class="col-lg-6">
          <input type="submit"  value="Insert" class="btn btn-primary btn-block">
        </div>
      </div>



    </form>
</div>
@stop
