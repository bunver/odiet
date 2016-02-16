<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.html");
		exit;
	}
	include('db.inc.php');
	
	$sql = "SELECT * FROM user_physical WHERE u_id=:u_id ORDER BY up_date DESC LIMIT 1"; 
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
	$stmt->execute();   
	$obj  = $stmt->fetchObject();
	$totalPhysical = $stmt->rowCount();
	
	$now = time();
	$reference = strtotime($obj->up_date);
	$result = $now - $reference;
	$day = floor($result / 86400);
	
	if($day < 1){
		header ("Location: home.php");
	}
		
	
	
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>OpenDiet - Lost Your Weights with Your Friends</title>
		<meta name="description" content="OpenDiet is a platform where users can update their weight loosing progress and share with their friends.">
		<meta name="author" content="opendiet.org">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="plugins/rs-plugin/css/settings.css" rel="stylesheet">
		<link href="css/animations.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="plugins/hover/hover-min.css" rel="stylesheet">		

		<!-- the project core CSS file -->
		<link href="css/style.css" rel="stylesheet" >

		<!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
		<link href="css/skins/light_blue.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
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
		
			<!-- header-container start -->
			<div class="header-container">
				
				<!-- header start -->
				<!-- classes:  -->
				<!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
				<!-- "dark": dark version of header e.g. class="header dark clearfix" -->
				<!-- "full-width": mandatory class for the full-width menu layout -->
				<!-- "centered": mandatory class for the centered logo layout -->
				<!-- ================ --> 
				<header class="header  fixed   clearfix">
					
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<!-- header-left start -->
								<!-- ================ -->
								<div class="header-left clearfix">

	
								<!-- logo -->	
								<div class="tp-caption sft large_black" style="margin-bottom:10px; font-size:42px;">
									<span class="logo-font">Open<span class="text-default">Diet</span></span>
								</div>										
									
								</div>
								<!-- header-left end -->

							</div>
							<div class="col-md-9">
					
								<!-- header-right start -->
								<!-- ================ -->
								<div class="header-right clearfix" style="margin-top:10px;">
									
								<!-- main-navigation start -->
								<!-- classes: -->
								<!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
								<!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
								<!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
								<!-- ================ -->
								<div class="main-navigation  animated with-dropdown-buttons">

									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">

											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">
												<!-- main-menu -->
												<div class="nav navbar-nav navbar-right">

													<!-- mega-menu start -->													
													<div class="pull-left">													
														<a href="login.html" class="btn btn-animated btn-default">Login <i class="fa fa-lock"></i></a>														
													</div>
													<!-- mega-menu end -->

													<!-- mega-menu start -->													
													<div class="pl-10 pull-left">
														<a href="register.html" class="btn btn-animated btn-warning">Register <i class="fa fa-user"></i></a>																												
													</div>
													<!-- mega-menu end -->
												</div>
												<!-- main-menu end -->												

												
											</div>

										</div>
									</nav>
									<!-- navbar end -->

								</div>
								<!-- main-navigation end -->	
								</div>
								<!-- header-right end -->
					
							</div>
						</div>
					</div>
					
				</header>
				<!-- header end -->
			</div>
			<!-- header-container end -->
		
			<div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible animated object-visible fadeInUpSmall" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div class="form-block center-block p-30 light-gray-bg border-clear">
								<h2 class="title">Diet</h2>
								<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
								<div id="successDiv" class="alert alert-success" style="display:none;"></div>
								<form class="form-horizontal">
									<div class="form-group">
										<label for="inputPassword" class="col-sm-3 control-label">Weight</label>
										<div class="col-sm-8">
											<div class="input-group">
											  <input placeholder="pounds" id="weight" name="weight" type="number" step="0.1" class="form-control">
											  <span class="input-group-addon">lbs</span>
											</div>
										</div>
									</div>									
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">										
											<button id="startDietBtn" style="float:right; margin-left:10px;" type="button" class="btn btn-group btn-default btn-animated">Start <i class="fa fa-arrow-right"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			
			<div id="page-start"></div>


			<!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
			<!-- ================ -->
			<footer id="footer" class="clearfix ">

				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="subfooter-inner">
							<div class="row">
								<div class="col-md-12">
									<p class="text-center">Copyright © 2015 The Project by <a target="_blank" href="http://htmlcoder.me">HtmlCoder</a>. All Rights Reserved</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->
			
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
		
			$("#startDietBtn").click(function(){
					$.ajax({
						type: "POST",
						url: "ajax.php",
						data: "function=diet&weight="+$('#weight').val(),
						dataType: "json",
						beforeSend: function() {

						},
						complete: function() {

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
				});

		</script>
	</body>
</html>