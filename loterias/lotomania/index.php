<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>XQ Loterias - Lotomania</title>
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
          <a href="index.php" title="Lotomania"><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania</a>
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
      <div class="tloterias tlotomania">

      <h4><strong>LOTOMANIA</strong></h4>
        <span class="font14">Confira hoje o resultado, ganhadores e prêmios da Lotomania nos sorteios que são realizados nas
           terças-feiras e sextas-feiras a partir das 20 horas online.</span>

      </div> <!-- end tloterias tlotomania -->

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
                $binds = ['ltmconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tblotomania WHERE ltmconc = $conc";
                } else {
                  $sql = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc) FROM tblotomania)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc) FROM tblotomania)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }

                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->ltmconc}";
                  $datalast = "{$itemlast->ltmdata}";
                  $premiolast = "{$itemlast->ltmpremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->ltmdata}"));
                  if("{$item->ltmd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->ltmconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->ltmconc}";
                      $post1 = $ultimo;
                    } else if ($dataproximo < $dataatual){//foi sorteado mas não foi lançado
                      $ultimo = "{$item->ltmconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->ltmconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else if ("{$item->ltmd01}" != 0) { //foi sorteado
                    $ultimo = (int)"{$item->ltmconc}";
                    $post1 = $ultimo +1;
                  }
                  $sql = "SELECT * FROM tblotomania WHERE ltmconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $sqlpost = "SELECT * FROM tblotomania WHERE ltmconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }
                  
                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->ltmconc}"; 
                    $datapost = "{$itempost->ltmdata}";
                    $premiopost = "{$itempost->ltmpremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT ltmdata FROM tblotomania WHERE ltmconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->ltmdata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT ltmdata FROM tblotomania WHERE ltmconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->ltmdata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT ltmdata FROM tblotomania WHERE ltmconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->ltmdata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT ltmdata FROM tblotomania WHERE ltmconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->ltmdata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT ltmdata FROM tblotomania WHERE ltmconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->ltmdata}";
                      }
                    }                
                } //end foreach

                $ltmpr20 = "{$item->ltmpr20}";
                $ltmpr19 = "{$item->ltmpr19}";
                $ltmpr18 = "{$item->ltmpr18}";
                $ltmpr17 = "{$item->ltmpr17}";
                $ltmpr16 = "{$item->ltmpr16}";
                $ltmpr15 = "{$item->ltmpr15}";
                $ltmpr00 = "{$item->ltmpr00}";

                $ltmpremioest = "{$item->ltmpremioest}";

                $ltmgan20 = "{$item->ltmgan20}";
                $ltmgan19 = "{$item->ltmgan19}";
                $ltmgan18 = "{$item->ltmgan18}";
                $ltmgan17 = "{$item->ltmgan17}";
                $ltmgan16 = "{$item->ltmgan16}";
                $ltmgan15 = "{$item->ltmgan15}";
                $ltmgan00 = "{$item->ltmgan00}";

                $ltmcidadesgan = "{$item->ltmcidadesgan}";

                $dtatual = "{$item->ltmdata}";
                $d01 = "{$item->ltmd01}";
                $d02 = "{$item->ltmd02}";
                $d03 = "{$item->ltmd03}";
                $d04 = "{$item->ltmd04}";
                $d05 = "{$item->ltmd05}";
                $d06 = "{$item->ltmd06}";
                $d07 = "{$item->ltmd07}";
                $d08 = "{$item->ltmd08}";
                $d09 = "{$item->ltmd09}";
                $d10 = "{$item->ltmd10}";
                $d11 = "{$item->ltmd11}";
                $d12 = "{$item->ltmd12}";
                $d13 = "{$item->ltmd13}";
                $d14 = "{$item->ltmd14}";
                $d15 = "{$item->ltmd15}";
                $d16 = "{$item->ltmd16}";
                $d17 = "{$item->ltmd17}";
                $d18 = "{$item->ltmd18}";
                $d19 = "{$item->ltmd19}";
                $d20 = "{$item->ltmd20}";

         ?>

        <div class="content_left">

            <!-- Lotomania -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tlotomania">            
                <h5><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Lotomania -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tlotomania">            
                <h5><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a>

            <!-- Lotomania -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tlotomania">            
                <h5><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a>

            <!-- Lotomania -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tlotomania">            
                <h5><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a>

            <!-- Lotomania -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tlotomania">            
                <h5><span class="icone"><img src="../../img/icon_lotomania.png" width="20"></span> Lotomania
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
        <p>A Lotomania foi lançada em 02 de outubro de 1999. Com 100 números disponíveis no volante, você deve marcar 50 números e ganha se acertar 20, 19, 18, 17, 16 ou 0 números. O custo de uma aposta é de R$ 2,50 e a probabilidade de acertar os 20 números é de 1 em 11.372.635.</p><br>

        <p><strong>Abaixo você confere o resultado da Lotomania no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
          <div class="top_right_lotomania">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ltmd01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
            
            if($premiopost == "Aguardando..."){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ "."{$item->ltmpremioest}"."</em></span>";
            } else if ($premiopost != "Aguardando..." && "{$item->ltmgan20}" == 0 && "{$item->ltmpr20}" != ""){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>A C U M U L O U !!!</em></span>";
            }
          ?></strong>
          </div> <!-- end top_right -->

          <div class="right_llotomania">

            <div class="cardnumbers_lotomania">
              
              <?php 
                for ($j = 1; $j <= 100; $j++) {
                  if($j == $d01 || $j == $d02 || $j == $d03 || $j == $d04 || $j == $d05 ||
                     $j == $d06 || $j == $d07 || $j == $d08 || $j == $d09 || $j == $d10 ||
                     $j == $d11 || $j == $d12 || $j == $d13 || $j == $d14 || $j == $d15 ||
                     $j == $d16 || $j == $d17 || $j == $d18 || $j == $d19 || $j == $d20){
                    echo "<div class='cardnumber_sel selltm'>" ;
                    echo $j;
                    echo "</div>";
                  } else {
                    echo "<div class='cardnumber'>" ;
                    echo $j;
                    echo "</div>";
                  } 
                  if($j < 100 && $j % 10 == 0) echo "<br><br>";
                }

              ?>

            </div> <!-- end cardnumbers -->

          </div> <!-- end right_l -->

          <div class="right_rlotomania">
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
                $ordemnum[15] = $d16;
                $ordemnum[16] = $d17;
                $ordemnum[17] = $d18;
                $ordemnum[18] = $d19;
                $ordemnum[19] = $d20;
                sort($ordemnum);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[4];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[5];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[6];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[7];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[8];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[9];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[10];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[11];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[12];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[13];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[14];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[15];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[16];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[17];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[18];
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo $ordemnum[19];
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
                    <li>20 acertos</li>
                    <li>19 acertos</li>
                    <li>18 acertos</li>
                    <li>17 acertos</li>
                    <li>16 acertos</li>
                    <li>15 acertos</li>
                    <li>00 acertos</li>
                  </ul>
                </div> <!-- end acertos col-md2 -->
                <div class="valorpremio col-md-4 col-sm-5 col-5">
                <div class="title_acertos">Prêmio</div>
                  <ul class="premiacao">
                    <li><?php echo "R$ ".$ltmpr20 ?></li>
                    <li><?php echo "R$ ".$ltmpr19 ?></li>
                    <li><?php echo "R$ ".$ltmpr18 ?></li>
                    <li><?php echo "R$ ".$ltmpr17 ?></li>
                    <li><?php echo "R$ ".$ltmpr16 ?></li>
                    <li><?php echo "R$ ".$ltmpr15 ?></li>
                    <li><?php echo "R$ ".$ltmpr00 ?></li>
                  </ul>  
                </div> <!-- end valorpremio col-md3 -->
                <div class="ganhadores col-md-2 col-sm-2 col-2">
                <div class="title_acertos">Ganhadores</div>
                  <ul class="ganhadores">
                    <li><?php echo $ltmgan20 ?></li>
                    <li><?php echo $ltmgan19 ?></li>
                    <li><?php echo $ltmgan18 ?></li>
                    <li><?php echo $ltmgan17 ?></li>
                    <li><?php echo $ltmgan16 ?></li>
                    <li><?php echo $ltmgan15 ?></li>
                    <li><?php echo $ltmgan00 ?></li>
                  </ul>  
                </div> <!-- end ganhadores col-md2 -->
                <div class="cidades col-md-4">
                <div class="title_cidades">Cidades dos ganhadores</div>
                  <ul class="cidades">
                    <li><?php echo $ltmcidadesgan ?></li>
                  </ul>
                </div> <!-- end cidades col-md5 -->

          </div> <!-- end tbl_premiacao -->      

      </div> <!-- end right_middle -->
      <div class="right_lowmiddle_info tlotomania col-12">
        <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
        <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
        <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
      </div> <!-- end right_lowmiddle_info --> 
      <div class="middle_ads">
                       
      </div> <!-- end middle_ads -->

<div class="text_info_lotomania">
  <h2>Como jogar na Lotomania</h2>
  <p>A Lotomania é fácil de jogar e de ganhar: basta escolher 50 números e então concorrer a prêmios para acertos de 20, 19, 18, 17, 16, 15 ou nenhum número. Além da opção de marcar no volante, você ainda pode marcar menos que 50 números e deixar que o sistema complete o jogo para você; não marcar nada e deixar que o sistema escolha todos os números na Surpresinha e/ou concorrer com a mesma aposta por 2, 4 ou 8 concursos consecutivos com a Teimosinha. Outra opção é efetuar uma nova aposta com o sistema selecionando os outros 50 números não registrados no jogo original, através da Aposta-Espelho.</p>

<div class="cb">&nbsp;</div>
<h2>Probabilidade</h2>
<ul>
<li><strong>20 números</strong>: 1 em 11.372.635</li>
<li><strong>19 números</strong>: 1 em 352.551</li>
<li><strong>18 números</strong>: 1 em 24.235</li>
<li><strong>17 números</strong>: 1 em 2.776</li>
<li><strong>16 números</strong>: 1 em 472</li>
<li><strong>15 números</strong>: 1 em 112</li>
<li><strong>0 números</strong>: 1 em 11.372.635</li>
</ul>

<h2>Premiação</h2>
<p>O apostador escolhe 50 números e ganha se acertar 15, 16, 17, 18, 19, 20 ou nenhum dos números sorteados. O preço da aposta é único e custa apenas R$ 2,50. O prêmio bruto corresponde a <strong>45,3%</strong> da arrecadação, já computado o adicional destinado ao Ministério do Esporte. Dessa porcentagem são distribuídos:</p>
<br>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>20 acertos:</td>
    <td>45%</td>
  </tr>
  <tr>
    <td>19 acertos:</td>
    <td>16%</td>
  </tr>
  <tr>
    <td>18 acertos:</td>
    <td>10%</td>
  </tr>
  <tr>
    <td>17 acertos:</td>
    <td>7%</td>
  </tr>
  <tr>
    <td>16 acertos:</td>
    <td>7%</td>
  </tr>
  <tr>
    <td>15 acertos:</td>
    <td>7%</td>
  </tr>
  <tr>
    <td>0 acertos:</td>
    <td>8%</td>
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
<li><strong>19,13%</strong>: Despesas de Custeio e Manutenção de Serviços<br />Deste percentual 9,57% são de Despesas Operacionais, 8,61% da Comissão dos Lotéricos e 0,95% do FDL - Fundo Desenvolvimento das Loterias.</li>
</ul>
<h2>Aos ganhadores da Lotomania</h2>
<p>Caso você seja um dos ganhadores da Lotomania saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Lotomania é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


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
