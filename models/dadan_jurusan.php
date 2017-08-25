<?php 

require_once 'koneksi.php';

/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/

class dadan_jurusan extends koneksi
{

	function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM jurusan");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM jurusan WHERE id=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('jurusan/index');
	    } else{
	    	print "gagal";
	    }
	}

	function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM jurusan WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM jurusan WHERE $criteria");
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

		$query = $db->prepare("INSERT INTO jurusan ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('jurusan/index');
		}
	}

	function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM jurusan WHERE id = :id");
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



		$query = $db->prepare("UPDATE jurusan SET $set_query WHERE id=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} else{
			dadan_components::redirect('jurusan/index');
		}
	}

	function getListSemester()
	{
		$list = [
			['id' => 1, 'semester' => 1],
			['id' => 2, 'semester' => 2],
			['id' => 3, 'semester' => 3],
			['id' => 4, 'semester' => 4],
			['id' => 5, 'semester' => 5],
			['id' => 6, 'semester' => 6],
			['id' => 7, 'semester' => 7],
			['id' => 8, 'semester' => 8],
			['id' => 9, 'semester' => 9],
			['id' => 10, 'semester' => 10],
			['id' => 11, 'semester' => 11],
			['id' => 12, 'semester' => 12],
		];
		return $list;
	}


}

 ?>
