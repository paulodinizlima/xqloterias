<script>
    function inserir(modulo, tipo){
        location.href='admpainel.php?m='+modulo+'&t='+tipo;
    }
</script>
<link rel="stylesheet" href="../css/style.css">

<?php
    require_once "../functions/funcoes.php";
    require_once "../functions/conection.php";

    $funcoes = new funcoes();
    $con = "../functions/conection.php";

    switch($tela){
        case 'cadastrardezenas':
            echo "<div class='crud'>
                <div class='painel-titulo-megasena'>Megasena - Cadastro de Dezenas</div>
                <form class='formcadloterias' id='formcadastro' method='POST' enctype='multipart/form-data' action=''>
                <div class='form-group'>
                    <input class='form-control' name='conc' type='text' placeholder='Concurso Nº' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='data' type='date' placeholder='Data do Sorteio' />
                </div>
                <div class='form-group'>
                    <input class='form-control' name='premioest' type='number' placeholder='Prêmio Estimado' />
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
                    <input class='form-control' name='mslocal' type='text'placeholder='Local do Sorteio'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnmegasena'><span>Cadastrar Dezenas</span></button>    
                    </div>
                </form>";
                
                    $conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_STRING);
                    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
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
                    $mslocal = filter_input(INPUT_POST, 'mslocal', FILTER_SANITIZE_STRING);
                    if(!empty($conc)){
                        $conection = new conection();
                        $binds = [  'msconc' => $conc,
                                    'msdata' => $data,
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
                                    'mslocal' => $mslocal];
                        $sql = "INSERT INTO tbmegasena SET 
                                        msconc = :msconc,
                                        msdata = :msdata,
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
                                        mslocal = :mslocal";                
                        $result = $conection->insert($sql,$binds);
                        if($result){
                            echo "<div class='success'>Cadastro foi realizado</div>";
                        } else {
                            echo "Ops, houve um erro no cadastro";
                        }
                    }            
        echo "</div>";
        break;
        case 'listaresultados':
           echo "Lista de Resultados";
        break;

        default:
           //code
        break;
    } //end switch
?>