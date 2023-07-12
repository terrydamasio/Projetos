<?php 

    session_start();
    /*
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    //remover índices do array de sessão
    //unset(array, índice a ser eliminado)

    unset($_SESSION['x']); //remover o indice apenas se existir 

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    
    //destruir a variável de sessão
    //session_destroy() 

    session_destroy(); //seção será destruida
    //forçar um redirecionamento (uma nova requisição http ao servidor) 

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    */

    session_destroy();
    header('Location: index.php');
?>