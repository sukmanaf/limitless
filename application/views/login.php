<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery.min.js"></script>
	<!-- Global stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/jquery.growl.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/notify.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/alertify.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script src="<?php echo base_url() ?>assets/scripts/jquery.growl.js"></script>

<script type="text/javascript">alertify.set('notifier','position', 'top-right');</script>

<script src="<?php echo base_url() ?>assets/scripts/jquery.growl.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	

<script src="<?php echo base_url() ?>assets/scripts/jquery.growl.js"></script>

<script type="text/javascript">alertify.set('notifier','position', 'top-right');</script>
</head>

<body class="login-container">



	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
        				<form action="#" id="postForm" class="form-basic" enctype="multipart/form-data" method="post">

						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="user" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" name="pass" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
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
</html>
<script type="text/javascript">
	  $(document).ready(function() {

   


   
$("#postForm").submit(function(event){
    // $(".btn").css('display','none');
        event.preventDefault(); //prevent default action 
        var post_url = '<?php echo base_url() ?>login/logins'; //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = new FormData(this); //Encode form elements for submission
        
      
        
        $.ajax({
            url : post_url,
            type: 'POST',
            data : form_data,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
        	console.log(response);
            if (response == 1){
            $.growl.notice({ message: "Login Berhasil!" });
              
              setTimeout(function () {
                window.location.replace('<?php echo site_url('niks') ?>')
                
            }, 2000);
               
            }else{
                $.growl.warning({ message: "Username atau Password Salah!" });
                $(".btn").css('display','inline');

            }
        });

        
    });
});
</script>