<?php  include "includes/header.php"; ?>

<?php
    if(isLoggedIn()) redirect("/admin");
    if(isMethod('post')) {
        if( isset($_POST['username']) && isset($_POST['password']) ) {
            userlogin($_POST['username'],$_POST['password']);
        } else {
            redirect('/login');
        }
    }

?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container mt-4">

	<div class="row text-center">
		<div class="col-lg-4 col-md-6 mx-auto">
			<h3><i class="fa fa-user fa-4x"></i></h3>
				<h2 class="text-center">Login</h2>
				<form id="login-form" role="form" autocomplete="off" class="form" method="post">

					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input name="username" type="text" class="form-control" placeholder="Enter Username">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-lock"></i></span>
							</div>
							<input name="password" type="password" class="form-control" placeholder="Enter Password">
						</div>
					</div>

					<div class="form-group">

						<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
					</div>
				</form>
		</div>
	</div>	<!-- /.row -->

</div> <!-- /.container -->

<?php include "includes/footer.php";?>
