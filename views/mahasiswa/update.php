

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	$id = $_GET['npm'];
	if(isset($_POST['submit'])){
		dadan_mahasiswa::updateData($_POST,$id);
	}

	$value = dadan_mahasiswa::getValueUpdate($id);

?>



<!--=====================================
=            End Logic :3            =
======================================-->



<?php
	include('_form.php');
?>
