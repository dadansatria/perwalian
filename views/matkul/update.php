

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	$id = $_GET['id'];
	if(isset($_POST['submit'])){
		dadan_matkul::updateData($_POST,$id);
	}

	$value = dadan_matkul::getValueUpdate($id);

?>



<!--=====================================
=            End Logic :3            =
======================================-->



<?php
	include('_form.php');
?>
