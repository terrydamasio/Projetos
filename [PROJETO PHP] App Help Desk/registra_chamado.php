<?php

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    //trabalhando na montagem do texto
    $titulo = str_replace('#', '-', $_POST['titulo']);
    $categoria = str_replace('#', '-', $_POST['categoria']);
    $descricao = str_replace('#', '-', $_POST['descricao']);

    //implode('#', $_POST);

    //usar constante PHP_EOL que armazena a quebra de linha de acordo com o sistema operacional que está sendo usado
    $texto = '- ' . $titulo . ' # ' . $categoria . ' # ' . $descricao . PHP_EOL; 

    //abrindo o arquivo com fopen('nome do arquivo', 'parametros de ação')
    $arquivo = fopen('arquivo.hd', 'a');

    fwrite($arquivo, $texto);

    //fechando o arquivo
    fclose($arquivo);
    
    //echo $texto;
    header('Location: abrir_chamado.php');

?>