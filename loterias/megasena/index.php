<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Megasena</title>
    <meta http-equiv="refresh" content="60">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />

	<!--Favicon -->
	<link href="../../img/favicon.png" rel="icon">
	<link href="../../img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="../../fontawesome/css/all.css">

	<!-- Google Fonts -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  	<!-- Bootstrap CSS File -->
  	<link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	
</head>


<body>

	<!--==========================
    Header
 	============================-->

 	<header>
    <h1 class="float-l">
      <a href="../../"><img src="../../img/logo.png"></a>
    </h1>

    
    <input type="checkbox" id="control-nav" />
    <label for="control-nav" class="control-nav"></label>
    <label for="control-nav" class="control-nav-close"></label>

    <nav class="float-r">
      <ul class="list-auto">
        <li class="megasena">          
          <a href="index.php" title="Megasena"><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena</a>         
        </li>
        <li class="lotofacil">
          <a href="../lotofacil/" title="Lotofácil"><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil</a>
        </li>
        <li class="quina">
          <a href="../quina/" title="Quina"><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina</a>
        </li>
        <li class="lotomania">
          <a href="../lotomania/" title="Lotomania"><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania</a>
        </li>
        <li class="timemania">
          <a href="../timemania/" title="Timemania"><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania</a>
        </li>
        <li class="duplasena">
          <a href="../duplasena/" title="Dupla Sena"><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena</a>
        </li>
        <li class="diadesorte">
          <a href="../diadesorte/" title="Dia de Sorte"><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte</a>
        </li>
        <li class="supersete">
          <a href="../supersete/" title="Super Sete"><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete</a>
        </li>
        <li class="federal">
          <a href="../federal/" title="Federal"><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Federal</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="containermain">
    
    <div class="main">
      <div class="tloterias tmegasena">

        <h4><strong>MEGASENA</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Mega Sena nos 
          sorteios que são realizados nas quartas-feiras e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias tmegasena -->

      <div class="left">
        <div class="title_left">
          Resultados Anteriores
        </div> <!-- end title_left -->

        <?php
              ini_set('default_charset', 'utf-8');
              //define fuso horário
              date_default_timezone_set('America/Sao_Paulo');

              require('../../paineladm/functions/conection.php');
                $con = new conection();
                $binds = ['msconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbmegasena WHERE msconc = $conc";                  
                } else {
                  $sql = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc) FROM tbmegasena)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }
                
                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc) FROM tbmegasena)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }
                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->msconc}";
                  $datalast = "{$itemlast->msdata}";
                  $premiolast = "{$itemlast->mspremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){ 
                  $dataproximo = date("Y-m-d", strtotime("{$item->msdata}")); 
                  if("{$item->msd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->msconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->msconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->msconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { //foi sorteado
                    $ultimo = (int)"{$item->msconc}";
                    $post1 = $ultimo +1;
                  }
                  
                  $sql = "SELECT * FROM tbmegasena WHERE msconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }               
                  
                  $sqlpost = "SELECT * FROM tbmegasena WHERE msconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  } 

                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->msconc}"; 
                    $datapost = "{$itempost->msdata}";
                    $premiopost = "{$itempost->mspremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT msdata FROM tbmegasena WHERE msconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->msdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT msdata FROM tbmegasena WHERE msconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->msdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT msdata FROM tbmegasena WHERE msconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->msdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT msdata FROM tbmegasena WHERE msconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->msdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT msdata FROM tbmegasena WHERE msconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->msdata}";
                      }
                    }                
                } //end foreach

                $mspr06 = "{$item->mspr06}"; 
                $mspr05 = "{$item->mspr05}";
                $mspr04 = "{$item->mspr04}";
                $mspremioest = "{$item->mspremioest}";

                $msgan06 = "{$item->msgan06}";
                $msgan05 = "{$item->msgan05}";
                $msgan04 = "{$item->msgan04}";

                $mscidadesgan = "{$item->mscidadesgan}";

                $dtatual = "{$item->msdata}";
                $d01 = "{$item->msd01}";
                $d02 = "{$item->msd02}";
                $d03 = "{$item->msd03}";
                $d04 = "{$item->msd04}";
                $d05 = "{$item->msd05}";
                $d06 = "{$item->msd06}";

         ?>

        <div class="content_left">

            <!-- Megasena -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tmegasena">            
                <h5><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Megasena -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tmegasena">            
                <h5><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Megasena -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tmegasena">            
                <h5><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Megasena -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tmegasena">            
                <h5><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Megasena -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tmegasena">            
                <h5><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena
                  <span class="concurso_left"><?php echo $ant5 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant5))?>
              </div>
            </a> 

        </div> <!-- end content_left -->

        <div class="left_ads">
          <!--ads aqui -->
        </div> <!-- end left_ads -->
        

      </div> <!-- end left -->

      <div class="right">  
      <div class="text_top">
        <p>A Mega Sena foi lançada em 11 de março de 1996. O volante é composto por 601 números e deve-se marcar de 6 a 15 números. São sorteados 6 números e ganha quem acertar 4, 5 ou 6 números sorteados. O valor da aposta mínima, de 6 números, é de R$ 4,50. Os sorteios são realizados nas quartas-feiras e sábados.</p><br><br>

        <p><strong>Abaixo você confere o resultado da Mega Sena no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
          <div class="top_right_megasena">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->msd01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
            
            if($premiopost == "Aguardando..."){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ "."{$item->mspremioest}"."</em></span>";
            } else if ($premiopost != "Aguardando..." && "{$item->msgan06}" == 0 && "{$item->mspr06}" != ""){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>A C U M U L O U !!!</em></span>";
            }
          ?></strong>
          </div> <!-- end top_right_megasena -->

          <div class="right_lmegasena">

            <div class="cardnumbers_megasena">
              
              <?php                 
                
                for ($j = 1; $j <= 60; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05 || $j == $d06){
                    echo "<div class='cardnumber_sel selms'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 60 && $j % 10 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers -->

          </div> <!-- end right_l -->

          <div class="right_rmegasena">
            <div class="resultnumbers">

              <?php
                $ordemnum[0] = $d01;
                $ordemnum[1] = $d02;
                $ordemnum[2] = $d03;                  
                $ordemnum[3] = $d04;
                $ordemnum[4] = $d05;
                $ordemnum[5] = $d06;
                sort($ordemnum);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[4];
                  echo "</div>";
                  echo "<div class='resultnumber tmegasena'>";
                      echo $ordemnum[5];
                  echo "</div>";
                }
/*
                for ($i=1; $i <= 6; $i++) { 
                  echo "<div class='resultnumber tmegasena'>";
                    echo $dados;
                  echo "</div>";
                  //if($i < 26 && $i % 10 == 0) echo "<br><br>";
                }
*/
              ?>



            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_r -->


      </div> <!-- end right -->
      <div class="right_middle">

          <div class="tbl_premiacao">

                <div class="acertos col-md-2 col-sm-2 col-3">
                  <div class="title_acertos">Faixa</div>
                  <ul class="faixa_premiacao">
                    <li>Sena</li>
                    <li>Quina</li>
                    <li>Quadra</li>
                  </ul>
                </div> <!-- end acertos col-md2 -->
                <div class="valorpremio col-md-4 col-sm-5 col-5">
                <div class="title_acertos">Prêmio</div>
                  <ul class="premiacao">
                    <li><?php echo "R$ ".$mspr06 ?></li>
                    <li><?php echo "R$ ".$mspr05 ?></li>
                    <li><?php echo "R$ ".$mspr04 ?></li>
                  </ul>  
                </div> <!-- end valorpremio col-md3 -->
                <div class="ganhadores col-md-2 col-sm-2 col-2">
                <div class="title_acertos">Ganhadores</div>
                  <ul class="ganhadores">
                    <li><?php echo $msgan06 ?></li>
                    <li><?php echo $msgan05 ?></li>
                    <li><?php echo $msgan04 ?></li>
                  </ul>  
                </div> <!-- end ganhadores col-md2 -->
                <div class="cidades col-md-4">
                <div class="title_cidades">Cidades dos ganhadores</div>
                  <ul class="cidades">
                    <li><?php echo $mscidadesgan ?></li>
                  </ul>
                </div> <!-- end cidades col-md5 -->

          </div> <!-- end tbl_premiacao -->      

      </div> <!-- end right_middle -->
      <div class="right_lowmiddle_info tmegasena col-12">
        <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
        <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
        <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
      </div> <!-- end right_lowmiddle_info --> 
      <div class="middle_ads">
          <!--ads aqui -->              
      </div> <!-- end middle_ads -->

<div class="text_info_megasena">
  <h2>Como jogar na Mega Sena</h2>
  <p>Escolha de 6 a 15 números dentre os 60 disponíveis. São sorteados seis números por concurso. O custo de aposta por jogo:</p>

<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>6 números</td>
      <td>R$ 4,50</td>
    </tr>
    <tr>
      <td>7 números</td>
      <td>R$ 31,50</td>
    </tr>
    <tr>
      <td>8 números</td>
      <td>R$ 126,00</td>
    </tr>
    <tr>
      <td>9 números</td>
      <td>R$ 378,00</td>
    </tr>
    <tr>
      <td>10 números</td>
      <td>R$ 945,00</td>
    </tr>
    <tr>
      <td>11 números</td>
      <td>R$ 2.079,00</td>
    </tr>
    <tr>
      <td>12 números</td>
      <td>R$ 4.158,00</td>
    </tr>
    <tr>
      <td>13 números</td>
      <td>R$ 7.722,00</td>
    </tr>
    <tr>
      <td>14 números</td>
      <td>R$ 13.513,50</td>
    </tr>
    <tr>
      <td>15 números</td>
      <td>R$ 22.522,50</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidades</h2>
<ul>
  <li><strong>06 números</strong>: 1 em 50.063.860</li>
  <li><strong>07 números</strong>: 1 em 7.151.980</li>
  <li><strong>08 números</strong>: 1 em 1.787.995</li>
  <li><strong>09 números</strong>: 1 em 595.998</li>
  <li><strong>10 números</strong>: 1 em 238.399</li>
  <li><strong>11 números</strong>: 1 em 108.363</li>
  <li><strong>12 números</strong>: 1 em 54.182</li>
  <li><strong>13 números</strong>: 1 em 29.175</li>
  <li><strong>14 números</strong>: 1 em 16.671</li>
  <li><strong>15 números</strong>: 1 em 10.003</li>
</ul>

<h2>Premiação</h2>
<p>O prêmio bruto corresponde a <strong>43.35%</strong> da arrecadação. Deste percentual ainda são deduzidos imposto de renda. Do prêmio líquido <strong>35%</strong> são destinados ao prêmio principal de 6 acertos (Sena), <strong>19%</strong> para o prêmio de 5 acertos (Quina) e <strong>19%</strong> para o prêmio de 4 acertos (Quadra). <strong>22%</strong> do prêmio líquido dos concursos de final 1, 2, 3 e 4 vão para o prêmio principal do concurso de final 5 e o mesmo percentual da premiação dos concursos de final 6, 7, 8 e 9 para o prêmio principal do concurso de final 0. Os outros <strong>5%</strong> do valor restante são acumulados ao prêmio principal do concurso especial da Mega Sena da Virada.</p>
<br>

<p><strong>Os prêmios prescrevem 90 dias após a data do sorteio. Após esse prazo, os valores são repassados ao Tesouro Nacional para aplicação no FIES - Fundo de Financiamento Estudantil.</strong></p>
<p><strong>Os 56,65% do valor arrecadado que não fazem parte da premiação são distribuídos da seguinte maneira:</strong></p>
<p><br></p>
<ul>
<li><strong>2,92%</strong>: Fundo Nacional da Cultura - FNC</li>
<li><strong>1,73%</strong>: Comitê Olímpico Brasileiro - COB</li>
<li><strong>0,96%</strong>: Comitê Paralímpico Brasileiro - CPB</li>
<li><strong>2,46%</strong>: Ministério do Esporte (Ministério da Cidadania)</li>
<li><strong>1%</strong>: Secretarias de esporte, ou órgãos equivalentes, dos Estados e do Distrito Federal</li>
<li><strong>0,50%</strong>: Comitê Brasileiro de Clubes - CBC</li>
<li><strong>0,04%</strong>: Fenaclubes</li>
<li><strong>0,22%</strong>: Confederação Brasileira do Desporto Escolar - CBDE</li>
<li><strong>0,11%</strong>: Confederação Brasileira do Desporto Universitário - CBDU</li>
<li><strong>9,26%</strong>: Fundo Nacional de Segurança Pública - FNSP</li>
<li><strong>1%</strong>: Fundo Penitenciário Nacional - FUNPEN</li>
<li><strong>17,32%</strong>: Seguridade Social</li>
<li><strong>19,13%</strong>: Despesas de Custeio e Manutenção de Serviços<br />
Deste percentual 9,57% são de Despesas Operacionais, 8,61% da Comissão dos Lotéricos e 0,95% do FDL - Fundo Desenvolvimento das Loterias.</li>
</ul>
<h2>Aos ganhadores da Mega Sena</h2>
<p>Caso você seja um dos ganhadores da Mega Sena saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Mega Sena é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


</div><!-- end text_info_megasena -->
</div> <!-- end main -->

</div> <!-- end containermain -->
<!--==========================
    Footer
  ============================-->
<footer id="footer">
  <div class="footer-top">
      <div class="container">
        <div class="row">

          

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Loterias</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../timemania/">Timemania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../supersete/">Super Sete</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../federal/">Federal</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Segunda</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../supersete/">Super Sete</a></li>
            </ul>
            <br><br><br>
            <h4>Terça</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../timemania/">Timemania</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Quarta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../federal/">Federal</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../supersete/">Super Sete</a></li>
            </ul>
            <br><br>
            <h4>Quinta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../timemania/">Timemania</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Sexta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../supersete/">Super Sete</a></li>
            </ul>
            <br>
            <h4>Sábado</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../federal/">Federal</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../timemania/">Timemania</a></li>
            </ul>
          </div><!-- col-lg-2 col-md-6 footer-links -->

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Fale Conosco</h4>
            <p>
              São Paulo - Brasil<br>
              <strong>Email:</strong> xqloterias@xqloterias.com.br<br>
            </p>
          </div><!-- col-lg-3 col-md-6 footer-contact -->
      </div> <!-- row -->
    </div><!-- container -->

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>XQ Loterias</strong>. Todos os direitos reservados
      </div>
      <div class="credits">
        Designed by <a href="http://www.mousegraphics.com.br/">Mousegraphics</a>
      </div>
    </div>

  </div><!-- #footer-top -->
</footer><!-- #footer -->    

</body>
</html>
