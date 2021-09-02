<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link href="{{asset('css/logincss.css')}}" rel="stylesheet" type="text/css">
  </head>
  <body>

    <div class="container">
    	<div class="d-flex justify-content-center h-100">

    		<div class="card">

    			<div class="card-header">
    				<h3>Sign In</h3>
    			</div>
				@error('UserId') <small class="text-danger text-center">{{$message}}</small>@enderror
				@error('password') <small class="text-danger text-center">{{$message}}</small>@enderror
    			<div class="card-body">

    				<form method=post action="/teacher/main">
                  @csrf
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text "><i  style=margin-left:5px; class="fas fa-user"></i></span>
    						</div>
    						<input type="text" class="form-control" value="{{old('UserId')}}"  placeholder="UserId" name="UserId" autocomplete="off">
							<br>
						
    					</div>

    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i style=margin-left:5px; class="fas fa-key"></i></span>
    						</div>
    						<input type="password" class="form-control" placeholder="password" name="password">
							<br>
					
    					</div>

    					<div class="form-group">
    						<input type="submit" value="Login" class="btn btn-md float-right login_btn">
    					</div>
    				</form>
    			</div>
    			<div class="alert" align=center style="color:purple">

      </div>
    			<!--<div class="card-footer">
    				<div class="d-flex justify-content-center links">
    					Don't have an account?<a style=color:purple; href="#">Sign Up</a>
    				</div>
    			</div>-->
    		</div>
    	</div>
    </div>
  </body>
</html>