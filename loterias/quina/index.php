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
                  $dadosultimo = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = strtotime(date('Y-m-d'));
                  


                //verifica se o último concurso já foi sorteado
                foreach($dadosultimo as $item){ 
                  //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                  $concproximo = "{$item->quiconc}"; 
                  $dataproximo = "{$item->quidata}";
                  $premioproximo = "{$item->quipremioest}";


                  if("{$item->quid01}" == 0){ //não foi sorteado 
                    
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->quiconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->quiconc}";
                    } else {
                      $ultimo = "{$item->quiconc}"-1;
                    }

                    $sql = "SELECT * FROM tbquina WHERE quiconc = $ultimo";
                    
                    $result = $con->select($sql, $binds);
                    if($result->rowCount() > 0){
                      $dados = $result->fetchAll(PDO::FETCH_OBJ);
                    }
                  } else { 
                    $ultimo = (int)"{$item->quiconc}";
                    $sql = "SELECT * FROM tbquina WHERE quiconc = $ultimo";
                    $result = $con->select($sql, $binds);
                    if($result->rowCount() > 0){
                      $dados = $result->fetchAll(PDO::FETCH_OBJ);
                    }
                  }
                } //end foreach

                foreach($dados as $item){ 
                  $post1 = $ultimo +1;                 
                  
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
          <img src="../../img/ads01.png">
        </div> <!-- end left_ads -->
        <div class="left_ads">
          <img src="../../img/ads01.png">
        </div> <!-- end left_ads -->
        <div class="left_ads">
          <img src="../../img/ads01.png">
        </div> <!-- end left_ads -->


      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>A Quina foi lançada em 13 de março de 1994 pela Caixa Econômica Federal e é a mais tradicional das loterias. Com 80 
          números disponíveis no volante de apostas da Quina, de 01 a 80, você pode marcar de 5 a 15 números e ganha se acertar
           2 (Duque), 3 (Terno), 4 (Quadra) ou 5 (Quina) números. O custo de uma aposta com 5 números é de R$ 2,00 e a 
           probabilidade de acertar o resultado da Quina com todos os 5 números é de 1 em 24.040.016.</p>

        <p><strong>No painel abaixo, você confere hoje o resultado da Quina online no último concurso. Os resultados dos sorteios
           anteriores da Quina você confere nas páginas dos respectivos números dos concursos no menu a esquerda ou utilizando o
            campo de busca para concursos mais antigos.</strong></p>      
      </div>
      <div class="top_right_quina">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->quid01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
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
                foreach($dados as $item){
                  echo "<div class='resultnumber tquina'>";
                      echo "{$item->quid01}";
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo "{$item->quid02}";
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo "{$item->quid03}";
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo "{$item->quid04}";
                  echo "</div>";
                  echo "<div class='resultnumber tquina'>";
                      echo "{$item->quid05}";
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($dataproximo))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $concproximo ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premioproximo ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
<img src="../../img/ads01.png" width="210"> 
<img src="../../img/ads02.png" width="210">
<img src="../../img/ads03.png" width="210">
<img src="../../img/ads01.png" width="210">               
</div> <!-- end middle_ads -->

<div class="text_info_quina">
<h2>Como jogar na Quina</h2>
<p>Para jogar na Quina compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 80 n&uacute;meros de 01 a 80. Em um &uacute;nico jogo voc&ecirc; pode escolher entre 5 e 15 n&uacute;meros com os respectivos custos de aposta por jogo:</p>
<div class="fl">
<ul>
<li><strong>05 n&uacute;meros:</strong>&nbsp;R$ 2,00</li>
<li><strong>06 n&uacute;meros:</strong>&nbsp;R$ 12,00</li>
<li><strong>07 n&uacute;meros:</strong>&nbsp;R$ 42,00</li>
<li><strong>08 n&uacute;meros:</strong>&nbsp;R$ 112,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>09 n&uacute;meros:</strong>&nbsp;R$ 252,00</li>
<li><strong>10 n&uacute;meros:</strong>&nbsp;R$ 504,00</li>
<li><strong>11 n&uacute;meros:</strong>&nbsp;R$ 924,00</li>
<li><strong>12 n&uacute;meros:</strong>&nbsp;R$ 1.584,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>13 n&uacute;meros:</strong>&nbsp;R$ 2.574,00</li>
<li><strong>14 n&uacute;meros:</strong>&nbsp;R$ 4.004,00</li>
<li><strong>15 n&uacute;meros:</strong>&nbsp;R$ 6.006,00</li>
</ul>
</div>
<div class="cb">&nbsp;</div>
<p>As probabilidades de acerto das apostas acima para o pr&ecirc;mio principal s&atilde;o:</p>
<ul>
<li><strong>5 n&uacute;meros</strong>: 1 em 24.040.016 jogos</li>
<li><strong>6 n&uacute;meros</strong>: 1 em 4.006.669 jogos</li>
<li><strong>7 n&uacute;meros</strong>: 1 em 1.144.762 jogos</li>
<li><strong>8 n&uacute;meros</strong>: 1 em 429.286 jogos</li>
<li><strong>9 n&uacute;meros</strong>: 1 em 190.794 jogos</li>
<li><strong>10 n&uacute;meros</strong>: 1 em 95.396 jogos</li>
<li><strong>11 n&uacute;meros</strong>: 1 em 52.035 jogos</li>
<li><strong>12 n&uacute;meros</strong>: 1 em 30.354 jogos</li>
<li><strong>13 n&uacute;meros</strong>: 1 em 18.679 jogos</li>
<li><strong>14 n&uacute;meros</strong>: 1 em 12.008 jogos</li>
<li><strong>15 n&uacute;meros</strong>: 1 em 8.005 jogos</li>
</ul>
<p>Em um &uacute;nico volante de apostas da Quina &eacute; poss&iacute;vel marcar at&eacute; 2 jogos. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros da Quina por voc&ecirc;. Deixe o volante da Quina em branco e marque entre 1 e 8 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Quina. Basta marcar 3, 6, 12, 18 ou 24 concursos.</p>
<p>Se desejar apostar em grupo na Quina voc&ecirc; ainda pode fazer o Bol&atilde;o CAIXA para dividir em cotas por apostador. Assim, cada apostador recebe um bilhete de apostas com todos os jogos da Quina realizados para confer&ecirc;ncia e se ganharem cada um pode retirar a sua parte no pr&ecirc;mio individualmente. A Caixa ir&aacute; garantir que cada apostador receba a parte do pr&ecirc;mio da Quina a que tem direito.<br />O valor m&iacute;nimo do Bol&atilde;o da Quina &eacute; de R$ 10,00, ou seja, 5 jogos de 5 n&uacute;meros, e cada cota n&atilde;o pode ser inferior a R$ 3,00 com o m&iacute;nimo de 2 e m&aacute;ximo de 50 cotas. No volante de apostas da Quina h&aacute; um campo onde se marca o n&uacute;mero de cotas.<br />Voc&ecirc; tamb&eacute;m pode comprar cotas de bol&otilde;es da Quina organizados pelas pr&oacute;prias Casas Lot&eacute;ricas onde poder&aacute; ser cobrada Tarifa de Servi&ccedil;o adicional de at&eacute; 35% do valor de cada cota.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Quina</h2>
<p>O pr&ecirc;mio principal para quem acertar os 5 n&uacute;meros da Quina sozinho &eacute; estimado em R$ 600.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. Se acumular o valor destinado ao pr&ecirc;mio principal da Quina, &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador na Quina no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o ocorre em todas as faixas de premia&ccedil;&atilde;o.</p>
<p>Do valor arrecadado para cada concurso da Quina somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. Do pr&ecirc;mio l&iacute;quido 35% s&atilde;o destinados ao pr&ecirc;mio principal de 5 acertos (Quina), 19% para o pr&ecirc;mio de 4 acertos (Quadra), 20% para o pr&ecirc;mio de 3 acertos (Terno) e 11% para o pr&ecirc;mio de 2 acertos (Duque). Os outros 15% do valor restante s&atilde;o acumulados ao pr&ecirc;mio principal do concurso especial da Quina de S&atilde;o Jo&atilde;o.</p>
<p>Os 56,65% do valor arrecadado que n&atilde;o fazem parte da premia&ccedil;&atilde;o s&atilde;o distribu&iacute;dos da seguinte maneira:</p>
<ul>
<li><strong>2,92%</strong>: Fundo Nacional da Cultura - FNC</li>
<li><strong>1,73%</strong>: Comit&ecirc; Ol&iacute;mpico Brasileiro - COB</li>
<li><strong>0,96%</strong>: Comit&ecirc; Paral&iacute;mpico Brasileiro - CPB</li>
<li><strong>2,46%</strong>: Minist&eacute;rio do Esporte (Minist&eacute;rio da Cidadania)</li>
<li><strong>1%</strong>: Secretarias de esporte, ou &oacute;rg&atilde;os equivalentes, dos Estados e do Distrito Federal</li>
<li><strong>0,50%</strong>: Comit&ecirc; Brasileiro de Clubes - CBC</li>
<li><strong>0,04%</strong>: Fenaclubes</li>
<li><strong>0,22%</strong>: Confedera&ccedil;&atilde;o Brasileira do Desporto Escolar - CBDE</li>
<li><strong>0,11%</strong>: Confedera&ccedil;&atilde;o Brasileira do Desporto Universit&aacute;rio - CBDU</li>
<li><strong>9,26%</strong>: Fundo Nacional de Seguran&ccedil;a P&uacute;blica - FNSP</li>
<li><strong>1%</strong>: Fundo Penitenci&aacute;rio Nacional - FUNPEN</li>
<li><strong>17,32%</strong>: Seguridade Social</li>
<li><strong>19,13%</strong>: Despesas de Custeio e Manuten&ccedil;&atilde;o de Servi&ccedil;os<br />Deste percentual 9,57% s&atilde;o de Despesas Operacionais, 8,61% da Comiss&atilde;o dos Lot&eacute;ricos e 0,95% do FDL - Fundo Desenvolvimento das Loterias.</li>
</ul>
<h2>Quina de S&atilde;o Jo&atilde;o</h2>
<p>A Quina de S&atilde;o Jo&atilde;o &eacute; um concurso especial da Quina realizado no dia 24 de junho de cada ano. O primeiro sorteio da Quina de S&atilde;o Jo&atilde;o ocorreu no dia 24 de junho de 2011 com o concurso de n&uacute;mero 2627.</p>
<p>As regras para jogar neste concurso especial s&atilde;o iguais aos outros concursos da Quina. Mas, o percentual da arrecada&ccedil;&atilde;o destinado ao pr&ecirc;mio principal &eacute; maior e se n&atilde;o houver nenhum ganhador com 5 acertos o pr&ecirc;mio principal &eacute; somado e pago aos ganhadores com 4 acertos, ou seja, o pr&ecirc;mio do concurso da Quina de S&atilde;o Jo&atilde;o n&atilde;o acumula.</p>
<p>O pr&ecirc;mio &eacute; composto pelo ac&uacute;mulo de parte do valor arrecadado nos concursos da Quina realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana antecedente &agrave; data do sorteio da Quina de S&atilde;o Jo&atilde;o n&atilde;o s&atilde;o realizados os sorteios normais da Quina.</p>
<h2>Aos ganhadores da Quina</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Quina saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado da Quina na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000,00 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Quina &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio da Quina apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio da Quina. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_quina -->
</div> <!-- end main -->

</div> <!-- end containermain -->







</body>
</html>
