<?php 
   if (!isset($_SESSION['user'])){
    redirect('login','refresh');
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery.min.js"></script>
	<link href="<?php echo base_url() ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/jquery.growl.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
	<!-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> -->

	<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css"> -->

	<link href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.css">


	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>

	<!-- /core JS files -->

	<!-- Theme JS files -->

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/ripple.min.js"></script>
	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/form_inputs.js"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/form_select2.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/picker_date.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/wizard_form.js"></script>


<style type="text/css">
	
	.lbl-basic{
		margin-top: 1%;
	}
</style>
</head>

<body class="layout-boxed">

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="<?php echo base_url() ?>assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-puzzle3"></i>
						<span class="visible-xs-inline-block position-right">Git updates</span>
						<span class="status-mark border-pink-300"></span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Git updates
							<ul class="icons-list">
								<li><a href="#"><i class="icon-sync"></i></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body width-350">
							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body">
									Drop the IE <a href="#">specific hacks</a> for temporal inputs
									<div class="media-annotation">4 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
								</div>
								
								<div class="media-body">
									Add full font overrides for popovers and tooltips
									<div class="media-annotation">36 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
									<div class="media-annotation">2 hours ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
									<div class="media-annotation">Dec 18, 18:36</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>
								
								<div class="media-body">
									Have Carousel ignore keyboard events
									<div class="media-annotation">Dec 12, 05:46</div>
								</div>
							</li>
						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>
			</ul>

			<div class="navbar-right">
				<p class="navbar-text">Morning, Victoria!</p>
				<p class="navbar-text"><span class="label bg-success">Online</span></p>
				
				<ul class="nav navbar-nav">				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Activity</span>
							<span class="status-mark border-pink-300"></span>
						</a>

						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Activity
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body width-350">
								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
									</div>

									<div class="media-body">
										<a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
										<div class="media-annotation">4 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-pink-400 btn-rounded btn-icon btn-xs"><i class="icon-paperplane"></i></a>
									</div>
									
									<div class="media-body">
										Special offers have been sent to subscribed users by <a href="#">Donna Gordon</a>
										<div class="media-annotation">36 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs"><i class="icon-plus3"></i></a>
									</div>
									
									<div class="media-body">
										<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch in <span class="text-semibold">Limitless</span> repository
										<div class="media-annotation">2 hours ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-purple-300 btn-rounded btn-icon btn-xs"><i class="icon-truck"></i></a>
									</div>
									
									<div class="media-body">
										Shipping cost to the Netherlands has been reduced, database updated
										<div class="media-annotation">Feb 8, 11:30</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs"><i class="icon-bubble8"></i></a>
									</div>
									
									<div class="media-body">
										New review received on <a href="#">Server side integration</a> services
										<div class="media-annotation">Feb 2, 10:20</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs"><i class="icon-spinner11"></i></a>
									</div>
									
									<div class="media-body">
										<strong>January, 2016</strong> - 1320 new users, 3284 orders, $49,390 revenue
										<div class="media-annotation">Feb 1, 05:46</div>
									</div>
								</li>
							</ul>
						</div>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bubble8"></i>
							<span class="visible-xs-inline-block position-right">Messages</span>
							<span class="status-mark border-pink-300"></span>
						</a>
						
						<div class="dropdown-menu dropdown-content width-350">
							<div class="dropdown-content-heading">
								Messages
								<ul class="icons-list">
									<li><a href="#"><i class="icon-compose"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body">
								<li class="media">
									<div class="media-left">
										<img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
										<span class="badge bg-danger-400 media-badge">5</span>
									</div>

									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">James Alexander</span>
											<span class="media-annotation pull-right">04:58</span>
										</a>

										<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
										<span class="badge bg-danger-400 media-badge">4</span>
									</div>

									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Margo Baker</span>
											<span class="media-annotation pull-right">12:16</span>
										</a>

										<span class="text-muted">That was something he was unable to do because...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Jeremy Victorino</span>
											<span class="media-annotation pull-right">22:48</span>
										</a>

										<span class="text-muted">But that would be extremely strained and suspicious...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Beatrix Diaz</span>
											<span class="media-annotation pull-right">Tue</span>
										</a>

										<span class="text-muted">What a strenuous career it is that I've chosen...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Richard Vango</span>
											<span class="media-annotation pull-right">Mon</span>
										</a>
										
										<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
									</div>
								</li>
							</ul>

							<div class="dropdown-content-footer">
								<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
							</div>
						</div>
					</li>					
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#"><img src="<?php echo base_url() ?>assets/images/placeholder.jpg" class="img-circle img-responsive" alt=""></a>
								<h6>Victoria Baker</h6>
								<span class="text-size-small">Santa Ana, CA</span>
							</div>

							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
								<li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>
								<li><a href="#"><i class="icon-comment-discussion"></i> <span><span class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
								<li><a href="#"><i class="icon-switch2"></i> <span>Logout</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<?php foreach ($parent as $kp => $vp): ?>

									<li><a href="<?= $vp->controller ?>"><i class="icon-home4"></i> <span><?= $vp->menu ?></span></a>
										<?php foreach ($child as $kc => $vc): ?> 
											<?php if ($vc->parent == $vp->id_menu): ?>
												<ul>
													<li><a href="<?= $vc->controller ?>"><?=$vc->menu ?></a></li>
												</ul>
											<?php endif ?>
										<?php endforeach ?>								
									</li>
								<?php endforeach ?>								
								<!-- Main -->
								
								<!-- /page kits -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">


				<div class="content">

					<!-- Basic datatable -->
					
					<?php echo $body ?>
					

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/notify.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/alertify.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script src="<?php echo base_url() ?>assets/scripts/jquery.growl.js"></script>

</html>
