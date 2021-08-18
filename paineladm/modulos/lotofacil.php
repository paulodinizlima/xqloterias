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
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=lotofacil&token=DNqXJmcth70uxIy&concurso=".$codconc);
    } else {
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=lotofacil&token=DNqXJmcth70uxIy&concurso=0");
    }
    
    $dat = json_decode($json);
    //var_dump($dat);
    $qtdcidades = count($dat->local_ganhadores);
    $cidades = "";
    if(isset($dat->local_ganhadores[0]->local)){
        $cidades = $dat->local_ganhadores[0]->local."(".$dat->local_ganhadores[0]->quantidade_ganhadores.")";
    }

    switch($tela){
        case 'cadastrardezenas':
            echo "<div class='div-left'>
                <div class='painel-titulo-lotofacil'>Lotofácil - Cadastro de Dezenas</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='lflocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='d08' type='text' placeholder='Dezena 08'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d09' type='text' placeholder='Dezena 09'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d10' type='text' placeholder='Dezena 10'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d11' type='text' placeholder='Dezena 11'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d12' type='text' placeholder='Dezena 12'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d13' type='text' placeholder='Dezena 13'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d14' type='text' placeholder='Dezena 14'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d15' type='text' placeholder='Dezena 15'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan15' type='text' placeholder='Ganhadores 15'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan14' type='text' placeholder='Ganhadores 14'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan13' type='text' placeholder='Ganhadores 13'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan12' type='text' placeholder='Ganhadores 12'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan11' type='text' placeholder='Ganhadores 11'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr15' type='text' placeholder='Premiação 15'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr14' type='text' placeholder='Premiação 14'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr13' type='text' placeholder='Premiação 13'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr12' type='text' placeholder='Premiação 12'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr11' type='text' placeholder='Premiação 11'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnlotofacil'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $lflocal = filter_input(INPUT_POST, 'lflocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $d08 = filter_input(INPUT_POST, 'd08', FILTER_SANITIZE_STRING);
                    $d09 = filter_input(INPUT_POST, 'd09', FILTER_SANITIZE_STRING);
                    $d10 = filter_input(INPUT_POST, 'd10', FILTER_SANITIZE_STRING);
                    $d11 = filter_input(INPUT_POST, 'd11', FILTER_SANITIZE_STRING);
                    $d12 = filter_input(INPUT_POST, 'd12', FILTER_SANITIZE_STRING);
                    $d13 = filter_input(INPUT_POST, 'd13', FILTER_SANITIZE_STRING);
                    $d14 = filter_input(INPUT_POST, 'd14', FILTER_SANITIZE_STRING);
                    $d15 = filter_input(INPUT_POST, 'd15', FILTER_SANITIZE_STRING);
                    $gan15 = filter_input(INPUT_POST, 'gan15', FILTER_SANITIZE_STRING);
                    $gan14 = filter_input(INPUT_POST, 'gan14', FILTER_SANITIZE_STRING);
                    $gan13 = filter_input(INPUT_POST, 'gan13', FILTER_SANITIZE_STRING);
                    $gan12 = filter_input(INPUT_POST, 'gan12', FILTER_SANITIZE_STRING);
                    $gan11 = filter_input(INPUT_POST, 'gan11', FILTER_SANITIZE_STRING);
                    $pr15 = filter_input(INPUT_POST, 'pr15', FILTER_SANITIZE_STRING);
                    $pr14 = filter_input(INPUT_POST, 'pr14', FILTER_SANITIZE_STRING);
                    $pr13 = filter_input(INPUT_POST, 'pr13', FILTER_SANITIZE_STRING);
                    $pr12 = filter_input(INPUT_POST, 'pr12', FILTER_SANITIZE_STRING);
                    $pr11 = filter_input(INPUT_POST, 'pr11', FILTER_SANITIZE_STRING);
                    $lfcidadesgan = filter_input(INPUT_POST, 'lfcidadesgan', FILTER_SANITIZE_STRING);
                    
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'lfconc' => $conc,
                                    'lfdata' => $data,
                                    'lflocal' => $lflocal,
                                    'lfpremioest' => $premioest,
                                    'lfd01' => $d01,
                                    'lfd02' => $d02,
                                    'lfd03' => $d03,
                                    'lfd04' => $d04,
                                    'lfd05' => $d05,
                                    'lfd06' => $d06,
                                    'lfd07' => $d07,
                                    'lfd08' => $d08,
                                    'lfd09' => $d09,
                                    'lfd10' => $d10,
                                    'lfd11' => $d11,
                                    'lfd12' => $d12,
                                    'lfd13' => $d13,
                                    'lfd14' => $d14,
                                    'lfd15' => $d15,
                                    'lfgan15' => $gan15,
                                    'lfgan14' => $gan14,
                                    'lfgan13' => $gan13,
                                    'lfgan12' => $gan12,
                                    'lfgan11' => $gan11,
                                    'lfpr15' => $pr15,
                                    'lfpr14' => $pr14,
                                    'lfpr13' => $pr13,
                                    'lfpr12' => $pr12,
                                    'lfpr11' => $pr11,
                                    'lfcidadesgan' => $lfcidadesgan ];
                        $sql = "INSERT INTO tblotofacil SET 
                                        lfconc = :lfconc,
                                        lfdata = :lfdata,
                                        lflocal = :lflocal,
                                        lfpremioest = :lfpremioest,
                                        lfd01 = :lfd01,
                                        lfd02 = :lfd02,
                                        lfd03 = :lfd03,
                                        lfd04 = :lfd04,
                                        lfd05 = :lfd05,
                                        lfd06 = :lfd06,
                                        lfd07 = :lfd07,
                                        lfd08 = :lfd08,
                                        lfd09 = :lfd09,
                                        lfd10 = :lfd10,
                                        lfd11 = :lfd11,
                                        lfd12 = :lfd12,
                                        lfd13 = :lfd13,
                                        lfd14 = :lfd14,
                                        lfd15 = :lfd15,
                                        lfgan15 = :lfgan15,
                                        lfgan14 = :lfgan14,
                                        lfgan13 = :lfgan13,
                                        lfgan12 = :lfgan12,
                                        lfgan11 = :lfgan11,
                                        lfpr15 = :lfpr15,
                                        lfpr14 = :lfpr14,
                                        lfpr13 = :lfpr13,
                                        lfpr12 = :lfpr12,
                                        lfpr11 = :lfpr11,
                                        lfcidadesgan = :lfcidadesgan";                
                        $result = $conection->insert($sql,$binds);
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    }  

        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-lotofacil'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idlotofacil' => 0];
               $sql = "SELECT * FROM tblotofacil WHERE idlotofacil > :idlotofacil ORDER BY idlotofacil DESC LIMIT 25";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                    $sql2 = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
                    $resultmax = $conection->select($sql2,$binds);
                    $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                    foreach($dadosmax as $itemmax){
                        $concproximo = "{$itemmax->lfconc}";
                        $d01proximo = "{$itemmax->lfd01}";
                    }
                //-------------------------------------------------------------------**
                    
               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Conc</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='35'>"."<strong>{$item->lfconc}</strong>"."</td>";
                            echo "<td width='40' align='center'>"."{$item->lfconc}"."</td>";
                            echo "<td width='150'>"."{$item->lfdata}"."</td>";
                            echo "<td width='20'>"."{$item->lfd01}"."</td>";
                            echo "<td width='20'>"."{$item->lfd02}"."</td>";
                            echo "<td width='20'>"."{$item->lfd03}"."</td>";
                            echo "<td width='20'>"."{$item->lfd04}"."</td>";
                            echo "<td width='20'>"."{$item->lfd05}"."</td>";
                            echo "<td width='20'>"."{$item->lfd06}"."</td>";
                            echo "<td width='20'>"."{$item->lfd07}"."</td>";
                            echo "<td width='20'>"."{$item->lfd08}"."</td>";
                            echo "<td width='20'>"."{$item->lfd09}"."</td>";
                            echo "<td width='20'>"."{$item->lfd10}"."</td>";
                            echo "<td width='20'>"."{$item->lfd11}"."</td>";
                            echo "<td width='20'>"."{$item->lfd12}"."</td>";
                            echo "<td width='20'>"."{$item->lfd13}"."</td>";
                            echo "<td width='20'>"."{$item->lfd14}"."</td>";
                            echo "<td width='20'>"."{$item->lfd15}"."</td>";
                            echo "<td><a href='admpainel.php?m=lotofacil&t=atualizardezenas&idconc="."{$item->idlotofacil}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=lotofacil&t=excluirresultado&idconc="."{$item->idlotofacil}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idlotofacil' => 0];
            $sql = "SELECT * FROM tblotofacil WHERE idlotofacil = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                <div class='painel-titulo-lotofacil'>Lotofácil - Atualizar</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' value=".$dat->numero_concurso." />
                </div><div class='formlabel'>conc</div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->lfdata)).' 20:00:00'."' />
                </div><div class='formlabel'>data</div>
                <div class='form-group'>
                    <input class='form-control' name='lflocal' type='text' value='".$item->lflocal."' />
                </div><div class='formlabel'>local</div>
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='text' value='".$item->lfpremioest."' />
                </div><div class='formlabel'>prest</div>";

                //15 dezenas
                echo "<div class='form-group'>
                        <input class='form-control' name='d01' type='text' value='".$dat->dezenas[0]."'/>
                      </div><div class='formlabel'>D01</div>
                      <div class='form-group'>
                        <input class='form-control' name='d02' type='text' value='".$dat->dezenas[1]."'/>
                      </div><div class='formlabel'>D02</div>
                      <div class='form-group'>
                        <input class='form-control' name='d03' type='text' value='".$dat->dezenas[2]."'/>
                      </div><div class='formlabel'>D03</div>
                      <div class='form-group'>
                        <input class='form-control' name='d04' type='text' value='".$dat->dezenas[3]."'/>
                      </div><div class='formlabel'>D04</div>
                      <div class='form-group'>
                        <input class='form-control' name='d05' type='text' value='".$dat->dezenas[4]."'/>
                      </div><div class='formlabel'>D05</div>
                      <div class='form-group'>
                        <input class='form-control' name='d06' type='text' value='".$dat->dezenas[5]."'/>
                      </div><div class='formlabel'>D06</div>
                      <div class='form-group'>
                        <input class='form-control' name='d07' type='text' value='".$dat->dezenas[6]."'/>
                      </div><div class='formlabel'>D07</div>
                      <div class='form-group'>
                        <input class='form-control' name='d08' type='text' value='".$dat->dezenas[7]."'/>
                      </div><div class='formlabel'>D08</div>
                      <div class='form-group'>
                        <input class='form-control' name='d09' type='text' value='".$dat->dezenas[8]."'/>
                      </div><div class='formlabel'>D09</div>
                      <div class='form-group'>
                        <input class='form-control' name='d10' type='text' value='".$dat->dezenas[9]."'/>
                      </div><div class='formlabel'>D10</div>
                      <div class='form-group'>
                        <input class='form-control' name='d11' type='text' value='".$dat->dezenas[10]."'/>
                      </div><div class='formlabel'>D11</div>
                      <div class='form-group'>
                        <input class='form-control' name='d12' type='text' value='".$dat->dezenas[11]."'/>
                      </div><div class='formlabel'>D12</div>
                      <div class='form-group'>
                        <input class='form-control' name='d13' type='text' value='".$dat->dezenas[12]."'/>
                      </div><div class='formlabel'>D13</div>
                      <div class='form-group'>
                        <input class='form-control' name='d14' type='text' value='".$dat->dezenas[13]."'/>
                      </div><div class='formlabel'>D14</div>
                      <div class='form-group'>
                        <input class='form-control' name='d15' type='text' value='".$dat->dezenas[14]."'/>
                      </div><div class='formlabel'>D15</div>";
                               
          echo "<div class='form-group'>
                    <input class='form-control' name='gan15' type='text' value='".number_format($dat->premiacao[0]->quantidade_ganhadores, 0,",",".")."' />
                </div><div class='formlabel'>Gan15</div>
                <div class='form-group'>
                    <input class='form-control' name='gan14' type='text' value='".number_format($dat->premiacao[1]->quantidade_ganhadores, 0,",",".")."' />
                </div><div class='formlabel'>Gan14</div>
                <div class='form-group'>
                    <input class='form-control' name='gan13' type='text' value='".number_format($dat->premiacao[2]->quantidade_ganhadores, 0,",",".")."' />
                </div><div class='formlabel'>Gan13</div>
                <div class='form-group'>
                    <input class='form-control' name='gan12' type='text' value='".number_format($dat->premiacao[3]->quantidade_ganhadores, 0,",",".")."' />
                </div><div class='formlabel'>Gan12</div>
                <div class='form-group'>
                    <input class='form-control' name='gan11' type='text' value='".number_format($dat->premiacao[4]->quantidade_ganhadores, 0,",",".")."' />
                </div><div class='formlabel'>Gan11</div>";

          echo "<div class='form-group'>
                    <input class='form-control' name='pr15' type='text' value='".number_format($dat->premiacao[0]->valor_total, 2,",",".")."' />
                </div><div class='formlabel'>Pre15</div>
                <div class='form-group'>
                    <input class='form-control' name='pr14' type='text' value='".number_format($dat->premiacao[1]->valor_total, 2,",",".")."' />
                </div><div class='formlabel'>Pre14</div>
                <div class='form-group'>
                    <input class='form-control' name='pr13' type='text' value='".number_format($dat->premiacao[2]->valor_total, 2,",",".")."' />
                </div><div class='formlabel'>Pre13</div>
                <div class='form-group'>
                    <input class='form-control' name='pr12' type='text' value='".number_format($dat->premiacao[3]->valor_total, 2,",",".")."' />
                </div><div class='formlabel'>Pre12</div>
                <div class='form-group'>
                    <input class='form-control' name='pr11' type='text' value='".number_format($dat->premiacao[4]->valor_total, 2,",",".")."' />
                </div><div class='formlabel'>Pre11</div>";
                
                for ($i=1; $i < $qtdcidades; $i++) { 
                    $cidades.=", ".$dat->local_ganhadores[$i]->local."(".$dat->local_ganhadores[$i]->quantidade_ganhadores.")";
                }
                
                if(isset($dat->local_ganhadores[0]->local)){
                    echo "<div class='form-group'>
                            <input class='form-control' name='lfcidadesgan' type='text' value='".$cidades."' />
                          </div><div class='formlabel'>Cidades</div>";
                } else {
                    echo "<div class='form-group'>
                            <input class='form-control' name='lfcidadesgan' type='text' value='".$item->lfcidadesgan."' />
                          </div><div class='formlabel'>Cidades</div>";                
                }

                echo "<div class='form-group'>   
                        <button type='submit' id='btnlotofacil'><span>Atualizar</span></button>    
                      </div>
                </form>";
            }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $lflocal = filter_input(INPUT_POST, 'lflocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $d08 = filter_input(INPUT_POST, 'd08', FILTER_SANITIZE_STRING);
                    $d09 = filter_input(INPUT_POST, 'd09', FILTER_SANITIZE_STRING);
                    $d10 = filter_input(INPUT_POST, 'd10', FILTER_SANITIZE_STRING);
                    $d11 = filter_input(INPUT_POST, 'd11', FILTER_SANITIZE_STRING);
                    $d12 = filter_input(INPUT_POST, 'd12', FILTER_SANITIZE_STRING);
                    $d13 = filter_input(INPUT_POST, 'd13', FILTER_SANITIZE_STRING);
                    $d14 = filter_input(INPUT_POST, 'd14', FILTER_SANITIZE_STRING);
                    $d15 = filter_input(INPUT_POST, 'd15', FILTER_SANITIZE_STRING);
                    $gan15 = filter_input(INPUT_POST, 'gan15', FILTER_SANITIZE_STRING);
                    if($gan15 == "0"){$gan15 = "-";}
                    $gan14 = filter_input(INPUT_POST, 'gan14', FILTER_SANITIZE_STRING);
                    if($gan14 == "0"){$gan14 = "-";}
                    $gan13 = filter_input(INPUT_POST, 'gan13', FILTER_SANITIZE_STRING);
                    if($gan13 == "0"){$gan13 = "-";}
                    $gan12 = filter_input(INPUT_POST, 'gan12', FILTER_SANITIZE_STRING);
                    if($gan12 == "0"){$gan12 = "-";}
                    $gan11 = filter_input(INPUT_POST, 'gan11', FILTER_SANITIZE_STRING);
                    if($gan11 == "0"){$gan11 = "-";}
                    $pr15 = filter_input(INPUT_POST, 'pr15', FILTER_SANITIZE_STRING);
                    $pr14 = filter_input(INPUT_POST, 'pr14', FILTER_SANITIZE_STRING);
                    $pr13 = filter_input(INPUT_POST, 'pr13', FILTER_SANITIZE_STRING);
                    $pr12 = filter_input(INPUT_POST, 'pr12', FILTER_SANITIZE_STRING);
                    $pr11 = filter_input(INPUT_POST, 'pr11', FILTER_SANITIZE_STRING);
                    $lfcidadesgan = filter_input(INPUT_POST, 'lfcidadesgan', FILTER_SANITIZE_STRING);
                    
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'lfconc' => $conc,
                                    'lfdata' => $data,
                                    'lflocal' => $lflocal,
                                    'lfpremioest' => $premioest,
                                    'lfd01' => $d01,
                                    'lfd02' => $d02,
                                    'lfd03' => $d03,
                                    'lfd04' => $d04,
                                    'lfd05' => $d05,
                                    'lfd06' => $d06,
                                    'lfd07' => $d07,
                                    'lfd08' => $d08,
                                    'lfd09' => $d09,
                                    'lfd10' => $d10,
                                    'lfd11' => $d11,
                                    'lfd12' => $d12,
                                    'lfd13' => $d13,
                                    'lfd14' => $d14,
                                    'lfd15' => $d15,
                                    'lfgan15' => $gan15,
                                    'lfgan14' => $gan14,
                                    'lfgan13' => $gan13,
                                    'lfgan12' => $gan12,
                                    'lfgan11' => $gan11,
                                    'lfpr15' => $pr15,
                                    'lfpr14' => $pr14,
                                    'lfpr13' => $pr13,
                                    'lfpr12' => $pr12,
                                    'lfpr11' => $pr11,
                                    'lfcidadesgan' => $lfcidadesgan ];
                        $sql = "UPDATE tblotofacil SET
                                        lfconc = :lfconc,
                                        lfdata = :lfdata,
                                        lflocal = :lflocal,
                                        lfpremioest = :lfpremioest,
                                        lfd01 = :lfd01,
                                        lfd02 = :lfd02,
                                        lfd03 = :lfd03,
                                        lfd04 = :lfd04,
                                        lfd05 = :lfd05,
                                        lfd06 = :lfd06,
                                        lfd07 = :lfd07,
                                        lfd08 = :lfd08,
                                        lfd09 = :lfd09,
                                        lfd10 = :lfd10,
                                        lfd11 = :lfd11,
                                        lfd12 = :lfd12,
                                        lfd13 = :lfd13,
                                        lfd14 = :lfd14,
                                        lfd15 = :lfd15,
                                        lfgan15 = :lfgan15,
                                        lfgan14 = :lfgan14,
                                        lfgan13 = :lfgan13,
                                        lfgan12 = :lfgan12,
                                        lfgan11 = :lfgan11,
                                        lfpr15 = :lfpr15,
                                        lfpr14 = :lfpr14,
                                        lfpr13 = :lfpr13,
                                        lfpr12 = :lfpr12,
                                        lfpr11 = :lfpr11,
                                        lfcidadesgan = :lfcidadesgan WHERE lfconc = $codconc";                 
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                        //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->lfconc}";
                            $d01proximo = "{$itemmax->lfd01}";
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
                            $binds = [  'lfconc' => $conc+1,
                                        'lfdata' => $proximosorteio,
                                        'lflocal' => 'SÃO PAULO, SP',
                                        'lfpremioest' => $premioestimadoprox,
                                        'lfd01' => 0,
                                        'lfd02' => 0,
                                        'lfd03' => 0,
                                        'lfd04' => 0,
                                        'lfd05' => 0,
                                        'lfd06' => 0,
                                        'lfd07' => 0,
                                        'lfd08' => 0,
                                        'lfd09' => 0,
                                        'lfd10' => 0,
                                        'lfd11' => 0,
                                        'lfd12' => 0,
                                        'lfd13' => 0,
                                        'lfd14' => 0,
                                        'lfd15' => 0,
                                        'lfgan15' => 0,
                                        'lfgan14' => 0,
                                        'lfgan13' => 0,
                                        'lfgan12' => 0,
                                        'lfgan11' => 0 ];
                            $sql = "INSERT INTO tblotofacil SET 
                                            lfconc = :lfconc,
                                            lfdata = :lfdata,
                                            lflocal = :lflocal,
                                            lfpremioest = :lfpremioest, 
                                            lfd01 = :lfd01,
                                            lfd02 = :lfd02,
                                            lfd03 = :lfd03,
                                            lfd04 = :lfd04,
                                            lfd05 = :lfd05,
                                            lfd06 = :lfd06,
                                            lfd07 = :lfd07,
                                            lfd08 = :lfd08,
                                            lfd09 = :lfd09,
                                            lfd10 = :lfd10,
                                            lfd11 = :lfd11,
                                            lfd12 = :lfd12,
                                            lfd13 = :lfd13,
                                            lfd14 = :lfd14,
                                            lfd15 = :lfd15,
                                            lfgan15 = :lfgan15,
                                            lfgan14 = :lfgan14,
                                            lfgan13 = :lfgan13,
                                            lfgan12 = :lfgan12,
                                            lfgan11 = :lfgan11";            
                            $result = $conection->insert($sql,$binds);
                        //atualizar premio estimado
                        } else if($conc != $concproximo && $d01proximo == 0){ 
                            $codconclast = $conc+1;
                            $binds = [  'lfpremioest' => $premioestimadoprox ];
                            $sql = "UPDATE tblotofacil SET
                                        lfpremioest = :lfpremioest WHERE lfconc = $codconclast"; 
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
            echo "<div class='painel-titulo-lotofacil'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idlotofacil' => 0];
               $sql = "SELECT * FROM tblotofacil WHERE idlotofacil > :idlotofacil ORDER BY idlotofacil DESC LIMIT 25";
               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Conc</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='35'>"."<strong>{$item->lfconc}</strong>"."</td>";
                            echo "<td width='40' align='center'>"."{$item->lfconc}"."</td>";
                            echo "<td width='150'>"."{$item->lfdata}"."</td>";
                            echo "<td width='20'>"."{$item->lfd01}"."</td>";
                            echo "<td width='20'>"."{$item->lfd02}"."</td>";
                            echo "<td width='20'>"."{$item->lfd03}"."</td>";
                            echo "<td width='20'>"."{$item->lfd04}"."</td>";
                            echo "<td width='20'>"."{$item->lfd05}"."</td>";
                            echo "<td width='20'>"."{$item->lfd06}"."</td>";
                            echo "<td width='20'>"."{$item->lfd07}"."</td>";
                            echo "<td width='20'>"."{$item->lfd08}"."</td>";
                            echo "<td width='20'>"."{$item->lfd09}"."</td>";
                            echo "<td width='20'>"."{$item->lfd10}"."</td>";
                            echo "<td width='20'>"."{$item->lfd11}"."</td>";
                            echo "<td width='20'>"."{$item->lfd12}"."</td>";
                            echo "<td width='20'>"."{$item->lfd13}"."</td>";
                            echo "<td width='20'>"."{$item->lfd14}"."</td>";
                            echo "<td width='20'>"."{$item->lfd15}"."</td>";
                            echo "<td><a href='admpainel.php?m=lotofacil&t=atualizardezenas&idconc="."{$item->idlotofacil}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=lotofacil&t=excluirresultado&idconc="."{$item->idlotofacil}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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