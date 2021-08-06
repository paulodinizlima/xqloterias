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
        <span class="font14">Confira o resultado, ganhadores e prêmios do Super Sete nos sorteios que 
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

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc) FROM tbsupersete)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }

                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->spsconc}";
                  $datalast = "{$itemlast->spsdata}";
                  $premiolast = "{$itemlast->spspremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('14:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->spsdata}")); 
                  if("{$item->spsd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->spsconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->spsconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->spsconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->spsconc}";
                    $post1 = $ultimo +1;
                  }
                  
                  $sql = "SELECT * FROM tbsupersete WHERE spsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

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
          
        </div> <!-- end left_ads -->
        

      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>O Super Sete foi lançado em setembro de 2020 e seu primeiro concurso foi realizado em 02 de outubro de 2020. O volante contém 7 colunas com 10 números cada uma. O apostador deve marcar de 01 a 03 números por coluna. São sorteados sete números (um por coluna) e ganha quem acertar 7, 6, 5, 4 ou 3 colunas. O valor da aposta mínima, de 7 números, é de R$ 2,50. Os sorteios são realizados nas segundas, quartas e sextas-feiras, a partir das 15 horas.</p><br>

        <p><strong>Abaixo você confere hoje o resultado do Super Sete no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>   
          <div class="top_right_supersete">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if($d01 == 0){ //não foi sorteado 
              //echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premiopost."</span>";
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
                    echo $d01;
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
             
</div> <!-- end middle_ads -->

<div class="text_info_supersete">
  <h2>Como jogar no Super Sete</h2>
  <p>O Super Sete é a loteria de prognósticos numéricos cujo volante contém 7 colunas com 10 números (de 0 a 9) em cada uma, de forma que o apostador deverá escolher um número por coluna. Caso opte por fazer apostas múltiplas, poderá escolher até mais 14 números (totalizando 21 números no máximo), sendo no mínimo 1 e no máximo 2 números por coluna com 8 a 14 números marcados e no mínimo 2 e no máximo 3 números por coluna com 15 a 21 números marcados. São sorteados sete números (um por coluna). Você pode deixar, ainda, que o sistema escolha os números para você (Surpresinha) e/ou continuar com o seu jogo por 3, 6,  9 ou 12 concursos consecutivos (Teimosinha).</p>

<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>7 números</td>
      <td>R$ 2,50</td>
    </tr>
    <tr>
      <td>8 números</td>
      <td>R$ 5,00</td>
    </tr>
    <tr>
      <td>9 números</td>
      <td>R$ 10,00</td>
    </tr>
    <tr>
      <td>10 números</td>
      <td>R$ 20,00</td>
    </tr>
    <tr>
      <td>11 números</td>
      <td>R$ 40,00</td>
    </tr>
    <tr>
      <td>12 números</td>
      <td>R$ 80,00</td>
    </tr>
    <tr>
      <td>13 números</td>
      <td>R$ 160,00</td>
    </tr>
    <tr>
      <td>14 números</td>
      <td>R$ 320,00</td>
    </tr>
    <tr>
      <td>15 números</td>
      <td>R$ 480,00</td>
    </tr>
    <tr>
      <td>16 números</td>
      <td>R$ 720,00</td>
    </tr>
    <tr>
      <td>17 números</td>
      <td>R$ 1.080,00</td>
    </tr>
    <tr>
      <td>18 números</td>
      <td>R$ 1.620,00</td>
    </tr>
    <tr>
      <td>19 números</td>
      <td>R$ 2.430,00</td>
    </tr>
    <tr>
      <td>20 números</td>
      <td>R$ 3.645,00</td>
    </tr>
    <tr>
      <td>21 números</td>
      <td>R$ 5.467,50</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidade</h2>
<ul>
<li><strong>07 números</strong>: 1 em 10.000.000</li>
<li><strong>08 números</strong>: 1 em 5.000.000</li>
<li><strong>09 números</strong>: 1 em 2.500.000</li>
<li><strong>10 números</strong>: 1 em 1.250.000</li>
<li><strong>11 números</strong>: 1 em 625.000</li>
<li><strong>12 números</strong>: 1 em 312.500</li>
<li><strong>13 números</strong>: 1 em 156.250</li>
<li><strong>14 números</strong>: 1 em 78.125</li>
<li><strong>15 números</strong>: 1 em 52.083</li>
<li><strong>16 números</strong>: 1 em 34.722</li>
<li><strong>17 números</strong>: 1 em 23.148</li>
<li><strong>18 números</strong>: 1 em 15.432</li>
<li><strong>19 números</strong>: 1 em 10.288</li>
<li><strong>20 números</strong>: 1 em 6.859</li>
<li><strong>21 números</strong>: 1 em 4.572</li>
</ul>

<h2>Premiação</h2>
<p>O prêmio bruto corresponde a <strong>43,35%</strong> da arrecadação. Dessa porcentagem, será deduzido o pagamento dos prêmios com valores fixos:</p>
<p><strong>- R$ 5,00 para as apostas com 3 prognósticos certos entre os 7 sorteados;</strong></p>
<br>

<p>Após a apuração dos ganhadores dos prêmios com valor fixo, o valor restante do total destinado à premiação será distribuído para as demais faixas de prêmios nos seguintes percentuais:</p>
<p>- <strong>55%</strong> entre os acertadores de 7 colunas com prognósticos certos;</p>
<p>- <strong>15%</strong> entre os acertadores de 6 colunas com prognósticos certos entre os 7 sorteados;</p>
<p>- <strong>15%</strong> entre os acertadores de 5 colunas com prognósticos certos entre os 7 sorteados;</p>
<p>- <strong>15%</strong> entre os acertadores de 4 colunas com prognósticos certos entre os 7 sorteados.</p>

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
<h2>Aos ganhadores do Super Sete</h2>
<p>Caso você seja um dos ganhadores do Super Sete saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete do Super Sete é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


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
