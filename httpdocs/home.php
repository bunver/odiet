<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.php");
		exit;
	}
	
	include('functions.php');
	
	$page = 'home';
	
	$redirect = checkRequiredInfo();
	switch($redirect){
		case 'step1';
			header ("Location: start.php?redirect=$redirect");
		break;
		case 'step2';
			header ("Location: start.php?redirect=$redirect");
		break;
		case 'step3';
			header ("Location: start.php?redirect=$redirect");
		break;
		case 'home';			
			$dietStatus = dietStatus();
			$isUpUpdateRequired = isUpUpdateRequired();
			if($dietStatus){
				$dietStats = getDietStats();
				if($dietStats->ds_progress == 'P'){
					$icon_diet_progres_class = 'fa fa-smile-o fa-2x';
					$progress_status = '';
				} else if($dietStats->ds_progress == 'N'){
					$icon_diet_progres_class = 'fa fa-frown-o fa-2x';
					$progress_status = '-';
				} else {
					$icon_diet_progres_class = 'fa fa-meh-o fa-2x';
					$progress_status = '';
				}
			}
			
			if(!isset($_SESSION['alerts']->updateWeight)){
				if($dietStatus && $isUpUpdateRequired){
					$showUpdateWeightModal = 1;
					$_SESSION['alerts']->updateWeight = 1;
				} else {
					$showUpdateWeightModal = 0;
					$_SESSION['alerts']->updateWeight = 0;
				}
			}
			
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
		<title>The Project | Page Two Sidebars</title>
		<meta name="description" content="The Project a Bootstrap-based, Responsive HTML5 Template">
		<?php include('head-out.inc.php'); ?>
		
	</head>

	<!-- body classes:  -->
	<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
	<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
	<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
	<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
	<body class="no-trans">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<!-- header-container start -->
			<div class="header-container">
				
				<!-- header-top start -->
				<!-- classes:  -->
				<!-- "dark": dark version of header top e.g. class="header-top dark" -->
				<!-- "colored": colored version of header top e.g. class="header-top colored" -->
				<!-- ================ -->
				
				
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
								<div class="header-right clearfix pull-right">	
									<div class="main-navigation  animated with-dropdown-buttons">

									<?php include('navbar.inc.php') ?>

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
		
			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="home.php">Home</a></li>
						<li class="active"></li>
					</ol>
				</div>
			</div>
			
			<!-- breadcrumb end -->

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">
				
				<div class="container">
					<div class="row">
					
						<!-- sidebar start -->
						<!-- ================ -->
						<aside class="col-md-3 col-md-push-9">
							<div class="sidebar">
							<?php
								if(dietStatus()){ ?>
								<div class="block clearfix" id="my-diet-div">
									<h3 class="title">My Diet</h3>									
									<div class="separator-2"></div>
									<div class="knob-container">									    
										<input class="knob" data-fgcolor="#f0ad4e" data-thickness=".10" data-animate-value="<?php echo $progress_status.$dietStats->ds_percent; ?>" value="0" data-displayInput="false" data-readOnly="true">
										<div class="knob-text">
											<i id="diet-progress" class="<?php echo $icon_diet_progres_class; ?>" style="margin-bottom:10px;"></i><br/>
											<label>Goal</label>
											<span><?php echo $progress_status.$dietStats->ds_percent; ?>%</span>
											<br/><label>Difference</label>
											<span><?php echo  $dietStats->ds_difference; ?> lbs</span>
											<br/><label>Weight</label>
											<span><?php echo  $dietStats->ds_weight; ?> lbs</span>												
											<br/><label>Time</label>
											<span><?php echo  $dietStats->ds_duration; ?> weeks</span>
										</div>
									</div>
									<button id="update-weight-bt" class="btn btn-animated btn-block btn-default">Update My Weight <i class="fa fa-edit"></i></button>									
								</div>
								<?php } else { ?>
									<div class="block clearfix" id="my-diet-div">
									<h3 class="title">My Diet</h3>									
									<div class="separator-2"></div>									
									<a href="start-diet.php"><button id="start-diet-bt" style="margin-top:30px;" class="btn btn-animated btn-block btn-default">Start Diet <i class="fa fa-arrow-right"></i></button></a>									
								</div>
								<?php }
								?>
								<div class="block clearfix">
									<h3 class="title">Featured Members</h3>
									<div class="separator-2"></div>
									<div id="carousel-portfolio-sidebar" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators">
											<li data-target="#carousel-portfolio-sidebar" data-slide-to="0" class="active"></li>
											<li data-target="#carousel-portfolio-sidebar" data-slide-to="1"></li>
											<li data-target="#carousel-portfolio-sidebar" data-slide-to="2"></li>
										</ol>

										<!-- Wrapper for slides -->
										<div class="carousel-inner" role="listbox">
											<div class="item active">
												<div class="image-box shadow text-center mb-20">
													<div class="overlay-container">
														<img src="images/portfolio-4.jpg" alt="">
														<a href="portfolio-item.html" class="overlay-link">
															<i class="fa fa-link"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="item">
												<div class="image-box shadow text-center mb-20">
													<div class="overlay-container">
														<img src="images/portfolio-1-2.jpg" alt="">
														<a href="portfolio-item.html" class="overlay-link">
															<i class="fa fa-link"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="item">
												<div class="image-box shadow text-center mb-20">
													<div class="overlay-container">
														<img src="images/portfolio-1-3.jpg" alt="">
														<a href="portfolio-item.html" class="overlay-link">
															<i class="fa fa-link"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</aside>
						<!-- sidebar end -->

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-6">
							<div id="errorDiv" class="alert alert-danger alert-dismissible" style="display:none; margin-top:0px;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<span id="errorDivMsg"></span>
							</div>
							<div id="successDiv" class="alert alert-success alert-dismissible" style="display:none; margin-top:0px;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<span id="successDivMsg"></span>
							</div>
							<div class="block clearfix">
								<!-- pills start -->
								<!-- ================ -->
								<!-- Nav tabs -->
								<ul class="nav nav-pills style-2" role="tablist">
									<li id="li-pill2-1" class="active"><a href="#pill2-1" role="tab" data-toggle="tab" title="text"><i class="fa fa-pencil pr-5"></i> Text</a></li>
									<li id="li-pill2-2"><a href="#pill2-2" role="tab" data-toggle="tab" title="images"><i class="fa fa-camera pr-5"></i> Photo</a></li>								
								</ul>
								<!-- Tab panes -->
								<div class="tab-content clear-style">
									<div class="tab-pane active" id="pill2-1">
										<form role="form">
											<textarea id="status-text" placeholder="How do you feel?" class="form-control" rows="3"></textarea>										
										</form>								
									</div>
									<div class="tab-pane" id="pill2-2">
										<label for="exampleInputFile">Choose a Picture</label>
											<div id="preview-img-div"><img src='' id='preview-img'/></div>
											<button class="file-btn btn btn-animated btn-default">
												Browse
												<input name="create_topic_file" id="create_topic_file" type="file" placeholder="Select File"></input>
												<i class="fa fa-folder-open-o"></i>
											</button>
											<button class="btn upload-result btn-animated btn-danger" id="img-select-cancel-bt" style="display:none;">Cancel <i class="fa fa-times"></i></button>
									</div>
									<button type="button" id="status-share-bt" class="btn btn-animated btn-default pull-right" data-dismiss="modal"> 
										<i class="fa fa-share"></i>
										<span id="upload-span"> Share </span>
										<span id="uploading-span-img" class="fa fa-refresh fa-spin" style="display:none;"></span>
										<span id="uploading-span-text" style="display:none;"> Sharing... </span>
									</button>
								</div>
								<!-- pills end -->
							</div>
							<div class="block clearfix">
							<!-- page-title start -->
							<!-- ================ -->							
							<div class="separator-2"></div>
							
							</div>
						</div>
						<!-- main end -->

						<!-- sidebar start -->
						<!-- ================ -->
						<aside class="col-md-3 col-md-pull-9">
							<div class="sidebar">							
								<div class="block clearfix">
									<nav>
										<ul class="nav nav-pills nav-stacked">
											<li class="active"><a href="home.php">Home</a></li>
											<li><a href="profile.php">Profile</a></li>										
										</ul>
									</nav>
								</div>
							</div>
						</aside>
						<!-- sidebar end -->

						

					</div>
				</div>
			</section>
			<!-- main-container end -->
			
			<!-- Modal -->
			<div id="updateWeightModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Your Weight</h4>
				  </div>
				  <div class="modal-body" style="text-align:center;">
					<div id="modalErrorDiv" class="alert alert-danger alert-dismissible" style="display:none; margin-top:0px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<span id="errorDivMsg"></span>
					</div>
					<div id="modalSuccessDiv" class="alert alert-success alert-dismissible" style="display:none; margin-top:0px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<span id="successDivMsg"></span>
					</div>
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
							<div class="col-sm-offset-3 col-sm-8"></div>
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-animated btn-danger" data-dismiss="modal">Cancel <i class="fa fa-times"></i></button>
					<button type="button" id="weightUpdateBtn" style="margin:0px;" id="img-upload-bt" class="btn btn-animated btn-default">
						<span id="update-span"> Update </span>
						<span id="updating-span-img" class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></span>
						<span id="updating-span-text" style="display:none;"> Updating... </span>  
						<i class="fa fa-check"></i>
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
		
		<!-- Bootstrap Knob javascript -->
		<script type="text/javascript" src="plugins/jquery.knob.min.js"></script>

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
			<?php if($showUpdateWeightModal == 1){
				echo "$('#updateWeightModal').modal();";
				//$_SESSION['alerts']->updateWeight = 0;
			} ?>
			
			
			$("#weightUpdateBtn").click(function(){
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=updateWeight&weight="+$('#weight').val(),
					dataType: "json",
					beforeSend: function() {
						$('#updating-span-text').show();
						$('#updating-span-img').show();
						$('#update-span').hide();
						$( "#weightUpdateBtn" ).attr( "disabled", true );
					},
					complete: function() {
						$('#updating-span-text').hide();
						$('#updating-span-img').hide();
						$('#update-span').show();
						$( "#weightUpdateBtn" ).attr( "disabled", false );
					},
					success: function(data){			
						if (data.status == 'error') {
							$('#modalErrorDiv').show();
							$('#modalSuccessDiv').hide();
							$('#modalErrorDiv #errorDivMsg').html(data.msg);
						} else if(data.status == 'success') {
							$('#modalErrorDiv').hide();
							$('#modalSuccessDiv').show();
							$('#modalSuccessDiv #successDivMsg').html(data.msg);
							setTimeout(function(){
							  window.location.href = "home.php";
							}, 1500);
						}
						
					},
					error: function(){
						$('#updating-span-text').hide();
						$('#updating-span-img').hide();
						$('#update-span').show();
						$( "#weightUpdateBtn" ).attr( "disabled", false );
					}
				});
			});
			
			$("#update-weight-bt").click(function(){
				$('#updateWeightModal').modal();
			});
			
			$("#img-select-cancel-bt").click(function(){
				$('#preview-img').attr('src', '');
				$('#img-select-cancel-bt').hide();
			});
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#preview-img').attr('src', e.target.result);
						$('#img-select-cancel-bt').show();
					}
					reader.readAsDataURL(input.files[0]);
				}
			}			
			
			$("#create_topic_file").change(function(){
				readURL(this);
			});
			
			$("#logout-bt").click(function(){
				window.location.href = "logout.php";
			});
			
			$("#status-share-bt").click(function(){
				$.ajax({
					url: 'ajax.php',
					type: 'POST',
					data: 'function=statusShare&statusText='+$('#status-text').val()+'&imgType=status&imgData='+$('#preview-img').attr("src"),
					cache: false,
					dataType: 'json',
					beforeSend: function() {
						$('#uploading-span-img').show();
						$('#upload-span').html('Sharing...');
						$('#status-share-bt').attr( "disabled", true );
					},
					complete: function() {
						$('#uploading-span-img').hide();
						$('#upload-span').html('Share');
						$('#status-share-bt').attr( "disabled", false );
						$('#preview-img').attr('src', '');
						$('#img-select-cancel-bt').hide();
						$("#pill2-2").removeClass("active");
						$("#pill2-1").addClass("active");
						$("#li-pill2-2").removeClass("active");
						$("#li-pill2-1").addClass("active");
					},					
					success: function(data)
					{
						if (data.status == 'error') {
							$('#errorDiv').show();
							$('#successDiv').hide();
							$('#errorDiv #errorDivMsg').html(data.msg);
							$("#errorDiv").delay(3000).fadeOut();
						} else if(data.status == 'success') {
							$('#errorDiv').hide();
							$('#successDiv').show();
							$('#successDiv #successDivMsg').html(data.msg);
							$("#status-text").val('');
							$("#successDiv").delay(3000).fadeOut();
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