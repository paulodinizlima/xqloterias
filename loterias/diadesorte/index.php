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

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = strtotime(date('Y-m-d'));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = "{$item->ddsdata}";                
                  if("{$item->ddsd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->ddsconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->ddsconc}";
                    } else {
                      $ultimo = "{$item->ddsconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->ddsconc}";
                  }
                  $sql = "SELECT * FROM tbdiadesorte WHERE ddsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
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
        <p>A Dia de Sorte foi lançada em 19 de maio de 2018 pela Caixa Econômica Federal. Com 31 números disponíveis no volante 
          de apostas, de 01 a 31, você deve marcar 7 números e um Mês de Sorte entre janeiro e dezembro. Ganha se acertar 
          7, 6, 5 ou 4 números ou o Mês de Sorte. O custo de uma aposta é de R$ 2,00 e a probabilidade de acertar todos os 7 
          números é de 1 em 2.629.575.</p>

        <p><strong>No painel de resultados abaixo, você confere hoje o resultado da Dia de Sorte no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos números dos concursos no menu a esquerda ou utilizando 
          o campo de busca para concursos mais antigos.</strong></p>      
      </div>    
          <div class="top_right_diadesorte">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ddsd01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
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
                foreach($dados as $item){
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd01}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd02}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd03}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd04}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd05}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd06}";
                  echo "</div>";
                  echo "<div class='resultnumber tdiadesorte'>";
                      echo "{$item->ddsd07}";
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datapost))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $concpost ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiopost ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
<img src="../../img/ads01.png" width="210"> 
<img src="../../img/ads01.png" width="210">
<img src="../../img/ads01.png" width="210">
<img src="../../img/ads01.png" width="210">               
</div> <!-- end middle_ads -->

<div class="text_info_diadesorte">
<h2>Como jogar na Dia de Sorte</h2>
<p>Para jogar na Dia de Sorte compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 31 n&uacute;meros de 01 a 31 e 12 Meses de Sorte. Em um jogo voc&ecirc; deve escolher entre 7 e 15 n&uacute;meros e um M&ecirc;s de Sorte com os respectivos custos de aposta por jogo:</p>
<div class="fl">
<ul>
<li><strong>07 n&uacute;meros:</strong>&nbsp;R$ 2,00</li>
<li><strong>08 n&uacute;meros:</strong>&nbsp;R$ 16,00</li>
<li><strong>09 n&uacute;meros:</strong>&nbsp;R$ 72,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>10 n&uacute;meros:</strong>&nbsp;R$ 240,00</li>
<li><strong>11 n&uacute;meros:</strong>&nbsp;R$ 660,00</li>
<li><strong>12 n&uacute;meros:</strong>&nbsp;R$ 1.584,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>13 n&uacute;meros:</strong>&nbsp;R$ 3.432,00</li>
<li><strong>14 n&uacute;meros:</strong>&nbsp;R$ 6.864,00</li>
<li><strong>15 n&uacute;meros:</strong>&nbsp;R$ 12.870,00</li>
</ul>
</div>
<div class="cb">&nbsp;</div>
<p>As probabilidades de acerto das apostas acima para o pr&ecirc;mio principal s&atilde;o:</p>
<ul>
<li><strong>07 n&uacute;meros</strong>: 1 em 2.629.575 jogos</li>
<li><strong>08 n&uacute;meros</strong>: 1 em 328.696 jogos</li>
<li><strong>09 n&uacute;meros</strong>: 1 em 73.043 jogos</li>
<li><strong>10 n&uacute;meros</strong>: 1 em 21.913 jogos</li>
<li><strong>11 n&uacute;meros</strong>: 1 em 7.968 jogos</li>
<li><strong>12 n&uacute;meros</strong>: 1 em 3.320 jogos</li>
<li><strong>13 n&uacute;meros</strong>: 1 em 1.532 jogos</li>
<li><strong>14 n&uacute;meros</strong>: 1 em 766 jogos</li>
<li><strong>15 n&uacute;meros</strong>: 1 em 408 jogos</li>
</ul>
<p>Em um volante de apostas da Dia de Sorte voc&ecirc; pode marcar at&eacute; 3 jogos. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros por voc&ecirc;. Deixe o volante da Dia de Sorte em branco e marque entre 1 e 7 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Dia de Sorte. Basta marcar 3, 6, 9 ou 12 concursos.</p>
<p>Se desejar apostar em grupo na Dia de Sorte voc&ecirc; ainda pode fazer o Bol&atilde;o CAIXA para dividir em cotas por apostador. Assim, cada apostador recebe um bilhete de apostas com todos os jogos realizados na Dia de Sorte para confer&ecirc;ncia e se ganharem cada um pode retirar a sua parte no pr&ecirc;mio individualmente. A Caixa ir&aacute; garantir que cada apostador receba a parte do pr&ecirc;mio da Dia de Sorte a que tem direito.<br />O valor m&iacute;nimo do Bol&atilde;o da Dia de Sorte &eacute; de R$ 10,00, ou seja, 5 jogos de 7 n&uacute;meros, e cada cota n&atilde;o pode ser inferior a R$ 2,50 com o m&iacute;nimo de 2 e m&aacute;ximo de 4 cotas para apostas compostas por 7 n&uacute;meros. No volante de apostas da Dia de Sorte h&aacute; um campo onde se marca o n&uacute;mero de cotas.<br />Voc&ecirc; tamb&eacute;m pode comprar cotas de bol&otilde;es da Dia de Sorte organizados pelas pr&oacute;prias Casas Lot&eacute;ricas onde poder&aacute; ser cobrada Tarifa de Servi&ccedil;o adicional de at&eacute; 35% do valor de cada cota.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Dia de Sorte</h2>
<p>O pr&ecirc;mio principal para quem acertar os 7 n&uacute;meros sozinho &eacute; estimado em R$ 350.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. Se acumular o valor destinado ao pr&ecirc;mio principal &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o de pr&ecirc;mio s&oacute; ocorre para as faixas de 7 e 6 acertos. Os valores dos pr&ecirc;mios para quem acertar 4, 5 ou o M&ecirc;s de Sorte s&atilde;o fixos para cada ganhador, conforme lista a seguir:</p>
<ul>
<li><strong>4 acertos:</strong>&nbsp;R$ 4,00</li>
<li><strong>5 acertos:</strong>&nbsp;R$ 20,00</li>
<li><strong>M&ecirc;s de Sorte:</strong>&nbsp;R$ 2,00</li>
</ul>
<p>Do valor arrecadado para cada concurso da Dia de Sorte somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. Do pr&ecirc;mio l&iacute;quido &eacute; deduzido o valor total dos pr&ecirc;mios fixos e do valor restante 70% s&atilde;o destinados ao pr&ecirc;mio principal de 7 acertos e 30% para o pr&ecirc;mio de 6 acertos.</p>
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
<h2>Aos ganhadores da Dia de Sorte</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Dia de Sorte saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000.000 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Dia de Sorte &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_megasena -->
</div> <!-- end main -->

</div> <!-- end containermain -->







</body>
</html>
