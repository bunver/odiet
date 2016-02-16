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
				<ul class="nav navbar-nav ">
					<!-- mega-menu start -->
					<li <?php if($page == 'home'){echo 'class="active"'; } ?>>
						<a class="dropdown-toggle" href="home.php">Home</a>
					</li>
					<!-- mega-menu end -->
					<!-- mega-menu start -->
					<li <?php if($page == 'profile'){echo 'class="active"'; } ?>>
						<a class="dropdown-toggle"  href="profile.php">Profile</a>														
					</li>
					<!-- mega-menu end -->
					<!-- mega-menu start -->
					<li <?php if($page == 'account'){echo 'class="active"'; } ?>>
						<div class="testimonial-image" style="width: 50px; margin: 0 auto; margin-top: 12px;">
							<img class="img-circle" style="" src="<?php echo getImgSrc($_SESSION['user']->u_profile_photo, 'profile'); ?>" />
						</div>													
					</li>
					<!-- mega-menu end -->
					<!-- mega-menu start -->													
					<li class="dropdown">
						<!-- header dropdown buttons 
						<div class="header-dropdown-buttons">
							<div class="btn-group">
								<button type="button" class="btn">
									<img class="img-circle" style="padding: 1px; border:1px solid #fff;;" src="<?php echo getImgSrc($_SESSION['user']->u_profile_photo, 'profile'); ?>" />
								</button>
																
							</div>												
						</div>
						<!-- header dropdown buttons end-->
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user']->u_firstname.' '.$_SESSION['user']->u_lastname;   ?></a>
						<ul class="dropdown-menu">
							<li ><a href="account.php?redirect=edit-my-info">Edit My Info</a></li>
							<li ><a href="account.php?redirect=change-password">Change Password</a></li>
							<li ><a href="account.php?redirect=change-profile-photo">Change Profile Photo</a></li>
							<li ><a href="account.php?redirect=edit-settings">Edit Settings</a></li>
						</ul>						
					</li>
					<!-- mega-menu end -->
				</ul>
				<!-- main-menu end -->
				<!-- header dropdown buttons -->
				<div class="header-dropdown-buttons hidden-xs ">
					<button type="button" id="logout-bt" class="btn btn-animated btn-danger pull-right" data-dismiss="modal"> 
							<i class="fa fa-sign-out"></i>
							<span id="logout-span"> Logout </span>										
						</button>
					
				</div>
				<!-- header dropdown buttons end-->
				
				
			</div>

		</div>
	</nav>
	<!-- navbar end -->