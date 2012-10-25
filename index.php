<!DOCTYPE html>
<html lang="en">
  <head>
  	<script type = "text/javascript">
		javascript:window.history.forward(1);
	</script>
    <meta charset="utf-8">
    <title>Ajatus Software</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="canonical" href="http://countableset.ch/blog/blog/2012/01/29/twitter-bootstrap-login-page">
  	<link href="/blog/favicon.png" rel="icon">
  	<link href="/blog/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css">
  	<script src="/blog/javascripts/modernizr-2.0.js"></script>
 	 <script src="/blog/javascripts/ender.js"></script>
 	 <script src="/blog/javascripts/octopress.js" type="text/javascript"></script>
 	 <link href="/blog/atom.xml" rel="alternate" title="countableSet" type="application/atom+xml">
 	 <!--Fonts from Google"s Web font directory at http://google.com/webfonts -->
	<link href="http://fonts.googleapis.com/css?family=PT+Serif:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>

    <!-- Le styles -->
   	<link href="docs/assets/css/bootstrap.css" rel="stylesheet">
   	<!--script type = "text/javascript">
		function validation()
		{
			var un = document.getElementById("name").value;
			var pw = document.getElementById("password").value;
			if(un == "" || un == "null" || pw == "" || pw == "null")
			{
				document.getElementById("errmsg").style.display= "block";
				document.getElementById("errmsg").innerHTML = "Error:All fields are required";
				return false;
			}
			else
			{
				document.forms["login"].submit();
			}
		}
	</script-->

    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
        margin:0 auto;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

    .login-form {
      margin-left: 65px;
    }
  
    legend {
      margin-right: -50px;
      font-weight: bold;
      color: #404040;
    }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="docs/assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="docs/assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="docs/assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="docs/assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/cupertino/jquery-ui.css" type="text/css" />
	<script src="docs/assets/js/bootstrap-alert.js"></script>
	
</head>
<body>
  <div class="container">
      <div class="content">
      	<div><img src="img/ajatus-logo.gif" style = "margin-left:42px;" /></div>
          <div class="row">
              <div class="login-form">
                  <h2>Login</h2>
                  <form name="login" id ="login" method="POST" action ="check.php">
                      <fieldset>
                          <div class="clearfix">
                              <input type="text" placeholder="Username" id = "name" name = "uname" autofocus="autofocus" required = "required"/>
                          </div>
                          <div class="clearfix">
                              <input type="password" placeholder="Password" id = "password" name = "password" required = "required"/>
                          </div>
                          <strong>
                          	<?php
                          	if(isset($_GET['msg']))
                          	{
								$a=$_GET['msg'];
								if($a == "err")
								{
									echo "<div class='alert alert-error'>";
									echo "<h5 style = 'color:red;'>Error:Invalid Id or Password!</h5>";
									echo "</div>";
									//echo $_GET['msg'];
								}
                          	}
                          ?>
                          </strong>
                
                          <input class="btn btn-primary" type="submit" value = "Sign in"/>&nbsp;&nbsp;<b>or</b>&nbsp;&nbsp;<a href="ajatus.php?login" class="btn btn-primary btn-medium">Sign in with Ajatus</a>
				<br /><br/>Forgot your password? <a href="recover-password.php">Recover it here.</a><br /></br>
                      </fieldset>
                  </form>
              </div>
          </div>
      </div>
  </div> <!-- /container -->
</body>
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <!--<script src="docs/assets/js/jquery.js"></script> -->
    <script src="docs/assets/js/google-code-prettify/prettify.js"></script>
    <script src="docs/assets/js/bootstrap-transition.js"></script>
    <script src="docs/assets/js/bootstrap-alert.js"></script>
    <script src="docs/assets/js/bootstrap-modal.js"></script>
    <script src="docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="docs/assets/js/bootstrap-tab.js"></script>
    <script src="docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="docs/assets/js/bootstrap-popover.js"></script>
    <script src="docs/assets/js/bootstrap-button.js"></script>
    <script src="docs/assets/js/bootstrap-collapse.js"></script>
    <script src="docs/assets/js/bootstrap-carousel.js"></script>
    <script src="docs/assets/js/bootstrap-typeahead.js"></script>
    <script src="docs/assets/js/application.js"></script>
</html>
