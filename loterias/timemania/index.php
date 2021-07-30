<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Timemania</title>
    <meta http-etmmv="refresh" content="60">
    <meta http-etmmv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-etmmv="X-UA-Compatible" content="IE=edge,chrome=1">
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
          <a href="../quina/" title="Quina"><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina</a>
        </li>
        <li class="lotomania">
          <a href="../lotomania/" title="Lotomania"><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania</a>
        </li>
        <li class="timemania">
          <a href="index.php" title="Timemania"><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania</a>
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
      <div class="tloterias ttimemania">

      <h4><strong>TIMEMANIA</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Timemania nos sorteios que são realizados nas terças-feiras, 
          tmmntas-feiras e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias ttimemania -->

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
                $binds = ['tmmconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbtimemania WHERE tmmconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc) FROM tbtimemania)";
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
                  $dataproximo = "{$item->tmmdata}";                
                  if("{$item->tmmd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->tmmconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->tmmconc}";
                    } else {
                      $ultimo = "{$item->tmmconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->tmmconc}";
                  }
                  $sql = "SELECT * FROM tbtimemania WHERE tmmconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
                  $sqlpost = "SELECT * FROM tbtimemania WHERE tmmconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->tmmconc}"; 
                    $datapost = "{$itempost->tmmdata}";
                    $premiopost = "{$itempost->tmmpremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT tmmdata FROM tbtimemania WHERE tmmconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->tmmdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT tmmdata FROM tbtimemania WHERE tmmconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->tmmdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT tmmdata FROM tbtimemania WHERE tmmconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->tmmdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT tmmdata FROM tbtimemania WHERE tmmconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->tmmdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT tmmdata FROM tbtimemania WHERE tmmconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->tmmdata}";
                      }
                    }                
                } //end foreach

                $tmmpr07 = "{$item->tmmpr07}";
                $tmmpr06 = "{$item->tmmpr06}";
                $tmmpr05 = "{$item->tmmpr05}";
                $tmmpr04 = "{$item->tmmpr04}";
                $tmmpr03 = "{$item->tmmpr03}";
                $tmmprtime = "{$item->tmmprtime}";
                $tmmpremioest = "{$item->tmmpremioest}";

                $tmmgan07 = "{$item->tmmgan07}";
                $tmmgan06 = "{$item->tmmgan06}";
                $tmmgan05 = "{$item->tmmgan05}";
                $tmmgan04 = "{$item->tmmgan04}";
                $tmmgan03 = "{$item->tmmgan03}";
                $tmmgantime = "{$item->tmmgantime}";

                $tmmcidadesgan = "{$item->tmmcidadesgan}";

                $dtatual = "{$item->tmmdata}";
                $d01 = "{$item->tmmd01}";
                $d02 = "{$item->tmmd02}";
                $d03 = "{$item->tmmd03}";
                $d04 = "{$item->tmmd04}";
                $d05 = "{$item->tmmd05}";
                $d06 = "{$item->tmmd06}";
                $d07 = "{$item->tmmd07}";

         ?>


        <div class="content_left">

            <!-- Timemania -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left ttimemania">            
                <h5><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Timemania -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left ttimemania">            
                <h5><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Timemania -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left ttimemania">            
                <h5><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Timemania -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left ttimemania">            
                <h5><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Timemania -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left ttimemania">            
                <h5><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania
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
        <p>A Timemania foi lançada em 01 de março de 2008 pela Caixa Econômica Federal. Com 80 números disponíveis no volante de 
          apostas, de 01 a 80, você deve marcar 10 números e um time de futebol dentre os 80 clubes disponíveis. Ganha se acertar
           7, 6, 5, 4 ou 3 números ou o Time do Coração. O custo de uma aposta é de R$ 3,00 e a probabilidade de acertar todos
            os 7 números é de 1 em 26.472.637.</p>

        <p><strong>No painel de resultados abaixo, você confere hoje o resultado da Timemania online no último 
          concurso. Os resultados dos sorteios anteriores você confere nas páginas dos respectivos números dos concursos no 
          menu a esquerda ou utilizando o campo de busca para concursos mais antigos.</strong></p>      
      </div>
          <div class="top_right_timemania">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->tmmd01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premiopost."</span>";
            }
          ?></strong>
          </div> <!-- end top_right -->

          <div class="right_ltimemania">

            <div class="cardnumbers_timemania">
              
              <?php                 
                
                for ($j = 1; $j <= 80; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05 || $j == $d06 || $j == $d07){
                    echo "<div class='cardnumber_sel seltmm'>" ;
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

          <div class="right_rtimemania">
            <div class="resultnumbers">

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd01}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd02}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd03}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd04}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd05}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd06}";
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo "{$item->tmmd07}";
                  echo "</div>";
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_rtimemania -->

          <div class="right_timecoracao">
            Time do Coração: <?php echo "{$item->tmmdtime}"; ?>
          </div> <!-- end right_timecoracao -->

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
          <li>3 acertos</li>
          <li>Time</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$tmmpr07 ?></li>
          <li><?php echo "R$ ".$tmmpr06 ?></li>
          <li><?php echo "R$ ".$tmmpr05 ?></li>
          <li><?php echo "R$ ".$tmmpr04 ?></li>
          <li><?php echo "R$ ".$tmmpr03 ?></li>
          <li><?php echo "R$ ".$tmmprtime ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li><?php echo $tmmgan07 ?></li>
          <li><?php echo $tmmgan06 ?></li>
          <li><?php echo $tmmgan05 ?></li>
          <li><?php echo $tmmgan04 ?></li>
          <li><?php echo $tmmgan03 ?></li>
          <li><?php echo $tmmgantime ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $tmmcidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info ttimemania col-12">
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

<div class="text_info_timemania">
<h2>Como jogar na Timemania</h2>
<p>Para jogar na Timemania compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 80 n&uacute;meros de 01 a 80 e 80 Times de Futebol. Em um jogo voc&ecirc; deve escolher 10 n&uacute;meros e um Time de Futebol ao custo de R$ 3,00 a aposta.</p>
<p>Em um volante de apostas da Timemania voc&ecirc; marca apenas 1 jogo. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros por voc&ecirc;. Deixe o volante da Timemania em branco e marque entre 1 e 9 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Timemania. Basta marcar 2 ou 4 concursos. As probabilidades de acerto s&atilde;o:</p>
<ul>
<li><strong>7 Acertos</strong>: 1 em 26.472.637 jogos</li>
<li><strong>6 Acertos</strong>: 1 em 216.103 jogos</li>
<li><strong>5 Acertos</strong>: 1 em 5.220 jogos</li>
<li><strong>4 Acertos</strong>: 1 em 276 jogos</li>
<li><strong>3 Acertos</strong>: 1 em 29 jogos</li>
<li><strong>Time do Cora&ccedil;&atilde;o</strong>: 1 em 80 jogos</li>
</ul>
<p>A Timemania n&atilde;o faz parte do sistema de Bol&atilde;o fornecido pela Caixa Econ&ocirc;mica Federal.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Timemania</h2>
<p>O pr&ecirc;mio principal para quem acertar os 7 n&uacute;meros sozinho &eacute; estimado em R$ 100.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. A Timemania &eacute; a loteria que mais acumula. Se acumular o valor destinado ao pr&ecirc;mio principal &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o de pr&ecirc;mio s&oacute; ocorre para as faixas de 7, 6 e 5 acertos. Os valores dos pr&ecirc;mios para quem acertar 3, 4 ou o Time do Cora&ccedil;&atilde;o s&atilde;o fixos para cada ganhador, conforme lista a seguir:</p>
<ul>
<li><strong>3 acertos:</strong>&nbsp;R$ 3,00</li>
<li><strong>4 acertos:</strong>&nbsp;R$ 9,00</li>
<li><strong>Time do Cora&ccedil;&atilde;o:</strong>&nbsp;R$ 7,50</li>
</ul>
<p>Do valor arrecadado para cada concurso da Timemania somente 46% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. Do pr&ecirc;mio l&iacute;tmmdo &eacute; deduzido o valor total dos pr&ecirc;mios fixos e do valor restante 50% s&atilde;o destinados ao pr&ecirc;mio principal de 7 acertos, 20% para o pr&ecirc;mio de 6 acertos e 20% para o pr&ecirc;mio de 4 acertos. Os outros 10% do valor restante s&atilde;o acumulados dos concursos de final 1, 2, 3 e 4 para o pr&ecirc;mio principal do concurso de final 5 e o mesmo percentual da premia&ccedil;&atilde;o dos concursos de final 6, 7, 8 e 9 para o pr&ecirc;mio principal do concurso de final 0.</p>
<p>Os 54% do valor arrecadado que n&atilde;o fazem parte da premia&ccedil;&atilde;o s&atilde;o distribu&iacute;dos da seguinte maneira:</p>
<ul>
<li><strong>22%</strong>: Clubes de Futebol</li>
<li><strong>1,26%</strong>: Comit&ecirc; Ol&iacute;mpico Brasileiro - COB</li>
<li><strong>0,74%</strong>: Comit&ecirc; Paral&iacute;mpico Brasileiro - CPB</li>
<li><strong>0,75%</strong>: Minist&eacute;rio do Esporte</li>
<li><strong>1,75%</strong>: Fundo Nacional de Sa&uacute;de</li>
<li><strong>0,50%</strong>: Fundo Nacional dos Direitos da Crian&ccedil;a e do Adolescente - FNCA</li>
<li><strong>5,00%</strong>: Fundo Nacional de Seguran&ccedil;a P&uacute;blica - FNSP</li>
<li><strong>1%</strong>: Fundo Penitenci&aacute;rio Nacional - FUNPEN</li>
<li><strong>1%</strong>: Seguridade Social</li>
<li><strong>20,00%</strong>: Despesas de Custeio e Manuten&ccedil;&atilde;o de Servi&ccedil;os<br />Deste percentual 11,00% s&atilde;o de Despesas Operacionais e 9,00% da Comiss&atilde;o dos Lot&eacute;ricos.</li>
</ul>
<h2>Aos ganhadores da Timemania</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Timemania saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000.000 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Timemania &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio da Mega Sena. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_timemania -->
</div> <!-- end main -->

</div> <!-- end containermain -->



</body>
</html>
