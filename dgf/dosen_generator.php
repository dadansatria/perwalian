<?php
$myfile = fopen("../models/dadan_dosen.php", "w") or die("Unable to open file!");

$db = '$db';
$data = '$data';
$id = '$id';
$criteria = '$criteria';
$key = '$key';
$field = '$field';
$field_value = '$field_value';
$entitas = '$entitas';
$value = '$value';
$set_query = '$set_query';
$query = '$query';


$txt = 


"

<?php 

include('koneksi.php');

/**

Dadan Satria Nugraha
Dadann Framework :3

/*lore*/

* 
*/
class dadan_dosen extends koneksi
{

	
	function __construct()
	{
		# code...
	}

	function findAll($criteria=null)
	{
		".$db." = parent::getKoneksi();
	    ".$query." = ".$db."->prepare(\"SELECT * FROM dosen\");
	    ".$query."->execute();
	    ".$data." = ".$query."->fetchAll();

	    return ".$data.";
	}

	function delete(".$id.")
	{
		".$db." = parent::getKoneksi();
	    ".$query." = ".$db."->prepare(\"DELETE FROM dosen WHERE npm=:id\");
	    ".$query."->bindParam(':id',".$id.");
	    if(".$query."->execute()){
	    	dadan_components::redirect('dosen/index');
	    } else{
	    	print \"gagal\";
	    }

	}

	function findAllByAttributes(".$criteria.")
	{
		".$db." = parent::getKoneksi();
	    ".$query." = ".$db."->prepare(\"SELECT * FROM dosen WHERE ".$criteria."\");
	    ".$query."->execute();
	    ".$data." = ".$query."->fetchAll();

	    return ".$data.";
	}

	function find(".$criteria.")
	{
		".$db." = parent::getKoneksi();
	    ".$query." = ".$db."->prepare(\"SELECT * FROM dosen WHERE ".$criteria."\");
	    ".$query."->execute();
	    ".$data." = ".$query."->fetch();

	    return ".$data.";
	}

	function createData(".$entitas.")
	{
		".$db." = parent::getKoneksi();

		//hapus array terkahir (karena value nya dari submit)
    	array_pop(".$entitas.");

		".$field."=null;
		".$field_value." = null;
		foreach (".$entitas." as ".$key." => ".$value.") {
			".$field." .= ".$key.".\",\";
			".$field_value." .= \"'\".".$value.".\"',\"; 
		}

		//hapus koma terakhir
		".$field." =  preg_replace('/'. preg_quote(',', '/') . '$/', '', ".$field.");
		".$field_value." =  preg_replace('/'. preg_quote(',', '/') . '$/', '', ".$field_value.");

		".$query." = ".$db."->prepare(\"INSERT INTO dosen (".$field.") VALUES (".$field_value.")\");

		if(".$query."->execute()){
			dadan_components::redirect('dosen/index');
		}
	}

	function getValueUpdate(".$id.")
	{
		".$db." = parent::getKoneksi();

		".$query." = ".$db."->prepare(\"SELECT * FROM dosen WHERE npm = :id\");
		".$query."->bindParam(':id',".$id.");
		if(!".$query."->execute()){
			return \"Err!  ID Tidak Ditemukan !\";
		} else{
			".$data." = ".$query."->fetch();
			return ".$data.";
		}
	}

	function updateData(".$entitas.",".$id.")
	{
		".$db." = parent::getKoneksi();

		array_pop(".$entitas.");

		".$set_query."=null;
		foreach (".$entitas." as ".$key." => ".$value.") {
			".$set_query." .= ".$key.".\"='\".".$value.".\"',\";
		}
		//hapus koma terakhir
		".$set_query." =  preg_replace('/'. preg_quote(',', '/') . '$/', '', ".$set_query.");



		".$query." = ".$db."->prepare(\"UPDATE dosen SET ".$set_query." WHERE npm=:id\");
		".$query."->bindParam(':id',".$id.");

		if(!".$query."->execute()){
			return \"Err!  Data Tidak Tersimpan !\";
		} else{
			echo \"
				<script type='text/javascript'>
					window.location = '\".dadan_components::baseUrl().\"';
				</script>
			\";
		}
	}


}

 ?>


";



fwrite($myfile, $txt);
?>
