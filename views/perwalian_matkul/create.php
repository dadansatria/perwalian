

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	if(isset($_POST['submit'])){
		dadan_perwalian_matkul::createData($_POST);
	}

	$value = null;

?>

<!--=====================================
=            End Logic :3            =
======================================-->

<?php
	include('_form.php');
?>
