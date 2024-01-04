<?php

    class Database{
        private $hostname = "31.170.160.103";
        private $database = "u284778729_internet";
        private $username = "u284778729_iot";
        private $password = "Ydgjwaq9&YxZ*%m";
        private $charset = "utf8";

        function conectar()
        {
            try{
            $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . ";
            charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false 
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
        //echo 'conexion exitosa';
            return $pdo;
        }catch(PDOException $e){
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
        }
    }
?>