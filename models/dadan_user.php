
<?php

/* @author : Dadan Satria */

require_once 'koneksi.php';
require_once 'models/dadan_dosen.php';
require_once 'models/dadan_mahasiswa.php';
class dadan_user extends koneksi
{

    //Login user
    public function login($username, $password)
    {
        $db = parent::getKoneksi();
        try
        {
            // Ambil data dari database
            $query = $db->prepare("SELECT * FROM user WHERE username = :username");
            $query->bindParam(":username", $username);
            $query->execute();
            $data = $query->fetch();

            // Jika jumlah baris > 0
            if($query->rowCount() > 0){
                // jika password yang dimasukkan sesuai dengan yg ada di database
                if(password_verify($password, $data['password'])){
                    session_start();
                    //simpan informasi user login
                    $_SESSION['user_session'] = $data['id'];
                    $_SESSION['model'] = $data['model'];
                    $_SESSION['id_model'] = $data['id_model'];
                    return true;
                }else{
                    $this->error = "username atau Password Salah1";
                    return false;
                }
            }else{
                $this->error = "username atau Password Salah2";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Cek apakah user sudah login
    public function isLogin()
    {
        // Apakah user_session sudah ada di session
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    // Ambil data user yang sudah login
    public function getUser()
    {
        // Cek apakah sudah login
        if(!$this->isLoggedIn()){
            return false;
        }

        try {
            // Ambil data user dari database
            $query = $db->prepare("SELECT * FROM user WHERE id = :id");
            $query->bindParam(":id", $_SESSION['user_session']);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Logout user
    public function logout()
    {
        // Hapus session
        session_destroy();
        // Hapus user_session
        unset($_SESSION['user_session']);
        return true;
    }

    // Ambil error terakhir yg disimpan di variable error
    public function getLastError(){
        return $this->error;
    }

    public function isAdmin()
    {
        if($_SESSION['model'] == 'admin'){
            return true;
        } else{
            return false;
        }
    }

    public function isMahasiswa()
    {
        if($_SESSION['model'] == 'mahasiswa'){
            return true;
        } else{
            return false;
        }
    }

    public function isDosen()
    {
        if($_SESSION['model'] == 'dosen'){
            return true;
        } else{
            return false;
        }
    }

    public function getModel()
    {
        $id_model = $_SESSION['id_model'];
        $model = dadan_mahasiswa::find('npm = '.$id_model);
        return $model;
    }

    public function getIdJurusan()
    {
        $model = self::getModel();
        return $model['id_jurusan'];
    }

    public function getAngkatan()
    {
        $model = self::getModel();
        return $model['angkatan'];
    }

    public function getNamaMahasiswa()
    {
        $model = self::getModel();
        return $model['nama'];
    }

    public static function getDosenWali()
    {
        $model = self::getModel();
        $jurusan = dadan_jurusan::find('id = '.$model['id_jurusan']);
        return $jurusan['id'];
    }

}

?>
