<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Quina</title>
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
          <a href="../megasena/" title="Megasena"><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena</a>          
        </li>
        <li class="lotofacil">
          <a href="../lotofacil/" title="Lotofácil"><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil</a>
        </li>
        <li class="quina">
          <a href="index.php" title="Quina"><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina</a>
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
      <div class="tloterias tquina">

      <h4><strong>QUINA</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Quina nos sorteios que são realizados nas 
          segundas, terças, quartas, quintas, sextas e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias tquina -->

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
                $binds = ['quiconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbquina WHERE quiconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc) FROM tbquina)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc) FROM tbquina)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }

                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->quiconc}";
                  $datalast = "{$itemlast->quidata}";
                  $premiolast = "{$itemlast->quipremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->quidata}"));                 
                  if("{$item->quid01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->quiconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->quiconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->quiconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->quiconc}";
                    $post1 = $ultimo +1;
                  }
                  
                  $sql = "SELECT * FROM tbquina WHERE quiconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $sqlpost = "SELECT * FROM tbquina WHERE quiconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->quiconc}"; 
                    $datapost = "{$itempost->quidata}";
                    $premiopost = "{$itempost->quipremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT quidata FROM tbquina WHERE quiconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->quidata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT quidata FROM tbquina WHERE quiconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->quidata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT quidata FROM tbquina WHERE quiconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->quidata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT quidata FROM tbquina WHERE quiconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->quidata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT quidata FROM tbquina WHERE quiconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->quidata}";
                      }
                    }                
                } //end foreach

                $quipr05 = "{$item->quipr05}";
                $quipr04 = "{$item->quipr04}";
                $quipr03 = "{$item->quipr03}";
                $quipr02 = "{$item->quipr02}";
                $quipremioest = "{$item->quipremioest}";

                $quigan05 = "{$item->quigan05}";
                $quigan04 = "{$item->quigan04}";
                $quigan03 = "{$item->quigan03}";
                $quigan02 = "{$item->quigan02}";

                $quicidadesgan = "{$item->quicidadesgan}";

                $dtatual = "{$item->quidata}";
                $d01 = "{$item->quid01}";
                $d02 = "{$item->quid02}";
                $d03 = "{$item->quid03}";
                $d04 = "{$item->quid04}";
                $d05 = "{$item->quid05}";

         ?>

        <div class="content_left">

            <!-- Quina -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tquina">            
                <h5><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Quina -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tquina">            
                <h5><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Quina -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tquina">            
                <h5><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Quina -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tquina">            
                <h5><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Quina -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tquina">            
                <h5><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina
                  <span class="concurso_left"><?php echo $ant5 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant5))?>
              </div>
            </a> 

        </div> <!-- end content_left -->

        <div class="left_ads">
          
        </div> <!-- end left_ads -->
        
      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>A Quina foi lançada em 13 de março de 1994. O volante é composto por 80 números e deve-se marcar de 5 a 15 números. São sorteados 5 números e ganha quem acertar 2, 3, 4 ou 5 números. O valor da aposta mínima, de 5 números, é de R$ 2,00. Os sorteios são realizados nas segundas, terças, quartas, quintas, sextas-feira e sábados, as 20 horas.</p><br>

        <p><strong>Abaixo você confere o resultado da Quina no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
      <div class="top_right_quina">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->quid01}" == 0){ //não foi sorteado 
              //echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premiopost."</span>";
            }
          ?></strong>
          </div> <!-- end top_right_quina -->

          <div class="right_lquina">

            <div class="cardnumbers_quina">
              
              <?php                 
                
                for ($j = 1; $j <= 80; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05){
                    echo "<div class='cardnumber_sel selqui'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 80 && $j % 10 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers -->

          </div> <!-- end right_l -->

          <div class="right_rquina">
            <div class="resultnumbers">

              <?php
                $ordemnum[0] = $d01;
                $ordemnum[1] = $d02;
                $ordemnum[2] = $d03;                  
                $ordemnum[3] = $d04;
                $ordemnum[4] = $d05;
                sort($ordemnum);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tquina'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo $ordemnum[4];
                  echo "</div>";
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_r -->


      </div> <!-- end right -->
      <div class="right_middle">

<div class="tbl_premiacao">

      <div class="acertos col-md-2 col-sm-2 col-3">
        <div class="title_acertos">Faixa</div>
        <ul class="faixa_premiacao">
          <li>Quina</li>
          <li>Quadra</li>
          <li>Terno</li>
          <li>Duque</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$quipr05 ?></li>
          <li><?php echo "R$ ".$quipr04 ?></li>
          <li><?php echo "R$ ".$quipr03 ?></li>
          <li><?php echo "R$ ".$quipr02 ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li><?php echo $quigan05 ?></li>
          <li><?php echo $quigan04 ?></li>
          <li><?php echo $quigan03 ?></li>
          <li><?php echo $quigan02 ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $quicidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info tquina col-12">
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
               
</div> <!-- end middle_ads -->

<div class="text_info_quina">
  <h2>Como jogar na Quina</h2>
  <p>Concorra a prêmios grandiosos com a Quina: basta marcar de 5 a 15 números dentre os 80 disponíveis no volante e torcer. Caso prefira o sistema pode escolher os números para você através da Surpresinha.</p>
  <p>Ganham prêmios os acertadores de 2, 3, 4 ou 5 números. Você ainda pode concorrer com a mesma aposta por 3, 6, 12, 18 ou 24 concursos consecutivos com a Teimosinha.</p>
<br>
<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>05 números</td>
      <td>R$ 2,00</td>
    </tr>
    <tr>
      <td>06 números</td>
      <td>R$ 12,00</td>
    </tr>
    <tr>
      <td>07 números</td>
      <td>R$ 42,00</td>
    </tr>
    <tr>
      <td>08 números</td>
      <td>R$ 112,00</td>
    </tr>
    <tr>
      <td>09 númerose</td>
      <td>R$ 252,00</td>
    </tr>
    <tr>
      <td>10 números</td>
      <td>R$ 504,00</td>
    </tr>
    <tr>
      <td>11 números</td>
      <td>R$ 924,00</td>
    </tr>
    <tr>
      <td>12 números</td>
      <td>R$ 1.584,00</td>
    </tr>
    <tr>
      <td>13 números</td>
      <td>R$ 2.574,00</td>
    </tr>
    <tr>
      <td>14 números</td>
      <td>R$ 4.004,00</td>
    </tr>
    <tr>
      <td>15 números</td>
      <td>R$ 6.006,00</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidade</h2>
<p>As probabilidades de acerto das apostas acima para o prêmio principal são:</p>
<ul>
  <li><strong>5 números</strong>: 1 em 24.040.016</li>
  <li><strong>6 números</strong>: 1 em 4.006.669</li>
  <li><strong>7 números</strong>: 1 em 1.144.762</li>
  <li><strong>8 números</strong>: 1 em 429.286</li>
  <li><strong>9 números</strong>: 1 em 190.794</li>
  <li><strong>10 números</strong>: 1 em 95.396</li>
  <li><strong>11 números</strong>: 1 em 52.035</li>
  <li><strong>12 números</strong>: 1 em 30.354</li>
  <li><strong>13 números</strong>: 1 em 18.679</li>
  <li><strong>14 números</strong>: 1 em 12.008</li>
  <li><strong>15 números</strong>: 1 em 8.005</li>
</ul>

<h2>Premiação</h2>
<p>Do valor arrecadado para cada concurso da Quina somente 43,35% são destinados ao prêmio bruto. Deste percentual ainda são deduzidos imposto de renda. Do prêmio líquido <strong>35%</strong> são destinados ao prêmio principal de 5 acertos (Quina), <strong>19%</strong> para o prêmio de 4 acertos (Quadra), <strong>20%</strong> para o prêmio de 3 acertos (Terno) e <strong>11%</strong> para o prêmio de 2 acertos (Duque). Os outros <strong>15%</strong> do valor restante são acumulados ao prêmio principal do concurso especial da Quina de São João</p>

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
<li><strong>19,13%</strong>: Despesas de Custeio e Manutenção de Serviços<br />Deste percentual 9,57% são de Despesas Operacionais, 8,61% da Comissão dos Lotéricos e 0,95% do FDL - Fundo Desenvolvimento das Loterias.</li>
</ul>


<h2>Quina de São João</h2>
<p>A Quina de São João é um concurso especial da Quina realizado no dia 24 de junho de cada ano. O primeiro sorteio da Quina de São João ocorreu no dia 24 de junho de 2011 com o concurso de número 2627.</p>

<p>As regras para jogar neste concurso especial são iguais aos outros concursos da Quina. Mas, o percentual da arrecadação destinado ao prêmio principal é maior e se não houver nenhum ganhador com 5 acertos o prêmio principal é somado e pago aos ganhadores com 4 acertos, ou seja, o prêmio do concurso da Quina de São João não acumula.</p>

<p>O prêmio é composto pelo acúmulo de parte do valor arrecadado nos concursos da Quina realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana antecedente à data do sorteio da Quina de São João não são realizados os sorteios normais da Quina.
</p>

<h2>Aos ganhadores da Quina</h2>
<p>aso você seja um dos ganhadores da Quina saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado da Quina na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000,00 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Quina é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio da Quina apresentando seu CPF.</p>

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
