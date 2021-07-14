<meta charset="utf-8">
<?php
    if(!isset($_SESSION))session_start();
    if(isset($_SESSION['id'])){
        include("../header.php");
        $modulo = '';

        if(isset($_GET['m'])){
            $modulo1 = $_GET['m'];
            $modulo = preg_replace('/[0-9]+h/','',$modulo1);
        }
        if(isset($_GET['t'])){
            $tela1 = $_GET['t'];
            $tela = preg_replace('/[0-9]+h/','',$tela1);
        }

        echo "<div class='painel'>";

            require_once("../functions/funcoes.php");
            $f = new funcoes();
            if($modulo && $tela){
                $f->loadmodulo($modulo,$tela);
            } else {
                echo "<p>Escolha uma opção no menu ao lado.</p>'";
            }

        echo "</div>"; //painel

        include("admsidebar.php");
    } else {
        echo "<meta http-equiv='refresh' content='1;URL=../index.php' />";
    }

?>