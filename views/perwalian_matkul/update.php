

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	$id = $_GET['id'];
	if(isset($_POST['submit'])){
		dadan_perwalian_matkul::updateData($_POST,$id);
	}

	$value = dadan_perwalian_matkul::getValueUpdate($id);

?>



<!--=====================================
=            End Logic :3            =
======================================-->



<?php
	include('_form.php');
?>
