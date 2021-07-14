<?php
    include_once "functions/funcoes.php";

    $funcoes = new funcoes();

    if(isset($_POST['usuario'])){
        $usuario = utf8_decode($_POST['usuario']);
        $senha1 = utf8_decode($_POST['senha']);
        $senha = preg_replace('/[^[:alnum:]_]/', '',$senha1);
        $funcoes->admlogin($usuario,$senha);
    }
?>

    <div id="header">
        <?php include "header.php"; ?>
    </div>
        <div id="loginform">
            <form class="formcadastro" method="POST" action="">
                <fieldset>
                    <legend>Acesso restrito, identifique-se</legend>
                    <div class="formlabel">
                        <label for="usuario">Usuário:</label>
                    </div>
                    <div class="forminput">
                        <input type="text" name="usuario" size="25" onfocus=
                        "if(this.value=='Digite seu e-mail')this.value='';" value="Digite seu e-mail" />
                    </div>
                    <div class="formlabel">
                        <label for="senha">Senha:</label>
                    </div>
                    <div class="forminput">
                        <input type="password" size="25" name="senha"/>
                    </div>
                    <div class="formlabel"></div>
                    <div class="forminput">
                        <input type="submit" name="logar" value="Efetuar Login"/>
                    </div>
                </fieldset>
            </form>
        </div> <!-- loginform -->






