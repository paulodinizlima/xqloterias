<?php

    ini_set('max_execution_time',0);

    require '../conexao/conexao.php';
    
    $filename = 'C:/xampp/htdocs/xqloterias/megasena.csv';

    if(file_exists($filename)){
        
        if(mysqli_query($conecta, "LOAD DATA INFILE '$filename' INTO TABLE tbmegasena 
        FIELDS TERMINATED BY ';' 
        LINES TERMINATED BY '\n'")){
            echo "Arquivo carregado com sucesso!";
        } else {
            echo "Não foi possível carregar o arquivo!";
        }

    } else {
        echo "Arquivo não existe!";
    }

?>