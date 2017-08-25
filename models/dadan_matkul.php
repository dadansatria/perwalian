<?php 

require_once 'koneksi.php';
require_once 'dadan_jurusan.php';
require_once 'dadan_user.php';

/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/

class dadan_matkul extends koneksi
{

	function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM matkul");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM matkul WHERE id=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('matkul/index');
	    } else{
	    	print "gagal";
	    }

	}

	function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM matkul WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM matkul WHERE $criteria");
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

		$query = $db->prepare("INSERT INTO matkul ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('matkul/index');
		}
	}

	function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM matkul WHERE id = :id");
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



		$query = $db->prepare("UPDATE matkul SET $set_query WHERE id=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} else{
			dadan_components::redirect('matkul/index');
		}
	}

	function relasi($tabel,$attribut,$id)
	{
		$model = $tabel::find('id = '.$id);
		if($model !==null){
			return $model[$attribut];
		}
	}

	public static function getSemesterSekarang()
	{
		$angkatan = dadan_user::getAngkatan();
		$sekarang = date('Y-m-d');
		$masuk = date('Y').'-06-01';
		$akhir_semester = (date('Y')+1).'-01-01';
		$tahun = date('Y');
		$semester_sekarang = ($tahun - $angkatan) *2;
		if($sekarang > $masuk AND $sekarang < $akhir_semester){
			$semester_sekarang = $semester_sekarang+1;
		}

		return $semester_sekarang;
	}

	public function getClassAktif($semester,$value)
	{
		if($semester == self::getSemesterSekarang()){
			return "class='success'";
		}
		elseif($semester < self::getSemesterSekarang() AND (!dadan_perwalian_matkul::isDiambilByMahasiswa($semester,$value))) {
			return "class='danger'";	
		}
		 else{
			return "bgcolor='#ccc'";
		}
	}

    public function import()
    {
    	$db = parent::getKoneksi();
    	$inputFileName = 'import/matkul.xlsx';
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
            $e->getMessage());
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();

        for($i = 2; $i <= $highestRow ;$i++)
        {
            $kode = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
            $id_jurusan = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
            $semester = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getValue();
            $nama = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
            $sks = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();

            if($id_jurusan == 'IF') $id_jurusan = 1;
            if($id_jurusan == 'SP') $id_jurusan = 2;
            if($id_jurusan == 'AR') $id_jurusan = 3;
            if($id_jurusan == 'EL') $id_jurusan = 4;

            $query = $db->prepare("INSERT INTO matkul (kode,id_jurusan,semester,nama,sks) VALUES ('$kode','$id_jurusan','$semester','$nama','$sks')");
            if(!$query->execute()){
            	print_r($query->getErrors());
            } 
        }
        return dadan_components::redirect('matkul/index');

    }



}


