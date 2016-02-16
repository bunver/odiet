<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.php");
		exit;
	}
	$redirect = $_REQUEST['redirect'];

	switch($redirect){
		case 'step1';
			$step1Active = 'active';
		break;
		case 'step2';
			$step2Active = 'active';
		break;
		case 'step3';
			$step3Active = 'active';
		break;
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
		
		<!-- Page css -->
        <link rel="Stylesheet" type="text/css" href="plugins/croppie/croppie.css" />
        <link rel="Stylesheet" type="text/css" href="plugins/croppie/demo.css" />
		
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
		
			<!-- main-container start -->
			<!-- ================ -->
			<div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div class="form-block center-block p-30 light-gray-bg border-clear">
								<h2 class="title">Required Information</h2>
								<div class="process">
									<!-- Nav tabs -->
									<ul class="nav nav-pills" role="tablist">
										<li class="<?php echo $step1Active; ?>"><a role="tab" data-toggle="tab" title="Step 1"><i class="fa fa-dot-circle-o pr-5"></i> Step 1</a></li>
										<li class="<?php echo $step2Active; ?>"><a role="tab" data-toggle="tab" title="Step 2"><i class="fa fa-dot-circle-o pr-5"></i> Step 2</a></li>
										<li class="<?php echo $step3Active; ?>"><a role="tab" data-toggle="tab" title="Step 3"><i class="fa fa-dot-circle-o pr-5"></i> Step 3</a></li>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content clear-style">
										<div class="tab-pane <?php echo $step1Active; ?>" id="pill-pr-1">
											<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
											<div id="successDiv" class="alert alert-success" style="display:none;"></div>
											<form class="form-horizontal" id="registerForm" method="POST" role="form">
												<div class="form-group">
													<label for="inputEmail" class="col-sm-3 control-label">Gender </label>
													<div class="col-sm-8">
														<select class="form-control" name="gender" id="gender">
															<option selected>Not Selected</option>
															<option>Male</option>
															<option>Female</option>
															<option>LGBT</option>
															<option>Other</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="inputName" class="col-sm-3 control-label">Birthday </label>
													<div class="col-sm-8">
														<input type="date" class="form-control" id="birthday" name="birthday">
													</div>
												</div>
												<div class="form-group">
													<label for="inputLastName" class="col-sm-3 control-label">Country </label>
													<div class="col-sm-8">
														<select class="form-control" id="country" name="country">
															<option selected>Not Selected</option>
															<option value="US">United States</option>
															<option value="CA">Canada</option>
															<option value="UK">United Kingdom</option>
															<option value="AU">Australia</option>
														</select>
													</div>
												</div>
												
												<div class="form-group" style="display:none;" id="zip-div">
													<label for="inputLastName" class="col-sm-3 control-label">ZIP Code </label>
													<div class="col-sm-8">
														
														<div class="input-group">
														  <input type="number" class="form-control" id="zip" name="zip" maxlength="5" pattern=".{3,5}" />
														  <span class="input-group-btn">
															<button class="btn btn-default" type="button" style="margin-top:0px; height:40px;" id="zip-button">Check</button>
														  </span>
														</div><!-- /input-group -->
													</div>
												</div>
												<div class="form-group" style="display:none;" id="states-div">
													<label for="inputLastName" class="col-sm-3 control-label">State </label>
													<div class="col-sm-8">
														<span class="form-control" id="state" name="state" />
													</div>
												</div>
												<div class="form-group" style="display:none;" id="city-div">
													<label for="inputPassword" class="col-sm-3 control-label">City </label>
													<div class="col-sm-8">
														<span class="form-control" id="city" name="city" />
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-3 col-sm-8">
														<button type="button" class="btn btn-group btn-default btn-animated" style="float:right;" id="step1-button">Next <i class="fa fa-arrow-right"></i></button>
													</div>
												</div>
											</form>
										</div>
										<div class="tab-pane <?php echo $step2Active; ?>" id="pill-pr-2">
											<div id="errorDiv2" class="alert alert-danger" style="display:none;"></div>
											<div id="successDiv2" class="alert alert-success" style="display:none;"></div>
											<form class="form-horizontal">
												<div class="form-group">
													<label for="inputUserName" class="col-sm-3 control-label">Height</label>
													<div class="col-sm-8">
														<div class="input-group" style="width:45%; float:left;">
														  <input placeholder="feet" id="feet" name="feet" type="number" step="1" class="form-control" >
														  <span class="input-group-addon">ft</span>
														</div>
														<div class="input-group" style="width:45%; float:right;">
														  <input placeholder="inches" id="inches" name="inches" type="number" step="1" class="form-control" >
														  <span class="input-group-addon">in</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="inputPassword" class="col-sm-3 control-label">Weight</label>
													<div class="col-sm-8">
														<div class="input-group">
														  <input placeholder="pounds" id="pounds" name="pounds" type="number" step="0.1" class="form-control">
														  <span class="input-group-addon">lbs</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-3 col-sm-8">										
														<button type="button" id="step2-button" style="float:right;" class="btn btn-group btn-default btn-animated">Next <i class="fa fa-arrow-right"></i></button>
													</div>
												</div>
											</form>
										</div>
										<div class="tab-pane <?php echo $step3Active; ?>" id="pill-pr-3">
											<label for="exampleInputFile">Choose Profile Picture</label>
											
											<div class="demo-wrap upload-demo">
												<div class="grid">
													<div class="col-1-2">
														<div class="col-1-2">
															Upload a photo to start cropping<br/><strong>Width and height are must be greater than 200px.</strong>
															<div id="upload-demo"></div>
														</div>																												
														<div class="actions">
															<button class="file-btn btn btn-animated btn-default">
																Browse
																<input type="file" id="upload" value="Choose a file" accept="images/*" />
																<i class="fa fa-folder-open-o"></i>
															</button>
															<button class="btn upload-result btn-animated btn-default">Crop <i class="fa fa-crop"></i></button>
														</div>
													</div>													
												</div>
											</div>											

										</div>
									</div>
								</div>	
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			<!-- main-container end -->
			
			
			<div id="page-start"></div>
			
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cropped Image</h4>
				  </div>
				  <div class="modal-body" style="text-align:center;">
				    <div id="errorDiv3" class="alert alert-danger" style="display:none;"></div>
					<div id="successDiv3" class="alert alert-success" style="display:none;"></div>
					<img id="cropped-img" style="max-width:200px; min-width:200px; margin-left: auto; margin-right: auto;" src=""/>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-animated btn-danger" data-dismiss="modal">Cancel <i class="fa fa-times"></i></button>
					<button type="button" style="margin:0px;" id="img-upload-bt" class="btn btn-animated btn-default">						
						<span id="upload-span"> Upload </span>
						<span id="uploading-span-img" class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></span>
						<span id="uploading-span-text" style="display:none;"> Uploading... </span> 	
						<i class="fa fa-upload"></i>
					</button>
				  </div>
				</div>

			  </div>
			</div>


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

        <script src="plugins/croppie/croppie.js"></script>
        <script src="plugins/croppie/demo.js"></script>
		
		<script>	
				
			Demo.init();
			
			$("#country").change(function(){
				console.log($(this).val());
				if($(this).val() == 'US'){
					$('#zip-div').show();
				} else {
					$('#zip-div').hide();
					$('#states-div').hide();
					$('#city-div').hide();
				}
			});
			$("#zip-button").click(function(){
				console.log($('#zip').val());
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=checkZIP&zip="+$('#zip').val(),
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
							$('#states-div').show();
							$('#state').html(data.data.state);
							$('#city-div').show();
							$('#city').html(data.data.primary_city);
						}
						
					},
					error: function(){

					}
				});
			});
			
			$("#step1-button").click(function(){
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=step1&gender="+$('#gender').val()+"&birthday="+$('#birthday').val()+"&country="+$('#country').val()+"&zip="+$('#zip').val(),
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
							window.location.href = "home.php";
						}
						
					},
					error: function(){

					}
				});
			});
			
			$("#step2-button").click(function(){
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=step2&feet="+$('#feet').val()+"&inches="+$('#inches').val()+"&pounds="+$('#pounds').val(),
					dataType: "json",
					beforeSend: function() {

					},
					complete: function() {

					},
					success: function(data){			
						if (data.status == 'error') {
							$('#errorDiv2').show();
							$('#successDiv2').hide();
							$('#errorDiv2').html(data.msg);
						} else if(data.status == 'success') {
							$('#errorDiv2').hide();
							window.location.href = "home.php";
						}
						
					},
					error: function(){

					}
				});
			});
			
			
			$("#img-upload-bt").click(function(){
				$.ajax({
					url: 'ajax.php',
					type: 'POST',
					data: 'function=imgUpload&imgType=profile&imgData='+$('#cropped-img').attr("src"),
					cache: false,
					dataType: 'json',
					beforeSend: function() {
						$('#uploading-span-text').show();
						$('#uploading-span-img').show();
						$('#upload-span').hide();
						$( "#img-upload-bt" ).attr( "disabled", true );
					},
					complete: function() {
						$('#uploading-span-text').hide();
						$('#uploading-span-img').hide();
						$('#upload-span').show();
						$( "#img-upload-bt" ).attr( "disabled", false );
					},					
					success: function(data)
					{
						if (data.status == 'error') {
							$('#errorDiv3').show();
							$('#successDiv3').hide();
							$('#errorDiv3').html(data.msg);
						} else if(data.status == 'success') {
							$('#errorDiv3').hide();
							$('#successDiv3').show();
							$('#successDiv3').html(data.msg);
							window.location.href = "home.php";
						}
					},
					error: function(data)
					{
						$('#uploading-span-text').hide();
						$('#uploading-span-img').hide();
						$('#upload-span').show();
						$( "#img-upload-bt" ).attr( "disabled", false );
					}
				});
			});			
			

			
			
		</script>

		
	</body>
</html>