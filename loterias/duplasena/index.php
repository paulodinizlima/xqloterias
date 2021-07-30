<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Dupla Sena</title>
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
          <a href="../quina/" title="Quina"><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina</a>
        </li>
        <li class="lotomania">
          <a href="../lotomania/" title="duplasena"><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania</a>
        </li>
        <li class="timemania">
          <a href="../timemania/" title="Timemania"><span class="icone"><img src="../../img/icon_timemania.png" width="20"></span> Timemania</a>
        </li>
        <li class="duplasena">
          <a href="index.php" title="Dupla Sena"><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena</a>
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
      <div class="tloterias tduplasena">

      <h4><strong>DUPLA SENA</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Dupla Sena nos sorteios que são realizados nas
           terças-feiras, quintas-feiras e sábados a partir das 20 horas.</span>

      </div> <!-- end tloterias tduplasena -->

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
                $binds = ['dsconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbduplasena WHERE dsconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc) FROM tbduplasena)";
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
                  $dataproximo = "{$item->dsdata}";                
                  if("{$item->ds01d01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->dsconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->dsconc}";
                    } else {
                      $ultimo = "{$item->dsconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->dsconc}";
                  }
                  $sql = "SELECT * FROM tbduplasena WHERE dsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
                  $sqlpost = "SELECT * FROM tbduplasena WHERE dsconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->dsconc}"; 
                    $datapost = "{$itempost->dsdata}";
                    $premiopost = "{$itempost->dspremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT dsdata FROM tbduplasena WHERE dsconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->dsdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT dsdata FROM tbduplasena WHERE dsconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->dsdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT dsdata FROM tbduplasena WHERE dsconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->dsdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT dsdata FROM tbduplasena WHERE dsconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->dsdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT dsdata FROM tbduplasena WHERE dsconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->dsdata}";
                      }
                    }                
                } //end foreach

                $ds01pr06 = "{$item->ds01pr06}";
                $ds01pr05 = "{$item->ds01pr05}";
                $ds01pr04 = "{$item->ds01pr04}";
                $ds01pr03 = "{$item->ds01pr03}";
                $ds02pr06 = "{$item->ds02pr06}";
                $ds02pr05 = "{$item->ds02pr05}";
                $ds02pr04 = "{$item->ds02pr04}";
                $ds02pr03 = "{$item->ds02pr03}";

                $dspremioest = "{$item->dspremioest}";

                $ds01gan06 = "{$item->ds01gan06}";
                $ds01gan05 = "{$item->ds01gan05}";
                $ds01gan04 = "{$item->ds01gan04}";
                $ds01gan03 = "{$item->ds01gan03}";
                $ds02gan06 = "{$item->ds02gan06}";
                $ds02gan05 = "{$item->ds02gan05}";
                $ds02gan04 = "{$item->ds02gan04}";
                $ds02gan03 = "{$item->ds02gan03}";

                $dscidadesgan = "{$item->dscidadesgan}";

                $dtatual = "{$item->dsdata}";
                $ds01d01 = "{$item->ds01d01}";
                $ds01d02 = "{$item->ds01d02}";
                $ds01d03 = "{$item->ds01d03}";
                $ds01d04 = "{$item->ds01d04}";
                $ds01d05 = "{$item->ds01d05}";
                $ds01d06 = "{$item->ds01d06}";
                $ds02d01 = "{$item->ds02d01}";
                $ds02d02 = "{$item->ds02d02}";
                $ds02d03 = "{$item->ds02d03}";
                $ds02d04 = "{$item->ds02d04}";
                $ds02d05 = "{$item->ds02d05}";
                $ds02d06 = "{$item->ds02d06}";

         ?>

        <div class="content_left">

            <!-- Dupla Sena -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tduplasena">            
                <h5><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Dupla Sena -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tduplasena">            
                <h5><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Dupla Sena -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tduplasena">            
                <h5><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Dupla Sena -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tduplasena">            
                <h5><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Dupla Sena -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tduplasena">            
                <h5><span class="icone"><img src="../../img/icon_duplasena.png" width="20"></span> Dupla Sena
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
        <p>A loteria Dupla Sena foi lançada em 06 de novembro de 2001 pela Caixa Econômica Federal e é uma versão da Mega Sena com 
          mais chances de acertar. Com 50 números disponíveis no volante de apostas, de 01 a 50, você pode marcar de 6 a 15 
          números e ganha se acertar 3 (Terno), 4 (Quadra), 5 (Quina) ou 6 (Sena) números. O custo de uma aposta com 6 números 
          é de R$ 2,50 e sua aposta participa de 2 sorteios no mesmo concurso. A probabilidade de acertar todos os 6 números é 
          de 1 em 15.890.700.</p>

        <p><strong>No painel de resultados abaixo, você confere hoje o resultado da Dupla Sena online no último 
          concurso. Os resultados anteriores você confere nas páginas dos respectivos números dos concursos no menu a esquerda 
          ou utilizando o campo de busca para concursos mais antigos.</strong></p>      
      </div> 
          <div class="top_right_duplasena">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ds01d01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
            }
          ?></strong>
          </div> <!-- end top_right -->

          <div class="right_lduplasena">
          <div class="top_right_duplasena text-white"><h5>1º Sorteio</h5></div>
            <div class="cardnumbers_duplasena">
            
              <?php 
                for ($j = 1; $j <= 50; $j++) {
                  if($j == $ds01d01 || $j == $ds01d02 || $j == $ds01d03 || $j == $ds01d04 || $j == $ds01d05 || $j == $ds01d06) {
                    echo "<div class='cardnumber_sel selds'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 50 && $j % 10 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers -->
            <div class="top_right_duplasena text-white"><h5>2º Sorteio</h5></div>
            <div class="cardnumbers_duplasena">
              
              <?php 
                for ($j = 1; $j <= 50; $j++) {
                  if($j == $ds02d01 || $j == $ds02d02 || $j == $ds02d03 || $j == $ds02d04 || $j == $ds02d05 || $j == $ds02d06) {
                    echo "<div class='cardnumber_sel selds'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 50 && $j % 10 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers_duplasena -->

          </div> <!-- end right_lduplasena -->
          

          <div class="right_rduplasena">
            <div class="top_right_duplasena text-white"><h5>1º Sorteio</h5></div>
            <div class="resultnumbers">

              <?php

                foreach($dados as $item){

                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d01}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d02}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d03}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d04}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d05}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds01d06}";
                  echo "</div>";
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_rduplasena-->

          <div class="right_rduplasena">

            <div class="top_right_duplasena text-white"><h5>2º Sorteio</h5></div>
            <div class="resultnumbers">

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d01}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d02}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d03}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d04}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d05}";
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo "{$item->ds02d06}";
                  echo "</div>";
                }

              ?>
            </div> <!-- end resultnumbers -->          
          </div> <!-- end right_rduplasena-->

      </div> <!-- end right -->
      <div class="right_middle">

<div class="tbl_premiacao">

      <div class="acertos col-md-2 col-sm-2 col-3">
        <div class="title_acertos">Faixa</div>
        <ul class="faixa_premiacao">
          <li><strong>1º Sorteio</strong></li>
          <li>Sena</li>
          <li>Quina</li>
          <li>Quadra</li>
          <li>Terno</li>
          <li><strong>2º Sorteio</strong></li>
          <li>Sena</li>
          <li>Quina</li>
          <li>Quadra</li>
          <li>Terno</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li>---</li>
          <li><?php echo "R$ ".$ds01pr06 ?></li>
          <li><?php echo "R$ ".$ds01pr05 ?></li>
          <li><?php echo "R$ ".$ds01pr04 ?></li>
          <li><?php echo "R$ ".$ds01pr03 ?></li>
          <li>---</li>
          <li><?php echo "R$ ".$ds02pr06 ?></li>
          <li><?php echo "R$ ".$ds02pr05 ?></li>
          <li><?php echo "R$ ".$ds02pr04 ?></li>
          <li><?php echo "R$ ".$ds02pr03 ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      <div class="ganhadores col-md-2 col-sm-2 col-2">
      <div class="title_acertos">Ganhadores</div>
        <ul class="ganhadores">
          <li>---</li>
          <li><?php echo $ds01gan06 ?></li>
          <li><?php echo $ds01gan05 ?></li>
          <li><?php echo $ds01gan04 ?></li>
          <li><?php echo $ds01gan03 ?></li>
          <li>---</li>
          <li><?php echo $ds02gan06 ?></li>
          <li><?php echo $ds02gan05 ?></li>
          <li><?php echo $ds02gan04 ?></li>
          <li><?php echo $ds02gan03 ?></li>
        </ul>  
      </div> <!-- end ganhadores col-md2 -->
      <div class="cidades col-md-4">
      <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $dscidadesgan ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info tduplasena col-12">
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

<div class="text_info_duplasena">
<h2>Como jogar na Dupla Sena</h2>
<p>Para jogar na Dupla Sena compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 50 n&uacute;meros de 01 a 50. Com um &uacute;nico jogo voc&ecirc; concorre aos dois sorteios do concurso e pode escolher entre 6 e 15 n&uacute;meros com os respectivos custos de aposta por jogo:</p>
<div class="fl">
<ul>
<li><strong>06 n&uacute;meros:</strong>&nbsp;R$ 2,50</li>
<li><strong>07 n&uacute;meros:</strong>&nbsp;R$ 17,50</li>
<li><strong>08 n&uacute;meros:</strong>&nbsp;R$ 70,00</li>
<li><strong>09 n&uacute;meros:</strong>&nbsp;R$ 210,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>10 n&uacute;meros:</strong>&nbsp;R$ 525,00</li>
<li><strong>11 n&uacute;meros:</strong>&nbsp;R$ 1.155,00</li>
<li><strong>12 n&uacute;meros:</strong>&nbsp;R$ 2.310,00</li>
</ul>
</div>
<div class="fl">
<ul>
<li><strong>13 n&uacute;meros:</strong>&nbsp;R$ 4.290,00</li>
<li><strong>14 n&uacute;meros:</strong>&nbsp;R$ 7.507,50</li>
<li><strong>15 n&uacute;meros:</strong>&nbsp;R$ 12.512,50</li>
</ul>
</div>
<div class="cb">&nbsp;</div>
<p>As probabilidades de acerto das apostas acima para o pr&ecirc;mio principal s&atilde;o:</p>
<ul>
<li><strong>06 n&uacute;meros</strong>: 1 em 15.890.700 jogos</li>
<li><strong>07 n&uacute;meros</strong>: 1 em 2.270.100 jogos</li>
<li><strong>08 n&uacute;meros</strong>: 1 em 567.525 jogos</li>
<li><strong>09 n&uacute;meros</strong>: 1 em 189.175 jogos</li>
<li><strong>10 n&uacute;meros</strong>: 1 em 75.670 jogos</li>
<li><strong>11 n&uacute;meros</strong>: 1 em 34.395 jogos</li>
<li><strong>12 n&uacute;meros</strong>: 1 em 17.197 jogos</li>
<li><strong>13 n&uacute;meros</strong>: 1 em 9.260 jogos</li>
<li><strong>14 n&uacute;meros</strong>: 1 em 5.291 jogos</li>
<li><strong>15 n&uacute;meros</strong>: 1 em 3.174 jogos</li>
</ul>
<p>Em um &uacute;nico volante de apostas da Dupla Sena &eacute; poss&iacute;vel marcar at&eacute; 2 jogos. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema de apostas da Caixa escolha os n&uacute;meros por voc&ecirc;. Deixe o volante da Dupla Sena em branco e marque entre 1 e 8 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Dupla Sena. Basta marcar 2, 4 ou 8 concursos.</p>
<p>Se desejar apostar em grupo na Dupla Sena voc&ecirc; ainda pode fazer o Bol&atilde;o CAIXA para dividir em cotas por apostador. Assim, cada apostador recebe um bilhete de apostas com todos os jogos realizados para confer&ecirc;ncia e se ganharem cada um pode retirar a sua parte no pr&ecirc;mio individualmente. A Caixa ir&aacute; garantir que cada apostador receba a parte do pr&ecirc;mio a que tem direito.<br />O valor m&iacute;nimo do Bol&atilde;o da Dupla Sena &eacute; de R$ 10,00, ou seja, 4 jogos de 6 n&uacute;meros, e cada cota n&atilde;o pode ser inferior a R$ 2,50 com o m&iacute;nimo de 2 e m&aacute;ximo de 50 cotas. No volante de apostas da Dupla Sena h&aacute; um campo onde se marca o n&uacute;mero de cotas.<br />Voc&ecirc; tamb&eacute;m pode comprar cotas de bol&otilde;es organizados pelas pr&oacute;prias Casas Lot&eacute;ricas onde poder&aacute; ser cobrada Tarifa de Servi&ccedil;o adicional de at&eacute; 35% do valor de cada cota.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Dupla Sena</h2>
<p>O pr&ecirc;mio principal do primeiro sorteio para quem acertar os 6 n&uacute;meros sozinho &eacute; estimado em R$ 200.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. A Dupla Sena &eacute; uma das loterias que mais acumulam. Se acumular o valor destinado ao pr&ecirc;mio principal do primeiro sorteio &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o ocorre em todas as faixas de premia&ccedil;&atilde;o.<br />O segundo sorteio da Dupla Sena paga um pr&ecirc;mio menor para 6 acertos que o primeiro sorteio.</p>
<p>Apostando de 7 a 15 n&uacute;meros e acertando de 4 a 6 n&uacute;meros a premia&ccedil;&atilde;o &eacute; proporcional. Por exemplo, se apostar com 7 n&uacute;meros e acertar 6 n&uacute;meros, al&eacute;m de ganhar o pr&ecirc;mio principal, voc&ecirc; ganha 6 pr&ecirc;mios de 5 acertos.</p>
<p>Do valor arrecadado para cada concurso da Dupla Sena somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. O pr&ecirc;mio l&iacute;quido &eacute; distribuido da seguinte maneira:</p>
<ul>
<li><strong>30%</strong>: 6 acertos no primeiro sorteio</li>
<li><strong>10%</strong>: 5 acertos no primeiro sorteio</li>
<li><strong>8%</strong>: 4 acertos no primeiro sorteio</li>
<li><strong>4%</strong>: 3 acertos no primeiro sorteio<br /><br /></li>
<li><strong>11%</strong>: 6 acertos no segundo sorteio</li>
<li><strong>9%</strong>: 5 acertos no segundo sorteio</li>
<li><strong>8%</strong>: 4 acertos no segundo sorteio</li>
<li><strong>4%</strong>: 3 acertos no segundo sorteio</li>
</ul>
<p>Os outros 16% do valor restante s&atilde;o acumulados ao pr&ecirc;mio principal do concurso especial da Dupla Sena de P&aacute;scoa. Os 56,65% do valor arrecadado que n&atilde;o fazem parte da premia&ccedil;&atilde;o s&atilde;o distribu&iacute;dos da seguinte maneira:</p>
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
<h2>Dupla Sena de P&aacute;scoa</h2>
<p>A Dupla Sena de P&aacute;scoa &eacute; um concurso especial da Dupla Sena realizado no s&aacute;bado que antecede o domingo de p&aacute;scoa de cada ano.</p>
<p>As regras para jogar neste concurso especial s&atilde;o iguais aos outros concursos da Dupla Sena. Mas, o percentual da arrecada&ccedil;&atilde;o destinado ao pr&ecirc;mio principal &eacute; maior e se n&atilde;o houver nenhum ganhador com 6 acertos o pr&ecirc;mio principal &eacute; somado e pago aos ganhadores com 5 acertos, ou seja, o pr&ecirc;mio do concurso da Dupla Sena de P&aacute;scoa n&atilde;o acumula.</p>
<p>O pr&ecirc;mio &eacute; composto pelo ac&uacute;mulo de parte do valor arrecadado nos concursos da Dupla Sena realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana antecedente &agrave; data do sorteio da Dupla Sena de P&aacute;scoa, com o n&uacute;mero de concurso de final 0 ou 5, n&atilde;o s&atilde;o realizados os sorteios normais da Dupla Sena.</p>
<h2>Aos ganhadores da Dupla Sena</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Dupla Sena saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000.000 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Dupla Sena &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
</div><!-- end text_info_duplasena -->
</div> <!-- end main -->

</div> <!-- end containermain -->







</body>
</html>
