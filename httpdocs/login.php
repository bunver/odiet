<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>OpenDiet - Lost Your Weights with Your Friends</title>
		<meta name="description" content="OpenDiet is a platform where users can update their weight loosing progress and share with their friends.">
		<?php include('head-out.inc.php'); ?>
	</head>

	<!-- body classes:  -->
	<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
	<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
	<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
	<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
	<body class="no-trans front-page transparent-header  ">
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<?php include('header-out.inc.php'); ?>

			<div class="main-container dark-translucent-bg" style="background-image:url('images/odiet-background1.jpg'); height:724px;">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible animated object-visible fadeInUpSmall" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div id="login-div" class="form-block center-block p-30 light-gray-bg border-clear" style="opacity:0.8;">
								<h2 class="title">Login</h2>
								<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
								<div id="successDiv" class="alert alert-success" style="display:none;"></div>
								<form class="form-horizontal">
									<div class="form-group has-feedback">
										<label for="inputUserName" class="col-sm-3 control-label">Email</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputEmail" placeholder="Email" required="">
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">Password</label>
										<div class="col-sm-8">
											<input type="password" maxlength="24" class="form-control" id="inputPassword" placeholder="Password" required="">
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input type="checkbox" id="rememberCheckbox" name="rememberCheckbox" required=""> Remember me.
												</label>
											</div>											
											<button type="button" id="login-bt" class="btn btn-group btn-default btn-animated">
												<i class="fa fa-user"></i>
												<span id="upload-span"> Log In  </span>
												<span id="uploading-span-img" class="fa fa-refresh fa-spin" style="display:none;"></span>
												<span id="uploading-span-text" style="display:none;"> Log in... </span> 	
											</button>
											<ul class="space-top">
												<li><a href="forgot-password.php">Forgot your password?</a></li>
											</ul>
											<span class="text-center text-muted">Login with</span>
											<ul class="social-links colored circle clearfix">
												<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
												<li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
												<li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</form>
							</div>
							<p class="text-center space-top">Don't have an account yet? <a href="register.php">Sign up</a> now.</p>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			
			<div id="page-start"></div>


			<?php include('footer.inc.php'); ?>
			
		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- jQuery Revolution Slider  -->
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.revolution.js"></script>

		
		

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>
		
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		
		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>
		
		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="plugins/jquery.validate.js"></script>

		<!-- Background Video -->
		<script src="plugins/vide/jquery.vide.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
		
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="plugins/jquery.browser.js"></script>
		<script type="text/javascript" src="plugins/SmoothScroll.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>
		
		<script>		
			$("input").focus(function(){
				$("#login-div").css("opacity", "1").fadeIn(1000);
			});
			
			
			$("#logo-span").click(function(){
				window.location.href = "index.php";
			});
		
			
			$("#login-bt").click(function(){
				login();
			});			
		
			function login(){
				if($('#rememberCheckbox').prop('checked')){
					var checkboxStatus = 1;
				} else {
					var checkboxStatus = 0;
				}
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=login&u_email="+$('#inputEmail').val()+"&u_password="+$('#inputPassword').val()+"&rememberCheckbox="+checkboxStatus,
					dataType: "json",
					beforeSend: function() {
						$('#uploading-span-text').show();
						$('#uploading-span-img').show();
						$('#upload-span').hide();
						$( "#login-bt" ).attr( "disabled", true );
					},
					complete: function() {
						$('#uploading-span-text').hide();
						$('#uploading-span-img').hide();
						$('#upload-span').show();
						$( "#login-bt" ).attr( "disabled", false );
					},
					success: function(data){			
						if (data.status == 'error') {
							$('#errorDiv').show();
							$('#successDiv').hide();
							$('#errorDiv').html(data.msg);
						} else if(data.status == 'success') {
							$('#errorDiv').hide();
							$('#registerForm').hide();
							$('#successDiv').show();
							$('#successDiv').html(data.msg);
							window.location.href = "home.php";
						}
						
					},
					error: function(){

					}
				});
			}
		</script>
	</body>
</html>
