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
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=lotomania&token=DNqXJmcth70uxIy&concurso=".$codconc);
    } else {
        $json = file_get_contents("https://apiloterias.com.br/app/resultado?loteria=lotomania&token=DNqXJmcth70uxIy&concurso=0");
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
                <div class='painel-titulo-lotomania'>Lotomania - Cadastro </div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ltmlocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='d16' type='text' placeholder='Dezena 16'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d17' type='text' placeholder='Dezena 17'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d18' type='text' placeholder='Dezena 18'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d19' type='text' placeholder='Dezena 19'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='d20' type='text' placeholder='Dezena 20'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan20' type='text' placeholder='Ganhadores 20'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan19' type='text' placeholder='Ganhadores 19'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan18' type='text' placeholder='Ganhadores 18'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan17' type='text' placeholder='Ganhadores 17'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan16' type='text' placeholder='Ganhadores 16'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan15' type='text' placeholder='Ganhadores 15'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan00' type='text' placeholder='Ganhadores 00'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr20' type='text' placeholder='Premiação 20'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr19' type='text' placeholder='Premiação 19'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr18' type='text' placeholder='Premiação 18'>
                </div>  
                <div class='form-group'>
                    <input class='form-control' name='pr17' type='text' placeholder='Premiação 17'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr16' type='text' placeholder='Premiação 16'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr15' type='text' placeholder='Premiação 15'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr00' type='text' placeholder='Premiação 00'>
                </div>               
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnlotomania'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $ltmlocal = filter_input(INPUT_POST, 'ltmlocal', FILTER_SANITIZE_STRING);
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
                    $d16 = filter_input(INPUT_POST, 'd16', FILTER_SANITIZE_STRING);
                    $d17 = filter_input(INPUT_POST, 'd17', FILTER_SANITIZE_STRING);
                    $d18 = filter_input(INPUT_POST, 'd18', FILTER_SANITIZE_STRING);
                    $d19 = filter_input(INPUT_POST, 'd19', FILTER_SANITIZE_STRING);
                    $d20 = filter_input(INPUT_POST, 'd20', FILTER_SANITIZE_STRING);
                    $gan20 = filter_input(INPUT_POST, 'gan20', FILTER_SANITIZE_STRING);
                    $gan19 = filter_input(INPUT_POST, 'gan19', FILTER_SANITIZE_STRING);
                    $gan18 = filter_input(INPUT_POST, 'gan18', FILTER_SANITIZE_STRING);
                    $gan17 = filter_input(INPUT_POST, 'gan17', FILTER_SANITIZE_STRING);
                    $gan16 = filter_input(INPUT_POST, 'gan16', FILTER_SANITIZE_STRING);
                    $gan15 = filter_input(INPUT_POST, 'gan15', FILTER_SANITIZE_STRING);
                    $gan00 = filter_input(INPUT_POST, 'gan00', FILTER_SANITIZE_STRING);
                    $pr20 = filter_input(INPUT_POST, 'pr20', FILTER_SANITIZE_STRING);
                    $pr19 = filter_input(INPUT_POST, 'pr19', FILTER_SANITIZE_STRING);
                    $pr18 = filter_input(INPUT_POST, 'pr18', FILTER_SANITIZE_STRING);
                    $pr17 = filter_input(INPUT_POST, 'pr17', FILTER_SANITIZE_STRING);
                    $pr16 = filter_input(INPUT_POST, 'pr16', FILTER_SANITIZE_STRING);
                    $pr15 = filter_input(INPUT_POST, 'pr15', FILTER_SANITIZE_STRING);
                    $pr00 = filter_input(INPUT_POST, 'pr00', FILTER_SANITIZE_STRING);
                    $ltmcidadesgan = filter_input(INPUT_POST, 'ltmcidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'ltmconc' => $conc,
                                    'ltmdata' => $data,
                                    'ltmlocal' => $ltmlocal,
                                    'ltmpremioest' => $premioest,
                                    'ltmd01' => $d01,
                                    'ltmd02' => $d02,
                                    'ltmd03' => $d03,
                                    'ltmd04' => $d04,
                                    'ltmd05' => $d05,
                                    'ltmd06' => $d06,
                                    'ltmd07' => $d07,
                                    'ltmd08' => $d08,
                                    'ltmd09' => $d09,
                                    'ltmd10' => $d10,
                                    'ltmd11' => $d11,
                                    'ltmd12' => $d12,
                                    'ltmd13' => $d13,
                                    'ltmd14' => $d14,
                                    'ltmd15' => $d15,
                                    'ltmd16' => $d16,
                                    'ltmd17' => $d17,
                                    'ltmd18' => $d18,
                                    'ltmd19' => $d19,
                                    'ltmd20' => $d20,
                                    'ltmgan20' => $gan20,
                                    'ltmgan19' => $gan19,
                                    'ltmgan18' => $gan18,
                                    'ltmgan17' => $gan17,
                                    'ltmgan16' => $gan16,
                                    'ltmgan15' => $gan15,
                                    'ltmgan00' => $gan00,
                                    'ltmpr20' => $pr20,
                                    'ltmpr19' => $pr19,
                                    'ltmpr18' => $pr18,
                                    'ltmpr17' => $pr17,
                                    'ltmpr16' => $pr16,
                                    'ltmpr15' => $pr15,
                                    'ltmpr00' => $pr00,
                                    'ltmcidadesgan' => $ltmcidadesgan ];
                        $sql = "INSERT INTO tblotomania SET 
                                        ltmconc = :ltmconc,
                                        ltmdata = :ltmdata,
                                        ltmlocal = :ltmlocal,
                                        ltmpremioest = :ltmpremioest,
                                        ltmd01 = :ltmd01,
                                        ltmd02 = :ltmd02,
                                        ltmd03 = :ltmd03,
                                        ltmd04 = :ltmd04,
                                        ltmd05 = :ltmd05,
                                        ltmd06 = :ltmd06,
                                        ltmd07 = :ltmd07,
                                        ltmd08 = :ltmd08,
                                        ltmd09 = :ltmd09,
                                        ltmd10 = :ltmd10,
                                        ltmd11 = :ltmd11,
                                        ltmd12 = :ltmd12,
                                        ltmd13 = :ltmd13,
                                        ltmd14 = :ltmd14,
                                        ltmd15 = :ltmd15,
                                        ltmd16 = :ltmd16,
                                        ltmd17 = :ltmd17,
                                        ltmd18 = :ltmd18,
                                        ltmd19 = :ltmd19,
                                        ltmd20 = :ltmd20,
                                        ltmgan20 = :ltmgan20,
                                        ltmgan19 = :ltmgan19,
                                        ltmgan18 = :ltmgan18,
                                        ltmgan17 = :ltmgan17,
                                        ltmgan16 = :ltmgan16,
                                        ltmgan15 = :ltmgan15,
                                        ltmgan00 = :ltmgan00,
                                        ltmpr20 = :ltmpr20,
                                        ltmpr19 = :ltmpr19,
                                        ltmpr18 = :ltmpr18,
                                        ltmpr17 = :ltmpr17,
                                        ltmpr16 = :ltmpr16,
                                        ltmpr15 = :ltmpr15,
                                        ltmpr00 = :ltmpr00,
                                        ltmcidadesgan = :ltmcidadesgan";                
                        $result = $conection->insert($sql,$binds);                      
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-lotomania'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idlotomania' => 0];
               $sql = "SELECT * FROM tblotomania WHERE idlotomania > :idlotomania ORDER BY idlotomania DESC LIMIT 30";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc) FROM tblotomania)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->ltmconc}";
                    $d01proximo = "{$itemmax->ltmd01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Conc</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='35'>"."<strong>{$item->ltmconc}</strong>"."</td>";
                            echo "<td width='40' align='center'>"."{$item->ltmconc}"."</td>";
                            echo "<td width='120'><span class='texto-12'>"."{$item->ltmdata}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd01}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd02}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd03}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd04}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd05}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd06}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd07}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd08}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd09}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd10}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd11}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd12}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd13}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd14}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd15}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd16}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd17}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd18}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd19}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd20}"."</span></td>";
                            echo "<td><a href='admpainel.php?m=lotomania&t=atualizardezenas&idconc="."{$item->idlotomania}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=lotomania&t=excluirresultado&idconc="."{$item->idlotomania}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idlotomania' => 0];
            $sql = "SELECT * FROM tblotomania WHERE idlotomania = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                <div class='painel-titulo-lotomania'>Lotomania - Atualização</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' value=".$dat->numero_concurso." />
                </div><div class='formlabel'>conc</div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->ltmdata)).' 20:00:00'."' />
                </div><div class='formlabel'>data</div>
                <div class='form-group'>
                    <input class='form-control' name='ltmlocal' type='text' value='".$item->ltmlocal."' />
                </div><div class='formlabel'>local</div>                        
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='text' value='".$item->ltmpremioest."' />
                </div><div class='formlabel'>prest</div>";

                //20 dezenas
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
                            <input class='form-control' name='d08' type='text' value='".$dat->dezenas[7]."' />
                        </div><div class='formlabel'>d08</div>
                        <div class='form-group'>
                            <input class='form-control' name='d09' type='text' value='".$dat->dezenas[8]."' />
                        </div><div class='formlabel'>d09</div>
                        <div class='form-group'>
                            <input class='form-control' name='d10' type='text' value='".$dat->dezenas[9]."' />
                        </div><div class='formlabel'>d10</div>
                        <div class='form-group'>
                            <input class='form-control' name='d11' type='text' value='".$dat->dezenas[10]."' />
                        </div><div class='formlabel'>d11</div>
                        <div class='form-group'>
                            <input class='form-control' name='d12' type='text' value='".$dat->dezenas[11]."' />
                        </div><div class='formlabel'>d12</div>
                        <div class='form-group'>
                            <input class='form-control' name='d13' type='text' value='".$dat->dezenas[12]."' />
                        </div><div class='formlabel'>d13</div>
                        <div class='form-group'>
                            <input class='form-control' name='d14' type='text' value='".$dat->dezenas[13]."' />
                        </div><div class='formlabel'>d14</div>
                        <div class='form-group'>
                            <input class='form-control' name='d15' type='text' value='".$dat->dezenas[14]."' />
                        </div><div class='formlabel'>d15</div>
                        <div class='form-group'>
                            <input class='form-control' name='d16' type='text' value='".$dat->dezenas[15]."' />
                        </div><div class='formlabel'>d16</div>
                        <div class='form-group'>
                            <input class='form-control' name='d17' type='text' value='".$dat->dezenas[16]."' />
                        </div><div class='formlabel'>d17</div>
                        <div class='form-group'>
                            <input class='form-control' name='d18' type='text' value='".$dat->dezenas[17]."' />
                        </div><div class='formlabel'>d18</div>
                        <div class='form-group'>
                            <input class='form-control' name='d19' type='text' value='".$dat->dezenas[18]."' />
                        </div><div class='formlabel'>d19</div>
                        <div class='form-group'>
                            <input class='form-control' name='d20' type='text' value='".$dat->dezenas[19]."' />
                        </div><div class='formlabel'>d20</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='gan20' type='text' value='".number_format($dat->premiacao[0]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan20</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan19' type='text' value='".number_format($dat->premiacao[1]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan19</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan18' type='text' value='".number_format($dat->premiacao[2]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan18</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan17' type='text' value='".number_format($dat->premiacao[3]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan17</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan16' type='text' value='".number_format($dat->premiacao[4]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan16</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan15' type='text' value='".number_format($dat->premiacao[5]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan15</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan00' type='text' value='".number_format($dat->premiacao[6]->quantidade_ganhadores, 0,",",".")."' />
                        </div><div class='formlabel'>gan00</div>";

                  echo "<div class='form-group'>
                            <input class='form-control' name='pr20' type='text' value='".number_format($dat->premiacao[0]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr20</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr19' type='text' value='".number_format($dat->premiacao[1]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr19</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr18' type='text' value='".number_format($dat->premiacao[2]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr18</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr17' type='text' value='".number_format($dat->premiacao[3]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr17</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr16' type='text' value='".number_format($dat->premiacao[4]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr16</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr15' type='text' value='".number_format($dat->premiacao[5]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr15</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr00' type='text' value='".number_format($dat->premiacao[6]->valor_total, 2,",",".")."' />
                        </div><div class='formlabel'>pr00</div>";                        
                
                        for ($i=1; $i < $qtdcidades; $i++) { 
                            $cidades.=", ".$dat->local_ganhadores[$i]->local."(".$dat->local_ganhadores[$i]->quantidade_ganhadores.")";
                        }
                        
                        if(isset($dat->local_ganhadores[0]->local)){
                            echo "<div class='form-group'>
                                    <input class='form-control' name='ltmcidadesgan' type='text' value='".$cidades."' />
                                  </div><div class='formlabel'>Cidades</div>";
                        } else {
                            echo "<div class='form-group'>
                                    <input class='form-control' name='ltmcidadesgan' type='text' value='".$item->ltmcidadesgan."' />
                                  </div><div class='formlabel'>Cidades</div>";                
                        }

                        echo "<div class='form-group'>   
                                <button type='submit' id='btnlotomania'><span>Atualizar</span></button>    
                              </div>

                        </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $ltmlocal = filter_input(INPUT_POST, 'ltmlocal', FILTER_SANITIZE_STRING);
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
                    $d16 = filter_input(INPUT_POST, 'd16', FILTER_SANITIZE_STRING);
                    $d17 = filter_input(INPUT_POST, 'd17', FILTER_SANITIZE_STRING);
                    $d18 = filter_input(INPUT_POST, 'd18', FILTER_SANITIZE_STRING);
                    $d19 = filter_input(INPUT_POST, 'd19', FILTER_SANITIZE_STRING);
                    $d20 = filter_input(INPUT_POST, 'd20', FILTER_SANITIZE_STRING);
                    $gan20 = filter_input(INPUT_POST, 'gan20', FILTER_SANITIZE_STRING);
                    if($gan20 == "0"){$gan20 = "-";}
                    $gan19 = filter_input(INPUT_POST, 'gan19', FILTER_SANITIZE_STRING);
                    if($gan19 == "0"){$gan19 = "-";}
                    $gan18 = filter_input(INPUT_POST, 'gan18', FILTER_SANITIZE_STRING);
                    if($gan18 == "0"){$gan18 = "-";}
                    $gan17 = filter_input(INPUT_POST, 'gan17', FILTER_SANITIZE_STRING);
                    if($gan17 == "0"){$gan17 = "-";}
                    $gan16 = filter_input(INPUT_POST, 'gan16', FILTER_SANITIZE_STRING);
                    if($gan16 == "0"){$gan16 = "-";}
                    $gan15 = filter_input(INPUT_POST, 'gan15', FILTER_SANITIZE_STRING);
                    if($gan15 == "0"){$gan15 = "-";}
                    $gan00 = filter_input(INPUT_POST, 'gan00', FILTER_SANITIZE_STRING);
                    if($gan00 == "0"){$gan00 = "-";}
                    $pr20 = filter_input(INPUT_POST, 'pr20', FILTER_SANITIZE_STRING);
                    $pr19 = filter_input(INPUT_POST, 'pr19', FILTER_SANITIZE_STRING);
                    $pr18 = filter_input(INPUT_POST, 'pr18', FILTER_SANITIZE_STRING);
                    $pr17 = filter_input(INPUT_POST, 'pr17', FILTER_SANITIZE_STRING);
                    $pr16 = filter_input(INPUT_POST, 'pr16', FILTER_SANITIZE_STRING);
                    $pr15 = filter_input(INPUT_POST, 'pr15', FILTER_SANITIZE_STRING);
                    $pr00 = filter_input(INPUT_POST, 'pr00', FILTER_SANITIZE_STRING);
                    $ltmcidadesgan = filter_input(INPUT_POST, 'ltmcidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'ltmconc' => $conc,
                                    'ltmdata' => $data,
                                    'ltmlocal' => $ltmlocal,
                                    'ltmpremioest' => $premioest,
                                    'ltmd01' => $d01,
                                    'ltmd02' => $d02,
                                    'ltmd03' => $d03,
                                    'ltmd04' => $d04,
                                    'ltmd05' => $d05,
                                    'ltmd06' => $d06,
                                    'ltmd07' => $d07,
                                    'ltmd08' => $d08,
                                    'ltmd09' => $d09,
                                    'ltmd10' => $d10,
                                    'ltmd11' => $d11,
                                    'ltmd12' => $d12,
                                    'ltmd13' => $d13,
                                    'ltmd14' => $d14,
                                    'ltmd15' => $d15,
                                    'ltmd16' => $d16,
                                    'ltmd17' => $d17,
                                    'ltmd18' => $d18,
                                    'ltmd19' => $d19,
                                    'ltmd20' => $d20,
                                    'ltmgan20' => $gan20,
                                    'ltmgan19' => $gan19,
                                    'ltmgan18' => $gan18,
                                    'ltmgan17' => $gan17,
                                    'ltmgan16' => $gan16,
                                    'ltmgan15' => $gan15,
                                    'ltmgan00' => $gan00,
                                    'ltmpr20' => $pr20,
                                    'ltmpr19' => $pr19,
                                    'ltmpr18' => $pr18,
                                    'ltmpr17' => $pr17,
                                    'ltmpr16' => $pr16,
                                    'ltmpr15' => $pr15,
                                    'ltmpr00' => $pr00,
                                    'ltmcidadesgan' => $ltmcidadesgan ];
                        $sql = "UPDATE tblotomania SET 
                                        ltmconc = :ltmconc,
                                        ltmdata = :ltmdata,
                                        ltmlocal = :ltmlocal,
                                        ltmpremioest = :ltmpremioest,
                                        ltmd01 = :ltmd01,
                                        ltmd02 = :ltmd02,
                                        ltmd03 = :ltmd03,
                                        ltmd04 = :ltmd04,
                                        ltmd05 = :ltmd05,
                                        ltmd06 = :ltmd06,
                                        ltmd07 = :ltmd07,
                                        ltmd08 = :ltmd08,
                                        ltmd09 = :ltmd09,
                                        ltmd10 = :ltmd10,
                                        ltmd11 = :ltmd11,
                                        ltmd12 = :ltmd12,
                                        ltmd13 = :ltmd13,
                                        ltmd14 = :ltmd14,
                                        ltmd15 = :ltmd15,
                                        ltmd16 = :ltmd16,
                                        ltmd17 = :ltmd17,
                                        ltmd18 = :ltmd18,
                                        ltmd19 = :ltmd19,
                                        ltmd20 = :ltmd20,
                                        ltmgan20 = :ltmgan20,
                                        ltmgan19 = :ltmgan19,
                                        ltmgan18 = :ltmgan18,
                                        ltmgan17 = :ltmgan17,
                                        ltmgan16 = :ltmgan16,
                                        ltmgan15 = :ltmgan15,
                                        ltmgan00 = :ltmgan00,
                                        ltmpr20 = :ltmpr20,
                                        ltmpr19 = :ltmpr19,
                                        ltmpr18 = :ltmpr18,
                                        ltmpr17 = :ltmpr17,
                                        ltmpr16 = :ltmpr16,
                                        ltmpr15 = :ltmpr15,
                                        ltmpr00 = :ltmpr00,
                                        ltmcidadesgan = :ltmcidadesgan WHERE ltmconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc) FROM tblotomania)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->ltmconc}";
                            $d01proximo = "{$itemmax->ltmd01}";
                        }

                        if (isset($dat->data_proximo_concurso)) {
                            $proximosorteio = substr($dat->data_proximo_concurso, 0,10).' 20:00:00';
                        } else {
                            $diadasemana = date('w', strtotime('today'));
                            if($diadasemana == 2){
                                $proximosorteio = date('Y/m/d', strtotime('+3 days')).' 20:00:00';
                            } else if($diadasemana == 5) {
                                $proximosorteio = date('Y/m/d', strtotime('+4 days')).' 20:00:00';
                            } else {
                                $proximosorteio = date('Y/m/d', strtotime('today')).' 20:00:00';
                            }
                        }

                        if($dat->valor_estimado_proximo_concurso != 0){
                            $premioestimadoprox = number_format($dat->valor_estimado_proximo_concurso, 2,",",".");
                        } else {
                            $premioestimadoprox = "Aguardando...";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'ltmconc' => $conc+1,
                                        'ltmdata' => $proximosorteio,
                                        'ltmlocal' => 'SÃO PAULO, SP',
                                        'ltmpremioest' => $premioestimadoprox,
                                        'ltmd01' => 0,
                                        'ltmd02' => 0,
                                        'ltmd03' => 0,
                                        'ltmd04' => 0,
                                        'ltmd05' => 0,
                                        'ltmd06' => 0,
                                        'ltmd07' => 0,
                                        'ltmd08' => 0,
                                        'ltmd09' => 0,
                                        'ltmd10' => 0,
                                        'ltmd11' => 0,
                                        'ltmd12' => 0,
                                        'ltmd13' => 0,
                                        'ltmd14' => 0,
                                        'ltmd15' => 0,
                                        'ltmd16' => 0,
                                        'ltmd17' => 0,
                                        'ltmd18' => 0,
                                        'ltmd19' => 0,
                                        'ltmd20' => 0,
                                        'ltmgan20' => 0,
                                        'ltmgan19' => 0,
                                        'ltmgan18' => 0,
                                        'ltmgan17' => 0,
                                        'ltmgan16' => 0,
                                        'ltmgan15' => 0,
                                        'ltmgan00' => 0 ];
                            $sql = "INSERT INTO tblotomania SET 
                                            ltmconc = :ltmconc,
                                            ltmdata = :ltmdata,
                                            ltmlocal = :ltmlocal,
                                            ltmpremioest = :ltmpremioest, 
                                            ltmd01 = :ltmd01,
                                            ltmd02 = :ltmd02,
                                            ltmd03 = :ltmd03,
                                            ltmd04 = :ltmd04,
                                            ltmd05 = :ltmd05,
                                            ltmd06 = :ltmd06,
                                            ltmd07 = :ltmd07,
                                            ltmd08 = :ltmd08,
                                            ltmd09 = :ltmd09,
                                            ltmd10 = :ltmd10,
                                            ltmd11 = :ltmd11,
                                            ltmd12 = :ltmd12,
                                            ltmd13 = :ltmd13,
                                            ltmd14 = :ltmd14,
                                            ltmd15 = :ltmd15,
                                            ltmd16 = :ltmd16,
                                            ltmd17 = :ltmd17,
                                            ltmd18 = :ltmd18,
                                            ltmd19 = :ltmd19,
                                            ltmd20 = :ltmd20,
                                            ltmgan20 = :ltmgan20,
                                            ltmgan19 = :ltmgan19,
                                            ltmgan18 = :ltmgan18,
                                            ltmgan17 = :ltmgan17,
                                            ltmgan16 = :ltmgan16,
                                            ltmgan15 = :ltmgan15,
                                            ltmgan00 = :ltmgan00";            
                            $result = $conection->insert($sql,$binds);
                        //atualizar premio estimado
                        } else if($conc != $concproximo && $d01proximo == 0){ 
                            $codconclast = $conc+1;
                            $binds = [  'ltmpremioest' => $premioestimadoprox ];
                            $sql = "UPDATE tblotomania SET
                                        ltmpremioest = :ltmpremioest WHERE ltmconc = $codconclast"; 
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
            echo "<div class='painel-titulo-lotomania'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idlotomania' => 0];
               $sql = "SELECT * FROM tblotomania WHERE idlotomania > :idlotomania ORDER BY idlotomania DESC LIMIT 30";

               $result = $conection->select($sql,$binds);

               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Conc</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='35'>"."<strong>{$item->ltmconc}</strong>"."</td>";
                            echo "<td width='40' align='center'>"."{$item->ltmconc}"."</td>";
                            echo "<td width='120'><span class='texto-12'>"."{$item->ltmdata}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd01}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd02}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd03}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd04}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd05}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd06}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd07}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd08}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd09}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd10}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd11}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd12}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd13}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd14}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd15}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd16}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd17}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd18}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd19}"."</span></td>";
                            echo "<td width='12'><span class='texto-14'>"."{$item->ltmd20}"."</span></td>";
                            echo "<td><a href='admpainel.php?m=lotomania&t=atualizardezenas&idconc="."{$item->idlotomania}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=lotomania&t=excluirresultado&idconc="."{$item->idlotomania}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

