<?php 

require_once 'koneksi.php';
require_once 'dadan_dosen.php';


/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/

class dadan_perwalian extends koneksi
{

	
	const DIAMBIL = 3;
	const DITERIMA = 2;
	const DINILAI = 1;
	const DITOLAK = 4;

	function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM perwalian WHERE id=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('perwalian/index');
	    } else{
	    	print "gagal";
	    }

	}

	function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian WHERE $criteria");
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

		$query = $db->prepare("INSERT INTO perwalian ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('perwalian/index');
		}
	}

	function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM perwalian WHERE id = :id");
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



		$query = $db->prepare("UPDATE perwalian SET $set_query WHERE id=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} else{
			dadan_components::redirect('perwalian/index');
		}
	}

	function relasi($tabel,$attribut,$id)
	{
		if($tabel == 'dadan_mahasiswa'){
			$properti = 'npm';
		} else{
			$properti = 'id';
		}
		$model = $tabel::find($properti.' = '.$id);
		if($model !==null){
			return $model[$attribut];
		}

	}

	public function getUrlPerwalian($semester)
	{
		$npm = $_SESSION['id_model'];
		$perwalian = self::find("semester='$semester' AND npm=$npm");
		if($perwalian['id'] !==null){
			return dadan_components::getUrl('perwalian/view',['id'=>$perwalian['id']]);
		} else{
			return dadan_components::getUrl('perwalian/create',['semester' => $semester]);
		}
	}

	public function ubahStatus($id_perwalian, $status)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("UPDATE perwalian SET status = $status WHERE id=:id");
		$query->bindParam(':id',$id_perwalian);
		return $query->execute();
	}


}


