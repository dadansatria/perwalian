<?php
		// Lampirkan db dan User
		require_once('models/dadan_user.php');
		require_once('dadanframework/dadan_components.php');

		//Buat object user
		$user = new dadan_user();

		//Jika sudah login
		if($user->isLogin()){
				header("location: index.php"); //redirect ke index
		}

		//jika ada data yg dikirim
		if(isset($_POST['kirim'])){
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Proses login user
				if($user->login($email, $password)){

					dadan_components::redirect('mahasiswa/index');
				}else{
						// Jika login gagal, ambil pesan error
					$error = $user->getLastError();
				}
		}
 ?>
<?php if (isset($error)): ?>
  <div class="error">
      <?php echo $error ?>
  </div>
<?php endif; ?>

<div class="login-box">
	<div class="login-logo">
		<a href="../../index2.html"><b>Admin</b>LTE</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>

		<form method="post">
			<div class="form-group has-feedback">
				<input type="text" name="email" class="form-control" placeholder="Email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox"> Remember Me
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" name="kirim">login</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php session_start(); print_r($_SESSION);  ?>