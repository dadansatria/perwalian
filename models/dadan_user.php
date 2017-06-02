<?php

    require_once 'koneksi.php';

    class dadan_user extends koneksi
    {

        public $db; //Menyimpan Koneksi database
        public $error; //Menyimpan Error Message

        // Contructor untuk class User, membutuhkan satu parameter yaitu koneksi ke databse
        function __construct()
        {
            // Mulai session
        }

        // Registrasi user baru
        public function register($nama, $username, $password)
        {
            try
            {
                // buat hash dari password yang dimasukkan
                $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

                //Masukkan user baru ke database
                $query = $db->prepare("INSERT INTO tbLogin(nama, username, password) VALUES(:nama, :username, :pass)");
                $query->bindParam(":nama", $nama);
                $query->bindParam(":username", $username);
                $query->bindParam(":pass", $hashPasswd);
                $query->execute();

                return true;
            }catch(PDOException $e){
                // Jika terjadi error
                if($e->errorInfo[0] == 23000){
                    //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                    //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                    $this->error = "username sudah digunakan!";
                    return false;
                }else{
                    echo $e->getMessage();
                    return false;
                }
            }
        }

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
                        $_SESSION['user_session'] = $data['id'];
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
        public function isLogin(){
            // Apakah user_session sudah ada di session
            if(isset($_SESSION['user_session']))
            {
                return true;
            }
        }

        // Ambil data user yang sudah login
        public function getUser(){
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
        public function logout(){
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
    }

?>
