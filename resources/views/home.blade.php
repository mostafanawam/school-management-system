
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">School Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
<li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
<li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
<li class="nav-item">
          <a class="nav-link" href="">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student/login">Login</a>
        </li>

</ul>
</div>
</div>
</nav>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

</ol>
<div class="carousel-inner">


                <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('images/home1.jpg') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>E-Learning</h5>
            <p>
                A learning system based on formalised teaching but with the help of electronic resources is known as E-learning.</p>
            </div>
            </div>


                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/home2.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Digital Transformation of education</h5>
                <p>
                    Enabling students to enter through the mobile app or web application. Providing a broad range of choices for online learning. Using technology to track the progress of students and enforce intervention protocols.</p>
                </div>
                </div>


                </div>

</div>

<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</body>
</html>