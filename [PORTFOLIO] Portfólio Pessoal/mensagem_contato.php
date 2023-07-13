<?php 

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    //montagem do texto
    $nome = str_replace('#', '-', $_POST['nome']);
    $email = str_replace('#', '-', $_POST['email']);
    $topico = str_replace('#', '-', $_POST['topico']);
    $mensagem = str_replace('#', '-', $_POST['mensagem']);

    $texto = '- ' . $nome . ' # ' . $email . ' # ' . $topico . ' # ' . $mensagem . PHP_EOL;
    
    $arquivo = fopen('arquivo.hd', 'a');

    fwrite($arquivo, $texto);

    fclose($arquivo);
    
    header('Location: index.html');
    
    /*
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    //trabalhando na montagem do texto
    $titulo = str_replace('#', '-', $_POST['titulo']);
    $categoria = str_replace('#', '-', $_POST['categoria']);
    $descricao = str_replace('#', '-', $_POST['descricao']);

    //implode('#', $_POST);

    //usar constante PHP_EOL que armazena a quebra de linha de acordo com o sistema operacional que está sendo usado
    $texto = '- ' . $nome . ' # ' . $categoria . ' # ' . $descricao . PHP_EOL; 

    //abrindo o arquivo com fopen('nome do arquivo', 'parametros de ação')
    $arquivo = fopen('arquivo.hd', 'a');

    //escrevendo no arquivo passando os parametros do arquivo aberto e o texto a ser escrito 
    fwrite($arquivo, $texto);

    //fechando o arquivo passando a referencia do arquivo que foi aberto
    fclose($arquivo);
    
    //echo $texto;
    header('Location: abrir_chamado.php'); 
    */
?>