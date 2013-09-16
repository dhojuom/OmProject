
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
            <li><a href="organizationSignup">Add Organization</a></li>
            <li><a href="courseSignup">Add Course</a></li>
            <li><a href="#contact">Add Book</a></li>
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
          <?php
          if(isset($message))
            echo $message; 
          ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello,everyone!</h1>
        <p>Welcome to the world of learning zone. You can experience a different ways of learning and teaching. </p>
        <!-- Button trigger modal -->
          
            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg" id="submit">
              Sign up Now
            </a>
          

            <!-- Modal -->
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>About us</h2>
          <p>Olive Media specialises in offering training solutions to meet your organisational goals to maximise employee performance and achieve long term business success </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Career</h2>
          <p>Olive Media are constantly looking for talented, ambitious people to join our team, have a look at our career opportunities here </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Contact us</h2>
          <p>If you’d like to speak to someone in Olive Media feel free to call us on +353 1 411 1011 or send us a message through our contact page</p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
      </div>

      <hr>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2><?php if(isset($message))
                  echo $message;
                ?></h2>
                <h3 class="modal-title">Member Sign up</h3>
              </div>
              <div class="modal-body">
                <form class="form-signin" method = "post">
                  <h2 class="form-signin-heading">Sign Up To Hell</h2>
                  <input type="text" class= "form-control" placeholder="First Name" name="first_name">
                  <input type="text" class= "form-control" placeholder="Last Name" name="last_name">
                  <input type="text" class= "form-control" placeholder="Phone number" name="phone_number">
                  <input type="text" class= "form-control" placeholder="Address" name="address">
                  <input type="text" class="form-control" placeholder="Email address" autofocus name = "email">
                  <input type="text" class= "form-control" placeholder="User name" name="user_name">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="passconf">

                  <h4> Select Organization</h4>
                    <select name="organization">
                    <?php 
                      foreach($organizations as $organization)
                      { ?>
                      <option value="<?php echo $organization->id; ?>"><?php echo $organization->name ;?>
                      </option>
                      <?php } ?>
                    </select>
                  
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         </div>
      <footer>
        <p>&copy; Company 2013</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../bootstrap/js/jquery.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
   
                
    



  </body>
</html>
