<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.php");
		exit;
	}
	
	include('functions.php');
	
	$page = 'profile';
	
	$address = getAddress($_SESSION['user']->u_zip);
	$age = getAge($_SESSION['user']->u_birthday);
	$membershipDuration = displayDate($_SESSION['user']->u_register_date, '2');
	$userTimeline = getUserTimeline($_SESSION['user']->u_id);	
	
	if($_SESSION['user']->u_gender == 'Male'){
		$genderIcon = 'fa-male';		
	} else if($_SESSION['user']->u_gender == 'Female'){
		$genderIcon = 'fa-female';		
	} else {
		$genderIcon = 'fa-genderless';		
	}
	
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
		
		<!-- Page css --> 
		<link href="css/profile.css" rel="stylesheet">
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
			
			<!-- banner start -->
			<!-- ================ -->
			<div id="collapseMap" class="banner">
				<!-- google map start -->
				<!-- ================ -->
				<div id="map-canvas"></div>
				<!-- google maps end -->
			</div>
			<!-- banner end -->
		
			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="home.php">Home</a></li>
						<li class="active">Profile </li>
					</ol>
				</div>
			</div>
			
			<!-- breadcrumb end -->
			<section class="main-container">
				<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div id="profile-info-div">
							<div id="profile-top">
								<div id="user-img">
									<img class="img-circle" style="padding: 3px; border:3px solid #fff; box-shadow: 0px 0px 20px #888888;" src="photos/profile/<?php echo $_SESSION['user']->u_profile_photo; ?>.jpg" />
								</div>
								<div id="user-info">
									<div class="body">
										<h3><?php echo $_SESSION['user']->u_firstname.' '; echo $_SESSION['user']->u_lastname; ?></h3>
										<div class="separator-2"></div>
										<p class="small mb-10 text-muted"><i class="pr-5 pl-5 fa fa-calendar"></i><?php echo $membershipDuration; ?><i class="pr-5 pl-10 fa <?php echo $genderIcon; ?>"></i><?php echo $age; ?> years old</p>
										<p class="small mb-10 text-muted"><i class="pl-5 pr-5 fa fa-map-marker"></i><?php echo $address->primary_city.'/'.$address->state; ?></p>
										<a class="btn btn-gray collapsed map-show btn-animated" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">Show Map <i class="fa fa-plus"></i></a>
										<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam atque ipsam nihil, adipisci rem minus? Voluptatem distinctio laborum porro aspernatur.</p> -->
									</div>
									<div class="body">
									
								<?php
								if(dietStatus()){ ?>
								
								<h4>Diet Status</h4>
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
										
								<?php } ?>
								

									</div>
									</div>
									<!--
									<ul class="list-icons">
										<li><i class="fa fa-map-marker pr-10 text-default"></i><?php echo $age; ?></li>
										<li><i class="fa fa-genderless pr-10 text-default"></i>Male</li>
									</ul>
									-->
								</div>
							</div>
							<div id="profile-bottom">
								
							</div>
						</div>
					</div>
					<div class="main col-md-9">
						<!-- Timeline -->
						<div class="timeline">
							
							<!-- Line component -->
							<div class="line text-muted"></div>
							
							<?php 
									
								foreach ($userTimeline as $key => $value) {
								   //print_r( $value);								   

									switch ($value['ua_type']){
										case 'u_updated_weight';
											$getRefWeightUpdate = getRefWeightUpdate($value['ref_id'], $value['u_id']);
											$date = date_create($getRefWeightUpdate->up_date);
											$date = date_format($date, 'm-d-Y');
											$view .= '<article class="panel panel-success">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="glyphicon glyphicon-plus"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Weight Updated</h2>
												</div>
												<!-- /Heading -->
												<!-- Body -->
												<div class="panel-body">
													'.$getRefWeightUpdate->up_weight.' lbs
												</div>
												<!-- /Body -->
												<div class="panel-footer">
													<small>'.$getRefWeightUpdate->displayDate.' ('.$date.')</small>
												</div>
											</article>';
										break;
										case 'u_started_diet';
											$getRefStartDiet = getRefStartDiet($value['ref_id'], $value['u_id']);
											$create_date = date_create($getRefStartDiet->ug_create_date);
											$create_date = date_format($create_date, 'm-d-Y');
											$target_date = date_create($getRefStartDiet->ug_date);
											$target_date = date_format($target_date, 'jS F Y');										
											$weightDiff = $getRefStartDiet->ug_weight - $getRefStartDiet->ug_first_weight;
											if($weightDiff > 0){
												$target = 'gain';
											} else if($weightDiff < 0){
												$target = 'lose';
											}
											$view .= '<article class="panel panel-danger">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="glyphicon glyphicon-plus"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Started Diet</h2>
												</div>
												<!-- /Heading -->
												<div class="panel-body">													
													<ul class="list-icons">
														<li><i class="icon-check pr-10"></i> Target Weight: '.$getRefStartDiet->ug_weight.'</li>
														<li><i class="icon-check pr-10"></i> Current Weight: '.$getRefStartDiet->ug_first_weight.'</li>
														<li><i class="icon-check pr-10"></i> Target Date: '.$target_date.'</li>
														<li><i class="icon-check pr-10"></i> Wants to '.$target.' '.abs($weightDiff).' lbs</li>
													</ul>
												</div>
												<div class="panel-footer">
													<small>'.$getRefStartDiet->displayDate.' ('.$create_date.')</small>
												</div>												
											</article>';
										break;
										case 'u_registered';
											$getRefRegisterDate = getRefRegisterDate($value['ref_id'], $value['u_id']);
											$date = date_create($getRefRegisterDate->u_register_date);
											$date = date_format($date, 'm-d-Y');
											$view .= '<article class="panel panel-warning">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="fa fa-user"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Registered '.$getRefRegisterDate->displayDate.' ('.$date.')</h2>
												</div>
												<!-- /Heading -->												
											</article>';
										break;
										case 'u_shared_photo_and_text';
											$getRefStatusShare = getRefStatusShare($value['ref_id'], $value['u_id']);
											$date = date_create($getRefStatusShare->us_date);
											$date = date_format($date, 'm-d-Y');
											$getImgSrc = getImgSrc($getRefStatusShare->p_id, 'status');
											$view .= '<article class="panel panel-info">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="glyphicon glyphicon-plus"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Status Updated</h2>
												</div>
												<!-- /Heading -->
										
												<!-- Body -->
												<div class="panel-body">
													<div class="shadow bordered">
														<div class="overlay-container">
															<img src="'.$getImgSrc.'" alt="">
															<a href="'.$getImgSrc.'" class="overlay-link popup-img" title="'.$getRefStatusShare->us_text.'">
																<i class="fa fa-plus"></i>
															</a>
														</div>
													</div>
													<!--<img class="img-responsive img-rounded" src="'.$getImgSrc.'" />-->
												</div>	
												<div class="panel-body" style="border-top:1px solid #bce8f1;">
													'.$getRefStatusShare->us_text.'
												</div>
												<!-- /Body -->	
												<div class="panel-footer">
													<small>'.$getRefStatusShare->displayDate.' ('.$date.')</small>
												</div>	
											</article>';
										break;
										case 'u_shared_photo';
											$getRefStatusShare = getRefStatusShare($value['ref_id'], $value['u_id']);
											$date = date_create($getRefStatusShare->us_date);
											$date = date_format($date, 'm-d-Y');
											$getImgSrc = getImgSrc($getRefStatusShare->p_id, 'status');
											$view .= '<article class="panel panel-primary">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="fa fa-picture-o"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Status Updated</h2>
												</div>
												<!-- /Heading -->
										
												<!-- Body -->
												<div class="panel-body">
													<div class="shadow bordered">
														<div class="overlay-container">
															<img src="'.$getImgSrc.'" alt="">
															<a href="'.$getImgSrc.'" class="overlay-link popup-img">
																<i class="fa fa-plus"></i>
															</a>
														</div>
													</div>
													<!--<img class="img-responsive img-rounded" src="'.$getImgSrc.'" />-->
												</div>									
												<!-- /Body -->	
												<div class="panel-footer">
													<small>'.$getRefStatusShare->displayDate.' ('.$date.')</small>
												</div>	
											</article>';
										break;
										case 'u_shared_text';
											$getRefStatusShare = getRefStatusShare($value['ref_id'], $value['u_id']);
											$date = date_create($getRefStatusShare->us_date);
											$date = date_format($date, 'm-d-Y');											
											$view .= '<article class="panel panel-default">						
												<!-- Icon -->
												<div class="panel-heading icon">
													<i class="fa fa-pencil"></i>
												</div>
												<!-- /Icon -->
										
												<!-- Heading -->
												<div class="panel-heading">
													<h2 class="panel-title">Status Updated</h2>
												</div>
												<!-- /Heading -->
										
												<!-- Body -->
												<div class="panel-body">
													'.$getRefStatusShare->us_text.'
												</div>
												<!-- /Body -->
												<div class="panel-footer">
													<small>'.$getRefStatusShare->displayDate.' ('.$date.')</small>
												</div>
											</article>';											
										break;
									
									}
								}
								echo $view;
							?>

							<!-- Separator 
							<div class="separator text-muted">
								<time>26. 3. 2015</time>
							</div>
							 /Separator -->
							
						</div>
						<!-- /Timeline -->
					</div>
				</div>
				
				

				

			</div>
			</section>
			
		</div>
			
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
		
		<!-- Google Maps javascript -->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;signed_in=true"></script>
		<script type="text/javascript" src="js/google.map.config.js"></script>
		
		<script>			
			var myLatlng = new google.maps.LatLng(<?php echo $address->latitude.','.$address->longitude; ?>);
		</script>

	</body>
</html>