<?php 



if(isset($_GET['model']) and isset($_GET['action']) ){
	$root = $_GET['model'].'/'.$_GET['action'].'.php';

	session_start();

	$model = $_GET['model'];
	$action = $_GET['action'];

	//library dadan framework :3

	include('dadanframework/dadan_components.php');
	include('dadanframework/dadan_widgets.php');

    


	/*modelnya :3*/
    include('models/dadan_user.php');
    include('models/dadan_'.$model.'.php');
    $user = new dadan_user();

	/*views dan layout*/
	if($user->isLogin()){
		include('layouts/header.php');
		include('views/'.$root);
		include('layouts/footer.php');
	} else {
		header('Location: login.php');
	}

}
else{
	header('Location: login.php');
}
?>