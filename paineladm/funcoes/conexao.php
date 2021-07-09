<?php

    Class conexao {
        private $con;
        public $dados;
        public $total;

        public $conectado='n';

        function conectar(){
            $this->conectado='n';
            $this->con = new mysqli("localhost", "root", "226298my@Sql", "dbxqloterias", "3306");
            if(!$this->con){
                return -1;
            } else {
                $this->conectado='s';
                return $this->con;
            }
        }

        function executar($comando){
            $resultado = mysqli_query($this->con, $comando);
            return $resultado;
        }

        function consultar($sql){
            if($this->conectado=="s"){
                $rs = mysqli_query($this->con, $sql);
                $this->dados = mysqli_fetch_array($rs);
            }
        }

        function listar($sql){
            if($this->conectado=="s"){
                $rs = mysqli_query($this->con,$sql);
                $this->total = mysqli_num_rows($rs);
                $this->dados=$rs;
            }
        }

        function contarRegistros(){
            return $this->total;
        }

        function retornaDados(){
            return mysqli_fetch_assoc($this->dados);
        }

        function desconectar(){
            mysqli_close($this->con);
        }

    }



?>