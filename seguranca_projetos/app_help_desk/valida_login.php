<?php 
    //protegendo páginas restritas com session (sempre antes de uma tag de print)
    session_start();

    //variável que verifica se a autenticação foi realizada
    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_perfil_id = null;

    $perfis = [1 => 'Administrativo', 2 => 'Usuário'];

    //usuarios do sistema
    $usuarios_app = [
        ['id' => 1, 'email' => 'adm1@teste.com.br', 'senha' => '123', 'perfil_id' => 1],
        ['id' => 2, 'email' => 'adm2@teste.com.br', 'senha' => '123', 'perfil_id' => 1],
        ['id' => 3, 'email' => 'jose@teste.com.br', 'senha' => '123', 'perfil_id' => 2],
        ['id' => 4, 'email' => 'maria@teste.com.br', 'senha' => '123', 'perfil_id' => 2]
    ];
    
    /*
    echo '<pre>';
    print_r($usuarios_app);
    echo '</pre>';
    */
 
    foreach($usuarios_app as $user) {
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
            $usuario_autenticado = true;
            $usuario_id = $user['id'];
            $usuario_perfil_id = $user['perfil_id'];
        }
    }

    if($usuario_autenticado) {
        echo 'Usuário autenticado';
        $_SESSION['autenticado'] = 'Sim';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil_id'] = $usuario_perfil_id;
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