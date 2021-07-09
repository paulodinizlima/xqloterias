<?php

    require_once('conexao.php');


    Class funcoes{

        private $senha;

        function __construct(){
            $this->objeto = new conexao();
            $this->objeto->conectar();
        }

        function admlogin($usuario, $senha){
            if($this->objeto->conectado=='s'){
                $sql = "SELECT * FROM administrador WHERE adm_email = '".$usuario."' AND adm_senha = '".$senha."'";
                $res = $this->objeto->consultar($sql);
                if($this->objeto->dados != ""){
                    echo "<meta http-equiv='refresh' content='0;URL=painel/admpainel.php?m=administrador&t=consultardados'/>";
                    $_SESSION['id'] = (int)$this->objeto->dados['id_administrador'];
                    $_SESSION['user'] = $this->objeto->dados['adm_nome'];
                }
            }
        }

        function loadmodulo($modulo=NULL, $tela=NULL){
            if($modulo == NULL || $tela == NULL) :
                echo '<p>Erro! Página não carregada!</p>';
            else:
                if(file_exists("../modulos/"."$modulo".".php")):
                    include_once("../modulos/"."$modulo".".php");
                else:
                    echo '<p>Módulo inexistente!</p>';
                endif;
            endif;
        }

        function logoff(){
            if($_GET['t']=="logoff"){
                $this->objeto->desconectar();
                echo "Desconectado";
            }
        }

        function anti_injection($sql){
            $sql = trim($sql);
            $sql = strip_tags($sql);
            $sql = addslashes($sql);
            return $sql;
        }



    }





?>