

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	if(isset($_POST['submit'])){
		dadan_perwalian::createData($_POST);
	}

	$value = null;

?>

<!--=====================================
=            End Logic :3            =
======================================-->

<?php
	include('_form.php');
?>
