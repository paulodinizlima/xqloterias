<?php
    //if(!isset($_SESSION)) session_start();

    require_once('conection.php');

    Class funcoes{
        private $senha;

        function __construct(){
            $this->objeto = new conection();
        }

        function admlogin($usuario, $senha){
            if($this->objeto->conectado=='s'){
                $binds = [  'usuario' => $usuario,
                            'senha' => $senha];
                $sql = "SELECT * FROM administrador WHERE usuario = :usuario AND senha = :senha";
                $res = $this->objeto->select($sql,$binds);
                if($res->rowCount() > 0){
                    $dados = $res->fetchAll(PDO::FETCH_OBJ);
                    echo "<meta http-equiv='refresh' content='0;URL=painel/admpainel.php?m=megasena&t=cadastrardezenas' />";
                    foreach($dados as $item){
                        $_SESSION['id'] = $item->idadm;
                        $_SESSION['user'] = $item->usuario;
                    }
                }
            }
        }

        function loadmodulo($modulo=NULL, $tela=NULL){
            if($modulo == NULL || $tela == NULL) :
                echo '<p>Erro! Página não carregada!</p>';
            else:
                if(file_exists("../modulos/"."$modulo".".php")) :
                    include_once("../modulos/"."$modulo".".php");
                else:
                    echo '<p>Módulo Inexistente!</p>';
                endif;
            endif;
        }

        function logoff(){
            if($_GET['t'] == "logoff"){
                $this->objeto->desconectar();
                echo "Desconectado";
            }
        }

        function verificaEmail($email, $tipo, $campo){
            if($this->objeto->conectado=='s'){
                $res = "";
                $sql = "SELECT * FROM ".$tipo." WHERE ".$campo." = ".$email."'";
                $res = $this->objeto->selecionaConsulta($sql);
                $teste = $this->objeto->retornaConsulta();
                if($teste[$campo] == $email){
                    return 1;
                } else {
                    return 0;
                }
            }
        }

        function anti_injection($sql){
            $sql = trim($sql);
            $sql = strip_tags($sql);
            return $sql;
        }





    } //end class funcoes


?>