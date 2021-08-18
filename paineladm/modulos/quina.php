<script>
    function inserir(modulo, tipo){
        location.href='admpainel.php?m='+modulo+'&t='+tipo;
    }
</script>
<link rel="stylesheet" href="../css/style.css">
<meta http-equiv="refresh" content="60">

<?php
    ini_set('default_charset', 'utf-8');
    //define fuso horário
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../functions/funcoes.php";
    require_once "../functions/conection.php";

    $funcoes = new funcoes();
    $con = "../functions/conection.php";

    if(isset($_GET['idconc'])){
        $codconc = $_GET['idconc'];
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=quina&token=DNqXJmcth70uxIy&concurso=".$codconc);
    } else {
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=quina&token=DNqXJmcth70uxIy&concurso=0");
    }
    
    $dat = json_decode($json);
    //var_dump($dat);
    $qtdcidades = count($dat->local_ganhadores);
    $cidades = "";
    if(isset($dat->local_ganhadores[0]->local)){
        $cidades = $dat->local_ganhadores[0]->local."(".$dat->local_ganhadores[0]->quantidade_ganhadores.")";
    }

    switch($tela){
        //--------------------------------------------------------------------------------------------------------------
        case 'cadastrardezenas':
            echo "<div class='div-left'>
                <div class='painel-titulo-quina'>Quina - Cadastro do Concurso</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='quilocal' type='text'placeholder='Local do Sorteio'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='text' placeholder='Prêmio Estimado' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d01' type='text' placeholder='Dezena 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d02' type='text' placeholder='Dezena 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d03' type='text' placeholder='Dezena 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d04' type='text' placeholder='Dezena 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d05' type='text' placeholder='Dezena 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan05' type='text' placeholder='Ganhadores 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan04' type='text' placeholder='Ganhadores 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan03' type='text' placeholder='Ganhadores 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan02' type='text' placeholder='Ganhadores 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr05' type='text' placeholder='Premiação 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr04' type='text' placeholder='Premiação 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr03' type='text' placeholder='Premiação 03'>
                </div>  
                <div class='form-group'>
                    <input class='form-control' name='pr02' type='text' placeholder='Premiação 02'>
                </div>               
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnquina'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $quilocal = filter_input(INPUT_POST, 'quilocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $gan03 = filter_input(INPUT_POST, 'gan03', FILTER_SANITIZE_STRING);
                    $gan02 = filter_input(INPUT_POST, 'gan02', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $pr02 = filter_input(INPUT_POST, 'pr02', FILTER_SANITIZE_STRING);
                    $quicidadesgan = filter_input(INPUT_POST, 'quicidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'quiconc' => $conc,
                                    'quidata' => $data,
                                    'quilocal' => $quilocal,
                                    'quipremioest' => $premioest,
                                    'quid01' => $d01,
                                    'quid02' => $d02,
                                    'quid03' => $d03,
                                    'quid04' => $d04,
                                    'quid05' => $d05,
                                    'quigan05' => $gan05,
                                    'quigan04' => $gan04,
                                    'quigan03' => $gan03,
                                    'quigan02' => $gan02,
                                    'quipr05' => $pr05,
                                    'quipr04' => $pr04,
                                    'quipr03' => $pr03,
                                    'quipr02' => $pr02,
                                    'quicidadesgan' => $quicidadesgan ];
                        $sql = "INSERT INTO tbquina SET 
                                        quiconc = :quiconc,
                                        quidata = :quidata,
                                        quilocal = :quilocal,
                                        quipremioest = :quipremioest,
                                        quid01 = :quid01,
                                        quid02 = :quid02,
                                        quid03 = :quid03,
                                        quid04 = :quid04,
                                        quid05 = :quid05,
                                        quigan05 = :quigan05,
                                        quigan04 = :quigan04,
                                        quigan03 = :quigan03,
                                        quigan02 = :quigan02,
                                        quipr05 = :quipr05,
                                        quipr04 = :quipr04,
                                        quipr03 = :quipr03,
                                        quipr02 = :quipr02,
                                        quicidadesgan = :quicidadesgan";                
                        $result = $conection->insert($sql,$binds);                        
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 
                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-quina'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idquina' => 0];
               $sql = "SELECT * FROM tbquina WHERE idquina > :idquina ORDER BY idquina DESC LIMIT 15";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc) FROM tbquina)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->quiconc}";
                    $d01proximo = "{$itemmax->quid01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>D01</th><th>D02</th><th>D03</th><th>D04</th><th>D05</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->quiconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->quiconc}"."</td>";
                            echo "<td width='200'>"."{$item->quidata}"."</td>";
                            echo "<td width='30'>"."{$item->quid01}"."</td>";
                            echo "<td width='30'>"."{$item->quid02}"."</td>";
                            echo "<td width='30'>"."{$item->quid03}"."</td>";
                            echo "<td width='30'>"."{$item->quid04}"."</td>";
                            echo "<td width='30'>"."{$item->quid05}"."</td>";
                            echo "<td><a href='admpainel.php?m=quina&t=atualizardezenas&idconc="."{$item->idquina}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=quina&t=excluirresultado&idconc="."{$item->idquina}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
                        echo "</tr>";
                   }
               }              

               echo "</table>";
           echo "</div>"; //div-right
        break;
        //--------------------------------------------------------------------------------------------------------------
        case 'atualizardezenas':
            if(isset($_GET['idconc']))
                $codconc = $_GET['idconc'];
            $conection = new conection();
            $binds = ['idquina' => 0];
            $sql = "SELECT * FROM tbquina WHERE idquina = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-quina'>quina - Atualização do Resultado</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$dat->numero_concurso." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->quidata)).' 20:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='quilocal' type='text' value='".$item->quilocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->quipremioest."' />
                        </div><div class='formlabel'>prest</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='d01' type='text' value='".$dat->dezenas[0]."'/>
                        </div><div class='formlabel'>d01</div>
                        <div class='form-group'>
                            <input class='form-control' name='d02' type='text' value='".$dat->dezenas[1]."' />
                        </div><div class='formlabel'>d02</div>
                        <div class='form-group'>
                            <input class='form-control' name='d03' type='text' value='".$dat->dezenas[2]."' />
                        </div><div class='formlabel'>d03</div>
                        <div class='form-group'>
                            <input class='form-control' name='d04' type='text' value='".$dat->dezenas[3]."' />
                        </div><div class='formlabel'>d04</div>
                        <div class='form-group'>
                            <input class='form-control' name='d05' type='text' value='".$dat->dezenas[4]."' />
                        </div><div class='formlabel'>d05</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='gan05' type='text' value='".number_format($dat->premiacao[0]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan04' type='text' value='".number_format($dat->premiacao[1]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan03' type='text' value='".number_format($dat->premiacao[2]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan03</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan02' type='text' value='".number_format($dat->premiacao[3]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan02</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='pr05' type='text' value='".number_format($dat->premiacao[0]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr04' type='text' value='".number_format($dat->premiacao[1]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr03' type='text' value='".number_format($dat->premiacao[2]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr03</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr02' type='text' value='".number_format($dat->premiacao[3]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr02</div>";
                
                        for ($i=1; $i < $qtdcidades; $i++) { 
                            $cidades.=", ".$dat->local_ganhadores[$i]->local."(".$dat->local_ganhadores[$i]->quantidade_ganhadores.")";
                        }
                        
                        if(isset($dat->local_ganhadores[0]->local)){
                            echo "<div class='form-group'>
                                    <input class='form-control' name='quicidadesgan' type='text' value='".$cidades."' />
                                  </div><div class='formlabel'>Cidades</div>";
                        } else {
                            echo "<div class='form-group'>
                                    <input class='form-control' name='quicidadesgan' type='text' value='".$item->quicidadesgan."' />
                                  </div><div class='formlabel'>Cidades</div>";                
                        }

                        echo "<div class='form-group'>   
                                    <button type='submit' id='btnquina'><span>Atualizar</span></button>    
                                </div>
                    </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $quilocal = filter_input(INPUT_POST, 'quilocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    if($gan05 == "0"){$gan05 = "-";}
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    if($gan04 == "0"){$gan04 = "-";}
                    $gan03 = filter_input(INPUT_POST, 'gan03', FILTER_SANITIZE_STRING);
                    if($gan03 == "0"){$gan03 = "-";}
                    $gan02 = filter_input(INPUT_POST, 'gan02', FILTER_SANITIZE_STRING);
                    if($gan02 == "0"){$gan02 = "-";}
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $pr02 = filter_input(INPUT_POST, 'pr02', FILTER_SANITIZE_STRING);
                    $quicidadesgan = filter_input(INPUT_POST, 'quicidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'quiconc' => $conc,
                                    'quidata' => $data,
                                    'quilocal' => $quilocal,
                                    'quipremioest' => $premioest,
                                    'quid01' => $d01,
                                    'quid02' => $d02,
                                    'quid03' => $d03,
                                    'quid04' => $d04,
                                    'quid05' => $d05,
                                    'quigan05' => $gan05,
                                    'quigan04' => $gan04,
                                    'quigan03' => $gan03,
                                    'quigan02' => $gan02,
                                    'quipr05' => $pr05,
                                    'quipr04' => $pr04,
                                    'quipr03' => $pr03,
                                    'quipr02' => $pr02,
                                    'quicidadesgan' => $quicidadesgan ];
                        $sql = "UPDATE tbquina SET 
                                        quiconc = :quiconc,
                                        quidata = :quidata,
                                        quilocal = :quilocal,
                                        quipremioest = :quipremioest,
                                        quid01 = :quid01,
                                        quid02 = :quid02,
                                        quid03 = :quid03,
                                        quid04 = :quid04,
                                        quid05 = :quid05,
                                        quigan05 = :quigan05,
                                        quigan04 = :quigan04,
                                        quigan03 = :quigan03,
                                        quigan02 = :quigan02,
                                        quipr05 = :quipr05,
                                        quipr04 = :quipr04,
                                        quipr03 = :quipr03,
                                        quipr02 = :quipr02,
                                        quicidadesgan = :quicidadesgan WHERE quiconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc) FROM tbquina)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->quiconc}";
                            $d01proximo = "{$itemmax->quid01}";
                        }

                        if (isset($dat->data_proximo_concurso)) {
                            $proximosorteio = substr($dat->data_proximo_concurso, 0,10).' 20:00:00';
                        } else {
                            $diadasemana = date('w', strtotime('today'));

                            if($diadasemana == 6){
                                $proximosorteio = date('Y/m/d', strtotime('+2 days')).' 20:00:00';
                            } else if($diadasemana != 6) {
                                $proximosorteio = date('Y/m/d', strtotime('+1 days')).' 20:00:00';
                            } 
                        }

                        if($dat->valor_estimado_proximo_concurso != 0){
                            $premioestimadoprox = number_format($dat->valor_estimado_proximo_concurso, 2,",",".");
                        } else {
                            $premioestimadoprox = "Aguardando...";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'quiconc' => $conc+1,
                                        'quidata' => $proximosorteio,
                                        'quilocal' => 'SÃO PAULO, SP',
                                        'quipremioest' => $premioestimadoprox,
                                        'quid01' => 0,
                                        'quid02' => 0,
                                        'quid03' => 0,
                                        'quid04' => 0,
                                        'quid05' => 0,
                                        'quigan05' => 0,
                                        'quigan04' => 0,
                                        'quigan03' => 0,
                                        'quigan02' => 0 ];
                            $sql = "INSERT INTO tbquina SET 
                                            quiconc = :quiconc,
                                            quidata = :quidata,
                                            quilocal = :quilocal,
                                            quipremioest = :quipremioest,
                                            quid01 = :quid01,
                                            quid02 = :quid02,
                                            quid03 = :quid03,
                                            quid04 = :quid04,
                                            quid05 = :quid05,
                                            quigan05 = :quigan05,
                                            quigan04 = :quigan04,
                                            quigan03 = :quigan03,
                                            quigan02 = :quigan02";            
                            $result = $conection->insert($sql,$binds);
                        //atualizar premio estimado
                        } else if($conc != $concproximo && $d01proximo == 0){ 
                            $codconclast = $conc+1;
                            $binds = [  'quipremioest' => $premioestimadoprox ];
                            $sql = "UPDATE tbquina SET
                                        quipremioest = :quipremioest WHERE quiconc = $codconclast"; 
                            $result = $conection->insert($sql,$binds);           
                        }
                        //------------------------------------------------------------//    
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    }            
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-quina'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idquina' => 0];
               $sql = "SELECT * FROM tbquina WHERE idquina > :idquina ORDER BY idquina DESC LIMIT 15";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>D01</th><th>D02</th><th>D03</th><th>D04</th><th>D05</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->quiconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->quiconc}"."</td>";
                            echo "<td width='200'>"."{$item->quidata}"."</td>";
                            echo "<td width='30'>"."{$item->quid01}"."</td>";
                            echo "<td width='30'>"."{$item->quid02}"."</td>";
                            echo "<td width='30'>"."{$item->quid03}"."</td>";
                            echo "<td width='30'>"."{$item->quid04}"."</td>";
                            echo "<td width='30'>"."{$item->quid05}"."</td>";
                            echo "<td><a href='admpainel.php?m=quina&t=atualizardezenas&idconc="."{$item->idquina}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=quina&t=excluirresultado&idconc="."{$item->idquina}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
                        echo "</tr>";
                   }
               }              

               echo "</table>";
           echo "</div>"; //div-right
        break;
        //--------------------------------------------------------------------------------------------------------------
        
        default:
           //code
        break;
    } //end switch
?>

