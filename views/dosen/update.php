

<!--=====================================
=            Logic Here :3            =
======================================-->
<?php

	$id = $_GET['id'];
	if(isset($_POST['submit'])){
		dadan_dosen::updateData($_POST,$id);
	}

	$value = dadan_dosen::getValueUpdate($id);

?>



<!--=====================================
=            End Logic :3            =
======================================-->



<?php
	include('_form.php');
?>
