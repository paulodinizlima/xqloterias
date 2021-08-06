<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Dia de Sorte</title>
    <meta http-eddsv="refresh" content="60">
    <meta http-eddsv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-eddsv="X-UA-Compatible" content="IE=edge,chrome=1">
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
    Header novo
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
          <a href="../megasena" title="Megasena"><span class="icone"><img src="../../img/icon_megasena.png" width="20"></span> Megasena</a>          
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
        <li class="diadesorte">
          <a href="../timemania/" title="Timemania"><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania</a>
        </li>
        <li class="duplasena">
          <a href="../duplasena/" title="Dupla Sena"><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena</a>
        </li>
        <li class="diadesorte">
          <a href="index.php" title="Dia de Sorte"><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte</a>
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
      <div class="tloterias tdiadesorte">

      <h4><strong>DIA DE SORTE</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Dia de Sorte nos sorteios que são realizados
           nas terças-feiras, quintas-feiras e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias tdiadesorte -->

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
                $binds = ['ddsconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbdiadesorte WHERE ddsconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc) FROM tbdiadesorte)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc) FROM tbdiadesorte)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }
                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->ddsconc}";
                  $datalast = "{$itemlast->ddsdata}";
                  $premiolast = "{$itemlast->ddspremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->ddsdata}")); 
                  if("{$item->ddsd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->ddsconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->ddsconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->ddsconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { //foi sorteado
                    $ultimo = (int)"{$item->ddsconc}";
                    $post1 = $ultimo +1;
                  }

                  $sql = "SELECT * FROM tbdiadesorte WHERE ddsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $sqlpost = "SELECT * FROM tbdiadesorte WHERE ddsconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->ddsconc}"; 
                    $datapost = "{$itempost->ddsdata}";
                    $premiopost = "{$itempost->ddspremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT ddsdata FROM tbdiadesorte WHERE ddsconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->ddsdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT ddsdata FROM tbdiadesorte WHERE ddsconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->ddsdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT ddsdata FROM tbdiadesorte WHERE ddsconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->ddsdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT ddsdata FROM tbdiadesorte WHERE ddsconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->ddsdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT ddsdata FROM tbdiadesorte WHERE ddsconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->ddsdata}";
                      }
                    }                
                } //end foreach

                $ddspr07 = "{$item->ddspr07}";
                $ddspr06 = "{$item->ddspr06}";
                $ddspr05 = "{$item->ddspr05}";
                $ddspr04 = "{$item->ddspr04}";
                $ddsprmes = "{$item->ddsprmes}";
                $ddspremioest = "{$item->ddspremioest}";

                $ddsgan07 = "{$item->ddsgan07}";
                $ddsgan06 = "{$item->ddsgan06}";
                $ddsgan05 = "{$item->ddsgan05}";
                $ddsgan04 = "{$item->ddsgan04}";
                $ddsganmes = "{$item->ddsganmes}";

                $ddscidadesgan = "{$item->ddscidadesgan}";

                $dtatual = "{$item->ddsdata}";
                $d01 = "{$item->ddsd01}";
                $d02 = "{$item->ddsd02}";
                $d03 = "{$item->ddsd03}";
                $d04 = "{$item->ddsd04}";
                $d05 = "{$item->ddsd05}";
                $d06 = "{$item->ddsd06}";
                $d07 = "{$item->ddsd07}";
                $dmes = "{$item->ddsdmes}";

         ?>

        <div class="content_left">

            <!-- Dia de Sorte -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tdiadesorte">            
                <h5><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Dia de Sorte -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tdiadesorte">            
                <h5><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Dia de Sorte -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tdiadesorte">            
                <h5><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Dia de Sorte -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tdiadesorte">            
                <h5><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Dia de Sorte -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tdiadesorte">            
                <h5><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte
                  <span class="concurso_left"><?php echo $ant5 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant5))?>
              </div>
            </a> 

        </div> <!-- end content_left -->

        <!--ads aqui -->

      <div class="left_ads">
        <!--ads aqui -->
      </div> <!-- end left_ads --> 

      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>Dia de Sorte foi lançada em 14 de maio de 2018 e seu primeiro concurso foi realizado em 19 de maio do mesmo ano. O volante é composto por 31 números e 12 "meses de sorte". Deve-se marcar de 7 a 15 números e mais 1 "mês de sorte". São sorteados 7 números e 1 "mês de sorte" por concurso. Ganha quem acertar 4, 5, 6 ou 7 números sorteados e/ou o "mês de sorte" sorteado. O valor da aposta mínima, de 7 números, é de R$ 2,00. Os sorteios são realizados nas terças-feiras, quintas-feiras e sábados.</p><br>

        <p><strong>Abaixo você confere o resultado da Dia de Sorte no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>    
          <div class="top_right_diadesorte">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ddsd01}" == 0){ //não foi sorteado 
              //echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
            }
          ?></strong>
          </div> <!-- end top_right -->

          <div class="right_ldiadesorte">

            <div class="cardnumbers_diadesorte">
              
              <?php 
                for ($j = 1; $j <= 31; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05 || $j == $d06 || $j == $d07){
                    echo "<div class='cardnumber_sel seldds'>" ;
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

          <div class="right_rdiadesorte">
            <div class="resultnumbers">

            <?php
              $ordemnum[0] = $d01;
              $ordemnum[1] = $d02;
              $ordemnum[2] = $d03;                  
              $ordemnum[3] = $d04;
              $ordemnum[4] = $d05;
              $ordemnum[5] = $d06;
              $ordemnum[6] = $d07;
              sort($ordemnum);
            ?>

            <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[4];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[5];
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo $ordemnum[6];
                  echo "</div>";
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_rdiadesorte -->

          <div class="right_diadesorte">
            Mês de Sorte: <?php echo "{$item->ddsdmes}"; ?>
          </div> <!-- end right_diadesorte -->

      </div> <!-- end right -->
      <div class="right_middle">

<div class="tbl_premiacao">

      <div class="acertos col-md-2 col-sm-2 col-3">
        <div class="title_acertos">Faixa</div>
        <ul class="faixa_premiacao">
          <li>7 acertos</li>
          <li>6 acertos</li>
          <li>5 acertos</li>
          <li>4 acertos</li>
          <li>Mês</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$ddspr07 ?></li>
          <li><?php echo "R$ ".$ddspr06 ?></li>
          <li><?php echo "R$ ".$ddspr05 ?></li>
          <li><?php echo "R$ ".$ddspr04 ?></li>
          <li><?php echo "R$ ".$ddsprmes ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li><?php echo $ddsgan07 ?></li>
          <li><?php echo $ddsgan06 ?></li>
          <li><?php echo $ddsgan05 ?></li>
          <li><?php echo $ddsgan04 ?></li>
          <li><?php echo $ddsganmes ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $ddscidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info tdiadesorte col-12">
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
            
</div> <!-- end middle_ads -->

<div class="text_info_diadesorte">
  <h2>Como jogar na Dia de Sorte</h2>
  <p>O Dia de Sorte é a loteria onde você aposta seus números da sorte. Escolha de 7 a 15 números dentre os 31 disponíveis e mais 1 “Mês de Sorte”. São sorteados sete números e um “Mês de Sorte” por concurso. Você pode deixar, ainda, que o sistema escolha os números para você (Surpresinha) e/ou continuar com o seu jogo por 3, 6, 9 ou 12 concursos consecutivos (Teimosinha).</p>

<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>7 números + 1 Mês de Sorte</td>
      <td>R$ 2,00</td>
    </tr>
    <tr>
      <td>8 números + 1 Mês de Sorte</td>
      <td>R$ 16,00</td>
    </tr>
    <tr>
      <td>9 números + 1 Mês de Sorte</td>
      <td>R$ 72,00</td>
    </tr>
    <tr>
      <td>10 números + 1 Mês de Sorte</td>
      <td>R$ 240,00</td>
    </tr>
    <tr>
      <td>11 números + 1 Mês de Sorte</td>
      <td>R$ 660,00</td>
    </tr>
    <tr>
      <td>12 números + 1 Mês de Sorte</td>
      <td>R$ 1.584,00</td>
    </tr>
    <tr>
      <td>13 números + 1 Mês de Sorte</td>
      <td>R$ 3.432,00</td>
    </tr>
    <tr>
      <td>14 números + 1 Mês de Sorte</td>
      <td>R$ 6.864,00</td>
    </tr>
    <tr>
      <td>15 números + 1 Mês de Sorte</td>
      <td>R$ 12.870,00</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidades</h2>
<ul>
<li><strong>07 números</strong>: 1 em 2.629.575</li>
<li><strong>08 números</strong>: 1 em 328.696</li>
<li><strong>09 números</strong>: 1 em 73.043</li>
<li><strong>10 números</strong>: 1 em 21.913</li>
<li><strong>11 números</strong>: 1 em 7.968</li>
<li><strong>12 números</strong>: 1 em 3.320</li>
<li><strong>13 números</strong>: 1 em 1.532</li>
<li><strong>14 números</strong>: 1 em 766</li>
<li><strong>15 números</strong>: 1 em 408</li>
</ul>

<h2>Premiação</h2>
<p>O prêmio bruto corresponde a <strong>43.35%</strong> da arrecadação. Do percentual destinado a premiação, é deduzido o montante destinado ao pagamento dos prêmios fixos, sendo R$ 2,00 para aposta com o Mês da Sorte sorteado, R$ 4,00 para as apostas com 4 números sorteados; e R$ 20,00 para as apostas com 5 números sorteados.</p>
<p>Após a apuração dos ganhadores dos prêmios fixos, o valor remanescente é distribuído entre as demais faixas, sendo 70% entre os acertadores de 7 números e 30% entre os acertadores de 6 números.</p>
<br>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>4 acertos:</td>
    <td>R$ 4,00</td>
  </tr>
  <tr>
    <td>5 acertos:</td>
    <td>R$ 20,00</td>
  </tr>
  <tr>
    <td>Mês de Sorte:</td>
    <td>R$ 2,00</td>
  </tr>
</table>
</div>
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
<h2>Aos ganhadores da Dia de Sorte</h2>
<p>Caso você seja um dos ganhadores da Dia de Sorte saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Dia de Sorte é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


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
