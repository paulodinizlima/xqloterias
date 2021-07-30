<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Super Sete</title>
    <meta http-espsv="refresh" content="60">
    <meta http-espsv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-espsv="X-UA-Compatible" content="IE=edge,chrome=1">
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
          <a href="../timemania/" title="Timemania"><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania</a>
        </li>
        <li class="duplasena">
          <a href="../duplasena/" title="Dupla Sena"><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena</a>
        </li>
        <li class="diadesorte">
          <a href="../diadesorte/" title="Dia de Sorte"><span class="icone"><img src="../../img/icon_diadesorte.png" width="20"></span> Dia de Sorte</a>
        </li>
        <li class="supersete">
          <a href="index.php" title="Super Sete"><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete</a>
        </li>
        <li class="federal">
          <a href="../federal/" title="Federal"><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Federal</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="containermain">
    
    <div class="main">
      <div class="tloterias tsupersete">

      <h4><strong>SUPER SETE</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Super Sete nos sorteios que 
          são realizados nas segundas-feiras, quartas-feiras e sextas-feiras a partir das 15 horas.</span>

      </div> <!-- end tloterias tsupersete -->

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
                $binds = ['spsconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbsupersete WHERE spsconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc) FROM tbsupersete)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //define horário para alternar concurso
                $horafixa = strtotime('14:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = strtotime(date('Y-m-d'));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = "{$item->spsdata}";                
                  if("{$item->spsd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->spsconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->spsconc}";
                    } else {
                      $ultimo = "{$item->spsconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->spsconc}";
                  }
                  $sql = "SELECT * FROM tbsupersete WHERE spsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
                  $sqlpost = "SELECT * FROM tbsupersete WHERE spsconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->spsconc}"; 
                    $datapost = "{$itempost->spsdata}";
                    $premiopost = "{$itempost->spspremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT spsdata FROM tbsupersete WHERE spsconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->spsdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT spsdata FROM tbsupersete WHERE spsconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->spsdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT spsdata FROM tbsupersete WHERE spsconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->spsdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT spsdata FROM tbsupersete WHERE spsconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->spsdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT spsdata FROM tbsupersete WHERE spsconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->spsdata}";
                      }
                    }                
                } //end foreach

                $spspr07 = "{$item->spspr07}";
                $spspr06 = "{$item->spspr06}";
                $spspr05 = "{$item->spspr05}";
                $spspr04 = "{$item->spspr04}";
                $spspr03 = "{$item->spspr03}";
                $spspremioest = "{$item->spspremioest}";

                $spsgan07 = "{$item->spsgan07}";
                $spsgan06 = "{$item->spsgan06}";
                $spsgan05 = "{$item->spsgan05}";
                $spsgan04 = "{$item->spsgan04}";
                $spsgan03 = "{$item->spsgan03}";

                $spscidadesgan = "{$item->spscidadesgan}";

                $dtatual = "{$item->spsdata}";
                $d01 = "{$item->spsd01}";
                if($d01 == 10){
                  $d01teste = 0;
                }
                else {
                  $d01teste = $d01;
                }
                $d02 = "{$item->spsd02}";
                $d03 = "{$item->spsd03}";
                $d04 = "{$item->spsd04}";
                $d05 = "{$item->spsd05}";
                $d06 = "{$item->spsd06}";
                $d07 = "{$item->spsd07}";

         ?>

        <div class="content_left">

            <!-- Super Sete -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tsupersete">            
                <h5><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Super Sete -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tsupersete">            
                <h5><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Super Sete -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tsupersete">            
                <h5><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Super Sete -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tsupersete">            
                <h5><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Super Sete -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tsupersete">            
                <h5><span class="icone"><img src="../../img/icon_supersete.png" width="20"></span> Super Sete
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
        <p>A Super Sete foi lançada em 02 de outubro de 2020 pela Caixa Econômica Federal. Com 7 colunas e 10 números de 0 a 9 
          disponíveis em cada coluna, você pode marcar de 7 a 21 números, com o mínimo de 1 e o máximo de 3 números por coluna. 
          Ganha se acertar 7, 6, 5, 4 ou 3 números, sendo 1 acerto por coluna. O custo de uma aposta é de R$ 2,50 e a probabilidade
           de acertar todos os 7 números, um por coluna, é de 1 em 10.000.000.</p>

        <p><strong>No painel de resultados abaixo, você confere hoje o resultado da Super Sete online no último concurso. 
          Os resultados dos sorteios anteriores você confere nas páginas dos respectivos números dos concursos no menu a 
          esquerda ou utilizando o campo de busca para concursos mais antigos.</strong></p>      
      </div>    
          <div class="top_right_supersete">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if($d01 == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premiopost."</span>";
            }
          ?></strong>
          </div> <!-- end top_right -->

          <div class="right_lsupersete">


            <div class="cardnumbers_supersete">
              <?php 
                echo "<div class='title_cs7'>C1</div>";
                  if($d01 == 10)
                    $d01 = 0;
                  for ($j = 0; $j < 10; $j++) {
                    if($j == $d01){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C2</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d02){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C3</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d03){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C4</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d04){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C5</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d05){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C6</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d06){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            <div class="cardnumbers_supersete">
              <?php 
              echo "<div class='title_cs7'>C7</div>";
                for ($j = 0; $j < 10; $j++) {
                    if($j == $d07){
                      echo "<div class='cardnumber_sel selsps'>" ;
                      echo $j;
                      echo "</div>";
                    } else {
                      echo "<div class='cardnumber'>" ;
                      echo $j;
                      echo "</div>";
                    }
                  }
              ?>
            </div> <!-- end cardnumbers_supersete -->
            

          </div> <!-- end right_lsupersete -->

          <div class="right_rsupersete">
            <div class="resultnumbers">

              <?php
                foreach($dados as $item){                  
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C1</div>";
                    echo "{$item->spsd01}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C2</div>";
                    echo "{$item->spsd02}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C3</div>";
                    echo "{$item->spsd03}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C4</div>";
                    echo "{$item->spsd04}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C5</div>";
                    echo "{$item->spsd05}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C6</div>";
                    echo "{$item->spsd06}";
                  echo "</div>";
                  echo "<div class='resultnumber tsupersete'>";
                  echo "<div class='title_ns7'>C7</div>";
                    echo "{$item->spsd07}";
                  echo "</div>";
                  
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_rsupersete -->

          
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
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$spspr07 ?></li>
          <li><?php echo "R$ ".$spspr06 ?></li>
          <li><?php echo "R$ ".$spspr05 ?></li>
          <li><?php echo "R$ ".$spspr04 ?></li>
          <li><?php echo "R$ ".$spspr03 ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li><?php echo $spsgan07 ?></li>
          <li><?php echo $spsgan06 ?></li>
          <li><?php echo $spsgan05 ?></li>
          <li><?php echo $spsgan04 ?></li>
          <li><?php echo $spsgan03 ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $spscidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info tsupersete col-12">
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

<div class="text_info_supersete">
<h2>Como jogar na Super Sete</h2>
<p>Para jogar na Super Sete compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 7 colunas com n&uacute;meros de 0 a 9 em cada coluna. Em um &uacute;nico jogo voc&ecirc; pode escolher entre 7 e 21 n&uacute;meros, com o m&iacute;nimo de 1 e o m&aacute;ximo de 3 n&uacute;meros por coluna, com os respectivos custos de aposta por jogo:</p>
<div class="fl">
<ul>
<li><strong>07 n&uacute;meros:</strong>&nbsp;R$ 2,50</li>
<li><strong>08 n&uacute;meros:</strong>&nbsp;R$ 5,00</li>
<li><strong>09 n&uacute;meros:</strong>&nbsp;R$ 10,00</li>
<li><strong>10 n&uacute;meros:</strong>&nbsp;R$ 20,00</li>
<li><strong>11 n&uacute;meros:</strong>&nbsp;R$ 40,00</li>
<li><strong>12 n&uacute;meros:</strong>&nbsp;R$ 80,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>13 n&uacute;meros:</strong>&nbsp;R$ 160,00</li>
<li><strong>14 n&uacute;meros:</strong>&nbsp;R$ 320,00</li>
<li><strong>15 n&uacute;meros:</strong>&nbsp;R$ 480,00</li>
<li><strong>16 n&uacute;meros:</strong>&nbsp;R$ 720,00</li>
<li><strong>17 n&uacute;meros:</strong>&nbsp;R$ 1.080,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>18 n&uacute;meros:</strong>&nbsp;R$ 1.620,00</li>
<li><strong>19 n&uacute;meros:</strong>&nbsp;R$ 2.430,00</li>
<li><strong>20 n&uacute;meros:</strong>&nbsp;R$ 3.645,00</li>
<li><strong>21 n&uacute;meros:</strong>&nbsp;R$ 5.467,50</li>
</ul>
</div>
<div class="cb">&nbsp;</div>
<p>As probabilidades de acerto das apostas acima para o pr&ecirc;mio principal s&atilde;o:</p>
<ul>
<li><strong>7 n&uacute;meros</strong>: 1 em 10.000.000 jogos</li>
<li><strong>8 n&uacute;meros</strong>: 1 em 5.000.000 jogos</li>
<li><strong>9 n&uacute;meros</strong>: 1 em 2.500.000 jogos</li>
<li><strong>10 n&uacute;meros</strong>: 1 em 1.250.000 jogos</li>
<li><strong>11 n&uacute;meros</strong>: 1 em 625.000 jogos</li>
<li><strong>12 n&uacute;meros</strong>: 1 em 312.500 jogos</li>
<li><strong>13 n&uacute;meros</strong>: 1 em 156.250 jogos</li>
<li><strong>14 n&uacute;meros</strong>: 1 em 78.125 jogos</li>
<li><strong>15 n&uacute;meros</strong>: 1 em 52.083 jogos</li>
<li><strong>16 n&uacute;meros</strong>: 1 em 34.722 jogos</li>
<li><strong>17 n&uacute;meros</strong>: 1 em 23.148 jogos</li>
<li><strong>18 n&uacute;meros</strong>: 1 em 15.432 jogos</li>
<li><strong>19 n&uacute;meros</strong>: 1 em 10.288 jogos</li>
<li><strong>20 n&uacute;meros</strong>: 1 em 6.859 jogos</li>
<li><strong>21 n&uacute;meros</strong>: 1 em 4.572 jogos</li>
</ul>
<p>Em um &uacute;nico volante de apostas da Super Sete &eacute; poss&iacute;vel marcar 1 jogo apenas. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros da Super Sete por voc&ecirc;. Deixe o volante da Super Sete em branco e marque entre 1 e 9 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Super Sete. Basta marcar 3, 6, 9 ou 12 concursos.</p>
<p>Se desejar apostar em grupo na Super Sete voc&ecirc; ainda pode fazer o Bol&atilde;o CAIXA para dividir em cotas por apostador. Assim, cada apostador recebe um bilhete de apostas com todos os jogos da Super Sete realizados para confer&ecirc;ncia e se ganharem cada um pode retirar a sua parte no pr&ecirc;mio individualmente. A Caixa ir&aacute; garantir que cada apostador receba a parte do pr&ecirc;mio da Super Sete a que tem direito.<br />O valor m&iacute;nimo do Bol&atilde;o da Super Sete &eacute; de R$ 10,00, ou seja, 4 jogos de 7 n&uacute;meros, e cada cota n&atilde;o pode ser inferior a R$ 5,00 com o m&iacute;nimo de 2 e m&aacute;ximo de 100 cotas. No volante de apostas da Super Sete h&aacute; um campo onde se marca o n&uacute;mero de cotas.<br />Voc&ecirc; tamb&eacute;m pode comprar cotas de bol&otilde;es da Super Sete organizados pelas pr&oacute;prias Casas Lot&eacute;ricas onde poder&aacute; ser cobrada Tarifa de Servi&ccedil;o adicional de at&eacute; 35% do valor de cada cota.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Super Sete</h2>
<p>O pr&ecirc;mio principal para quem acertar os 7 n&uacute;meros sozinho &eacute; estimado em R$ 300.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. Se acumular o valor destinado ao pr&ecirc;mio principal &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o de pr&ecirc;mio s&oacute; ocorre para as faixas de 7, 6, 5 e 4 acertos. Os valores dos pr&ecirc;mios para quem acertar 3 &eacute; fixo e cada ganhador ganha R$ 5,00.</p>
<p>Do valor arrecadado para cada concurso da Super Sete somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. Do pr&ecirc;mio l&iacute;quido &eacute; deduzido o valor total do pr&ecirc;mio fixo e do valor restante 55% s&atilde;o destinados ao pr&ecirc;mio principal de 7 acertos e 15% para os pr&ecirc;mios de 6, 5 e 4 acertos.</p>
<p>Os 56,65% do valor arrecadado que n&atilde;o fazem parte da premia&ccedil;&atilde;o s&atilde;o distribu&iacute;dos da seguinte maneira:</p>
<ul>
<li><strong>17,32%</strong>: Seguridade Social</li>
<li><strong>2,92%</strong>: Fundo Nacional da Cultura - FNC</li>
<li><strong>1%</strong>: Fundo Penitenci&aacute;rio Nacional - FUNPEN</li>
<li><strong>9,26%</strong>: Fundo Nacional de Seguran&ccedil;a P&uacute;blica - FNSP</li>
<li><strong>2,46%</strong>: Minist&eacute;rio do Esporte (Minist&eacute;rio da Cidadania)</li>
<li><strong>0,04%</strong>: Fenaclubes</li>
<li><strong>1%</strong>: Secretarias de esporte, ou &oacute;rg&atilde;os equivalentes, dos Estados e do Distrito Federal</li>
<li><strong>0,50%</strong>: Comit&ecirc; Brasileiro de Clubes - CBC</li>
<li><strong>0,22%</strong>: Confedera&ccedil;&atilde;o Brasileira do Desporto Escolar - CBDE</li>
<li><strong>0,11%</strong>: Confedera&ccedil;&atilde;o Brasileira do Desporto Universit&aacute;rio - CBDU</li>
<li><strong>1,73%</strong>: Comit&ecirc; Ol&iacute;mpico Brasileiro - COB</li>
<li><strong>0,96%</strong>: Comit&ecirc; Paral&iacute;mpico Brasileiro - CPB</li>
<li><strong>19,13%</strong>: Despesas de Custeio e Manuten&ccedil;&atilde;o de Servi&ccedil;os<br />Deste percentual 9,57% s&atilde;o de Despesas Operacionais, 8,61% da Comiss&atilde;o dos Lot&eacute;ricos e 0,95% do FDL - Fundo Desenvolvimento das Loterias.</li>
</ul>
<h2>Aos ganhadores da Super Sete</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Super Sete saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000.000 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Super Sete &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_megasena -->
</div> <!-- end main -->

</div> <!-- end containermain -->







</body>
</html>
