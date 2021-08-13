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
                <div class='painel-titulo-federal'>Loteria Federal - Cadastro</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='fedlocal' type='text'placeholder='Local do Sorteio'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='text' placeholder='Prêmio Estimado' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='s01' type='text' placeholder='Sorteio 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='s02' type='text' placeholder='Sorteio 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='s03' type='text' placeholder='Sorteio 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='s04' type='text' placeholder='Sorteio 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='s05' type='text' placeholder='Sorteio 05'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr01' type='text' placeholder='Premiação 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr02' type='text' placeholder='Premiação 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='pr03' type='text' placeholder='Premiação 03'>
                </div>  
                <div class='form-group'>
                    <input class='form-control' name='pr04' type='text' placeholder='Premiação 04'>
                </div>  
                <div class='form-group'>
                    <input class='form-control' name='pr05' type='text' placeholder='Premiação 05'>
                </div>              
                <div class='form-group'>
                    <input class='form-control' name='cidgan01' type='text' placeholder='Cidade Ganhador 01'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='cidgan02' type='text' placeholder='Cidade Ganhador 02'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='cidgan03' type='text' placeholder='Cidade Ganhador 03'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='cidgan04' type='text' placeholder='Cidade Ganhador 04'>
                </div>
                <div class='form-group'>
                    <input class='form-control' name='cidgan05' type='text' placeholder='Cidade Ganhador 05'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnfederal'><span>Cadastrar</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $fedlocal = filter_input(INPUT_POST, 'fedlocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $s01 = filter_input(INPUT_POST, 's01', FILTER_SANITIZE_STRING);
                    $s02 = filter_input(INPUT_POST, 's02', FILTER_SANITIZE_STRING);
                    $s03 = filter_input(INPUT_POST, 's03', FILTER_SANITIZE_STRING);
                    $s04 = filter_input(INPUT_POST, 's04', FILTER_SANITIZE_STRING);
                    $s05 = filter_input(INPUT_POST, 's05', FILTER_SANITIZE_STRING);
                    $pr01 = filter_input(INPUT_POST, 'pr01', FILTER_SANITIZE_STRING);
                    $pr02 = filter_input(INPUT_POST, 'pr02', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $fedcidgan01 = filter_input(INPUT_POST, 'fedcidgan01', FILTER_SANITIZE_STRING);
                    $fedcidgan02 = filter_input(INPUT_POST, 'fedcidgan02', FILTER_SANITIZE_STRING);
                    $fedcidgan03 = filter_input(INPUT_POST, 'fedcidgan03', FILTER_SANITIZE_STRING);
                    $fedcidgan04 = filter_input(INPUT_POST, 'fedcidgan04', FILTER_SANITIZE_STRING);
                    $fedcidgan05 = filter_input(INPUT_POST, 'fedcidgan05', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'fedconc' => $conc,
                                    'feddata' => $data,
                                    'fedlocal' => $fedlocal,
                                    'fedpremioest' => $premioest,
                                    'feds01' => $s01,
                                    'feds02' => $s02,
                                    'feds03' => $s03,
                                    'feds04' => $s04,
                                    'feds05' => $s05,
                                    'fedpr01' => $pr01,
                                    'fedpr02' => $pr02,
                                    'fedpr03' => $pr03,
                                    'fedpr04' => $pr04,
                                    'fedpr05' => $pr05,
                                    'fedcidgan01' => $fedcidgan01,
                                    'fedcidgan02' => $fedcidgan02,
                                    'fedcidgan03' => $fedcidgan03,
                                    'fedcidgan04' => $fedcidgan04,
                                    'fedcidgan05' => $fedcidgan05 ];
                        $sql = "INSERT INTO tbfederal SET 
                                        fedconc = :fedconc,
                                        feddata = :feddata,
                                        fedlocal = :fedlocal,
                                        fedpremioest = :fedpremioest,
                                        feds01 = :feds01,
                                        feds02 = :feds02,
                                        feds03 = :feds03,
                                        feds04 = :feds04,
                                        feds05 = :feds05,
                                        fedpr01 = :fedpr01,
                                        fedpr02 = :fedpr02,
                                        fedpr03 = :fedpr03,
                                        fedpr04 = :fedpr04,
                                        fedpr05 = :fedpr05,
                                        fedcidgan01 = :fedcidgan01,
                                        fedcidgan02 = :fedcidgan02,
                                        fedcidgan03 = :fedcidgan03,
                                        fedcidgan04 = :fedcidgan04,
                                        fedcidgan05 = :fedcidgan05 ";                
                        $result = $conection->insert($sql,$binds);                        

                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    } 

                      
        echo "</div>"; //div-left

        echo "<div class='div-right'>";
            echo "<div class='painel-titulo-federal'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idfederal' => 0];
               $sql = "SELECT * FROM tbfederal WHERE idfederal > :idfederal ORDER BY idfederal DESC LIMIT 15";

               //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
               $sql2 = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc) FROM tbfederal)";
               $resultmax = $conection->select($sql2,$binds);
               $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
               foreach($dadosmax as $itemmax){
                    $concproximo = "{$itemmax->fedconc}";
                    $s01proximo = "{$itemmax->feds01}";
                }

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>S01</th><th>S02</th><th>S03</th><th>S04</th><th>S05</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->fedconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->fedconc}"."</td>";
                            echo "<td width='200'>"."{$item->feddata}"."</td>";
                            echo "<td width='30'>"."{$item->feds01}"."</td>";
                            echo "<td width='30'>"."{$item->feds02}"."</td>";
                            echo "<td width='30'>"."{$item->feds03}"."</td>";
                            echo "<td width='30'>"."{$item->feds04}"."</td>";
                            echo "<td width='30'>"."{$item->feds05}"."</td>";
                            echo "<td><a href='admpainel.php?m=federal&t=atualizardezenas&idconc="."{$item->idfederal}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=federal&t=excluirresultado&idconc="."{$item->idfederal}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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
            $binds = ['idfederal' => 0];
            $sql = "SELECT * FROM tbfederal WHERE idfederal = $codconc";
            $result = $conection->select($sql,$binds);
            if($result->rowCount() > 0){
                $dados = $result->fetchAll(PDO::FETCH_OBJ);
            }

            foreach($dados as $item){
                echo "<div class='div-left'>
                    <div class='painel-titulo-federal'>federal - Atualização do Resultado</div>
                    <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                        <div class='form-group'>
                            <input class='form-control' name='conc' type='text' value=".$item->idfederal." />
                        </div><div class='formlabel'>conc</div>
                        <div class='form-group'>
                            <input class='form-control' name='data' type='text' value='".date('Y/m/d', strtotime($item->feddata)).' 19:00:00'."' />
                        </div><div class='formlabel'>data</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedlocal' type='text' value='".$item->fedlocal."' />
                        </div><div class='formlabel'>local</div>                        
                        <div class='form-group'>
                            <input class='form-control' name='premioest' type='text' value='".$item->fedpremioest."' />
                        </div><div class='formlabel'>prest</div>
                        <div class='form-group'>
                            <input class='form-control' name='s01' type='text' value='".$item->feds01."'/>
                        </div><div class='formlabel'>s01</div>
                        <div class='form-group'>
                            <input class='form-control' name='s02' type='text' value='".$item->feds02."' />
                        </div><div class='formlabel'>s02</div>
                        <div class='form-group'>
                            <input class='form-control' name='s03' type='text' value='".$item->feds03."' />
                        </div><div class='formlabel'>s03</div>
                        <div class='form-group'>
                            <input class='form-control' name='s04' type='text' value='".$item->feds04."' />
                        </div><div class='formlabel'>s04</div>
                        <div class='form-group'>
                            <input class='form-control' name='s05' type='text' value='".$item->feds05."' />
                        </div><div class='formlabel'>s05</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr01' type='text' value='".$item->fedpr01."' />
                        </div><div class='formlabel'>pr01</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr02' type='text' value='".$item->fedpr02."' />
                        </div><div class='formlabel'>pr02</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr03' type='text' value='".$item->fedpr03."' />
                        </div><div class='formlabel'>pr03</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr04' type='text' value='".$item->fedpr04."' />
                        </div><div class='formlabel'>pr04</div>
                        <div class='form-group'>
                            <input class='form-control' name='pr05' type='text' value='".$item->fedpr05."' />
                        </div><div class='formlabel'>pr05</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedcidgan01' type='text' value='".$item->fedcidgan01."' />
                        </div><div class='formlabel'>cidgan01</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedcidgan02' type='text' value='".$item->fedcidgan02."' />
                        </div><div class='formlabel'>cidgan02</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedcidgan03' type='text' value='".$item->fedcidgan03."' />
                        </div><div class='formlabel'>cidgan03</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedcidgan04' type='text' value='".$item->fedcidgan04."' />
                        </div><div class='formlabel'>cidgan04</div>
                        <div class='form-group'>
                            <input class='form-control' name='fedcidgan05' type='text' value='".$item->fedcidgan05."' />
                        </div><div class='formlabel'>cidgan05</div>
                        <div class='form-group'>   
                            <button type='submit' id='btnfederal'><span>Atualizar</span></button>    
                        </div>

                    </form>";
                }
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                    $fedlocal = filter_input(INPUT_POST, 'fedlocal', FILTER_SANITIZE_STRING);
                    $premioest = filter_input(INPUT_POST, 'premioest', FILTER_SANITIZE_STRING);
                    $s01 = filter_input(INPUT_POST, 's01', FILTER_SANITIZE_STRING);
                    $s02 = filter_input(INPUT_POST, 's02', FILTER_SANITIZE_STRING);
                    $s03 = filter_input(INPUT_POST, 's03', FILTER_SANITIZE_STRING);
                    $s04 = filter_input(INPUT_POST, 's04', FILTER_SANITIZE_STRING);
                    $s05 = filter_input(INPUT_POST, 's05', FILTER_SANITIZE_STRING);
                    $pr01 = filter_input(INPUT_POST, 'pr01', FILTER_SANITIZE_STRING);
                    $pr02 = filter_input(INPUT_POST, 'pr02', FILTER_SANITIZE_STRING);
                    $pr03 = filter_input(INPUT_POST, 'pr03', FILTER_SANITIZE_STRING);
                    $pr04 = filter_input(INPUT_POST, 'pr04', FILTER_SANITIZE_STRING);
                    $pr05 = filter_input(INPUT_POST, 'pr05', FILTER_SANITIZE_STRING);
                    $fedcidgan01 = filter_input(INPUT_POST, 'fedcidgan01', FILTER_SANITIZE_STRING);
                    $fedcidgan02 = filter_input(INPUT_POST, 'fedcidgan02', FILTER_SANITIZE_STRING);
                    $fedcidgan03 = filter_input(INPUT_POST, 'fedcidgan03', FILTER_SANITIZE_STRING);
                    $fedcidgan04 = filter_input(INPUT_POST, 'fedcidgan04', FILTER_SANITIZE_STRING);
                    $fedcidgan05 = filter_input(INPUT_POST, 'fedcidgan05', FILTER_SANITIZE_STRING);

                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'fedconc' => $conc,
                                    'feddata' => $data,
                                    'fedlocal' => $fedlocal,
                                    'fedpremioest' => $premioest,
                                    'feds01' => $s01,
                                    'feds02' => $s02,
                                    'feds03' => $s03,
                                    'feds04' => $s04,
                                    'feds05' => $s05,
                                    'fedpr01' => $pr01,
                                    'fedpr02' => $pr02,
                                    'fedpr03' => $pr03,
                                    'fedpr04' => $pr04,
                                    'fedpr05' => $pr05,
                                    'fedcidgan01' => $fedcidgan01,
                                    'fedcidgan02' => $fedcidgan02,
                                    'fedcidgan03' => $fedcidgan03,
                                    'fedcidgan04' => $fedcidgan04,
                                    'fedcidgan05' => $fedcidgan05 ];
                        $sql = "UPDATE tbfederal SET 
                                        fedconc = :fedconc,
                                        feddata = :feddata,
                                        fedlocal = :fedlocal,
                                        fedpremioest = :fedpremioest,
                                        feds01 = :feds01,
                                        feds02 = :feds02,
                                        feds03 = :feds03,
                                        feds04 = :feds04,
                                        feds05 = :feds05,
                                        fedpr01 = :fedpr01,
                                        fedpr02 = :fedpr02,
                                        fedpr03 = :fedpr03,
                                        fedpr04 = :fedpr04,
                                        fedpr05 = :fedpr05,
                                        fedcidgan01 = :fedcidgan01,
                                        fedcidgan02 = :fedcidgan02,
                                        fedcidgan03 = :fedcidgan03,
                                        fedcidgan04 = :fedcidgan04,
                                        fedcidgan05 = :fedcidgan05 WHERE fedconc = $codconc"; 
                        $result = $conection->insert($sql,$binds);

                        //---------------------------------------------------------
                       //**pegar o último concurso cadastrado no banco de dados, armazena em $concproximo
                        $sql2 = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc) FROM tbfederal)";
                        $resultmax = $conection->select($sql2,$binds);
                        $dadosmax = $resultmax->fetchAll(PDO::FETCH_OBJ);
                        foreach($dadosmax as $itemmax){
                            $concproximo = "{$itemmax->fedconc}";
                            $s01proximo = "{$itemmax->feds01}";
                        }

                        $diadasemana = date('w', strtotime('today'));

                        if($diadasemana == 3 || $diadasemana == 0){
                            $proximosorteio = date('Y/m/d', strtotime('+3 days')).' 20:00:00';
                        } else if($diadasemana == 6) {
                            $proximosorteio = date('Y/m/d', strtotime('+4 days')).' 20:00:00';
                        } else if($diadasemana == 1 || $diadasemana == 4) {
                            $proximosorteio = date('Y/m/d', strtotime('+2 days')).' 20:00:00';
                        } else {
                            $proximosorteio = date('Y/m/d', strtotime('+1 days')).' 20:00:00';
                        }

                        if($conc == $concproximo && $s01proximo != 0){
                            $binds = [  'fedconc' => $conc+1,
                                        'feddata' => $proximosorteio,
                                        'fedlocal' => 'SÃO PAULO, SP',    
                                        'feds01' => '00.000',
                                        'feds02' => '00.000',
                                        'feds03' => '00.000',
                                        'feds04' => '00.000',
                                        'feds05' => '00.000' ];
                            $sql = "INSERT INTO tbfederal SET 
                                            fedconc = :fedconc,
                                            feddata = :feddata,
                                            fedlocal = :fedlocal,
                                            feds01 = :feds01,
                                            feds02 = :feds02,
                                            feds03 = :feds03,
                                            feds04 = :feds04,
                                            feds05 = :feds05";            
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
            echo "<div class='painel-titulo-federal'>Lista de Resultados</div>";
               echo "<table class='bordasimples'>";
               $conection = new conection();
               $binds = ['idfederal' => 0];
               $sql = "SELECT * FROM tbfederal WHERE idfederal > :idfederal ORDER BY idfederal DESC LIMIT 15";

               $result = $conection->select($sql,$binds);
               if($result->rowCount() > 0){
                   $dados = $result->fetchAll(PDO::FETCH_OBJ);
                   echo "<tr><th>ID</th><th>Concurso</th><th>Data</th><th>D01</th><th>D02</th><th>D03</th><th>D04</th><th>D05</th><th colspan='2'>Ações</th></tr>";
                   foreach($dados as $item){
                        
                        echo "<tr>";
                            echo "<td width='40'>"."<strong>{$item->fedconc}</strong>"."</td>";
                            echo "<td width='80' align='center'>"."{$item->fedconc}"."</td>";
                            echo "<td width='200'>"."{$item->feddata}"."</td>";
                            echo "<td width='30'>"."{$item->feds01}"."</td>";
                            echo "<td width='30'>"."{$item->feds02}"."</td>";
                            echo "<td width='30'>"."{$item->feds03}"."</td>";
                            echo "<td width='30'>"."{$item->feds04}"."</td>";
                            echo "<td width='30'>"."{$item->feds05}"."</td>";
                            echo "<td><a href='admpainel.php?m=federal&t=atualizardezenas&idconc="."{$item->idfederal}"."'><img src='../images/edit.png' width='32' height='32' alt='Alterar Resultado'></a></td>";
                            echo "<td><a href='admpainel.php?m=federal&t=excluirresultado&idconc="."{$item->idfederal}"."'><img src='../images/delete.png' width='32' height='32' alt='Excluir Resultado'></a></td>";
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

