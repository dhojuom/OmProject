
<?php include_once('header.php');?>
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
                <h3 class="modal-title">Member Sign up </h3>
                <h3 class="modal-title">press ESC for login </h3>
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
      <?php include_once('footer.php'); ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../bootstrap/js/jquery.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
   
                
    



  </body>
</html>
