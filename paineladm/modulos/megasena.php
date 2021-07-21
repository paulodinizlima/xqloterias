<meta charset=utf-8 />
<script>
    function inserir(modulo, tipo){
        location.href='admpainel.php?m='+modulo+'&t='+tipo;
    }
</script>
<link rel="stylesheet" href="../css/style.css">

<?php
    ini_set('default_charset', 'utf-8');
    require_once "../functions/funcoes.php";
    require_once "../functions/conection.php";

    $funcoes = new funcoes();
    $con = "../functions/conection.php";

    switch($tela){
        //--------------------------------------------------------------------------------------------------------------
        case 'cadastrardezenas':
            echo "<div class='div-left'>
                <div class='painel-titulo-megasena'>Megasena - Cadastro do Concurso</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='mslocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='gan06' type='text' placeholder='Ganhadores 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan05' type='text' placeholder='Ganhadores 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='gan04' type='text' placeholder='Ganhadores 04'>
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
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnmegasena'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $mslocal = filter_input(INPUT_POST, 'mslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $mscidadesgan = filter_input(INPUT_POST, 'mscidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'msconc' => $conc,
                                    'msdata' => $data,
                                    'mslocal' => $mslocal,
                                    'mspremioest' => $premioest,
                                    'msd01' => $d01,
                                    'msd02' => $d02,
                                    'msd03' => $d03,
                                    'msd04' => $d04,
                                    'msd05' => $d05,
                                    'msd06' => $d06,
                                    'msgan06' => $gan06,
                                    'msgan05' => $gan05,
                                    'msgan04' => $gan04,
                                    'mspr06' => $pr06,
                                    'mspr05' => $pr05,
                                    'mspr04' => $pr04,
                                    'mscidadesgan' => $mscidadesgan ];
                        $sql = "INSERT INTO tbmegasena SET 
                                        msconc = :msconc,
                                        msdata = :msdata,
                                        mslocal = :mslocal,
                                        mspremioest = :mspremioest,
                                        msd01 = :msd01,
                                        msd02 = :msd02,
                                        msd03 = :msd03,
                                        msd04 = :msd04,
                                        msd05 = :msd05,
                                        msd06 = :msd06,
                                        msgan06 = :msgan06,
                                        msgan05 = :msgan05,
                                        msgan04 = :msgan04,
                                        mspr06 = :mspr06,
                                        mspr05 = :mspr05,
                                        mspr04 = :mspr04,
                                        mscidadesgan = :mscidadesgan";                
                        $result = $conection->insert($sql,$binds);

                        

                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-megasena'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idmegasena' => 0];
               $sql = "SELECT * FROM tbmegasena WHERE idmegasena > :idmegasena ORDER BY idmegasena DESC LIMIT 15";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc) FROM tbmegasena)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->msconc}";
                    $d01proximo = "{$itemmax->msd01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>D01</th><th>D02</th><th>D03</th><th>D04</th><th>D05</th><th>D06</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->msconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->msconc}"."</td>";
                            echo "<td width='200'>"."{$item->msdata}"."</td>";
                            echo "<td width='30'>"."{$item->msd01}"."</td>";
                            echo "<td width='30'>"."{$item->msd02}"."</td>";
                            echo "<td width='30'>"."{$item->msd03}"."</td>";
                            echo "<td width='30'>"."{$item->msd04}"."</td>";
                            echo "<td width='30'>"."{$item->msd05}"."</td>";
                            echo "<td width='30'>"."{$item->msd06}"."</td>";
                            echo "<td><a href='admpainel.php?m=megasena&t=atualizardezenas&idconc="."{$item->idmegasena}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=megasena&t=excluirresultado&idconc="."{$item->idmegasena}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idmegasena' => 0];
            $sql = "SELECT * FROM tbmegasena WHERE idmegasena = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-megasena'>Megasena - Atualização do Resultado</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$item->idmegasena." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->msdata)).' 20:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='mslocal' type='text' value='".$item->mslocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->mspremioest."' />
                        </div><div class='formlabel'>prest</div>
                        <div class='form-group'>
                            <input class='form-control' name='d01' type='text' value='".$item->msd01."'/>
                        </div><div class='formlabel'>d01</div>
                        <div class='form-group'>
                            <input class='form-control' name='d02' type='text' value='".$item->msd02."' />
                        </div><div class='formlabel'>d02</div>
                        <div class='form-group'>
                            <input class='form-control' name='d03' type='text' value='".$item->msd03."' />
                        </div><div class='formlabel'>d03</div>
                        <div class='form-group'>
                            <input class='form-control' name='d04' type='text' value='".$item->msd04."' />
                        </div><div class='formlabel'>d04</div>
                        <div class='form-group'>
                            <input class='form-control' name='d05' type='text' value='".$item->msd05."' />
                        </div><div class='formlabel'>d05</div>
                        <div class='form-group'>
                            <input class='form-control' name='d06' type='text' value='".$item->msd06."' />
                        </div><div class='formlabel'>d06</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan06' type='text' value='".$item->msgan06."' />
                        </div><div class='formlabel'>gan06</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan05' type='text' value='".$item->msgan05."' />
                        </div><div class='formlabel'>gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan04' type='text' value='".$item->msgan04."' />
                        </div><div class='formlabel'>gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr06' type='text' value='".$item->mspr06."' />
                        </div><div class='formlabel'>pr06</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr05' type='text' value='".$item->mspr05."' />
                        </div><div class='formlabel'>pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr04' type='text' value='".$item->mspr04."' />
                        </div><div class='formlabel'>pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='mscidadesgan' type='text' value='".$item->mscidadesgan."' />
                        </div><div class='formlabel'>cidgan</div>

                        <div class='form-group'>   
                            <button type='submit' id='btnmegasena'><span>Atualizar</span></button>    
                        </div>

                    </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $mslocal = filter_input(INPUT_POST, 'mslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $mscidadesgan = filter_input(INPUT_POST, 'mscidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'msconc' => $conc,
                                    'msdata' => $data,
                                    'mslocal' => $mslocal,
                                    'mspremioest' => $premioest,
                                    'msd01' => $d01,
                                    'msd02' => $d02,
                                    'msd03' => $d03,
                                    'msd04' => $d04,
                                    'msd05' => $d05,
                                    'msd06' => $d06,
                                    'msgan06' => $gan06,
                                    'msgan05' => $gan05,
                                    'msgan04' => $gan04,
                                    'mspr06' => $pr06,
                                    'mspr05' => $pr05,
                                    'mspr04' => $pr04,
                                    'mscidadesgan' => $mscidadesgan ];
                        $sql = "UPDATE tbmegasena SET 
                                        msconc = :msconc,
                                        msdata = :msdata,
                                        mslocal = :mslocal,
                                        mspremioest = :mspremioest,
                                        msd01 = :msd01,
                                        msd02 = :msd02,
                                        msd03 = :msd03,
                                        msd04 = :msd04,
                                        msd05 = :msd05,
                                        msd06 = :msd06,
                                        msgan06 = :msgan06,
                                        msgan05 = :msgan05,
                                        msgan04 = :msgan04,
                                        mspr06 = :mspr06,
                                        mspr05 = :mspr05,
                                        mspr04 = :mspr04,
                                        mscidadesgan = :mscidadesgan WHERE msconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc) FROM tbmegasena)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->msconc}";
                            $d01proximo = "{$itemmax->msd01}";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'msconc' => $conc+1,
                                        'msd01' => 0,
                                        'msd02' => 0,
                                        'msd03' => 0,
                                        'msd04' => 0,
                                        'msd05' => 0,
                                        'msd06' => 0,
                                        'msgan06' => 0,
                                        'msgan05' => 0,
                                        'msgan04' => 0 ];
                            $sql = "INSERT INTO tbmegasena SET 
                                            msconc = :msconc,
                                            msd01 = :msd01,
                                            msd02 = :msd02,
                                            msd03 = :msd03,
                                            msd04 = :msd04,
                                            msd05 = :msd05,
                                            msd06 = :msd06,
                                            msgan06 = :msgan06,
                                            msgan05 = :msgan05,
                                            msgan04 = :msgan04";            
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
            echo "<div class='painel-titulo-megasena'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idmegasena' => 0];
               $sql = "SELECT * FROM tbmegasena WHERE idmegasena > :idmegasena ORDER BY idmegasena DESC LIMIT 15";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>D01</th><th>D02</th><th>D03</th><th>D04</th><th>D05</th><th>D06</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->msconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->msconc}"."</td>";
                            echo "<td width='200'>"."{$item->msdata}"."</td>";
                            echo "<td width='30'>"."{$item->msd01}"."</td>";
                            echo "<td width='30'>"."{$item->msd02}"."</td>";
                            echo "<td width='30'>"."{$item->msd03}"."</td>";
                            echo "<td width='30'>"."{$item->msd04}"."</td>";
                            echo "<td width='30'>"."{$item->msd05}"."</td>";
                            echo "<td width='30'>"."{$item->msd06}"."</td>";
                            echo "<td><a href='admpainel.php?m=megasena&t=atualizardezenas&idconc="."{$item->idmegasena}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=megasena&t=excluirresultado&idconc="."{$item->idmegasena}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

