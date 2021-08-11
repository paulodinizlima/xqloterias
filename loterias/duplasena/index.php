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

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc) FROM tbduplasena)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }
                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->dsconc}";
                  $datalast = "{$itemlast->dsdata}";
                  $premiolast = "{$itemlast->dspremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->dsdata}"));               
                  if("{$item->ds01d01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->dsconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->dsconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->dsconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { //foi sorteado
                    $ultimo = (int)"{$item->dsconc}";
                    $post1 = $ultimo +1;
                  }

                  $sql = "SELECT * FROM tbduplasena WHERE dsconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

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

        <!--ads aqui -->

      <div class="left_ads">
        <!--ads aqui -->
      </div> <!-- end left_ads -->
          
      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>A Dupla Sena foi lançada em 06 de novembro de 2001. O volante é composto por 50 números e você pode marcar de 6 a 15 números. São sorteados 6 números e ganha quem acertar 3, 4, 5 ou 6 números. O valor da aposta mínima, de 6 números, é de R$ 2,50. A Dupla Sena é sorteada às terças, quintas e sábados, sempre às 20h.</p><br>

        <p><strong>Abaixo você confere hoje o resultado da Dupla Sena no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
          <div class="top_right_duplasena">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ds01d01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
            
            if($premiopost == "Aguardando..."){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ "."{$item->dspremioest}"."</em></span>";
            } else if ($premiopost != "Aguardando..." && "{$item->ds01gan06}" == 0 && "{$item->ds01pr06}" != ""){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>A C U M U L O U !!!</em></span>";
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
                $ordemnum1[0] = $ds01d01;
                $ordemnum1[1] = $ds01d02;
                $ordemnum1[2] = $ds01d03;                  
                $ordemnum1[3] = $ds01d04;
                $ordemnum1[4] = $ds01d05;
                $ordemnum1[5] = $ds01d06;
                sort($ordemnum1);
              ?>

              <?php

                foreach($dados as $item){

                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[0];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[1];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[2];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[3];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[4];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum1[5];
                  echo "</div>";
                }

              ?>

            </div> <!-- end resultnumbers -->
          
          </div> <!-- end right_rduplasena-->

          <div class="right_rduplasena">

            <div class="top_right_duplasena text-white"><h5>2º Sorteio</h5></div>
            <div class="resultnumbers">

              <?php
                $ordemnum2[0] = $ds02d01;
                $ordemnum2[1] = $ds02d02;
                $ordemnum2[2] = $ds02d03;                  
                $ordemnum2[3] = $ds02d04;
                $ordemnum2[4] = $ds02d05;
                $ordemnum2[5] = $ds02d06;
                sort($ordemnum2);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[0];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[1];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[2];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[3];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[4];
                  echo "</div>";
                  echo "<div class='resultnumber tduplasena'>";
                      echo $ordemnum2[5];
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
<!--ads aqui -->            
</div> <!-- end middle_ads -->

<div class="text_info_duplasena">
  <h2>Como jogar na Dupla Sena</h2>
  <p>Com apenas um bilhete da Dupla Sena, você tem o dobro de chances de ganhar: são dois sorteios por concurso e ganha acertando 3, 4, 5 ou 6 números no primeiro e/ou segundo sorteios.</p>
  <p>Basta escolher de 6 a 15 números dentre os 50 disponíveis e torcer. Você pode deixar, ainda, que o sistema escolha os números para você (Surpresinha) e/ou concorrer com a mesma aposta por 2, 4 ou 8, 3, 6, 9 ou 12 concursos consecutivos (Teimosinha).</p>

<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>6 números</td>
      <td>R$ 2,50</td>
    </tr>
    <tr>
      <td>7 números</td>
      <td>R$ 17,50</td>
    </tr>
    <tr>
      <td>8 números</td>
      <td>R$ 70,00</td>
    </tr>
    <tr>
      <td>9 números</td>
      <td>R$ 210,00</td>
    </tr>
    <tr>
      <td>10 números</td>
      <td>R$ 525,00</td>
    </tr>
    <tr>
      <td>11 números</td>
      <td>R$ 1.155,00</td>
    </tr>
    <tr>
      <td>12 números</td>
      <td>R$ 2.310,00</td>
    </tr>
    <tr>
      <td>13 números</td>
      <td>R$ 4.290,00</td>
    </tr>
    <tr>
      <td>14 números</td>
      <td>R$ 7.507,50</td>
    </tr>
    <tr>
      <td>15 números</td>
      <td>R$ 12.512,50</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidade</h2>
<ul>
<li><strong>06 números</strong>: 1 em 15.890.700</li>
<li><strong>07 números</strong>: 1 em 2.270.100</li>
<li><strong>08 números</strong>: 1 em 567.525</li>
<li><strong>09 números</strong>: 1 em 189.175</li>
<li><strong>10 números</strong>: 1 em 75.670</li>
<li><strong>11 números</strong>: 1 em 34.395</li>
<li><strong>12 números</strong>: 1 em 17.197</li>
<li><strong>13 números</strong>: 1 em 9.260</li>
<li><strong>14 números</strong>: 1 em 5.291</li>
<li><strong>15 números</strong>: 1 em 3.174</li>
</ul>

<h2>Premiação</h2>
<p>O prêmio bruto corresponde a 43,35% da arrecadação. Desse valor, são distribuídos, para o primeiro sorteio:</p>
<br>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>6 acertos:</td>
    <td>30%</td>
  </tr>
  <tr>
    <td>5 acertos:</td>
    <td>10%</td>
  </tr>
  <tr>
    <td>4 acertos:</td>
    <td>8%</td>
  </tr>
  <tr>
    <td>3 acertos:</td>
    <td>4%</td>
  </tr>
</table>
</div>
<br>
<p>E para o segundo sorteio:</p>
<br>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>6 acertos:</td>
    <td>11%</td>
  </tr>
  <tr>
    <td>5 acertos:</td>
    <td>9%</td>
  </tr>
  <tr>
    <td>4 acertos:</td>
    <td>8%</td>
  </tr>
  <tr>
    <td>3 acertos:</td>
    <td>4%</td>
  </tr>
</table>
</div>
<br>
<p><strong>16%</strong> ficam acumulados para a 1ª faixa do 1º sorteio (seis acertos) do próximo concurso especial de Páscoa.</p>

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
<br>
<h2>Dupla de Páscoa</h2>
<p>O Concurso Especial Dupla de Páscoa acontece todo ano, no sábado que antecede o domingo de páscoa, e obedece às seguintes regras:</p>

<p><strong>Prazo de comercialização:</strong></p>
<p>Durante 30 dias com captação de apostas independente e concomitante com os demais concursos da modalidade, utilizando-se de volantes específicos (a CAIXA informará com antecedência a data do início das vendas e o número do concurso especial).</p>
<p><strong>Distribuição do valor destinado ao pagamento dos prêmios:</strong></p>

<p>- 1ª faixa - 46% rateados entre as apostas que contiverem 6 prognósticos certos (sena) do 1º sorteio;</p>

<p>- 2ª faixa - 10% rateados entre as apostas que contiverem 5 prognósticos certos (quina) do 1º sorteio;</p>

<p>- 3ª faixa - 8% rateados entre as apostas que contiverem 4 prognósticos certos (quadra) do 1º sorteio;</p>

<p>- 4ª faixa - 4% rateados entre as apostas que contiverem 3 prognósticos certos (terno) do 1º sorteio;</p>

<p>- 5ª faixa – 11% rateados entre as apostas que contiverem 6 prognósticos certos (sena) do 2º sorteio;</p>

<p>- 6ª faixa - 9% rateados entre as apostas que contiverem 5 prognósticos certos (quina) do 2º sorteio;</p>

<p>- 7ª faixa – 8% rateados entre as apostas que contiverem 4 prognósticos certos (quadra) do 2º sorteio;</p>

<p>- 8ª faixa – 4% rateados entre as apostas que contiverem 3 prognósticos certos (terno) do 2º sorteio.</p>

<p><strong>No concurso especial de Páscoa de cada ano, a 1ª faixa de premiação – seis acertos do 1º sorteio tem a seguinte composição:</strong></p>

<p>- 46% do valor destinado a prêmios;</p>

<p>- total acumulado para o concurso especial de Páscoa;</p>

<p>- total acumulado do concurso anterior, em quaisquer das faixas, quando houver.</p>

<p><strong>Critério de acumulação:</strong></p>

<p>- inexistindo aposta vencedora na primeira faixa de premiação ("sena") do primeiro sorteio, o valor destinado a esta faixa de premiação será adicionado ao valor destinado à segunda faixa de premiação ("quina") do primeiro sorteio e rateado entre os portadores de bilhetes com apostas vencedoras com cinco prognósticos certos;</p>

<p>- inexistindo aposta vencedora na primeira faixa de premiação ("sena") e na segunda faixa de premiação ("quina") do primeiro sorteio, o valor total destinado a estas faixas de premiação será adicionado ao valor destinado à terceira faixa de premiação ("quadra") do primeiro sorteio e rateado entre os portadores de bilhetes com apostas vencedoras com quatro prognósticos certos; e assim sucessivamente;</p>

<p>- inexistindo aposta vencedora nas quatro faixas de premiação ("sena", "quina", "quadra" e "terno") do primeiro sorteio, o valor total destinado a estas faixas de premiação será adicionado ao valor destinado à primeira faixa de premiação ("sena") do segundo sorteio e rateado entre os portadores de bilhetes com apostas vencedoras com seis prognósticos certos;</p>

<p>- inexistindo aposta vencedora nas quatro faixas de premiação ("sena", "quina", "quadra" e "terno") do primeiro sorteio e na primeira faixa de premiação ("sena") do segundo sorteio, o valor total destinado a estas faixas de premiação será adicionado ao valor destinado à segunda faixa de premiação ("quina") do segundo sorteio e rateado entre os portadores de bilhetes com apostas vencedoras com cinco prognósticos certos; e assim sucessivamente; e</p>

<p>- inexistindo aposta vencedora em qualquer uma das quatro faixas de premiação ("sena", "quina", "quadra" e "terno") do primeiro e do segundo sorteios, o valor total destinado a estas faixas de premiação será adicionado ao valor destinado à primeira faixa de premiação ("sena") do primeiro sorteio do concurso da Dupla-Sena imediatamente seguinte ao concurso especial de que se trata e rateado entre os portadores de bilhetes com apostas vencedoras com seis prognósticos certos.</p>
<br>

<h2>Aos ganhadores da Dupla Sena</h2>
<p>Caso você seja um dos ganhadores da Dupla Sena saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Dupla Sena é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


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
