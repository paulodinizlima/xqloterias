<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <meta charset="utf-8">
    <head>
        <title>XQ LOTERIAS - PAINEL ADMINISTRATIVO</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
        <?php require_once("functions/funcoes.php");
            if(isset($_GET['d'])){
                $p = $_GET['d'];
            } else {
                $p = "admlogin";
            }
            if($p == 'admlogin'){
                include("painel/admlogin.php");
            }
        ?>
    </body>
</html>