<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Lotofácil</title>
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
          <a href="index.php" title="Lotofácil"><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil</a>
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
      <div class="tloterias tlotofacil">

      <h4><strong>LOTOFÁCIL</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Lotofácil nos sorteios que são realizados nas segundas, 
        terças, quartas, quintas, sextas e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias tlotofacil -->

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
                $binds = ['lfconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tblotofacil WHERE lfconc = $conc";
                } else {
                  $sql = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
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
                  $dataproximo = "{$item->lfdata}";                
                  if("{$item->lfd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->lfconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->lfconc}";
                    } else {
                      $ultimo = "{$item->lfconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->lfconc}";
                  }
                  $sql = "SELECT * FROM tblotofacil WHERE lfconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
                  $sqlpost = "SELECT * FROM tblotofacil WHERE lfconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->lfconc}"; 
                    $datapost = "{$itempost->lfdata}";
                    $premiopost = "{$itempost->lfpremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;                  
                  $sql = "SELECT lfdata FROM tblotofacil WHERE lfconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->lfdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT lfdata FROM tblotofacil WHERE lfconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->lfdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT lfdata FROM tblotofacil WHERE lfconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->lfdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT lfdata FROM tblotofacil WHERE lfconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->lfdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT lfdata FROM tblotofacil WHERE lfconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->lfdata}";
                      }
                    }                
                } //end foreach

                $lfpr15 = "{$item->lfpr15}"; 
                $lfpr14 = "{$item->lfpr14}";
                $lfpr13 = "{$item->lfpr13}";
                $lfpr12 = "{$item->lfpr12}";
                $lfpr11 = "{$item->lfpr11}";
                $lfpremioest = "{$item->lfpremioest}";

                $lfgan15 = "{$item->lfgan15}";
                $lfgan14 = "{$item->lfgan14}";
                $lfgan13 = "{$item->lfgan13}";
                $lfgan12 = "{$item->lfgan12}";
                $lfgan11 = "{$item->lfgan11}";                

                $lfcidadesgan = "{$item->lfcidadesgan}";

                $dtatual = "{$item->lfdata}";
                $d01 = "{$item->lfd01}";
                $d02 = "{$item->lfd02}";
                $d03 = "{$item->lfd03}";
                $d04 = "{$item->lfd04}";
                $d05 = "{$item->lfd05}";
                $d06 = "{$item->lfd06}";
                $d07 = "{$item->lfd07}";
                $d08 = "{$item->lfd08}";
                $d09 = "{$item->lfd09}";
                $d10 = "{$item->lfd10}";
                $d11 = "{$item->lfd11}";
                $d12 = "{$item->lfd12}";
                $d13 = "{$item->lfd13}";
                $d14 = "{$item->lfd14}";
                $d15 = "{$item->lfd15}";

         ?>

        <div class="content_left">

            <!-- Lotofácil -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tlotofacil">            
                <h5><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Lotofácil -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tlotofacil">            
                <h5><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Lotofácil -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tlotofacil">            
                <h5><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Lotofácil -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tlotofacil">            
                <h5><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Lotofácil -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tlotofacil">            
                <h5><span class="icone"><img src="../../img/icon_lotofacil.png" width="20"></span> Lotofácil
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



      </div> <!-- end left -->

      <div class="right">
      <div class="text_top">
        <p>A Lotofácil foi lançada em 29 de setembro de 2003 pela Caixa Econômica Federal e hoje é uma das loterias preferidas pelos 
        apostadores por ser a mais fácil de ganhar algum prêmio. Com apenas 25 números disponíveis no volante de apostas da Lotofácil,
         de 01 a 25, você pode marcar de 15 a 18 números e ganha se acertar 11, 12, 13, 14 ou 15 números. O custo de uma aposta com 
         15 números é de R$ 2,50 e a probabilidade de acertar o resultado da Lotofácil com todos os 15 números é de 1 em 3.268.760.</p>

        <p><strong>No painel abaixo, você confere hoje o resultado da Lotofácil online no último concurso. Os resultados dos sorteios 
        anteriores da Lotofácil você confere nas páginas dos respectivos números dos concursos no menu a esquerda ou utilizando o 
        campo de busca para concursos mais antigos.</strong></p>      
      </div>       
          
          <div class="top_right_lotofacil">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->lfd01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
            }
          ?></strong>
          </div> <!-- end top_right_lotofacil -->

          <div class="right_llotofacil">

            <div class="cardnumbers_lotofacil">
              
              <?php                 
                
                for ($j = 1; $j <= 25; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05 || 
                     $j == $d06 || $j == $d07 || $j == $d08 || $j == $d09 || $j == $d10 || 
                     $j == $d11 || $j == $d12 || $j == $d13 || $j == $d14 || $j == $d15){
                    echo "<div class='cardnumber_sel sellf'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 25 && $j % 5 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers -->

          </div> <!-- end right_l -->

          <div class="right_rlotofacil">
            <div class="resultnumbers">

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd01}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd02}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd03}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd04}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd05}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd06}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd07}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd08}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd09}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd10}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd11}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd12}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd13}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd14}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo "{$item->lfd15}";
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
          <li>15 acertos</li>
          <li>14 acertos</li>
          <li>13 acertos</li>
          <li>12 acertos</li>
          <li>11 acertos</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$lfpr15 ?></li>
          <li><?php echo "R$ ".$lfpr14 ?></li>
          <li><?php echo "R$ ".$lfpr13 ?></li>
          <li><?php echo "R$ ".$lfpr12 ?></li>
          <li><?php echo "R$ ".$lfpr11 ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li><?php echo $lfgan15 ?></li>
          <li><?php echo $lfgan14 ?></li>
          <li><?php echo $lfgan13 ?></li>
          <li><?php echo $lfgan12 ?></li>
          <li><?php echo $lfgan11 ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $lfcidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->

<div class="right_lowmiddle_info tlotofacil col-12">
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

<div class="text_info_lotofacil">
<h2>Como jogar na Lotof&aacute;cil</h2>
<p>Para jogar na Lotof&aacute;cil compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 25 n&uacute;meros de 01 a 25. Em um &uacute;nico jogo voc&ecirc; pode escolher entre 15 e 20 n&uacute;meros com os respectivos custos de aposta por jogo:</p>
<ul>
<li><strong>15 n&uacute;meros:</strong>&nbsp;R$ 2,50</li>
<li><strong>16 n&uacute;meros:</strong>&nbsp;R$ 40,00</li>
<li><strong>17 n&uacute;meros:</strong>&nbsp;R$ 340,00</li>
<li><strong>18 n&uacute;meros:</strong>&nbsp;R$ 2.040,00</li>
<li><strong>19 n&uacute;meros:</strong>&nbsp;R$ 9.690,00</li>
<li><strong>20 n&uacute;meros:</strong>&nbsp;R$ 38.760,00</li>
</ul>
<p>As probabilidades de acerto das apostas acima para o pr&ecirc;mio principal s&atilde;o:</p>
<ul>
<li><strong>15 n&uacute;meros</strong>: 1 em 3.268.760 jogos</li>
<li><strong>16 n&uacute;meros</strong>: 1 em 204.297 jogos</li>
<li><strong>17 n&uacute;meros</strong>: 1 em 24.035 jogos</li>
<li><strong>18 n&uacute;meros</strong>: 1 em 4.005 jogos</li>
<li><strong>19 n&uacute;meros</strong>: 1 em 843 jogos</li>
<li><strong>20 n&uacute;meros</strong>: 1 em 211 jogos</li>
</ul>
<p>Em um &uacute;nico volante de apostas da Lotof&aacute;cil &eacute; poss&iacute;vel marcar at&eacute; 2 jogos. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros da Lotof&aacute;cil por voc&ecirc;. Deixe o volante da Lotof&aacute;cil em branco e marque entre 1 e 7 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Lotof&aacute;cil. Basta marcar 2, 3, 4, 6, 8, 9, 12, 18 ou 24 concursos.</p>
<h2>Bol&atilde;o da Lotof&aacute;cil</h2>
<p>Se desejar apostar em grupo na Lotof&aacute;cil voc&ecirc; ainda pode fazer o Bol&atilde;o CAIXA para dividir em cotas por apostador. Assim, cada apostador recebe um bilhete de apostas com todos os jogos realizados na Lotof&aacute;cil para confer&ecirc;ncia e se ganharem cada um pode retirar a sua parte no pr&ecirc;mio individualmente. A Caixa ir&aacute; garantir que cada apostador receba a parte do pr&ecirc;mio da Lotof&aacute;cil a que tem direito.<br />O valor m&iacute;nimo do Bol&atilde;o da Lotof&aacute;cil &eacute; de R$ 10,00, ou seja, 4 jogos de 15 n&uacute;meros, e cada cota n&atilde;o pode ser inferior a R$ 3,00 com o m&iacute;nimo de 2 e m&aacute;ximo de 8 cotas para apostas de at&eacute; 15 n&uacute;meros ou o m&iacute;nimo de 2 e m&aacute;ximo de 25 cotas para apostas de 16 ou o m&iacute;nimo de 2 e m&aacute;ximo de 30 cotas para apostas de 17 ou o m&iacute;nimo de 2 e m&aacute;ximo de 35 cotas para apostas de 18 n&uacute;meros ou o m&iacute;nimo de 2 e m&aacute;ximo de 70 cotas para apostas de 19 n&uacute;meros ou o m&iacute;nimo de 2 e m&aacute;ximo de 100 cotas para apostas de 20 n&uacute;meros. No volante de apostas da Lotof&aacute;cil h&aacute; um campo onde se marca o n&uacute;mero de cotas.<br />Voc&ecirc; tamb&eacute;m pode comprar cotas de bol&otilde;es da Lotof&aacute;cil organizados pelas pr&oacute;prias Casas Lot&eacute;ricas onde poder&aacute; ser cobrada Tarifa de Servi&ccedil;o adicional de at&eacute; 35% do valor de cada cota.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Lotof&aacute;cil</h2>
<p>O pr&ecirc;mio principal para quem acertar os 15 n&uacute;meros da Lotof&aacute;cil sozinho &eacute; estimado em R$ 2.000.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. Geralmente h&aacute; um ou mais ganhadores do pr&ecirc;mio principal e raramente acumula. Se acumular o valor destinado ao pr&ecirc;mio principal da Lotof&aacute;cil, &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador na Lotof&aacute;cil no mesmo concurso o pr&ecirc;mio &eacute; dividido, tanto para o pr&ecirc;mio de 15 acertos quanto para o pr&ecirc;mio de 14 acertos. Os valores dos pr&ecirc;mios para quem acertar 11, 12 ou 13 n&uacute;meros s&atilde;o fixos para cada ganhador, conforme lista a seguir:</p>
<ul>
<li><strong>11 acertos:</strong>&nbsp;R$ 5,00</li>
<li><strong>12 acertos:</strong>&nbsp;R$ 10,00</li>
<li><strong>13 acertos:</strong>&nbsp;R$ 25,00</li>
</ul>
<p>Apostando com 16, 17 ou 18 n&uacute;meros e acertando de 11 a 15 n&uacute;meros a premia&ccedil;&atilde;o &eacute; proporcional. Por exemplo, se apostar com 16 n&uacute;meros e acertar 15 n&uacute;meros, al&eacute;m de ganhar o pr&ecirc;mio principal, voc&ecirc; ganha 15 pr&ecirc;mios de 14 acertos.</p>
<p>Do valor arrecadado para cada concurso da Lotof&aacute;cil somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. Do pr&ecirc;mio l&iacute;quido &eacute; deduzido o valor total dos pr&ecirc;mios fixos e do valor restante 65% s&atilde;o destinados ao pr&ecirc;mio principal de 15 acertos e 20% para o pr&ecirc;mio de 14 acertos. Os outros 15% do valor restante s&atilde;o acumulados ao pr&ecirc;mio principal do concurso especial da Lotof&aacute;cil da Independ&ecirc;ncia.</p>
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
<h2>Lotof&aacute;cil da Independ&ecirc;ncia</h2>
<p>A Lotof&aacute;cil da Independ&ecirc;ncia &eacute; um concurso especial da Lotof&aacute;cil realizado em setembro de cada ano e ganhou este nome em decorr&ecirc;ncia da comemora&ccedil;&atilde;o da Independ&ecirc;ncia do Brasil no dia 07 de setembro. O primeiro sorteio da Lotof&aacute;cil da Independ&ecirc;ncia ocorreu no dia 06 de setembro de 2012 com o concurso de n&uacute;mero 800.</p>
<p>As regras para jogar neste concurso especial s&atilde;o iguais aos outros concursos da Lotof&aacute;cil. Mas, o percentual da arrecada&ccedil;&atilde;o destinado ao pr&ecirc;mio principal &eacute; maior e se n&atilde;o houver nenhum ganhador com 15 acertos o pr&ecirc;mio principal &eacute; somado e pago aos ganhadores com 14 acertos, ou seja, o pr&ecirc;mio do concurso da Lotof&aacute;cil da Independ&ecirc;ncia n&atilde;o acumula.</p>
<p>O pr&ecirc;mio &eacute; composto pelo ac&uacute;mulo de parte do valor arrecadado nos concursos da Lotof&aacute;cil realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana antecedente &agrave; data do sorteio da Lotof&aacute;cil da Independ&ecirc;ncia n&atilde;o s&atilde;o realizados os sorteios normais da Lotof&aacute;cil.</p>
<h2>Aos ganhadores da Lotof&aacute;cil</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Lotof&aacute;cil saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado da Lotof&aacute;cil na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000,00 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Lotof&aacute;cil &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio da Lotof&aacute;cil apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio da Lotof&aacute;cil. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_lotofacil -->
</div> <!-- end main -->

</div> <!-- end containermain -->







</body>
</html>
