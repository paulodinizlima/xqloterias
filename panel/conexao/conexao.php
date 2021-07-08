<?php

    session_start();

    $localhost = "localhost";
    $user = "root";
    $pass = "226298my@Sql";
    $banco = "dbxqloterias";

    //CONEXAO MYSQLI ESTRUTURAL

    $conecta = mysqli_connect($localhost, $user, $pass, $banco);
    mysqli_set_charset($conecta, "utf8");


?>