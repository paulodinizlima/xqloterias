<meta charset=utf-8 />
<script>
    function inserir(modulo, tipo){
        location.href='admpainel.php?m='+modulo+'&t='+tipo;
    }
</script>
<link rel="stylesheet" href="../css/style.css">

<?php
    ini_set('default_charset', 'utf-8');
    //define fuso horário
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../functions/funcoes.php";
    require_once "../functions/conection.php";

    $funcoes = new funcoes();
    $con = "../functions/conection.php";

    switch($tela){
        //--------------------------------------------------------------------------------------------------------------
        case 'cadastrardezenas':
            echo "<div class='div-left'>
                <div class='painel-titulo-diadesorte'>Dia de Sorte - Cadastro</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='ddslocal' type='text'placeholder='Local do Sorteio'>
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
                    <input class='form-control' name='dmes' type='text' placeholder='Mês'>
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
                    <input class='form-control' name='ganmes' type='text' placeholder='Ganhadores Mês'>
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
                    <input class='form-control' name='prmes' type='text' placeholder='Premiação Mês'>
                </div> 
                <div class='form-group'>
                    <input class='form-control' name='cidadesgan' type='text' placeholder='Cidades dos Ganhadores'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btndiadesorte'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $ddslocal = filter_input(INPUT_POST, 'ddslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $dmes = filter_input(INPUT_POST, 'dmes', FILTER_SANITIZE_STRING);
                    $gan07 = filter_input(INPUT_POST, 'gan07', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $ganmes = filter_input(INPUT_POST, 'ganmes', FILTER_SANITIZE_STRING);
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $prmes = filter_input(INPUT_POST, 'prmes', FILTER_SANITIZE_STRING);
                    $ddscidadesgan = filter_input(INPUT_POST, 'cidadesgan', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'ddsconc' => $conc,
                                    'ddsdata' => $data,
                                    'ddslocal' => $ddslocal,
                                    'ddspremioest' => $premioest,
                                    'ddsd01' => $d01,
                                    'ddsd02' => $d02,
                                    'ddsd03' => $d03,
                                    'ddsd04' => $d04,
                                    'ddsd05' => $d05,
                                    'ddsd06' => $d06,
                                    'ddsd07' => $d07,
                                    'ddsdmes' => $dmes,
                                    'ddsgan07' => $gan07,
                                    'ddsgan06' => $gan06,
                                    'ddsgan05' => $gan05,
                                    'ddsgan04' => $gan04,
                                    'ddsganmes' => $ganmes,
                                    'ddspr07' => $pr07,
                                    'ddspr06' => $pr06,
                                    'ddspr05' => $pr05,
                                    'ddspr04' => $pr04,
                                    'ddsprmes' => $prmes,
                                    'ddscidadesgan' => $ddscidadesgan ];
                        $sql = "INSERT INTO tbdiadesorte SET 
                                        ddsconc = :ddsconc,
                                        ddsdata = :ddsdata,
                                        ddslocal = :ddslocal,
                                        ddspremioest = :ddspremioest,
                                        ddsd01 = :ddsd01,
                                        ddsd02 = :ddsd02,
                                        ddsd03 = :ddsd03,
                                        ddsd04 = :ddsd04,
                                        ddsd05 = :ddsd05,
                                        ddsd06 = :ddsd06,
                                        ddsd07 = :ddsd07,
                                        ddsdmes = :ddsdmes,
                                        ddsgan07 = :ddsgan07,
                                        ddsgan06 = :ddsgan06,
                                        ddsgan05 = :ddsgan05,
                                        ddsgan04 = :ddsgan04,
                                        ddsganmes = :ddsganmes,
                                        ddspr07 = :ddspr07,
                                        ddspr06 = :ddspr06,
                                        ddspr05 = :ddspr05,
                                        ddspr04 = :ddspr04,
                                        ddsprmes = :ddsprmes,
                                        ddscidadesgan = :ddscidadesgan";                
                        $result = $conection->insert($sql,$binds);                        

                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-diadesorte'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['iddiadesorte' => 0];
               $sql = "SELECT * FROM tbdiadesorte WHERE iddiadesorte > :iddiadesorte ORDER BY iddiadesorte DESC LIMIT 20";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc) FROM tbdiadesorte)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->ddsconc}";
                    $d01proximo = "{$itemmax->ddsd01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>Mês</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->ddsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->ddsconc}"."</td>";
                            echo "<td width='150'>"."{$item->ddsdata}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd01}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd02}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd03}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd04}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd05}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd06}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd07}"."</td>";
                            echo "<td width='30'>"."{$item->ddsdmes}"."</td>";
                            echo "<td><a href='admpainel.php?m=diadesorte&t=atualizardezenas&idconc="."{$item->iddiadesorte}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=diadesorte&t=excluirresultado&idconc="."{$item->iddiadesorte}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['iddiadesorte' => 0];
            $sql = "SELECT * FROM tbdiadesorte WHERE iddiadesorte = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-diadesorte'>diadesorte - Atualização</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$item->iddiadesorte." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->ddsdata)).' 20:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='ddslocal' type='text' value='".$item->ddslocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->ddspremioest."' />
                        </div><div class='formlabel'>prest</div>
                        <div class='form-group'>
                            <input class='form-control' name='d01' type='text' value='".$item->ddsd01."'/>
                        </div><div class='formlabel'>d01</div>
                        <div class='form-group'>
                            <input class='form-control' name='d02' type='text' value='".$item->ddsd02."' />
                        </div><div class='formlabel'>d02</div>
                        <div class='form-group'>
                            <input class='form-control' name='d03' type='text' value='".$item->ddsd03."' />
                        </div><div class='formlabel'>d03</div>
                        <div class='form-group'>
                            <input class='form-control' name='d04' type='text' value='".$item->ddsd04."' />
                        </div><div class='formlabel'>d04</div>
                        <div class='form-group'>
                            <input class='form-control' name='d05' type='text' value='".$item->ddsd05."' />
                        </div><div class='formlabel'>d05</div>
                        <div class='form-group'>
                            <input class='form-control' name='d06' type='text' value='".$item->ddsd06."' />
                        </div><div class='formlabel'>d06</div>
                        <div class='form-group'>
                            <input class='form-control' name='d07' type='text' value='".$item->ddsd07."' />
                        </div><div class='formlabel'>d07</div>
                        <div class='form-group'>
                            <input class='form-control' name='dmes' type='text' value='".$item->ddsdmes."' />
                        </div><div class='formlabel'>dmes</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan07' type='text' value='".$item->ddsgan07."' />
                        </div><div class='formlabel'>gan07</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan06' type='text' value='".$item->ddsgan06."' />
                        </div><div class='formlabel'>gan06</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan05' type='text' value='".$item->ddsgan05."' />
                        </div><div class='formlabel'>gan05</div>
                        <div class='form-group'>
                            <input class='form-control' name='gan04' type='text' value='".$item->ddsgan04."' />
                        </div><div class='formlabel'>gan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='ganmes' type='text' value='".$item->ddsganmes."' />
                        </div><div class='formlabel'>ganmes</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr07' type='text' value='".$item->ddspr07."' />
                        </div><div class='formlabel'>pr07</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr06' type='text' value='".$item->ddspr06."' />
                        </div><div class='formlabel'>pr06</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr05' type='text' value='".$item->ddspr05."' />
                        </div><div class='formlabel'>pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr04' type='text' value='".$item->ddspr04."' />
                        </div><div class='formlabel'>pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='prmes' type='text' value='".$item->ddsprmes."' />
                        </div><div class='formlabel'>prmes</div>
                        <div class='form-group'>
                            <input class='form-control' name='ddscidadesgan' type='text' value='".$item->ddscidadesgan."' />
                        </div><div class='formlabel'>cidgan</div>

                        <div class='form-group'>   
                            <button type='submit' id='btndiadesorte'><span>Atualizar</span></button>    
                        </div>

                    </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $ddslocal = filter_input(INPUT_POST, 'ddslocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $d01 = filter_input(INPUT_POST, 'd01', FILTER_SANITIZE_STRING);
                    $d02 = filter_input(INPUT_POST, 'd02', FILTER_SANITIZE_STRING);
                    $d03 = filter_input(INPUT_POST, 'd03', FILTER_SANITIZE_STRING);
                    $d04 = filter_input(INPUT_POST, 'd04', FILTER_SANITIZE_STRING);
                    $d05 = filter_input(INPUT_POST, 'd05', FILTER_SANITIZE_STRING);
                    $d06 = filter_input(INPUT_POST, 'd06', FILTER_SANITIZE_STRING);
                    $d07 = filter_input(INPUT_POST, 'd07', FILTER_SANITIZE_STRING);
                    $dmes = filter_input(INPUT_POST, 'dmes', FILTER_SANITIZE_STRING);
                    $gan07 = filter_input(INPUT_POST, 'gan07', FILTER_SANITIZE_STRING);
                    $gan06 = filter_input(INPUT_POST, 'gan06', FILTER_SANITIZE_STRING);
                    $gan05 = filter_input(INPUT_POST, 'gan05', FILTER_SANITIZE_STRING);
                    $gan04 = filter_input(INPUT_POST, 'gan04', FILTER_SANITIZE_STRING);
                    $ganmes = filter_input(INPUT_POST, 'ganmes', FILTER_SANITIZE_STRING);
                    $pr07 = filter_input(INPUT_POST, 'pr07', FILTER_SANITIZE_STRING);
                    $pr06 = filter_input(INPUT_POST, 'pr06', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $prmes = filter_input(INPUT_POST, 'prmes', FILTER_SANITIZE_STRING);
                    $ddscidadesgan = filter_input(INPUT_POST, 'ddscidadesgan', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'ddsconc' => $conc,
                                    'ddsdata' => $data,
                                    'ddslocal' => $ddslocal,
                                    'ddspremioest' => $premioest,
                                    'ddsd01' => $d01,
                                    'ddsd02' => $d02,
                                    'ddsd03' => $d03,
                                    'ddsd04' => $d04,
                                    'ddsd05' => $d05,
                                    'ddsd06' => $d06,
                                    'ddsd07' => $d07,
                                    'ddsdmes' => $dmes,
                                    'ddsgan07' => $gan07,
                                    'ddsgan06' => $gan06,
                                    'ddsgan05' => $gan05,
                                    'ddsgan04' => $gan04,
                                    'ddsganmes' => $ganmes,
                                    'ddspr07' => $pr07,
                                    'ddspr06' => $pr06,
                                    'ddspr05' => $pr05,
                                    'ddspr04' => $pr04,
                                    'ddsprmes' => $prmes,
                                    'ddscidadesgan' => $ddscidadesgan ];
                        $sql = "UPDATE tbdiadesorte SET 
                                        ddsconc = :ddsconc,
                                        ddsdata = :ddsdata,
                                        ddslocal = :ddslocal,
                                        ddspremioest = :ddspremioest,
                                        ddsd01 = :ddsd01,
                                        ddsd02 = :ddsd02,
                                        ddsd03 = :ddsd03,
                                        ddsd04 = :ddsd04,
                                        ddsd05 = :ddsd05,
                                        ddsd06 = :ddsd06,
                                        ddsd07 = :ddsd07,
                                        ddsdmes = :ddsdmes,
                                        ddsgan07 = :ddsgan07,
                                        ddsgan06 = :ddsgan06,
                                        ddsgan05 = :ddsgan05,
                                        ddsgan04 = :ddsgan04,
                                        ddsganmes = :ddsganmes,
                                        ddspr07 = :ddspr07,
                                        ddspr06 = :ddspr06,
                                        ddspr05 = :ddspr05,
                                        ddspr04 = :ddspr04,
                                        ddsprmes = :ddsprmes,
                                        ddscidadesgan = :ddscidadesgan WHERE ddsconc = $codconc";                
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc) FROM tbdiadesorte)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->ddsconc}";
                            $d01proximo = "{$itemmax->ddsd01}";
                        }

                        $diadasemana = date('w', strtotime('today'));

                        if($diadasemana == 2 || $diadasemana == 4 || $diadasemana == 1){
                            $proximosorteio = date('Y/m/d', strtotime('+2 days')).' 20:00:00';
                        } else if($diadasemana == 6) {
                            $proximosorteio = date('Y/m/d', strtotime('+3 days')).' 20:00:00';
                        } else {
                            $proximosorteio = date('Y/m/d', strtotime('+1 days')).' 20:00:00';
                        }

                        if($conc == $concproximo && $d01proximo != 0){
                            $binds = [  'ddsconc' => $conc+1,
                                        'ddsdata' => $proximosorteio,
                                        'ddslocal' => 'SÃO PAULO, SP',
                                        'ddsd01' => 0,
                                        'ddsd02' => 0,
                                        'ddsd03' => 0,
                                        'ddsd04' => 0,
                                        'ddsd05' => 0,
                                        'ddsd06' => 0,
                                        'ddsd07' => 0,
                                        'ddsgan07' => '',
                                        'ddsgan06' => '',
                                        'ddsgan05' => '',
                                        'ddsgan04' => '',
                                        'ddsganmes' => '' ];
                            $sql = "INSERT INTO tbdiadesorte SET 
                                            ddsconc = :ddsconc,
                                            ddsdata = :ddsdata,
                                            ddslocal = :ddslocal,
                                            ddsd01 = :ddsd01,
                                            ddsd02 = :ddsd02,
                                            ddsd03 = :ddsd03,
                                            ddsd04 = :ddsd04,
                                            ddsd05 = :ddsd05,
                                            ddsd06 = :ddsd06,
                                            ddsd07 = :ddsd07,
                                            ddsgan07 = :ddsgan07,
                                            ddsgan06 = :ddsgan06,
                                            ddsgan05 = :ddsgan05,
                                            ddsgan04 = :ddsgan04,
                                            ddsganmes = :ddsganmes";            
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
            echo "<div class='painel-titulo-diadesorte'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['iddiadesorte' => 0];
               $sql = "SELECT * FROM tbdiadesorte WHERE iddiadesorte > :iddiadesorte ORDER BY iddiadesorte DESC LIMIT 20";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>Mês</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->ddsconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->ddsconc}"."</td>";
                            echo "<td width='150'>"."{$item->ddsdata}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd01}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd02}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd03}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd04}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd05}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd06}"."</td>";
                            echo "<td width='30'>"."{$item->ddsd07}"."</td>";
                            echo "<td width='30'>"."{$item->ddsdmes}"."</td>";
                            echo "<td><a href='admpainel.php?m=diadesorte&t=atualizardezenas&idconc="."{$item->iddiadesorte}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=diadesorte&t=excluirresultado&idconc="."{$item->iddiadesorte}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

