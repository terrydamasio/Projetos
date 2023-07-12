<?php 
    //protegendo páginas restritas com session (sempre antes de uma tag de print)
    session_start();

    //variável que verifica se a autenticação foi realizada
    $usuario_autenticado = false;

    //usuarios do sistema
    $usuarios_app = [
        ['email' => 'adm@teste.com.br', 'senha' => '123456'],
        ['email' => 'user@teste.com.br', 'senha' => 'abcdef']
    ];

    /*
    echo '<pre>';
    print_r($usuarios_app);
    echo '</pre>';
    */
 
    foreach($usuarios_app as $user) {
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
            $usuario_autenticado = true;
        }
    }

    if($usuario_autenticado) {
        echo 'Usuário autenticado';
        $_SESSION['autenticado'] = 'Sim';
        $_SESSION['x'] = 'um valor';
        $_SESSION['y'] = 'outro valor';
        header('Location: home.php?login=erro');    
    } else {
        $_SESSION['autenticado'] = 'Não';
        header('Location: index.php?login=erro');     
    }

    /*
    print_r($_GET);

    echo '<br>';

    echo $_GET['email'];
    echo '<br>';
    echo $_GET['senha'];
    */
     
    //Método post > Anexa os dados do formulario dentro da propria requisição retirando os dados da url
    /*
    print_r($_POST);

    echo '<br>';

    echo $_POST['email'];
    echo '<br>';
    echo $_POST['senha'];
    */
?> 