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

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/fc-3.3.1/fh-3.1.7/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/fc-3.3.1/fh-3.1.7/datatables.min.js"></script>


	<link href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.css">


	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/uploaders/fileinput.min.js"></script>


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
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/blog_single.js"></script> -->
	



<style type="text/css">
	
	.lbl-basic{
		margin-top: 1%;
	}
	.lbl-basic-2{
		margin-top: 3%;
	}
</style>
</head>

<body class="layout-boxed">

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header" style="display: flex;justify-content: center;vertical-align: middle;">
								
			<a class="navbar-brand" href="#" style="align-self: center;color: white"><h6><?= $session['nama'] ?></h6></a>

			
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
<!-- 
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
				</li> -->
			</ul>

			
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
								<a href="#"><img src="<?php echo base_url() ?>assets/files/image/logo.png" class="img-circle img-responsive" style="margin-top: 10%" alt=""></a>
								<!-- <a href="<?=base_url() ?>login/log_out" class="btn-sm btn-default">Log Out</a> -->
							</div>

							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li><a href="<?=base_url() ?>dashboard"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
								<!-- <li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li> -->
								<!-- <li><a href="#"><i class="icon-comment-discussion"></i> <span><span class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li> -->
								<!-- <li class="divider"></li> -->
								<li><a href="<?=base_url().'akun/get/'.$this->session->userdata('user')['id_user']; ?>"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
								<li><a href="<?=base_url() ?>login/log_out"><i class="icon-switch2"></i> <span>Logout</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<?php foreach ($parent as $kp => $vp): ?>
									<?php $notif =''; if ($vp->menu == 'SSPD') {
										$notif = '<span id="sspd_notif" class="badge bg-teal-400 pull-right">'.$sspd_notif.'</span>';
									} ?>

									<li><a href="<?=base_url(). $vp->controller ?>"><i class="<?= $vp->icon ?>"></i> <span><?= $notif.$vp->menu ?></span></a>
										<?php foreach ($child as $kc => $vc): ?> 
											<?php if ($vc->parent == $vp->id_menu): ?>
												<ul>
													<li><a href="<?=base_url(). $vc->controller ?>"><?=$vc->menu ?></a></li>
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
						<!-- &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a> -->
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

<script src="<?php echo base_url() ?>assets/scripts/jquery.growl.js"></script>

</html>


<script type="text/javascript">
	$( document ).ready(function() {
        
    });

    function get_notif_sspd() {
    	$.ajax({
            url : '<?php  ?>',
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_kelurahan').html(response);
            var text=$("#select_kelurahan option:selected").text();
            $("#nm_kelurahan").val(text);
        });
    }
</script>