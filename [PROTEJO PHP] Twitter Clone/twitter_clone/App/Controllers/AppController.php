<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

    public function timeline() {

        $this->validaAutenticacao();

        //recuperação doos tweets
        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweet->__set('id_usuario', $_SESSION['id']);

        //variáveis de paginação 
		$total_registros_pagina = 10; //limit
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; //qual página
        $deslocamento = ($pagina - 1) * $total_registros_pagina; //offset

        //$tweets = $tweet->getAll();
        $tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
        $total_tweets = $tweet->getTotalRegistros();
        $this->view->total_de_paginas = ceil($total_tweets['total'] / $total_registros_pagina);
        $this->view->pagina_ativa = $pagina; //exibir pagina ativa na navegação

        $this->view->tweets = $tweets;

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);

        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();

        $this->render('timeline');
    }

    public function tweet() {

        $this->validaAutenticacao();

        $tweet = Container::getModel('Tweet');
            
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario',$_SESSION['id']);

        $tweet->salvar();

        header('Location: /timeline');

    }

    public function validaAutenticacao() {

        session_start();
        
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location: /?login=erro');  
        } 
    }

    public function quemSeguir() {

        $this->validaAutenticacao();

        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

        echo $pesquisarPor;

        $usuarios = array();

        if($pesquisarPor != '') {
            
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisarPor);
            $usuario->__set('id', $_SESSION['id']);
            $usuarios = $usuario->getAll();
        }

        //recuperação doos tweets
        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);

        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();

        $this->view->usuarios = $usuarios; 

        $this->render('quemSeguir');   
    }

    public function acao() {
        $this->validaAutenticacao();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : ''; //acao
        $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : ''; //id_usario que será seguido 

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        
        if($acao == 'seguir') {
            $usuario->seguirUsuario($id_usuario_seguindo);

        } else if ($acao == 'deixar_de_seguir') {
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }

        header('Location: /quem_seguir');
    }
}



?>