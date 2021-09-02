@extends('teacher.main') 
@section('content')
<div class="container">
	<h1 class="text-center">Manage Profile</h1>
	<br>
     @if (session('status'))
	<div class="alert alert-success text-center" role="alert"> {{ session('status') }} </div> @elseif(session('failed'))
	<div class="alert alert-danger text-center" role="alert"> {{session('failed')}} </div> @endif
	<form action="/teacher/UpdateProfile" method="post"> 
        @csrf 
        @foreach($teacher as $info)

		<div class="form-row justify-content-center ">

			<div class="form-group col-lg-4">
				<label for="UserID" class="font-weight-bold">UserID:</label>
				<input type="text" name="UserID" readonly value="{{$info->id}}" placeholder="UserID" class="form-control">
            </div>

			<div class="form-group col-lg-4">
				<label for="fn" class="font-weight-bold">Full Name:</label>
				<input type="text" name="fn" value="{{$info->fn}}" class="form-control"> 
                @error('fn')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror 
            </div>

			<div class="form-group col-lg-4">
				<label for="email" class="font-weight-bold">Email:</label>
				<input type="text" name="email" value="{{$info->email}}" placeholder="Email" class="form-control">
                @error('email')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror 
            </div>
		</div>

		<div class="form-row justify-content-center ">

			<div class="form-group col-lg-4">
				<label for="phone" class="font-weight-bold">Phone:</label>
				<input type="tel" name="phone" value="{{$info->tel}}" placeholder="Phone" class="form-control">
                @error('phone')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror 
            </div>

			<div class="form-group col-lg-4">
				<label for="dob" class="font-weight-bold">DOB:</label>
				<input type="date" name="dob" value="{{$info->dob}}" placeholder="DOB" class="form-control">
                @error('dob')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror 
            </div>

			<div class="form-group col-lg-4">
				<label for="Gender" class="font-weight-bold">Gender:</label>
				<br> @if($info->gender=="female")
				<input type="radio" name="Gender" value="male"> male
				<input type="radio" name="Gender" value="female" checked> female @else
				<input type="radio" name="Gender" value="male" checked> male
				<input type="radio" name="Gender" value="female"> female @endif 
                @error('Gender')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror 
            </div>
		</div>
		<div class="form-row justify-content-center">
			<div class="form-group col-lg-6">
				<button type="submit" class="btn btn-primary btn-block">Save</button>
			</div>
		</div> 
        @endforeach 
    </form> @stop