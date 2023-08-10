<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function inscreverse() {
		$this->view->erroCadastro = false;

		$this->render('inscreverse');
	}

	public function registrar() {

		//receber dados do formulario
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);

		//verificar se o registro vai ser inserido ou não no db
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {

			//quantidade de elementos contida dentro do array
			$usuario->salvar();
			$this->render('cadastro');

		} else {

			$this->view->erroCadastro = true;

			$this->render('inscreverse');
		}

		

		//sucesso


		//erro
	}

}


?>