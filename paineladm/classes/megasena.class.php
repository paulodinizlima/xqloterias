<?php
    $filename = '../funcoes/funcoes.php';
    if(file_exists($filename)){
        require_once('../funcoes/funcoes.php');
    } else {
        require_once('paineladm/funcoes/funcoes.php');
    }

    Class megasena {
        private $idMegasena;
        private $msConc;
        private $msData;
        private $msLocal;
        private $msPremioEst;
        private $msPr06;
        private $msPr05;
        private $msPr04;
        private $msGan06;
        private $msGan05;
        private $msGan04;
        private $msD01;
        private $msD02;
        private $msD03;
        private $msD04;
        private $msD05;
        private $msD06;

        function __construct(){
            $this->objeto = new conexao();
            $this->objeto->conectar();
        }

        function __destruct(){
            $this->objeto->desconectar();
        }

	function getCodigo() {
		return $this->idMegasena;
	}

	function setCodigo($idMegasena) {
		$this->idMegasena = $idMegasena;
	}

	function getMsConc() {
		return $this->msConc;
	}

	function setMsConc($msConc) {
		$this->msConc = $msConc;
	}

	function getMsData() {
		return $this->msData;
	}

	function setMsData($msData) {
		$this->msData = $msData;
	}

	function getMsLocal() {
		return $this->msLocal;
	}

	function setMsLocal($msLocal) {
		$this->msLocal = $msLocal;
	}

	function getMsPremioEst() {
		return $this->msPremioEst;
	}

	function setMsPremioEst($msPremioEst) {
		$this->msPremioEst = $msPremioEst;
	}

	function getMsPr06() {
		return $this->msPr06;
	}

	function setMsPr06($msPr06) {
		$this->msPr06 = $msPr06;
	}

	function getMsPr05() {
		return $this->msPr05;
	}

	function setMsPr05($msPr05) {
		$this->msPr05 = $msPr05;
	}

	function getMsPr04() {
		return $this->msPr04;
	}

	function setMsPr04($msPr04) {
		$this->msPr04 = $msPr04;
	}

	function getMsGan06() {
		return $this->msGan06;
	}

	function setMsGan06($msGan06) {
		$this->msGan06 = $msGan06;
	}

	function getMsGan05() {
		return $this->msGan05;
	}

	function setMsGan05($msGan05) {
		$this->msGan05 = $msGan05;
	}

	function getMsGan04() {
		return $this->msGan04;
	}

	function setMsGan04($msGan04) {
		$this->msGan04 = $msGan04;
	}

	function getMsD01() {
		return $this->msD01;
	}

	function setMsD01($msD01) {
		$this->msD01 = $msD01;
	}

	function getMsD02() {
		return $this->msD02;
	}

	function setMsD02($msD02) {
		$this->msD02 = $msD02;
	}

	function getMsD03() {
		return $this->msD03;
	}

	function setMsD03($msD03) {
		$this->msD03 = $msD03;
	}

	function getMsD04() {
		return $this->msD04;
	}

	function setMsD04($msD04) {
		$this->msD04 = $msD04;
	}

	function getMsD05() {
		return $this->msD05;
	}

	function setMsD05($msD05) {
		$this->msD05 = $msD05;
	}

	function getMsD06() {
		return $this->msD06;
	}

	function setMsD06($msD06) {
		$this->msD06 = $msD06;
	}      

    function gravar(){
        if($this->objeto->conectado == "s"){
            $sql = "INSERT INTO tbmegasena (msconc, msdata, mslocal, mspremioest, mspr06, mspr05, 
            mspr04, msgan06, msgan05, msgan04, msd01, msd02, msd03, msd04, msd05, msd06) VALUES ";
            $sql .= "(" .$this->getMsConc().",'"
                         .$this->getMsData()."','"
                         .$this->getMsLocal()."','"
                         .$this->getMsPr06()."','"
                         .$this->getMsPr05()."','"
                         .$this->getMsPr04()."',"
                         .$this->getMsGan06().","
                         .$this->getMsGan05().","
                         .$this->getMsGan04().","
                         .$this->getMsD01().","
                         .$this->getMsD02().","
                         .$this->getMsD03().","
                         .$this->getMsD04().","
                         .$this->getMsD05().","
                         .$this->getMsD06().")";
            $ok = $this->objeto->executar($sql);
            if($ok == 1){
                include "../painel/gravado.php";
                $g = new gravado();
                $g->gravadoOk('Resultado Megasena');
            } else {
                include "../painel/erros.php";
                $e = new erros();
                $e->erroGravar('Resultado Megasena');
            }
        }
    } //end gravar

    function alterar(){
        $funcoes = new funcoes();
        if($this->objeto->conectado=="s"){
            $codigo = $funcoes->anti_injection($this->getCodigo());
            $sql = "UPDATE tbmegasena SET
                        msconc = ".$this->getMsConc().",
                        msdata = ".$this->getMsData().",
                        mslocal = ".$this->getMsLocal().",
                        mspremioest = ".$this->getMsPremioEst().",
                        mspr06 = ".$this->getMsPr06().",
                        mspr05 = ".$this->getMsPr05().",
                        mspr04 = ".$this->getMsPr04().",
                        msgan06 = ".$this->getMsPr06().",
                        msgan05 = ".$this->getMsPr05().",
                        msgan04 = ".$this->getMsPr04().",
                        msd01 = ".$this->getMsD01().",
                        msd02 = ".$this->getMsD02().",
                        msd03 = ".$this->getMsD03().",
                        msd04 = ".$this->getMsD04().",
                        msd05 = ".$this->getMsD05().",
                        msd06 = ".$this->getMsD06()."
                        WHERE idmegasena = ".$codigo;
            $ok = $this->objeto->executar($sql);
            if($ok == 1){
                include "../painel/gravado.php";
                $g = new gravado();
                $g->alteradoOk('Resultado Megasena');
            } else {
                include "../painel/erros.php";
                $e = new erros();
                $e->erroAlterar('Resultado Megasena');
            }
        }
    } //end alterar

    function excluir($idMegasena){
        $funcoes = new funcoes();
        $codigo = $funcoes->anti_injection($idMegasena);
        $sql = "DELETE FROM tbmegasena WHERE idMegasena = ".$codigo;
        $ok = $this->objeto->executar($sql);
        if($ok == 1){
            include "../painel/gravado.php";
            $g = new gravado();
            $g->excluidoOk('Resultado Megasena');
        } else {
            include "../painel/erros.php";
            $e = new erros();
            $e->erroExcluir('Resultado Megasena');
        }
    } //end excluir

    function listarRegistros(){
        $sql = "SELECT * FROM tbmegasena order by idmegasena desc";
        $this->objeto->Listar($sql);
        return $this->objeto->contarRegistros();
    } //end listarRegistros

    function lerLista(){
        $this->lista=$this->objeto->retornaDados();
        $this->setCodigo($this->lista['idmegasena']);
        $this->setMsConc($this->lista['msconc']);
        $this->setMsData($this->lista['msdata']);
        $this->setMsLocal($this->lista['mslocal']);
        $this->setMsPremioEst($this->lista['mspremioest']);
        $this->setMsPr06($this->lista['mspr06']);
        $this->setMsPr05($this->lista['mspr05']);
        $this->setMsPr04($this->lista['mspr04']);
        $this->setMsGan06($this->lista['msgan06']);
        $this->setMsGan05($this->lista['msgan05']);
        $this->setMsGan04($this->lista['msgan04']);
        $this->setMsD01($this->lista['msd01']);
        $this->setMsD02($this->lista['msd02']);
        $this->setMsD03($this->lista['msd03']);
        $this->setMsD04($this->lista['msd04']);
        $this->setMsD05($this->lista['msd05']);
        $this->setMsD06($this->lista['msd06']);
    } //end lerLista



    } //classe

?>