<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.php");
		exit;
	}
	include('functions.php');
	
	$page = 'start-diet';
	
	$sql = "SELECT * FROM user_physical WHERE u_id=:u_id LIMIT 1"; 
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
	$stmt->execute();   
	$obj  = $stmt->fetchObject();
	$total = $stmt->rowCount();
		
	
	
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
								<div class="header-right clearfix pull-right" style="margin-top:10px;">
									
								<!-- main-navigation start -->
								<!-- classes: -->
								<!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
								<!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
								<!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
								<!-- ================ -->
								<div class="main-navigation  animated with-dropdown-buttons">

									<?php include('navbar.inc.php'); ?>

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
								<h2 class="title">Start Diet</h2>
								<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
								<div id="successDiv" class="alert alert-success" style="display:none;"></div>
								<form class="form-horizontal">
									<div class="form-group">
										<label for="inputPassword" class="col-sm-3 control-label">Current Weight</label>
										<div class="col-sm-8">
											<div class="input-group">
											  <input placeholder="pounds" value="<?php echo $obj->up_weight; ?>" id="currentWeight" name="currentWeight" type="number" step="0.1" class="form-control">
											  <span class="input-group-addon">lbs</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword" class="col-sm-3 control-label">Target Weight</label>
										<div class="col-sm-8">
											<div class="input-group">
											  <input placeholder="pounds" id="targetWeight" name="targetWeight" type="number" step="0.1" class="form-control">
											  <span class="input-group-addon">lbs</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-3 control-label">Date</label>
										<div class="col-sm-8">
											<input type="date" class="form-control" id="targetDate" name="targetDate">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">										
											<button id="startDietBtn" style="float:right; margin-left:10px;" type="button" class="btn btn-group btn-default btn-animated">Start <i class="fa fa-arrow-right"></i></button>
											<a href="home.php"><button style="float:right;" type="button" class="btn btn-group btn-danger btn-animated">Cancel <i class="fa fa-times"></i></button></a>
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
		
			$("#startDietBtn").click(function(){
					$.ajax({
						type: "POST",
						url: "ajax.php",
						data: "function=startDiet&currentWeight="+$('#currentWeight').val()+"&targetWeight="+$('#targetWeight').val()+"&targetDate="+$('#targetDate').val(),
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