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
		
			<!-- main-container start -->
			<!-- ================ -->
			<div class="main-container dark-translucent-bg" style="background-image:url('images/odiet-background1.jpg'); height:724px;">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div id="register-div" class="form-block center-block p-30 light-gray-bg border-clear" style="opacity:0.8;">
								<h2 class="title">Sign Up</h2>
								<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
								<div id="successDiv" class="alert alert-success" style="display:none;"></div>
								<form class="form-horizontal" id="registerForm" method="POST" role="form">
									<div class="form-group has-feedback">
										<label for="inputEmail" class="col-sm-3 control-label">Email </label>
										<div class="col-sm-8">
											<input type="email" class="form-control" id="inputEmail" name="u_email" placeholder="Email" required>
											<i class="fa fa-envelope form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputName" class="col-sm-3 control-label">First Name </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputName" name="u_firstname" placeholder="First Name" required maxlength="100" pattern=".{3,100}">
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputLastName" class="col-sm-3 control-label">Last Name </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputLastName" name="u_lastname" placeholder="Last Name" required maxlength="50" pattern=".{3,50}">
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">Password </label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="inputPassword" name="u_password" placeholder="Password" required maxlength="24" pattern=".{6,24}">
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">Password </label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="inputPasswordRepeat" name="u_passwordrepeat" placeholder="Password" required maxlength="24" pattern=".{6,24}">
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input id="agreementCheckbox" name="agreementCheckbox" type="checkbox" required> Accept our <a href="#">privacy policy</a> and <a href="#">customer agreement</a>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<button type="button" id="register-bt" class="btn btn-group btn-default btn-animated"> 
												<i class="fa fa-check"></i>
												<span id="upload-span"> Sign Up </span>
												<span id="uploading-span-img" class="fa fa-refresh fa-spin" style="display:none;"></span>
												<span id="uploading-span-text" style="display:none;"> Sign Up... </span> 	
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			<!-- main-container end -->
			
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
				$("#register-div").css("opacity", "1").fadeIn(1000);
			});
			
			$("#logo-span").click(function(){
				window.location.href = "index.php";
			});
			
			$("#register-bt").click(function(){
				if($('#agreementCheckbox').prop('checked')){
					var checkboxStatus = 1;
				} else {
					var checkboxStatus = 0;
				}
				console.log($('#agreementCheckbox').prop('checked'));
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=register&u_email="+$('#inputEmail').val()+"&u_firstname="+$('#inputName').val()+"&u_lastname="+$('#inputLastName').val()+"&u_password="+$('#inputPassword').val()+"&u_passwordrepeat="+$('#inputPasswordRepeat').val()+"&agreementCheckbox="+checkboxStatus,
					dataType: "json",
					beforeSend: function() {
						$('#uploading-span-text').show();
						$('#uploading-span-img').show();
						$('#upload-span').hide();
						$( "#register-button" ).attr( "disabled", true );
						
					},
					complete: function() {
						$('#uploading-span-text').hide();
						$('#uploading-span-img').hide();
						$('#upload-span').show();
						$( "#register-button" ).attr( "disabled", false );
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
						}
						console.log(data);
						console.log(data.status);
						console.log(data.msg);						
					},
					error: function(){

					},
				});
			});
			
			
			
		</script>
	</body>
</html>