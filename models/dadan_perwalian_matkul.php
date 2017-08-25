<?php 

require_once 'koneksi.php';
require_once 'dadan_jurusan.php';

/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/

class dadan_perwalian_matkul extends koneksi
{

	const BELUM_DINILAI = 2;
	const DINILAI = 1;

	function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian_matkul");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM perwalian_matkul WHERE id=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('perwalian_matkul/index');
	    } else{
	    	print "gagal";
	    }

	}

	function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian_matkul WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian_matkul WHERE $criteria");
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

		$query = $db->prepare("INSERT INTO perwalian_matkul ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('perwalian_matkul/index');
		}
	}

	function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM perwalian_matkul WHERE id = :id");
		$query->bindParam(':id',$id);
		if(!$query->execute()){
			return "Err!  ID Tidak Ditemukan !";
		} else{
			$data = $query->fetch();
			return $data;
		}
	}

	function updateData($entitas,$id,$redirect=null)
	{
		$db = parent::getKoneksi();

		array_pop($entitas);

		$set_query=null;
		foreach ($entitas as $key => $value) {
			$set_query .= $key."='".$value."',";
		}
		//hapus koma terakhir
		$set_query =  preg_replace('/'. preg_quote(',', '/') . '$/', '', $set_query);



		$query = $db->prepare("UPDATE perwalian_matkul SET $set_query WHERE id=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} elseif($redirect == null){
			dadan_components::redirect('perwalian_matkul/index');
		} else{
			dadan_components::redirect($redirect);
		}
	}

	public function relasi($tabel,$attribut,$id)
	{
		$model = $tabel::find('id = '.$id);
		if($model !==null){
			return $model[$attribut];
		}

	}

	public static function isDiambil($id_perwalian,$id_matkul)
	{
		$model = self::find("id_perwalian = '$id_perwalian' AND id_matkul = '$id_matkul'");
		if($model['id'] !==null){
			return true;
		} else{
			return false;
		}
	}

/*		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM perwalian_matkul WHERE $criteria");
	    $query->execute();
	    $data = $query->fetch();

	    return $data;
*/

	public static function getDiambilModel($semester,$id_matkul)
	{
		$db = parent::getKoneksi();
		$npm = $_SESSION['id_model'];
		$query = $db->prepare("SELECT perwalian.*, perwalian_matkul.*, perwalian_matkul.status as perwalian_status FROM perwalian_matkul perwalian_matkul, perwalian perwalian WHERE perwalian_matkul.id_perwalian = perwalian.id AND perwalian.npm = $npm AND perwalian.semester = $semester AND perwalian_matkul.id_matkul = $id_matkul");

		$query->execute();
		return $query->fetch();

	}

	public static function isDiambilByMahasiswa($semester,$id_matkul)
	{
		$data = self::getDiambilModel($semester,$id_matkul);
		if($data['id'] !==null){
			return true;
		} else{
			return false;
		}
	}

	public static function isDibayar($semester,$id_matkul)
	{
		$data = self::getDiambilModel($semester,$id_matkul);
		if($data['perwalian_status'] <= dadan_perwalian::DIBAYAR){
			return true;
		} else{
			return false;
		}
	}

	public static function isDiterima($semester,$id_matkul)
	{
		$data = self::getDiambilModel($semester,$id_matkul);
		if($data['perwalian_status'] <= dadan_perwalian::DITERIMA){
			return true;
		} elseif($data['perwalian_status'] <= dadan_perwalian::DITOLAK){
			return false;
		}
	}

	public static function isDinilai($semester,$id_matkul)
	{
		$data = self::getDiambilModel($semester,$id_matkul);
		if(self::isDiambilByMahasiswa($semester,$id_matkul)){		
			if($data['perwalian_status'] == self::DINILAI){
				return true;
			} else{
				return false;
			}
		} else{
			return false;
		}
	}

	public static function getNilai($semester,$id_matkul)
	{
		$data = self::getDiambilModel($semester,$id_matkul);
		if($data['nilai'] !== null){
			switch ($data['nilai']) {
				case 4:
					$nilai = 'A';
					break;
				case 3:
					$nilai = 'B';
					break;
				case 2:
					$nilai = 'C';
					break;
				case 1:
					$nilai = 'D';
					break;
				case 0:
					$nilai = 'E';
					break;
			}
			return $nilai;
		} else{
			return null;
		}
	}

	public static function getListNilai()
	{
		$list = [
			['key' => 4, 'value' => 'A'],
			['key' => 3, 'value' => 'B'],
			['key' => 2, 'value' => 'C'],
			['key' => 1, 'value' => 'D'],
			['key' => 0, 'value' => 'F'],
		];
		return $list;
	}

	public static function findAllMakul($semester)
	{
		$db = parent::getKoneksi();
		$npm = $_SESSION['id_model'];
		$query = $db->prepare("SELECT perwalian.*, perwalian_matkul.*, perwalian_matkul.status as perwalian_status FROM perwalian_matkul perwalian_matkul, perwalian perwalian WHERE perwalian_matkul.id_perwalian = perwalian.id AND perwalian.npm = $npm AND perwalian.semester = $semester");

		$query->execute();
		return $query->fetchAll();

	}


}


