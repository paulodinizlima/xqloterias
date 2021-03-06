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
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=timemania&token=DNqXJmcth70uxIy&concurso=".$codconc);
    } else {
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=timemania&token=DNqXJmcth70uxIy&concurso=0");
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
                <div class='painel-titulo-timemania'>Timemania - Cadastro</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='tmmlocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='time' type='text' placeholder='Ganhadores Time'>
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
                    <input class='form-control' name='prtime' type='text' placeholder='Premiação Time'>
                </div>              
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btntimemania'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $tmmlocal = filter_input(INPUT_POST, 'tmmlocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $dtime = filter_input(INPUT_POST, 'dtime', FILTER_SANITIZE_STRING);
                    $gan07 = filter_input(INPUT_POST, 'gan07', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $gan03 = filter_input(INPUT_POST, 'gan03', FILTER_SANITIZE_STRING);
                    $gantime = filter_input(INPUT_POST, 'gantime', FILTER_SANITIZE_STRING);
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $prtime = filter_input(INPUT_POST, 'prtime', FILTER_SANITIZE_STRING);
                    $tmmcidadesgan = filter_input(INPUT_POST, 'tmmcidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'tmmconc' => $conc,
                                    'tmmdata' => $data,
                                    'tmmlocal' => $tmmlocal,
                                    'tmmpremioest' => $premioest,
                                    'tmmd01' => $d01,
                                    'tmmd02' => $d02,
                                    'tmmd03' => $d03,
                                    'tmmd04' => $d04,
                                    'tmmd05' => $d05,
                                    'tmmd06' => $d06,
                                    'tmmd07' => $d07,
                                    'tmmdtime' => $dtime,
                                    'tmmgan07' => $gan07,
                                    'tmmgan06' => $gan06,
                                    'tmmgan05' => $gan05,
                                    'tmmgan04' => $gan04,
                                    'tmmgan03' => $gan03,
                                    'tmmgantime' => $gantime,
                                    'tmmpr07' => $pr07,
                                    'tmmpr06' => $pr06,
                                    'tmmpr05' => $pr05,
                                    'tmmpr04' => $pr04,
                                    'tmmpr03' => $pr03,
                                    'tmmprtime' => $prtime,
                                    'tmmcidadesgan' => $tmmcidadesgan ];
                        $sql = "INSERT INTO tbtimemania SET 
                                        tmmconc = :tmmconc,
                                        tmmdata = :tmmdata,
                                        tmmlocal = :tmmlocal,
                                        tmmpremioest = :tmmpremioest,
                                        tmmd01 = :tmmd01,
                                        tmmd02 = :tmmd02,
                                        tmmd03 = :tmmd03,
                                        tmmd04 = :tmmd04,
                                        tmmd05 = :tmmd05,
                                        tmmd06 = :tmmd06,
                                        tmmd07 = :tmmd07,
                                        tmmdtime = :tmmdtime,
                                        tmmgan07 = :tmmgan07,
                                        tmmgan06 = :tmmgan06,
                                        tmmgan05 = :tmmgan05,
                                        tmmgan04 = :tmmgan04,
                                        tmmgan03 = :tmmgan03,
                                        tmmgantime = :tmmgantime,
                                        tmmpr07 = :tmmpr07,
                                        tmmpr06 = :tmmpr06,
                                        tmmpr05 = :tmmpr05,
                                        tmmpr04 = :tmmpr04,
                                        tmmpr03 = :tmmpr03,
                                        tmmprtime = :tmmprtime,
                                        tmmcidadesgan = :tmmcidadesgan";                
                        $result = $conection->insert($sql,$binds);

                        

                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-timemania'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idtimemania' => 0];
               $sql = "SELECT * FROM tbtimemania WHERE idtimemania > :idtimemania ORDER BY idtimemania DESC LIMIT 20";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc) FROM tbtimemania)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->tmmconc}";
                    $d01proximo = "{$itemmax->tmmd01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>Time</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->tmmconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->tmmconc}"."</td>";
                            echo "<td width='150'>"."{$item->tmmdata}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd01}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd02}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd03}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd04}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd05}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd06}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd07}"."</td>";
                            echo "<td width='30'>"."{$item->tmmdtime}"."</td>";
                            echo "<td><a href='admpainel.php?m=timemania&t=atualizardezenas&idconc="."{$item->idtimemania}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=timemania&t=excluirresultado&idconc="."{$item->idtimemania}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idtimemania' => 0];
            $sql = "SELECT * FROM tbtimemania WHERE idtimemania = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-timemania'>timemania - Atualização</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$dat->numero_concurso." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->tmmdata)).' 20:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='tmmlocal' type='text' value='".$item->tmmlocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->tmmpremioest."' />
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
                        </div><div class='formlabel'>d07</div>
                        <div class='form-group'>
                            <input class='form-control' name='dtime' type='text' value='".utf8_decode($dat->nome_time_coracao)."' />
                        </div><div class='formlabel'>dtime</div>";
                        
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
                        </div><div class='formlabel'>gan03</div>
                        <div class='form-group'>
                            <input class='form-control' name='gantime' type='text' value='".number_format($dat->premiacao[5]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gantime</div>
                        <div class='form-group'>
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
                        </div><div class='formlabel'>pr03</div>
                        <div class='form-group'>
                            <input class='form-control' name='prtime' type='text' value='".number_format($dat->premiacao[5]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>prtime</div>";

                        for ($i=1; $i < $qtdcidades; $i++) { 
                            $cidades.=", ".$dat->local_ganhadores[$i]->local."(".$dat->local_ganhadores[$i]->quantidade_ganhadores.")";
                        }
                        
                        if(isset($dat->local_ganhadores[0]->local)){
                            echo "<div class='form-group'>
                                    <input class='form-control' name='tmmcidadesgan' type='text' value='".$cidades."' />
                                  </div><div class='formlabel'>Cidades</div>";
                        } else {
                            echo "<div class='form-group'>
                                    <input class='form-control' name='tmmcidadesgan' type='text' value='".$item->tmmcidadesgan."' />
                                  </div><div class='formlabel'>Cidades</div>";                
                        }

                        echo "<div class='form-group'>   
                                <button type='submit' id='btntimemania'><span>Atualizar</span></button>    
                              </div>
                        </form>";
            }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $tmmlocal = filter_input(INPUT_POST, 'tmmlocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $dtime = filter_input(INPUT_POST, 'dtime', FILTER_SANITIZE_STRING);
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
                    $gantime = filter_input(INPUT_POST, 'gantime', FILTER_SANITIZE_STRING);
                    if($gantime == "0"){$gantime = "-";}
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $prtime = filter_input(INPUT_POST, 'prtime', FILTER_SANITIZE_STRING);
                    $tmmcidadesgan = filter_input(INPUT_POST, 'tmmcidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'tmmconc' => $conc,
                                    'tmmdata' => $data,
                                    'tmmlocal' => $tmmlocal,
                                    'tmmpremioest' => $premioest,
                                    'tmmd01' => $d01,
                                    'tmmd02' => $d02,
                                    'tmmd03' => $d03,
                                    'tmmd04' => $d04,
                                    'tmmd05' => $d05,
                                    'tmmd06' => $d06,
                                    'tmmd07' => $d07,
                                    'tmmdtime' => $dtime,
                                    'tmmgan07' => $gan07,
                                    'tmmgan06' => $gan06,
                                    'tmmgan05' => $gan05,
                                    'tmmgan04' => $gan04,
                                    'tmmgan03' => $gan03,
                                    'tmmgantime' => $gantime,
                                    'tmmpr07' => $pr07,
                                    'tmmpr06' => $pr06,
                                    'tmmpr05' => $pr05,
                                    'tmmpr04' => $pr04,
                                    'tmmpr03' => $pr03,
                                    'tmmprtime' => $prtime,
                                    'tmmcidadesgan' => $tmmcidadesgan ];
                        $sql = "UPDATE tbtimemania SET 
                                        tmmconc = :tmmconc,
                                        tmmdata = :tmmdata,
                                        tmmlocal = :tmmlocal,
                                        tmmpremioest = :tmmpremioest,
                                        tmmd01 = :tmmd01,
                                        tmmd02 = :tmmd02,
                                        tmmd03 = :tmmd03,
                                        tmmd04 = :tmmd04,
                                        tmmd05 = :tmmd05,
                                        tmmd06 = :tmmd06,
                                        tmmd07 = :tmmd07,
                                        tmmdtime = :tmmdtime,
                                        tmmgan07 = :tmmgan07,
                                        tmmgan06 = :tmmgan06,
                                        tmmgan05 = :tmmgan05,
                                        tmmgan04 = :tmmgan04,
                                        tmmgan03 = :tmmgan03,
                                        tmmgantime = :tmmgantime,
                                        tmmpr07 = :tmmpr07,
                                        tmmpr06 = :tmmpr06,
                                        tmmpr05 = :tmmpr05,
                                        tmmpr04 = :tmmpr04,
                                        tmmpr03 = :tmmpr03,
                                        tmmprtime = :tmmprtime,
                                        tmmcidadesgan = :tmmcidadesgan WHERE tmmconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc) FROM tbtimemania)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->tmmconc}";
                            $d01proximo = "{$itemmax->tmmd01}";
                        }

                        if (isset($dat->data_proximo_concurso)) {
                            $proximosorteio = substr($dat->data_proximo_concurso, 0,10).' 20:00:00';
                        } else {
                            $diadasemana = date('w', strtotime('today'));
                            if($diadasemana == 2 || $diadasemana == 4 || $diadasemana == 1){
                                $proximosorteio = date('Y/m/d', strtotime('+2 days')).' 20:00:00';
                            } else if($diadasemana == 6) {
                                $proximosorteio = date('Y/m/d', strtotime('+3 days')).' 20:00:00';
                            } else {
                                $proximosorteio = date('Y/m/d', strtotime('+1 days')).' 20:00:00';
                            }
                        }

                        if($dat->valor_estimado_proximo_concurso != 0){
                            $premioestimadoprox = number_format($dat->valor_estimado_proximo_concurso, 2,",",".");
                        } else {
                            $premioestimadoprox = "Aguardando...";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'tmmconc' => $conc+1,
                                        'tmmdata' => $proximosorteio,
                                        'tmmlocal' => 'SÃO PAULO, SP',
                                        'tmmpremioest' => $premioestimadoprox,
                                        'tmmd01' => 0,
                                        'tmmd02' => 0,
                                        'tmmd03' => 0,
                                        'tmmd04' => 0,
                                        'tmmd05' => 0,
                                        'tmmd06' => 0,
                                        'tmmd07' => 0,
                                        'tmmgan07' => 0,
                                        'tmmgan06' => 0,
                                        'tmmgan05' => 0,
                                        'tmmgan04' => 0,
                                        'tmmgan03' => 0 ];
                            $sql = "INSERT INTO tbtimemania SET 
                                            tmmconc = :tmmconc,
                                            tmmdata = :tmmdata,
                                            tmmlocal = :tmmlocal,
                                            tmmpremioest = :tmmpremioest, 
                                            tmmd01 = :tmmd01,
                                            tmmd02 = :tmmd02,
                                            tmmd03 = :tmmd03,
                                            tmmd04 = :tmmd04,
                                            tmmd05 = :tmmd05,
                                            tmmd06 = :tmmd06,
                                            tmmd07 = :tmmd07,
                                            tmmgan07 = :tmmgan07,
                                            tmmgan06 = :tmmgan06,
                                            tmmgan05 = :tmmgan05,
                                            tmmgan04 = :tmmgan04,
                                            tmmgan03 = :tmmgan03";            
                            $result = $conection->insert($sql,$binds);
                        //atualizar premio estimado
                        } else if($conc != $concproximo && $d01proximo == 0){ 
                            $codconclast = $conc+1;
                            $binds = [  'tmmpremioest' => $premioestimadoprox ];
                            $sql = "UPDATE tbtimemania SET
                                        tmmpremioest = :tmmpremioest WHERE tmmconc = $codconclast"; 
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
            echo "<div class='painel-titulo-timemania'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idtimemania' => 0];
               $sql = "SELECT * FROM tbtimemania WHERE idtimemania > :idtimemania ORDER BY idtimemania DESC LIMIT 20";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>Time</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->tmmconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->tmmconc}"."</td>";
                            echo "<td width='150'>"."{$item->tmmdata}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd01}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd02}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd03}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd04}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd05}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd06}"."</td>";
                            echo "<td width='30'>"."{$item->tmmd07}"."</td>";
                            echo "<td width='30'>"."{$item->tmmdtime}"."</td>";
                            echo "<td><a href='admpainel.php?m=timemania&t=atualizardezenas&idconc="."{$item->idtimemania}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=timemania&t=excluirresultado&idconc="."{$item->idtimemania}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

