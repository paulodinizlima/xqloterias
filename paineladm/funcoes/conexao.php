<?php

    Class conexao {
        private $con;
        public $dados;
        public $total;

        public $conectado='n';

        function Conectar(){
            $this->conectado='n';
            $this->con = new mysqli("localhost", "root", "226298my@Sql", "dbxqloterias", "3306");
            if(!$this->con){
                return -1;
            } else {
                $this->conectado='s';
                return $this->con;
            }
        }

        function Executar($comando){
            $resultado = mysqli_query($this->con, $comando);
            return $resultado;
        }

        function Consultar($sql){
            if($this->conectado=="s"){
                $rs = mysqli_query($this->con, $sql);
                $this->dados = mysqli_fetch_array($rs);
            }
        }

        function Listar($sql){
            if($this->conectado=="s"){
                $rs = mysqli_query($this->con,$sql);
                $this->total = mysqli_num_rows($rs);
                $this->dados=$rs;
            }
        }

        function ContarRegistros(){
            return $this->total;
        }

        function RetornaDados(){
            return mysqli_fetch_assoc($this->dados);
        }

        function Desconectar(){
            mysqli_close($this->con);
        }

    }



?>