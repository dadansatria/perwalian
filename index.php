<?php 



if(isset($_GET['model']) and isset($_GET['action']) ){
	$root = $_GET['model'].'/'.$_GET['action'].'.php';

	session_start();

	$model = $_GET['model'];
	$action = $_GET['action'];

	//library dadan framework :3

	require_once 'dadanframework/dadan_components.php';
	require_once 'dadanframework/dadan_widgets.php';
	require_once 'vendors/mpdf/mpdf.php';

    
	/*modelnya :3*/
    require_once 'models/dadan_user.php';

    if($action == 'pdf'){
		require_once 'views/'.$model.'/pdf.php';
    } else{
    	require_once 'models/dadan_'.$model.'.php';
    }

    $user = new dadan_user();

	/*views dan layout*/
	if($user->isLogin()){
		require_once 'layouts/header.php';
		require_once 'views/'.$root;
		require_once 'layouts/footer.php';
	} else {
		header('Location: login.php');
	}

}
else{
	header('Location: login.php');
}



?>