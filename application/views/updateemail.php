
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>FollowersFactory</title>
    <link rel="shortcut icon" href="/images/favicon.png">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <?php echo $this->load->view('common/globalcss'); ?>
    <link rel="stylesheet" href="/styles/animate-custom.css" media="all" type="text/css" />
    <link rel="stylesheet" href="/css/style.css" media="all" type="text/css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"  media="all" type="text/css">
  </head>
  <body>
    <div id="wrap">
      
        <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="/">Followersfactory <i class="fa fa-bolt "></i></a>
          </div>

          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">              
                <li><a href="login">Log in</a></li>              
            </ul>
          </div>
        </div>
      </nav>

		<div class="container">
		    <div class="row top">
		      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-2">
		        <h2>Just one final step!</h2>
		      </div>
		    </div>
		    <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-2" style="text-align:center;">
		        	<h5>Update your email and pick a Password!</h5>
		      	</div>
		    </div>		    
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-2">
		      <form action="/signup/done" method="post" class="bgwhite">
		          <div class="form-group <?php if(isset($sign_up_email_error)){echo "has-error";}?>">
		            <label>Email</label>
		            <input type="text" name="email" value="<?php echo $email;?>" class="form-control">
		            <?php if(isset($sign_up_email_error)){?>
		            <small class="help-block  col-lg-12" style=""><?php echo $sign_up_email_error;?></small>
		            <?php }?>
		          </div>
		          <div class="form-group <?php if(isset($sign_up_password_error)){echo "has-error";}?>">
		            <label>Password</label>
		            <input type="password" name="password" value="<?php echo $password;?>" class="form-control">
		            <?php if(isset($sign_up_password_error)){?>
		            <small class="help-block col-lg-12" style=""><?php echo $sign_up_password_error;?></small>
		            <?php }?>		            
		          </div>
		          <div class="form-group" style="text-align:center">
		          	<button type="submit" class="btn btn-glow primary">Complete</button>
		          </div>
		      </form>
		    </div>
		  </div>
		</div>


      <div id="push"></div>
    </div>
  </body>

</html>
