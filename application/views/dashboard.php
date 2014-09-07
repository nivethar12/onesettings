
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>One Settings</title>
    <link rel="shortcut icon" href="/images/favicon.png">

    
    <?php echo $this->load->view('common/globalcss'); ?>
    <link rel="stylesheet" href="css/style.css" media="all" type="text/css" />
    <link rel="stylesheet" href="css/alertify.core.css" media="all" type="text/css" />
    <link rel="stylesheet" href="css/alertify.default.css" media="all" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" media="all" type="text/css" />
    <link rel="stylesheet" href="css/tables.css" media="all" type="text/css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"  media="all" type="text/css">
	<style type="text/css">
		.table .img {
			display:inline;
		}
		
		ul.selectedList{
			list-style: none;
			font-size: 11px;
		}
		
		ul.selectedList li{
			padding-top:7px;
		}		
		
		.cap{
			text-transform: capitalize;
		}
	</style>
  </head>
  <body>
    <div id="wrap">
    	<div class="container">
    	
    	
        
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation"" role="navigation">
        	<div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="/">One Settings <i class="fa fa-bolt "></i></a>
          </div>

          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav " id="sitemenu">
            	
            	<li class="active"><a href="/"> Dashboard</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
            	<li><a href="logout">Log Out</a></li>           
            </ul>
          </div>
          </div>
      </nav>
     </div>





      <section id="landing">
      
        <div class="container">
		  <div class="container" style="min-height: 600px;">
		    <div class="row">
		      <div class="col-md-12" style="padding: 0px 26px;">
		      		<div style="text-align:right">
		      			<a class="btn btn-glow primary" style="margin-top:10px;margin-bottom:10px" href="#" id="addAccountButton">Add Accounts</a>
		      			
		      			<a class="btn btn-glow bulkactions inverse disabled" style="margin-top:10px;margin-bottom:10px" href="#" id="changePasswordBulk">Change Password</a>
		      			
		      			<a class="btn btn-glow bulkactions inverse disabled" style="margin-top:10px;margin-bottom:10px" href="#" id="changeEmailBulk">Update Email</a>
		      			
		      			<a class="btn btn-glow bulkactions inverse disabled" style="margin-top:10px;margin-bottom:10px" href="#" id="terminateAccountBulk">Terminate Account</a>
		      		</div>
					<table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width:1%">
                                    <input type="checkbox">
                                </th>                            
                                <th class="col-md-3">
                                    Your Accounts
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>Status
                                </th>
                                <th class="col-md-3">
                                    <span class="line"></span> #
                                </th>                                
                            </tr>
                        </thead>
                        <tbody id="AccountTable">

                        </tbody>
                    </table>		      
		      
		      
		      
		      
		      
		      
		      
		      
		      
		      </div>
		    </div>
		  </div>









      <div id="push"></div>
    </div> <!-- end wrap -->
  	
  
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">Add Accounts To Manage</h4>
      </div>
      <div class="modal-body" id="trackercode">
			<form class="form-horizontal" role="form" id="addAccountForm">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="email" placeholder="Email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="password" placeholder="Password">
			    </div>
			  </div>


			<div class="form-group">
			  <label for="inputPassword3" class="col-sm-2 control-label">Online Accounts</label>
			    <div class="col-sm-10">
			      	<select class="multiselect" multiple="multiple" id="accountsList">
									  		<option value="twitter" >Twitter</option>
  									  		<option value="facebook" >Facebook</option>
  									  		<option value="dropbox" >Dropbox</option>
  									  		<option value="tumblr" >Tumblr</option>
  									  		<option value="instagram" >Instagram</option>
  									  		<option value="foursquare" >Foursquare</option>
					</select>
			    </div>
			  </div>	  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-glow primary">Add Accounts</button>
			    </div>
			  </div>
			</form>    

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">Change Password</h4>
      </div>
      <div class="modal-body" id="trackercode">
      		<p style="font-size: 11px;"> You are now about change the password for the following accounts <br>
	      		<ul class="selectedList">
      				<li><i class="fa fa-tumblr"></i>  Tumblr (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-twitter"></i> Twitter (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-dropbox"></i> Dropbox (arunkumar.krishna@gmail.com)</li>
    	  		</ul>
      		</p>
      		<hr></hr>
			<form class="form-horizontal" role="form" id="changePasswordForm">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-4 control-label">New Password</label>
			    <div class="col-sm-8">
			      <input type="password" class="form-control" id="changePass" placeholder="Password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password</label>
			    <div class="col-sm-8">
			      <input type="password" class="form-control" id="changePassConfirm" placeholder="Retype Password">
			    </div>
			  </div>
			   
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-10">
			      <button type="submit" class="btn btn-default">Change Password</button>
			    </div>
			  </div>
			   
			</form>    

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="changeEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">Update Email Address</h4>
      </div>
      <div class="modal-body" id="trackercode">
      		<p style="font-size: 11px;"> You are now about update the email for the following accounts <br>
	      		<ul class="selectedList">
      				<li><i class="fa fa-tumblr"></i>  Tumblr (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-twitter"></i> Twitter (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-dropbox"></i> Dropbox (arunkumar.krishna@gmail.com)</li>
    	  		</ul>
      		</p>
      		<hr></hr>
			<form class="form-horizontal" role="form" id="emailUpdateForm">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-8">
			      <input type="email" class="form-control" id="updatedEmail" placeholder="Email">
			    </div>
			  </div>
			  			   
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-10">
			      <button type="submit" class="btn btn-default">Update Email</button>
			    </div>
			  </div>
			   
			</form>    

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="terminateAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">Delete The Accounts</h4>
      </div>
      <div class="modal-body" id="trackercode">
      		<p style="font-size: 11px;"> Are you sure you want to delete the following accounts. You will not be able to use any of the services below.<br>
	      		<ul class="selectedList">
      				<li><i class="fa fa-tumblr"></i>  Tumblr (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-twitter"></i> Twitter (arunkumar.krishna@gmail.com)</li>
      				<li><i class="fa fa-dropbox"></i> Dropbox (arunkumar.krishna@gmail.com)</li>
    	  		</ul>
      		</p>
      		<hr></hr>
			<form class="form-horizontal" role="form" id="terminateAccountForm">
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-10">
			      <button type="submit" class="btn btn-default">Delete Accounts</button>
			    </div>
			  </div>
			</form>    

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<input type="hidden"  id="selectedListHdn" value="">


<script id="accountRow" type="text/x-handlebars-template">
                            <tr data-id="{{credId}}" data-email="{{account}}" data-pass="{{password}}" data-service={{service}} id="{{credId}}">
                            	<td>
                            		<input type="checkbox" class="accountCheck">
                            	</td>
                                <td>
                                    <div class="img">
										<i class="fa fa-{{service}}"></i>
                                    </div>
                                    <a href="#" class="name">{{account}}</a>
                                </td>
                                <td>
                                    <span class="label label-{{status}}">{{label}}</span> <img src='/img/loading.gif' class='loadingImg hide'></img>
                                </td>

                                <td>
                                    <div class="actions hide"> <a href="#" class="changePassLnk">Change Password</a> | <a href="#" class="changeEmailLnk">Change Email</a> | <a href="#" class="terminateLnk">Terminate Account  </a> </div>  
                                </td>                                
                                
                            </tr>  
</script>


<script id="selectedElement" type="text/x-handlebars-template">
	<li><i class="fa fa-{{service}}"></i> <span class="cap">{{service}}</span> ({{email}})</li> 
</script>


    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/handlebars.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
    <script src="js/md5.js"></script>
    <script src="js/dashboard.js"></script>
  	<?php echo $this->load->view('common/tracker'); ?>
	</body>  	
</html>
