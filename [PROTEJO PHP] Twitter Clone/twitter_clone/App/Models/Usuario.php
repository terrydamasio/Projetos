<?php 
    namespace App\Models;

    use MF\Model\Model;

    class Usuario extends Model {
        private $id;
        private $nome;
        private $email;
        private $senha;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        //salvar
        public function salvar() {
            $query = "insert into usuarios(nome, email, senha) values(:nome, :email, :senha)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha')); //md4() -> hash 32 caracteres 
            $stmt->execute();

            return $this;
        }

        //validar cadastro (caso o usuario deixe de preencher algum input)
        public function validarCadastro() {
            $valido = true;

            if(strlen($this->__get('nome')) < 4) {
                $valido = false;
            }

            if(strlen($this->__get('email')) < 3) {
                $valido = false;
            }

            if (!preg_match('/[A-Za-z]/', $this->__get('senha')) || !preg_match('/[0-9]/', $this->__get('senha')) || strlen($this->__get('senha')) < 5) {
                $valido = false;
            }
            
            return $valido;
        }
        
        //recuperar usuário por email
        public function getUsuarioPorEmail() {
            $query = "select nome, email from usuarios where email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindvalue(':email', $this->__get('email'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    
    
    }



?>