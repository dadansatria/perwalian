<?php 

require_once 'koneksi.php';
require_once 'dadan_jurusan.php';

/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/

class dadan_dadan_perwalian_matkul extends koneksi
{

	function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM dadan_perwalian_matkul");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM dadan_perwalian_matkul WHERE id=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('dadan_perwalian_matkul/index');
	    } else{
	    	print "gagal";
	    }

	}

	function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM dadan_perwalian_matkul WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM dadan_perwalian_matkul WHERE $criteria");
	    $query->execute();
	    $data = $query->fetch();

	    return $data;
	}

	function createData($entitas)
	{
		$db = parent::getKoneksi();

		//hapus array terkahir (karena value nya dari submit)
    	array_pop($entitas);

		$field=null;
		$field_value = null;
		foreach ($entitas as $key => $value) {
			$field .= $key.",";
			$field_value .= "'".$value."',"; 
		}

		//hapus koma terakhir
		$field =  preg_replace('/'. preg_quote(',', '/') . '$/', '', $field);
		$field_value =  preg_replace('/'. preg_quote(',', '/') . '$/', '', $field_value);

		$query = $db->prepare("INSERT INTO dadan_perwalian_matkul ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('dadan_perwalian_matkul/index');
		}
	}

	function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM dadan_perwalian_matkul WHERE id = :id");
		$query->bindParam(':id',$id);
		if(!$query->execute()){
			return "Err!  ID Tidak Ditemukan !";
		} else{
			$data = $query->fetch();
			return $data;
		}
	}

	function updateData($entitas,$id)
	{
		$db = parent::getKoneksi();

		array_pop($entitas);

		$set_query=null;
		foreach ($entitas as $key => $value) {
			$set_query .= $key."='".$value."',";
		}
		//hapus koma terakhir
		$set_query =  preg_replace('/'. preg_quote(',', '/') . '$/', '', $set_query);



		$query = $db->prepare("UPDATE dadan_perwalian_matkul SET $set_query WHERE id=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} else{
			dadan_components::redirect('dadan_perwalian_matkul/index');
		}
	}

	function relasi($tabel,$attribut,$id)
	{
		$model = $tabel::find('id = '.$id);
		if($model !==null){
			return $model[$attribut];
		}

	}


}


