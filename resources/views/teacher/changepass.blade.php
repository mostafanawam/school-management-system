@extends('teacher.main')




@section('content')
<div class="container">


<h1 class="text-center">Change Password</h1>
<br>
@if (session('status'))
<div class="form-row justify-content-center">
  <div class=" col-lg-6 ">
    	<div class="alert alert-success text-center" role="alert">
        {{ session('status') }}
</div>
</div>
</div>

@elseif(session('error'))
<div class="form-row justify-content-center">
  <div class=" col-lg-6 ">
    	<div class="alert alert-danger text-center" role="alert">
        {{session('error')}}
</div>
</div>
</div>
@endif
<form  action="/teacher/change" method="post">
  @csrf
  <div class="form-row justify-content-center">
    <div class=" form-group  col-lg-6 ">
      <label for=" " class="font-weight-bold">Current Password:</label>
        <input type="password" value="{{old('CurrentPassword')}}" name="CurrentPassword" placeholder="Current Password" class="form-control">
        <small class="alert text-danger">@error('CurrentPassword'){{$message}}@enderror</small>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <div class=" form-group  col-lg-6 ">
      <label for="" class="font-weight-bold">New Password:</label>
<input type="password" name="NewPassword" value="{{old('NewPassword')}}" placeholder="New Password" class="form-control">
<small class="alert text-danger">@error('NewPassword'){{$message}}@enderror</small>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <div class=" form-group  col-lg-6 ">
      <label for="" class="font-weight-bold">Confirm Password:</label>
<input type="password" name="new_confirm_password" value="{{old('new_confirm_password')}}" placeholder="Re-enter Password" class="form-control">
<small class="alert text-danger">@error('new_confirm_password'){{$message}}@enderror</small>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <div class="col-lg-6">
      <input type="submit"  value="Change Password" class="btn btn-primary btn-block">
    </div>
  </div>

</form>
</div>
@stop
