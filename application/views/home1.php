
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="google-site-verification" content="syTXxQYVXNBDS7FaNzVjSqqwuHVaM9CAa1dj5_FiUAI" />
    <title>FollowersFactory</title>
    <link rel="shortcut icon" href="/images/favicon.png">
    <script src="js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <?php echo $this->load->view('common/globalcss'); ?>
    <link rel="stylesheet" href="css/style.css" media="all" type="text/css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"  media="all" type="text/css">
	<style type="text/css">
		#covupromo{
			background: none repeat scroll 0 0 #FDFFDD;
			font-size: 11px;
			padding: 5px 10px;
			display:none;
		}

	</style>
  </head>
  <body style="padding-top:0px;margin-top:0px;">
  <div id="covupromo" style="display:none;"><span>.co.vu Promo</span><span style="float: right;">Go Back To <strong>short.co.vu</strong></span>

</div>   
    <div id="wrap">
      
        <nav class="navbar navbar-default " role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="/">FollowersFactory <i class="fa fa-bolt "></i></a>
          </div>
		  
		  <?php if(false){?>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">              
                <li><a href="signup">Log in</a></li>              
            </ul>
          </div>
          <?php }?>
        </div>
      </nav>

      <section id="landing">
  <div class="container" id="hero-container">
    <div class="row">
	  
    
    
	  <div class="hero-text col-xs-8 col-sm-12 col-md-12" style="text-align:center;background: #e7e7e7;padding: 15px;margin-top: 0px;">
        <h1 style="font-size:36px;padding: 0px 40px">Promote Your Tumblr and Get More Followers</h1>
        <p class="button-group">
       	<form action="login" method="post">
       	  <?php if(isset($iserror) && $iserror){?>
       	  <span style="color: red;">Enter a valid tumblr blog</span>
       	  <?php }?>
          <div><input type="text" id="grayedInput" name="tumblr" placeholder="Enter your tumblr url (hello.tumblr.com)"></input></div>
          <button type="submit" class="btn" id="btn-sign-up">Promote</button>
        </form>  
        </p>
        <p style="font-size: 12px;color: gray;"><i class="fa fa-shield" style="color: gray;" ></i> We don't auto follow or post on your behalf</p>
      </div>    
  
    
    		<div class="row">				
				<div class="col-md-12" style="margin-top:20px">
				    <div class="sescTitle" id="recentPromoTitle">
				        Recent Promoted Blogs
				    </div>			
				    <div class="row">	
				    <div class="col-md-12" id="recentPromoBlock">
				    <?php echo $this->load->view('homesection/recent'); ?>
				    </div>
				    </div>
				</div>
			</div>	
    
    
    <?php if(false){?>
    
	  <form action="login" method="post">
     	 <div class="hero col-md-2 col-md-offset-5" style="text-align:center">
     	   <h4>Login to Tumblr</h4>
     	   <h3><input type="text" class="form-control" id="appname" name="tumblr" placeholder="something.tumblr.com"></h3>
    	    <p class="button-group" >
        	  <button type="submit" class="btn btn-glow primary">Login With Tumblr</button>
        	</p>
      	</div>
	  </form>
	  
	  <?php }?>
    </div> <!-- /.row --> 
  </div> <!-- /.container -->

<?php if(false){?>
<section id="explain-section">
  <div class="container text-center space-below" id="explain">
    <h2 class="space-below">How does it work?</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="num">1</div>
        <h3>Login with Tumblr</h3>
        <p>Sign up with your <br>Tumblr account</p>
      </div>

      <div class="col-md-4">
        <div class="num">2</div>
        <h3>Find similar blogs</h3>
        <p>View and follow similar blogs that match your interest</p>
      </div>

      <div class="col-md-4">
        <div class="num">3</div>
        <h3>Promote Your Blog!</h3>
        <p>Promote your blog before 1000's of tumblr users</p>
      </div>
    </div>
  </div>
</section>
<?php }?>
  <?php if(false){?>
<section id="resolve-section">
  <div class="container text-center space-below" id="resolve">
    <h2 class="space-below">Built on the bleeding edge</h2>
    <div class="row">
      <div class="col-md-4">
        <h3>Login using your tumblr blog url</h3>
        <p>Built on Express.js</p>
      </div>

      <div class="col-md-4">
        <h3>Find similar blogs to follow</h3>
        <p>Low latency, live data connections</p>
      </div>

      <div class="col-md-4">
        <h3>Promote Ur Blog</h3>
        <p>Fast Bitcoin miner in pure JS</p>
      </div>
    </div>
  </div>
</section>

<section id="stats-section">
  <div class="container text-center space-below" id="stats">
    <h2>Here is some Stats?</h2>
    <div class="row">
      <div class="col-md-12">
        <h3><strong>12,603</strong> Follows Today | <strong>7,233,755</strong> Since Launch</h3>
      </div>
    </div>
  </div>
</section>


<section id="stats-section">
  <div class="container text-center space-below" id="stats">
    <h2>Signup Now</h2>
    <div class="row">
      <div class="col-md-12">
        <p class="button-group">
          
          <a href="signup" class="btn" id="btn-sign-up">Sign up with Tumblr</a>
        </p>
      </div>
    </div>
  </div>
</section>

<?php }?>
      <div id="push"></div>
    </div> <!-- end wrap -->
  <?php echo $this->load->view('common/tracker'); ?>
   </body>
   <script src="js/jquery-1.7.2.min.js"></script>
   <script src="js/jquery.cookie.js"></script>
   <script>
    $(document).ready(function(){
    	if($.cookie('covudomain')){
    		var covuUrl = $.cookie('covuurl');
    		var covuDomain = $.cookie('covudomain');
//			$("#grayedInput").val(covuDomain);
//			$("#btn-sign-up").text("Promote");    	
//    		$("#covupromo").html('<span>.co.vu Promo</span><span style="float: right;"> Go back to <a href="'+covuUrl+'"> <strong>'+ covuDomain +'</a></strong>')
//        	$("#covupromo").css("display","block")
        }
	});
   </script>
<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push(100699758);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100699758ns.gif" /></p></noscript>   
</html>
