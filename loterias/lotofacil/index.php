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

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }

                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->lfconc}";
                  $datalast = "{$itemlast->lfdata}";
                  $premiolast = "{$itemlast->lfpremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->lfdata}"));
                  if("{$item->lfd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->lfconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->lfconc}";
                      $post1 = $ultimo;
                    } else if ($dataproximo < $dataatual){//foi sorteado mas não foi lançado
                      $ultimo = "{$item->lfconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->lfconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else if ("{$item->lfd01}" != 0) { //foi sorteado
                    $ultimo = (int)"{$item->lfconc}";
                    $post1 = $ultimo +1;
                  }
                  $sql = "SELECT * FROM tblotofacil WHERE lfconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

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
          
        </div> <!-- end left_ads -->
        
      </div> <!-- end left -->

      <div class="right">
      <div class="text_top">
        <p>A Lotofácil foi lançada em 29 de setembro de 2003. O volante é composto por 25 números e deve-se marcar de 15 a 20 números. São sorteados 15 números e ganha quem acertar 11, 12, 13, 14 ou 15 números. O valor da aposta mínima, de 15 números, é de R$ 2,50. Os sorteios são realizados nas segundas, terças, quartas, quintas, sextas-feiras e sábados, as 20 horas.</p><br>

        <p><strong>Abaixo você confere o resultado da Lotofácil no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>       
          
          <div class="top_right_lotofacil">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->lfd01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
            
            if($premiopost == "Aguardando..."){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ "."{$item->lfpremioest}"."</em></span>";
            } else if ($premiopost != "Aguardando..." && "{$item->lfgan15}" == 0 && "{$item->lfpr15}" != ""){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>A C U M U L O U !!!</em></span>";
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
                $ordemnum[0] = $d01;
                $ordemnum[1] = $d02;
                $ordemnum[2] = $d03;                  
                $ordemnum[3] = $d04;
                $ordemnum[4] = $d05;
                $ordemnum[5] = $d06;
                $ordemnum[6] = $d07;
                $ordemnum[7] = $d08;
                $ordemnum[8] = $d09;
                $ordemnum[9] = $d10;
                $ordemnum[10] = $d11;
                $ordemnum[11] = $d12;
                $ordemnum[12] = $d13;
                $ordemnum[13] = $d14;
                $ordemnum[14] = $d15;
                sort($ordemnum);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[4];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[5];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[6];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[7];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[8];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[9];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[10];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[11];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[12];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[13];
                  echo "</div>";
                  echo "<div class='resultnumber tlotofacil'>";
                      echo $ordemnum[14];
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 

<div class="middle_ads">
              
</div> <!-- end middle_ads -->

<div class="text_info_lotofacil">
  <h2>Como jogar na Lotofácil</h2>
  <p>A Lotofácil é, como o próprio nome diz, fácil de apostar e principalmente de ganhar. Você marca entre 15 e 20 números, dentre os 25 disponíveis no volante, e fatura prêmio se acertar 11, 12, 13, 14 ou 15 números. Pode ainda deixar que o sistema escolha os números para você por meio da Surpresinha, ou concorrer com a mesma aposta por 3, 6, 12, 18 ou 24 concursos consecutivos através da Teimosinha.</p>
<br>
<h2>Tabela de Preços</h2>
<div class="bordasimples">
  <table class="bordasimples">
    <tr>
      <td>15 números</td>
      <td>R$ 2,50</td>
    </tr>
    <tr>
      <td>16 números</td>
      <td>R$ 40,00</td>
    </tr>
    <tr>
      <td>17 números</td>
      <td>R$ 340,00</td>
    </tr>
    <tr>
      <td>18 números</td>
      <td>R$ 2.040,00</td>
    </tr>
    <tr>
      <td>19 númerose</td>
      <td>R$ 9.690,00</td>
    </tr>
    <tr>
      <td>20 números</td>
      <td>R$ 38.760,00</td>
    </tr>
  </table>
</div> <!-- borda simples -->

<div class="cb">&nbsp;</div>
<h2>Probabilidade</h2>
<ul>
  <li><strong>15 números</strong>: 1 em 3.268.760</li>
  <li><strong>14 números</strong>: 1 em 21.792</li>
  <li><strong>13 números</strong>: 1 em 692</li>
  <li><strong>12 números</strong>: 1 em 60</li>
  <li><strong>11 números</strong>: 1 em 11</li>
</ul>

<h2>Premiação</h2>
<p>O prêmio bruto corresponde a 45,3% da arrecadação, já computado o adicional destinado ao Ministério do Esporte. Dessa porcentagem, será deduzido o pagamento dos prêmios com valores fixos:</p>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>13 acertos:</td>
    <td>R$ 25,00</td>
  </tr>
  <tr>
    <td>12 acertos:</td>
    <td>R$ 10,00</td>
  </tr>
  <tr>
    <td>11 acertos:</td>
    <td>R$ 5,00</td>
  </tr>
</table>
</div>
<br>
<p>Somente após a apuração dos ganhadores dos prêmios com valores fixos, o valor restante do total destinado à premiação será distribuído para as demais faixas de prêmios nos seguintes percentuais:</p>
<table class="bordasimples">
  <tr>
    <td>15 acertos:</td>
    <td>62%</td>
  </tr>
  <tr>
    <td>14 acertos:</td>
    <td>13%</td>
  </tr>
</table>
<br>
<p>Nos concursos de final 0, após a apuração dos ganhadores dos prêmios com valores fixos, o valor restante do total destinado à premiação será distribuído para as demais faixas de prêmios nos seguintes percentuais:</p>
<table class="bordasimples">
  <tr>
    <td>15 acertos:</td>
    <td>72%</td>
  </tr>
  <tr>
    <td>14 acertos:</td>
    <td>13%</td>
  </tr>
  <tr>
    <td>Acumulado para 15 acertos do concurso especial de setembro:</td>
    <td>15%</td>
  </tr>
</table>
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


<h2>Lotofácil da Independência</h2>
<p>A Lotofácil da Independência é um concurso especial da Lotofácil realizado em setembro de cada ano e ganhou este nome em decorrência da comemoração da Independência do Brasil no dia 07 de setembro. O primeiro sorteio da Lotofácil da Independência ocorreu no dia 06 de setembro de 2012 com o concurso de número 800.</p>

<p>As regras para jogar neste concurso especial são iguais aos outros concursos da Lotofácil. Mas, o percentual da arrecadação destinado ao prêmio principal é maior e se não houver nenhum ganhador com 15 acertos o prêmio principal é somado e pago aos ganhadores com 14 acertos, ou seja, o prêmio do concurso da Lotofácil da Independência não acumula.</p>

<p>O prêmio é composto pelo acúmulo de parte do valor arrecadado nos concursos da Lotofácil realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana antecedente à data do sorteio da Lotofácil da Independência não são realizados os sorteios normais da Lotofácil.
</p>

<h2>Aos ganhadores da Lotofácil</h2>
<p>Caso você seja um dos ganhadores da Lotofácil saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Lotofácil é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>

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
