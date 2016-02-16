<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.php");
		exit;
	}
	
	include('functions.php');
	
	$page = 'account';
	
	$redirect = $_REQUEST['redirect'];

	switch($redirect){
		case 'edit-my-info';
			$active1 = 'active';
			$activeTab1 = 'active in';
			$breadcrumb = 'Edit My Info';
		break;
		case 'change-password';
			$active2 = 'active';
			$activeTab2 = 'active in';
			$breadcrumb = 'Change Password';
		break;
		case 'change-profile-photo';
			$active3 = 'active';
			$activeTab3 = 'active in';
			$breadcrumb = 'Change Profile Photo';
		break;
		case 'edit-settings';
			$active4 = 'active';
			$activeTab4 = 'active in';
			$breadcrumb = 'Edit Settings';
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
		
		<!-- Page css -->
        <link rel="Stylesheet" type="text/css" href="plugins/croppie/croppie.css" />
        <link rel="Stylesheet" type="text/css" href="plugins/croppie/demo.css" />
		
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
						<li>Account </li>
						<li class="active"><?php echo $breadcrumb; ?> </li>
					</ol>
				</div>
			</div>
			
			<!-- breadcrumb end -->

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">
				
				<div class="container">
					<div class="row">
					
						<div class="vertical" style="margin: 20px 20px;">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist" style="background-color:#2e6da4;">
								<li class="<?php echo $active1; ?>"><a href="#vtab1" role="tab" data-toggle="tab" aria-expanded="true" style="border-color:#337ab7;"><i class="fa fa-edit pr-10"></i> Edit My Info</a></li>
								<li class="<?php echo $active2; ?>"><a href="#vtab2" role="tab" data-toggle="tab" aria-expanded="false" style="border-color:#337ab7;"><i class="fa fa-key pr-10"></i> Change Password</a></li>
								<li class="<?php echo $active3; ?>"><a href="#vtab3" role="tab" data-toggle="tab" aria-expanded="false" style="border-color:#337ab7;"><i class="fa fa-image pr-10"></i> Change Profile Photo</a></li>
								<li class="<?php echo $active4; ?>"><a href="#vtab4" role="tab" data-toggle="tab" aria-expanded="false" style="border-color:#337ab7;"><i class="fa fa-cogs pr-10"></i> Edit Settings</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content" style="width: 100%;">
								<div class="tab-pane fade <?php echo $activeTab1; ?>" id="vtab1">
									<h3 class="title">Edit My Info</h3>
									<form class="form-horizontal">
										<div class="form-group has-feedback">
											<label for="inputUserName" class="col-sm-3 control-label">Old Password</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" id="inputEmail" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group has-feedback">
											<label for="inputPassword" class="col-sm-3 control-label">New Password</label>
											<div class="col-sm-8">
												<input type="password" maxlength="24" class="form-control" id="inputPassword" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group has-feedback">
											<label for="inputPassword" class="col-sm-3 control-label">New Password</label>
											<div class="col-sm-8">
												<input type="password" maxlength="24" class="form-control" id="inputPassword" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-8">											
												<button type="button" id="login-bt" class="btn btn-group btn-default btn-animated">
													<i class="fa fa-key"></i>
													<span id="upload-span"> Change </span>	
												</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane <?php echo $activeTab2; ?> fade" id="vtab2">
									<h3 class="title">Change Password</h3>
									<div id="errorDiv" class="alert alert-danger" style="display:none;"></div>
									<div id="successDiv" class="alert alert-success" style="display:none;"></div>
									<form class="form-horizontal">
										<div class="form-group has-feedback">
											<label for="inputUserName" class="col-sm-3 control-label">Old Password</label>
											<div class="col-sm-8">
												<input type="password" maxlength="24" class="form-control" id="inputOldPassword" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group has-feedback">
											<label for="inputPassword" class="col-sm-3 control-label">New Password</label>
											<div class="col-sm-8">
												<input type="password" maxlength="24" class="form-control" id="inputNewPassword" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group has-feedback">
											<label for="inputPassword" class="col-sm-3 control-label">New Password</label>
											<div class="col-sm-8">
												<input type="password" maxlength="24" class="form-control" id="inputNewPasswordRepeat" placeholder="Password" required="">
												<i class="fa fa-lock form-control-feedback"></i>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-8">											
												<button type="button" id="change-password-bt" class="btn btn-group btn-default btn-animated">
													<i class="fa fa-key"></i>
													<span id="upload-span"> Change </span>	
												</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane <?php echo $activeTab3; ?> fade" id="vtab3">
									<h3 class="title">Change Profile Photo</h3>
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
								<div class="tab-pane <?php echo $activeTab4; ?> fade" id="vtab4">
									<h3 class="title">Edit Settings</h3>
									
								</div>
							</div>
						</div>
			
					</div>
				</div>
			</section>
			<!-- main-container end -->
			
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
		
		<script src="plugins/croppie/croppie.js"></script>
        <script src="plugins/croppie/demo.js"></script>
		
		<script>

			Demo.init();
	
			$("#logout-bt").click(function(){
				window.location.href = "logout.php";
			});
			
			$("#change-password-bt").click(function(){
				console.log($('#zip').val());
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "function=changePassword&oldPassword="+$('#inputOldPassword').val()+"&newPassword="+$('#inputNewPassword').val()+"&newPasswordRepeat="+$('#inputNewPasswordRepeat').val(),
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
							$('#successDiv').show();
						}
						
					},
					error: function(){

					}
				});
			});
			
			
		</script>

	</body>
</html>