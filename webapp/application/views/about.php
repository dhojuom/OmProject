  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/bootstrap/ico/favicon.ico">
    <script src="/bootstrap/js/jquery.js"></script>

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="jumbotron.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Olive Media</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Home</a></li> -->
            <li><a href="/organizationSignup">Add Organization</a></li>
            <li><a href="/courseSignup">Add Course</a></li>
            <!-- <li><a href="#contact">Add Book</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <!-- <li><a href="#">Features</a></li> -->
                <li><a href="/organizationSignup/view_organizations">Organizations</a></li>
                <!-- <li><a href="#">Updates</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li> -->
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" method = "post">
            <div class="form-group" >
              <input type="text" placeholder="Username" class="form-control" name ="user_name">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
              <button type="submit" class="btn btn-success" formaction="loginValidation">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>About Us</h1>
        <p>This is a simple and user easy informational website. It includes a large numbers of organization along with respective courses. Use it as a starting point to create something more unique.</p>
        <!-- Button trigger modal -->
          
            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg" id="submit">
              Sign up Now
            </a>
          

            <!-- Modal -->
      </div>
    </div>
    


      <hr>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      
      <div class="col-lg-6 col-lg-offset-5">
      <footer>
        <p>&copy; OLIVE MEDIA 2013</p>
      </footer>
      </div>
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
   
  </body>
</html>
