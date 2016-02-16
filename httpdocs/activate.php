<?php
	include('db.inc.php');
	
	$sql = "SELECT * FROM user WHERE u_activation_code=:u_activation_code LIMIT 1"; 
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':u_activation_code', $_REQUEST['code'], PDO::PARAM_STR);
	$stmt->execute();   
	$obj  = $stmt->fetchObject();
	$total = $stmt->rowCount();
	
	if($total == 1){
		$sql = "UPDATE user SET u_status=1 WHERE u_status=0 AND u_activation_code=:u_activation_code"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_activation_code', $_REQUEST['code'], PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		if ($total == 1){
			$display1 = 'block';
			$display0 = 'none';
			$display2 = 'none';
		} else {
			$display0 = 'block';
			$display1 = 'none';
			$display2 = 'none';
		}
	} else {
		$display2 = 'block';
		$display0 = 'none';
		$display1 = 'none';
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
			<div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div class="form-block center-block p-30 light-gray-bg border-clear">
								<h2 class="title">Activation</h2>
								<div id="errorDiv" class="alert alert-danger" style="display:<?php echo $display0; ?>;">Your account already have been activated before!</div>
								<div id="errorDiv" class="alert alert-danger" style="display:<?php echo $display2; ?>;">Your account could not activate!</div>
								<div id="successDiv" class="alert alert-success" style="display:<?php echo $display1; ?>;">Your Account successfully activated!</div>
								<div class="pull-left" style="display:<?php echo $display1; ?>;">													
									<a href="login.php" class="btn btn-animated btn-default">Login <i class="fa fa-lock"></i></a>														
								</div>
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
		
	</body>
</html>