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
                $dataatual = strtotime(date('Y-m-d'));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->ltmdata}"));                
                  if("{$item->ltmd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->ltmconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->ltmconc}";
                    } else {
                      $ultimo = "{$item->ltmconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->ltmconc}";
                  }
                  $sql = "SELECT * FROM tblotomania WHERE ltmconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
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
        <p>A Lotomania foi lançada em 02 de outubro de 1999 pela Caixa Econômica Federal. Com 100 números disponíveis no volante 
          de apostas, de 01 a 00, você deve marcar 50 números e ganha se acertar 20, 19, 18, 17 ou 16 números e também se não 
          acertar nenhum. O custo de uma aposta é de R$ 2,50 e a probabilidade de acertar todos os 20 números é de 1 em 11.372.635.</p>

        <p><strong>No painel de resultados abaixo, você confere hoje o resultado da Lotomania online no último
           concurso. Os resultados dos sorteios anteriores você confere nas páginas dos respectivos números dos concursos no 
           menu a esquerda ou utilizando o campo de busca para concursos mais antigos.</strong></p>      
      </div>
          <div class="top_right_lotomania">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->ltmd01}" == 0){ //não foi sorteado 
              //echo " - <span class='text-white'>Prêmio Estimado: R$ ".$premioproximo."</span>";
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
                foreach($dados as $item){
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd01}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd02}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd03}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd04}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd05}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd06}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd07}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd08}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd09}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd10}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd11}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd12}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd13}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd14}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd15}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd16}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd17}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd18}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd19}";
                  echo "</div>";
                  echo "<div class='resultnumber tlotomania'>";
                      echo "{$item->ltmd20}";
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
          <img src="../../img/ads01.png" width="210"> 
          <img src="../../img/ads01.png" width="210">
          <img src="../../img/ads01.png" width="210">
          <img src="../../img/ads01.png" width="210">               
      </div> <!-- end middle_ads -->

      <div class="text_info_lotomania">
      <h2>Como jogar na Lotomania</h2>
<p>Para jogar na Lotomania compare&ccedil;a a uma Casa Lot&eacute;rica ou jogue online pelo site da Caixa Loterias e preencha seu jogo no volante de apostas que cont&eacute;m 100 n&uacute;meros de 01 a 00. Em um jogo voc&ecirc; deve escolher 50 n&uacute;meros. As probabilidades de acerto na Lotomania s&atilde;o:</p>
<ul>
<li><strong>20 Acertos</strong>: 1 em 11.372.635 jogos</li>
<li><strong>19 Acertos</strong>: 1 em 352.551 jogos</li>
<li><strong>18 Acertos</strong>: 1 em 24.235 jogos</li>
<li><strong>17 Acertos</strong>: 1 em 2.776 jogos</li>
<li><strong>16 Acertos</strong>: 1 em 472 jogos</li>
<li><strong>15 Acertos</strong>: 1 em 112 jogos</li>
<li><strong>0 Acertos</strong>: 1 em 11.372.635 jogos</li>
</ul>
<p>Marcando APOSTA ESPELHO o sistema de apostas da Caixa gera um segundo jogo com os outros 50 n&uacute;meros n&atilde;o marcados no volante. H&aacute; a op&ccedil;&atilde;o de deixar que o sistema escolha os n&uacute;meros por voc&ecirc;. Deixe o volante da Lotomania em branco e marque entre 1 ou 2 jogos no campo SURPRESINHA. H&aacute; tamb&eacute;m a op&ccedil;&atilde;o TEIMOSINHA, onde voc&ecirc; pode repetir o mesmo jogo nos pr&oacute;ximos concursos da Lotomania. Basta marcar 2, 4 ou 8 concursos.</p>
<p>A Lotomania n&atilde;o faz parte do sistema de Bol&atilde;o fornecido pela Caixa Econ&ocirc;mica Federal.</p>
<h2>Sobre a premia&ccedil;&atilde;o da Lotomania</h2>
<p>O pr&ecirc;mio principal para quem acertar os 20 n&uacute;meros sozinho &eacute; estimado em R$ 500.000,00 se n&atilde;o houver nenhum ac&uacute;mulo de pr&ecirc;mio de concursos anteriores. A Lotomania &eacute; uma das loterias que mais acumulam. Se acumular o valor destinado ao pr&ecirc;mio principal &eacute; somado ao valor do pr&ecirc;mio principal do concurso seguinte e sucessivamente at&eacute; que haja um ganhador. Quando h&aacute; mais de um ganhador no mesmo concurso o pr&ecirc;mio &eacute; dividido. A divis&atilde;o ocorre em todas as faixas de premia&ccedil;&atilde;o.</p>
<p>Do valor arrecadado para cada concurso da Lotomania somente 43,35% s&atilde;o destinados ao pr&ecirc;mio bruto. Deste percentual ainda s&atilde;o deduzidos imposto de renda. O pr&ecirc;mio l&iacute;quido &eacute; distribuido da seguinte maneira:</p>
<ul>
<li><strong>45%</strong>: 20 acertos</li>
<li><strong>16%</strong>: 19 acertos</li>
<li><strong>10%</strong>: 18 acertos</li>
<li><strong>7%</strong>: 17 acertos</li>
<li><strong>7%</strong>: 16 acertos</li>
<li><strong>7%</strong>: 15 acertos</li>
<li><strong>8%</strong>: 0 acertos</li>
</ul>
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
<h2>Aos ganhadores da Lotomania</h2>
<p>Caso voc&ecirc; seja um dos ganhadores da Lotomania saiba que pode receber seu pr&ecirc;mio em qualquer casa Lot&eacute;rica ou ag&ecirc;ncia da Caixa se o valor do pr&ecirc;mio for igual ou inferior a R$ 1.903,98. Para pr&ecirc;mios acima deste valor somente nas ag&ecirc;ncias da Caixa Econ&ocirc;mica Federal. Ap&oacute;s apresentar o bilhete premiado na rede banc&aacute;ria da Caixa, se o valor do pr&ecirc;mio for superior a R$ 10.000,00 (dez mil reais), &eacute; necess&aacute;rio aguardar 2(dois) dias para que o pr&ecirc;mio seja pago.</p>
<p>O bilhete da Lotomania &eacute; a &uacute;nica forma de comprovar sua aposta e receber o pr&ecirc;mio caso seus n&uacute;meros sejam sorteados neste concurso, portanto, guarde-o em um local seguro e n&atilde;o se esque&ccedil;a de colocar seu nome e o n&uacute;mero de seu CPF no verso do bilhete para evitar o saque do pr&ecirc;mio por outra pessoa. Somente voc&ecirc; poder&aacute; retirar o pr&ecirc;mio apresentando seu CPF.</p>
<p>Voc&ecirc; tem at&eacute; 90 dias da data do sorteio para resgatar seu pr&ecirc;mio. Ap&oacute;s este prazo o pr&ecirc;mio prescreve e &eacute; repassado ao Tesouro Nacional para aplica&ccedil;&atilde;o no FIES - Fundo de Financiamento ao Estudante do Ensino Superior.</p>
      </div><!-- end text_info_lotomania -->
    </div> <!-- end main -->

  </div> <!-- end containermain -->


</body>
</html>