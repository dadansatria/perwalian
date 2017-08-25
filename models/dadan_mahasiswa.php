<?php 

require_once 'koneksi.php';
require_once 'vendors/PHPExcel/IOFactory.php';

/**

Dadan Satria Nugraha
Dadann Framework :3
* 
*/
class dadan_mahasiswa extends koneksi
{

	
	public function __construct()
	{
		# code...
	}

	public function findAll($criteria=null)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM mahasiswa");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	public function delete($id)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("DELETE FROM mahasiswa WHERE npm=:id");
	    $query->bindParam(':id',$id);
	    if($query->execute()){
	    	dadan_components::redirect('mahasiswa/index');
	    } else{
	    	print "gagal";
	    }

	}

	public function findAllByAttributes($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM mahasiswa WHERE $criteria");
	    $query->execute();
	    $data = $query->fetchAll();

	    return $data;
	}

	public function find($criteria)
	{
		$db = parent::getKoneksi();
	    $query = $db->prepare("SELECT * FROM mahasiswa WHERE $criteria");
	    $query->execute();
	    $data = $query->fetch();

	    return $data;
	}

	public function createData($entitas)
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

		$query = $db->prepare("INSERT INTO mahasiswa ($field) VALUES ($field_value)");

		if($query->execute()){
			dadan_components::redirect('mahasiswa/index');
		}
	}

	public function getValueUpdate($id)
	{
		$db = parent::getKoneksi();

		$query = $db->prepare("SELECT * FROM mahasiswa WHERE npm = :id");
		$query->bindParam(':id',$id);
		if(!$query->execute()){
			return "Err!  ID Tidak Ditemukan !";
		} else{
			$data = $query->fetch();
			return $data;
		}
	}

	public function updateData($entitas,$id)
	{
		$db = parent::getKoneksi();

		array_pop($entitas);

		$set_query=null;
		foreach ($entitas as $key => $value) {
			$set_query .= $key."='".$value."',";
		}
		//hapus koma terakhir
		$set_query =  preg_replace('/'. preg_quote(',', '/') . '$/', '', $set_query);



		$query = $db->prepare("UPDATE mahasiswa SET $set_query WHERE npm=:id");
		$query->bindParam(':id',$id);

		if(!$query->execute()){
			return "Err!  Data Tidak Tersimpan !";
		} else{
			dadan_components::redirect('mahasiswa/index');
		}
	}


    public function import()
    {
    	$db = parent::getKoneksi();
    	$inputFileName = 'import/mahasiswa.xlsx';
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
            $npm = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
            $nama = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
            $alamat = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getValue();
            $hp = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
            $jurusan = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();
            $angkatan = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getValue();

            if($jurusan == 'IF') $jurusan = 1;
            if($jurusan == 'SP') $jurusan = 2;
            if($jurusan == 'AR') $jurusan = 3;
            if($jurusan == 'EL') $jurusan = 4;

            $query = $db->prepare("INSERT INTO mahasiswa (npm,nama,alamat,hp,id_jurusan,angkatan) VALUES ('$npm','$nama','$alamat','$hp','$jurusan','$angkatan')");
            if(!$query->execute()){
            	print_r($query->getErrors());
            } 
        }

        return dadan_components::redirect('mahasiswa/index');

    }


}

 ?>
