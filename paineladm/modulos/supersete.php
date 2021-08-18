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
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=supersete&token=DNqXJmcth70uxIy&concurso=".$codconc);
    } else {
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=supersete&token=DNqXJmcth70uxIy&concurso=0");
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
                <div class='painel-titulo-supersete'>Super Sete</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='spslocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='d06' type='text' placeholder='Dezena 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d07' type='text' placeholder='Dezena 07'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan07' type='text' placeholder='Ganhadores 07'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan06' type='text' placeholder='Ganhadores 06'>
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
                    <input class='form-control' name='pr07' type='text' placeholder='Premiação 07'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr06' type='text' placeholder='Premiação 06'>
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
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnsupersete'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $spslocal = filter_input(INPUT_POST, 'spslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $gan07 = filter_input(INPUT_POST, 'gan07', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $gan03 = filter_input(INPUT_POST, 'gan03', FILTER_SANITIZE_STRING);
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $spscidadesgan = filter_input(INPUT_POST, 'cidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'spsconc' => $conc,
                                    'spsdata' => $data,
                                    'spslocal' => $spslocal,
                                    'spspremioest' => $premioest,
                                    'spsd01' => $d01,
                                    'spsd02' => $d02,
                                    'spsd03' => $d03,
                                    'spsd04' => $d04,
                                    'spsd05' => $d05,
                                    'spsd06' => $d06,
                                    'spsd07' => $d07,
                                    'spsgan07' => $gan07,
                                    'spsgan06' => $gan06,
                                    'spsgan05' => $gan05,
                                    'spsgan04' => $gan04,
                                    'spsgan03' => $gan03,
                                    'spspr07' => $pr07,
                                    'spspr06' => $pr06,
                                    'spspr05' => $pr05,
                                    'spspr04' => $pr04,
                                    'spspr03' => $pr03,
                                    'spscidadesgan' => $spscidadesgan ];
                        $sql = "INSERT INTO tbsupersete SET 
                                        spsconc = :spsconc,
                                        spsdata = :spsdata,
                                        spslocal = :spslocal,
                                        spspremioest = :spspremioest,
                                        spsd01 = :spsd01,
                                        spsd02 = :spsd02,
                                        spsd03 = :spsd03,
                                        spsd04 = :spsd04,
                                        spsd05 = :spsd05,
                                        spsd06 = :spsd06,
                                        spsd07 = :spsd07,
                                        spsgan07 = :spsgan07,
                                        spsgan06 = :spsgan06,
                                        spsgan05 = :spsgan05,
                                        spsgan04 = :spsgan04,
                                        spsgan03 = :spsgan03,
                                        spspr07 = :spspr07,
                                        spspr06 = :spspr06,
                                        spspr05 = :spspr05,
                                        spspr04 = :spspr04,
                                        spspr03 = :spspr03,
                                        spscidadesgan = :spscidadesgan";                
                        $result = $conection->insert($sql,$binds);                       
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 
                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-supersete'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idsupersete' => 0];
               $sql = "SELECT * FROM tbsupersete WHERE idsupersete > :idsupersete ORDER BY idsupersete DESC LIMIT 20";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc) FROM tbsupersete)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->spsconc}";
                    $d01proximo = "{$itemmax->spsd01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->spsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->spsconc}"."</td>";
                            echo "<td width='150'>"."{$item->spsdata}"."</td>";
                            echo "<td width='30'>"."{$item->spsd01}"."</td>";
                            echo "<td width='30'>"."{$item->spsd02}"."</td>";
                            echo "<td width='30'>"."{$item->spsd03}"."</td>";
                            echo "<td width='30'>"."{$item->spsd04}"."</td>";
                            echo "<td width='30'>"."{$item->spsd05}"."</td>";
                            echo "<td width='30'>"."{$item->spsd06}"."</td>";
                            echo "<td width='30'>"."{$item->spsd07}"."</td>";
                            echo "<td><a href='admpainel.php?m=supersete&t=atualizardezenas&idconc="."{$item->idsupersete}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=supersete&t=excluirresultado&idconc="."{$item->idsupersete}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idsupersete' => 0];
            $sql = "SELECT * FROM tbsupersete WHERE idsupersete = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-supersete'>supersete - Atualização</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$dat->numero_concurso." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->spsdata)).' 15:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='spslocal' type='text' value='".$item->spslocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->spspremioest."' />
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
                        </div><div class='formlabel'>d05</div>
                        <div class='form-group'>
                            <input class='form-control' name='d06' type='text' value='".$dat->dezenas[5]."' />
                        </div><div class='formlabel'>d06</div>
                        <div class='form-group'>
                            <input class='form-control' name='d07' type='text' value='".$dat->dezenas[6]."' />
                        </div><div class='formlabel'>d07</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='gan07' type='text' value='".number_format($dat->premiacao[0]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan07</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan06' type='text' value='".number_format($dat->premiacao[1]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan06</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan05' type='text' value='".number_format($dat->premiacao[2]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan04' type='text' value='".number_format($dat->premiacao[3]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan03' type='text' value='".number_format($dat->premiacao[4]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan03</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='pr07' type='text' value='".number_format($dat->premiacao[0]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr07</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr06' type='text' value='".number_format($dat->premiacao[1]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr06</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr05' type='text' value='".number_format($dat->premiacao[2]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr04' type='text' value='".number_format($dat->premiacao[3]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr03' type='text' value='".number_format($dat->premiacao[4]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr03</div>";

                        for ($i=1; $i < $qtdcidades; $i++) { 
                            $cidades.=", ".$dat->local_ganhadores[$i]->local."(".$dat->local_ganhadores[$i]->quantidade_ganhadores.")";
                        }
                        
                        if(isset($dat->local_ganhadores[0]->local)){
                            echo "<div class='form-group'>
                                    <input class='form-control' name='spscidadesgan' type='text' value='".$cidades."' />
                                  </div><div class='formlabel'>Cidades</div>";
                        } else {
                            echo "<div class='form-group'>
                                    <input class='form-control' name='spscidadesgan' type='text' value='".$item->spscidadesgan."' />
                                  </div><div class='formlabel'>Cidades</div>";                
                        }

                        echo "<div class='form-group'>   
                                <button type='submit' id='btnsupersete'><span>Atualizar</span></button>    
                              </div>
                        </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $spslocal = filter_input(INPUT_POST, 'spslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $gan07 = filter_input(INPUT_POST, 'gan07', FILTER_SANITIZE_STRING);
                    if($gan07 == "0"){$gan07 = "-";}
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    if($gan06 == "0"){$gan06 = "-";}
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    if($gan05 == "0"){$gan05 = "-";}
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    if($gan04 == "0"){$gan04 = "-";}
                    $gan03 = filter_input(INPUT_POST, 'gan03', FILTER_SANITIZE_STRING);
                    if($gan03 == "0"){$gan03 = "-";}
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $spscidadesgan = filter_input(INPUT_POST, 'spscidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'spsconc' => $conc,
                                    'spsdata' => $data,
                                    'spslocal' => $spslocal,
                                    'spspremioest' => $premioest,
                                    'spsd01' => $d01,
                                    'spsd02' => $d02,
                                    'spsd03' => $d03,
                                    'spsd04' => $d04,
                                    'spsd05' => $d05,
                                    'spsd06' => $d06,
                                    'spsd07' => $d07,
                                    'spsgan07' => $gan07,
                                    'spsgan06' => $gan06,
                                    'spsgan05' => $gan05,
                                    'spsgan04' => $gan04,
                                    'spsgan03' => $gan03,
                                    'spspr07' => $pr07,
                                    'spspr06' => $pr06,
                                    'spspr05' => $pr05,
                                    'spspr04' => $pr04,
                                    'spspr03' => $pr03,
                                    'spscidadesgan' => $spscidadesgan ];
                        $sql = "UPDATE tbsupersete SET 
                                        spsconc = :spsconc,
                                        spsdata = :spsdata,
                                        spslocal = :spslocal,
                                        spspremioest = :spspremioest,
                                        spsd01 = :spsd01,
                                        spsd02 = :spsd02,
                                        spsd03 = :spsd03,
                                        spsd04 = :spsd04,
                                        spsd05 = :spsd05,
                                        spsd06 = :spsd06,
                                        spsd07 = :spsd07,
                                        spsgan07 = :spsgan07,
                                        spsgan06 = :spsgan06,
                                        spsgan05 = :spsgan05,
                                        spsgan04 = :spsgan04,
                                        spsgan03 = :spsgan03,
                                        spspr07 = :spspr07,
                                        spspr06 = :spspr06,
                                        spspr05 = :spspr05,
                                        spspr04 = :spspr04,
                                        spspr03 = :spspr03,
                                        spscidadesgan = :spscidadesgan WHERE spsconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc) FROM tbsupersete)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->spsconc}";
                            $d01proximo = "{$itemmax->spsd01}";
                        }

                        if (isset($dat->data_proximo_concurso)) {
                            $proximosorteio = substr($dat->data_proximo_concurso, 0,10).' 20:00:00';
                        } else {
                            $diadasemana = date('w',strtotime('today'));
                            if($diadasemana != 5){
                                $proximosorteio = date('Y/m/d', strtotime('+2 days')).' 15:00:00';
                            } else {
                                $proximosorteio = date('Y/m/d', strtotime('+3 days')).' 15:00:00';
                            }
                        }

                        if($dat->valor_estimado_proximo_concurso != 0){
                            $premioestimadoprox = number_format($dat->valor_estimado_proximo_concurso, 2,",",".");
                        } else {
                            $premioestimadoprox = "Aguardando...";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'spsconc' => $conc+1,
                                        'spsdata' => $proximosorteio,
                                        'spslocal' => 'SÃO PAULO, SP',
                                        'spspremioest' => $premioestimadoprox,
                                        'spsd01' => 0,
                                        'spsd02' => 0,
                                        'spsd03' => 0,
                                        'spsd04' => 0,
                                        'spsd05' => 0,
                                        'spsd06' => 0,
                                        'spsd07' => 0 ];
                            $sql = "INSERT INTO tbsupersete SET 
                                            spsconc = :spsconc,
                                            spsdata = :spsdata,
                                            spslocal = :spslocal,
                                            spspremioest = :spspremioest,
                                            spsd01 = :spsd01,
                                            spsd02 = :spsd02,
                                            spsd03 = :spsd03,
                                            spsd04 = :spsd04,
                                            spsd05 = :spsd05,
                                            spsd06 = :spsd06,
                                            spsd07 = :spsd07";            
                            $result = $conection->insert($sql,$binds);
                        //atualizar premio estimado
                        } else if($conc != $concproximo && $d01proximo == 0){ 
                            $codconclast = $conc+1;
                            $binds = [  'spspremioest' => $premioestimadoprox ];
                            $sql = "UPDATE tbsupersete SET
                                        spspremioest = :spspremioest WHERE spsconc = $codconclast"; 
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
            echo "<div class='painel-titulo-supersete'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idsupersete' => 0];
               $sql = "SELECT * FROM tbsupersete WHERE idsupersete > :idsupersete ORDER BY idsupersete DESC LIMIT 20";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->spsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->spsconc}"."</td>";
                            echo "<td width='150'>"."{$item->spsdata}"."</td>";
                            echo "<td width='30'>"."{$item->spsd01}"."</td>";
                            echo "<td width='30'>"."{$item->spsd02}"."</td>";
                            echo "<td width='30'>"."{$item->spsd03}"."</td>";
                            echo "<td width='30'>"."{$item->spsd04}"."</td>";
                            echo "<td width='30'>"."{$item->spsd05}"."</td>";
                            echo "<td width='30'>"."{$item->spsd06}"."</td>";
                            echo "<td width='30'>"."{$item->spsd07}"."</td>";
                            echo "<td><a href='admpainel.php?m=supersete&t=atualizardezenas&idconc="."{$item->idsupersete}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=supersete&t=excluirresultado&idconc="."{$item->idsupersete}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

