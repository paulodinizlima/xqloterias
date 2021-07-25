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
                <div class='painel-titulo-duplasena'>Dupla Sena - Cadastro</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='dslocal' type='text'placeholder='Local do Sorteio'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='text' placeholder='Prêmio Estimado' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d01' type='text' placeholder='01 - Dezena 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d02' type='text' placeholder='01 - Dezena 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d03' type='text' placeholder='01 - Dezena 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d04' type='text' placeholder='01 - Dezena 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d05' type='text' placeholder='01 - Dezena 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01d06' type='text' placeholder='01 - Dezena 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d01' type='text' placeholder='02 - Dezena 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d02' type='text' placeholder='02 - Dezena 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d03' type='text' placeholder='02 - Dezena 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d04' type='text' placeholder='02 - Dezena 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d05' type='text' placeholder='02 - Dezena 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02d06' type='text' placeholder='02 - Dezena 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01gan06' type='text' placeholder='01 - Ganhadores 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01gan05' type='text' placeholder='01 - Ganhadores 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01gan04' type='text' placeholder='01 - Ganhadores 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01gan03' type='text' placeholder='01 - Ganhadores 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02gan06' type='text' placeholder='02 - Ganhadores 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02gan05' type='text' placeholder='02 - Ganhadores 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02gan04' type='text' placeholder='02 - Ganhadores 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02gan03' type='text' placeholder='02 - Ganhadores 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01pr06' type='text' placeholder='01 - Premiação 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01pr05' type='text' placeholder='01 - Premiação 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds01pr04' type='text' placeholder='01 - Premiação 04'>
                </div> 
                <div class='form-group'>
                    <input class='form-control' name='ds01pr03' type='text' placeholder='01 - Premiação 03'>
                </div> 
                <div class='form-group'>
                    <input class='form-control' name='ds02pr06' type='text' placeholder='02 - Premiação 06'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02pr05' type='text' placeholder='02 - Premiação 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ds02pr04' type='text' placeholder='02 - Premiação 04'>
                </div> 
                <div class='form-group'>
                    <input class='form-control' name='ds02pr03' type='text' placeholder='02 - Premiação 03'>
                </div>              
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnduplasena'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $dslocal = filter_input(INPUT_POST, 'dslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $ds01d01 = filter_input(INPUT_POST, 'ds01d01', FILTER_SANITIZE_STRING);
                    $ds01d02 = filter_input(INPUT_POST, 'ds01d02', FILTER_SANITIZE_STRING);
                    $ds01d03 = filter_input(INPUT_POST, 'ds01d03', FILTER_SANITIZE_STRING);
                    $ds01d04 = filter_input(INPUT_POST, 'ds01d04', FILTER_SANITIZE_STRING);
                    $ds01d05 = filter_input(INPUT_POST, 'ds01d05', FILTER_SANITIZE_STRING);
                    $ds01d06 = filter_input(INPUT_POST, 'ds01d06', FILTER_SANITIZE_STRING);
                    $ds02d01 = filter_input(INPUT_POST, 'ds02d01', FILTER_SANITIZE_STRING);
                    $ds02d02 = filter_input(INPUT_POST, 'ds02d02', FILTER_SANITIZE_STRING);
                    $ds02d03 = filter_input(INPUT_POST, 'ds02d03', FILTER_SANITIZE_STRING);
                    $ds02d04 = filter_input(INPUT_POST, 'ds02d04', FILTER_SANITIZE_STRING);
                    $ds02d05 = filter_input(INPUT_POST, 'ds02d05', FILTER_SANITIZE_STRING);
                    $ds02d06 = filter_input(INPUT_POST, 'ds02d06', FILTER_SANITIZE_STRING);
                    $ds01gan06 = filter_input(INPUT_POST, 'ds01gan06', FILTER_SANITIZE_STRING);
                    $ds01gan05 = filter_input(INPUT_POST, 'ds01gan05', FILTER_SANITIZE_STRING);
                    $ds01gan04 = filter_input(INPUT_POST, 'ds01gan04', FILTER_SANITIZE_STRING);
                    $ds02gan06 = filter_input(INPUT_POST, 'ds02gan06', FILTER_SANITIZE_STRING);
                    $ds02gan05 = filter_input(INPUT_POST, 'ds02gan05', FILTER_SANITIZE_STRING);
                    $ds02gan04 = filter_input(INPUT_POST, 'ds02gan04', FILTER_SANITIZE_STRING);
                    $ds01pr06 = filter_input(INPUT_POST, 'ds01pr06', FILTER_SANITIZE_STRING);
                    $ds01pr05 = filter_input(INPUT_POST, 'ds01pr05', FILTER_SANITIZE_STRING);
                    $ds01pr04 = filter_input(INPUT_POST, 'ds01pr04', FILTER_SANITIZE_STRING);
                    $ds02pr06 = filter_input(INPUT_POST, 'ds02pr06', FILTER_SANITIZE_STRING);
                    $ds02pr05 = filter_input(INPUT_POST, 'ds02pr05', FILTER_SANITIZE_STRING);
                    $ds02pr04 = filter_input(INPUT_POST, 'ds02pr04', FILTER_SANITIZE_STRING);
                    $dscidadesgan = filter_input(INPUT_POST, 'dscidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'dsconc' => $conc,
                                    'dsdata' => $data,
                                    'dslocal' => $dslocal,
                                    'dspremioest' => $premioest,
                                    'ds01d01' => $ds01d01,
                                    'ds01d02' => $ds01d02,
                                    'ds01d03' => $ds01d03,
                                    'ds01d04' => $ds01d04,
                                    'ds01d05' => $ds01d05,
                                    'ds01d06' => $ds01d06,
                                    'ds02d01' => $ds02d01,
                                    'ds02d02' => $ds02d02,
                                    'ds02d03' => $ds02d03,
                                    'ds02d04' => $ds02d04,
                                    'ds02d05' => $ds02d05,
                                    'ds02d06' => $ds02d06,
                                    'ds01gan06' => $ds01gan06,
                                    'ds01gan05' => $ds01gan05,
                                    'ds01gan04' => $ds01gan04,
                                    'ds02gan06' => $ds02gan06,
                                    'ds02gan05' => $ds02gan05,
                                    'ds02gan04' => $ds02gan04,
                                    'ds01pr06' => $ds01pr06,
                                    'ds01pr05' => $ds01pr05,
                                    'ds01pr04' => $ds01pr04,
                                    'ds02pr06' => $ds02pr06,
                                    'ds02pr05' => $ds02pr05,
                                    'ds02pr04' => $ds02pr04,
                                    'dscidadesgan' => $dscidadesgan ];
                        $sql = "INSERT INTO tbduplasena SET 
                                        dsconc = :dsconc,
                                        dsdata = :dsdata,
                                        dslocal = :dslocal,
                                        dspremioest = :dspremioest,
                                        ds01d01 = :ds01d01,
                                        ds01d02 = :ds01d02,
                                        ds01d03 = :ds01d03,
                                        ds01d04 = :ds01d04,
                                        ds01d05 = :ds01d05,
                                        ds01d06 = :ds01d06,
                                        ds02d01 = :ds02d01,
                                        ds02d02 = :ds02d02,
                                        ds02d03 = :ds02d03,
                                        ds02d04 = :ds02d04,
                                        ds02d05 = :ds02d05,
                                        ds02d06 = :ds02d06,
                                        ds01gan06 = :ds01gan06,
                                        ds01gan05 = :ds01gan05,
                                        ds01gan04 = :ds01gan04,
                                        ds02gan06 = :ds02gan06,
                                        ds02gan05 = :ds02gan05,
                                        ds02gan04 = :ds02gan04,
                                        ds01pr06 = :ds01pr06,
                                        ds01pr05 = :ds01pr05,
                                        ds01pr04 = :ds01pr04,
                                        ds02pr06 = :ds02pr06,
                                        ds02pr05 = :ds02pr05,
                                        ds02pr04 = :ds02pr04,
                                        dscidadesgan = :dscidadesgan";                
                        $result = $conection->insert($sql,$binds);

                        

                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-duplasena'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idduplasena' => 0];
               $sql = "SELECT * FROM tbduplasena WHERE idduplasena > :idduplasena ORDER BY idduplasena DESC LIMIT 28";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc) FROM tbduplasena)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->dsconc}";
                    $d01proximo = "{$itemmax->ds01d01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>101</th><th>102</th><th>103</th><th>104</th><th>105</th><th>106</th><th>201</th><th>202</th><th>203</th><th>204</th><th>205</th><th>206</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->dsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->dsconc}"."</td>";
                            echo "<td width='150'>"."{$item->dsdata}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d01}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d02}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d03}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d04}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d05}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d06}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d01}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d02}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d03}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d04}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d05}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d06}"."</td>";
                            echo "<td><a href='admpainel.php?m=duplasena&t=atualizardezenas&idconc="."{$item->idduplasena}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=duplasena&t=excluirresultado&idconc="."{$item->idduplasena}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idduplasena' => 0];
            $sql = "SELECT * FROM tbduplasena WHERE idduplasena = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-duplasena'>duplasena - Atualização</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$item->idduplasena." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->dsdata)).' 20:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='dslocal' type='text' value='".$item->dslocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->dspremioest."' />
                        </div><div class='formlabel'>prest</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds01d01' type='text' value='".$item->ds01d01."'/>
                        </div><div class='formlabel'>1d01</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01d02' type='text' value='".$item->ds01d02."' />
                        </div><div class='formlabel'>1d02</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01d03' type='text' value='".$item->ds01d03."' />
                        </div><div class='formlabel'>1d03</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01d04' type='text' value='".$item->ds01d04."' />
                        </div><div class='formlabel'>1d04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01d05' type='text' value='".$item->ds01d05."' />
                        </div><div class='formlabel'>1d05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01d06' type='text' value='".$item->ds01d06."' />
                        </div><div class='formlabel'>1d06</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds02d01' type='text' value='".$item->ds02d01."'/>
                        </div><div class='formlabel'>2d01</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02d02' type='text' value='".$item->ds02d02."' />
                        </div><div class='formlabel'>2d02</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02d03' type='text' value='".$item->ds02d03."' />
                        </div><div class='formlabel'>2d03</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02d04' type='text' value='".$item->ds02d04."' />
                        </div><div class='formlabel'>2d04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02d05' type='text' value='".$item->ds02d05."' />
                        </div><div class='formlabel'>2d05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02d06' type='text' value='".$item->ds02d06."' />
                        </div><div class='formlabel'>2d06</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds01gan06' type='text' value='".$item->ds01gan06."' />
                        </div><div class='formlabel'>1gan06</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01gan05' type='text' value='".$item->ds01gan05."' />
                        </div><div class='formlabel'>1gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01gan04' type='text' value='".$item->ds01gan04."' />
                        </div><div class='formlabel'>1gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01gan04' type='text' value='".$item->ds01gan03."' />
                        </div><div class='formlabel'>1gan03</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds02gan06' type='text' value='".$item->ds02gan06."' />
                        </div><div class='formlabel'>2gan06</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02gan05' type='text' value='".$item->ds02gan05."' />
                        </div><div class='formlabel'>2gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02gan04' type='text' value='".$item->ds02gan04."' />
                        </div><div class='formlabel'>2gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02gan04' type='text' value='".$item->ds02gan03."' />
                        </div><div class='formlabel'>2gan03</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds01pr06' type='text' value='".$item->ds01pr06."' />
                        </div><div class='formlabel'>1pr06</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01pr05' type='text' value='".$item->ds01pr05."' />
                        </div><div class='formlabel'>1pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01pr04' type='text' value='".$item->ds01pr04."' />
                        </div><div class='formlabel'>1pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds01pr04' type='text' value='".$item->ds01pr03."' />
                        </div><div class='formlabel'>1pr03</div>

                        <div class='form-group'>
                            <input class='form-control' name='ds02pr06' type='text' value='".$item->ds02pr06."' />
                        </div><div class='formlabel'>2pr06</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02pr05' type='text' value='".$item->ds02pr05."' />
                        </div><div class='formlabel'>2pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02pr04' type='text' value='".$item->ds02pr04."' />
                        </div><div class='formlabel'>2pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ds02pr04' type='text' value='".$item->ds02pr03."' />
                        </div><div class='formlabel'>2pr03</div>

                        <div class='form-group'>
                            <input class='form-control' name='dscidadesgan' type='text' value='".$item->dscidadesgan."' />
                        </div><div class='formlabel'>cidgan</div>

                        <div class='form-group'>   
                            <button type='submit' id='btnduplasena'><span>Atualizar</span></button>    
                        </div>

                    </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $dslocal = filter_input(INPUT_POST, 'dslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $ds01d01 = filter_input(INPUT_POST, 'ds01d01', FILTER_SANITIZE_STRING);
                    $ds01d02 = filter_input(INPUT_POST, 'ds01d02', FILTER_SANITIZE_STRING);
                    $ds01d03 = filter_input(INPUT_POST, 'ds01d03', FILTER_SANITIZE_STRING);
                    $ds01d04 = filter_input(INPUT_POST, 'ds01d04', FILTER_SANITIZE_STRING);
                    $ds01d05 = filter_input(INPUT_POST, 'ds01d05', FILTER_SANITIZE_STRING);
                    $ds01d06 = filter_input(INPUT_POST, 'ds01d06', FILTER_SANITIZE_STRING);
                    $ds01gan06 = filter_input(INPUT_POST, 'ds01gan06', FILTER_SANITIZE_STRING);
                    $ds01gan05 = filter_input(INPUT_POST, 'ds01gan05', FILTER_SANITIZE_STRING);
                    $ds01gan04 = filter_input(INPUT_POST, 'ds01gan04', FILTER_SANITIZE_STRING);
                    $ds01pr06 = filter_input(INPUT_POST, 'ds01pr06', FILTER_SANITIZE_STRING);
                    $ds01pr05 = filter_input(INPUT_POST, 'ds01pr05', FILTER_SANITIZE_STRING);
                    $ds01pr04 = filter_input(INPUT_POST, 'ds01pr04', FILTER_SANITIZE_STRING);
                    $dscidadesgan = filter_input(INPUT_POST, 'dscidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'dsconc' => $conc,
                                    'dsdata' => $data,
                                    'dslocal' => $dslocal,
                                    'dspremioest' => $premioest,
                                    'ds01d01' => $ds01d01,
                                    'ds01d02' => $ds01d02,
                                    'ds01d03' => $ds01d03,
                                    'ds01d04' => $ds01d04,
                                    'ds01d05' => $ds01d05,
                                    'ds01d06' => $ds01d06,
                                    'ds01gan06' => $ds01gan06,
                                    'ds01gan05' => $ds01gan05,
                                    'ds01gan04' => $ds01gan04,
                                    'ds01pr06' => $ds01pr06,
                                    'ds01pr05' => $ds01pr05,
                                    'ds01pr04' => $ds01pr04,
                                    'dscidadesgan' => $dscidadesgan ];
                        $sql = "UPDATE tbduplasena SET 
                                        dsconc = :dsconc,
                                        dsdata = :dsdata,
                                        dslocal = :dslocal,
                                        dspremioest = :dspremioest,
                                        ds01d01 = :ds01d01,
                                        ds01d02 = :ds01d02,
                                        ds01d03 = :ds01d03,
                                        ds01d04 = :ds01d04,
                                        ds01d05 = :ds01d05,
                                        ds01d06 = :ds01d06,
                                        ds01gan06 = :ds01gan06,
                                        ds01gan05 = :ds01gan05,
                                        ds01gan04 = :ds01gan04,
                                        ds01pr06 = :ds01pr06,
                                        ds01pr05 = :ds01pr05,
                                        ds01pr04 = :ds01pr04,
                                        dscidadesgan = :dscidadesgan WHERE dsconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc) FROM tbduplasena)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->dsconc}";
                            $d01proximo = "{$itemmax->ds01d01}";
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'dsconc' => $conc+1,
                                        'ds01d01' => 0,
                                        'ds01d02' => 0,
                                        'ds01d03' => 0,
                                        'ds01d04' => 0,
                                        'ds01d05' => 0,
                                        'ds01d06' => 0,
                                        'ds02d01' => 0,
                                        'ds02d02' => 0,
                                        'ds02d03' => 0,
                                        'ds02d04' => 0,
                                        'ds02d05' => 0,
                                        'ds02d06' => 0,
                                        'ds01gan06' => 0,
                                        'ds01gan05' => 0,
                                        'ds01gan04' => 0,
                                        'ds01gan03' => 0,
                                        'ds02gan06' => 0,
                                        'ds02gan05' => 0,
                                        'ds02gan04' => 0,
                                        'ds02gan03' => 0 ];
                            $sql = "INSERT INTO tbduplasena SET 
                                            dsconc = :dsconc,
                                            ds01d01 = :ds01d01,
                                            ds01d02 = :ds01d02,
                                            ds01d03 = :ds01d03,
                                            ds01d04 = :ds01d04,
                                            ds01d05 = :ds01d05,
                                            ds01d06 = :ds01d06,
                                            ds02d01 = :ds02d01,
                                            ds02d02 = :ds02d02,
                                            ds02d03 = :ds02d03,
                                            ds02d04 = :ds02d04,
                                            ds02d05 = :ds02d05,
                                            ds02d06 = :ds02d06,
                                            ds01gan06 = :ds01gan06,
                                            ds01gan05 = :ds01gan05,
                                            ds01gan04 = :ds01gan04,
                                            ds01gan03 = :ds01gan03,
                                            ds02gan06 = :ds02gan06,
                                            ds02gan05 = :ds02gan05,
                                            ds02gan04 = :ds02gan04,
                                            ds02gan03 = :ds02gan03";            
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
            echo "<div class='painel-titulo-duplasena'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idduplasena' => 0];
               $sql = "SELECT * FROM tbduplasena WHERE idduplasena > :idduplasena ORDER BY idduplasena DESC LIMIT 28";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>101</th><th>102</th><th>103</th><th>104</th><th>105</th><th>106</th><th>201</th><th>202</th><th>203</th><th>204</th><th>205</th><th>206</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->dsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->dsconc}"."</td>";
                            echo "<td width='150'>"."{$item->dsdata}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d01}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d02}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d03}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d04}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d05}"."</td>";
                            echo "<td width='30'>"."{$item->ds01d06}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d01}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d02}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d03}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d04}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d05}"."</td>";
                            echo "<td width='30'>"."{$item->ds02d06}"."</td>";
                            echo "<td><a href='admpainel.php?m=duplasena&t=atualizardezenas&idconc="."{$item->idduplasena}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=duplasena&t=excluirresultado&idconc="."{$item->idduplasena}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

