<?php
    class Conexao {

        private $host = 'localhost'; //local
        private $db_name = 'php_com_pdo'; //nome
        private $user = 'root'; //usuario
        private $pass = ''; //senha

        public function conectar() {

            try {
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->db_name", //DSN
                    "$this->user", //user
                    "$this->pass", //pass
                ); 
                    
                return $conexao;

            } catch(PDOException $e) {
                echo '<p>'.$e->getMessage().'</p>';
            }


        }
    }
?> 