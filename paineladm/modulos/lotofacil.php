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
                <div class='painel-titulo-lotofacil'>Lotofácil - Cadastro de Dezenas</div>
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
                    <input class='form-control' name='mslocal' type='text'placeholder='Local do Sorteio'>
                </div>
                <div class='form-group'>   
                    <button type='submit' id='btnlotofacil'><span>Cadastrar Dezenas</span></button>    
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
                                    'msd06' => $d07,
                                    'msd06' => $d08,
                                    'msd06' => $d09,
                                    'msd06' => $d10,
                                    'msd06' => $d11,
                                    'msd06' => $d12,
                                    'msd06' => $d13,
                                    'msd06' => $d14,
                                    'msd06' => $d15,
                                    'msgan06' => $gan15,
                                    'msgan05' => $gan14,
                                    'msgan04' => $gan13,
                                    'msgan04' => $gan12,
                                    'msgan04' => $gan11,
                                    'mspr06' => $pr15,
                                    'mspr05' => $pr14,
                                    'mspr04' => $pr13,
                                    'mspr04' => $pr12,
                                    'mspr04' => $pr11,
                                    'mslocal' => $mslocal];
                        $sql = "INSERT INTO tblotofacil SET 
                                        msconc = :msconc,
                                        msdata = :msdata,
                                        mspremioest = :mspremioest,
                                        msd01 = :msd01,
                                        msd02 = :msd02,
                                        msd03 = :msd03,
                                        msd04 = :msd04,
                                        msd05 = :msd05,
                                        msd06 = :msd06,
                                        msd06 = :msd07,
                                        msd06 = :msd08,
                                        msd06 = :msd09,
                                        msd06 = :msd10,
                                        msd06 = :msd11,
                                        msd06 = :msd12,
                                        msd06 = :msd13,
                                        msd06 = :msd14,
                                        msd06 = :msd15,
                                        msgan06 = :msgan15,
                                        msgan05 = :msgan14,
                                        msgan04 = :msgan13,
                                        msgan04 = :msgan12,
                                        msgan04 = :msgan11,
                                        mspr06 = :mspr15,
                                        mspr05 = :mspr14,
                                        mspr04 = :mspr13,
                                        mspr04 = :mspr12,
                                        mspr04 = :mspr11,
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