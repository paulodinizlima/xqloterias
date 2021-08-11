<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>XQ Loterias - Loteria Federal</title>
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
          <a href="../quina/" title="quina"><span class="icone"><img src="../../img/icon_quina.png" width="20"></span> Quina</a>
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
          <a href="index.php" title="Federal"><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Federal</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="containermain">
    
    <div class="main">
      <div class="tloterias tfederal">

      <h4><strong>LOTERIA FEDERAL</strong></h4>
        <span class="font14">Confira o resultado, ganhadores e prêmios da Loteria Federal nos 
          sorteios que são realizados nas quartas-feiras e sábados a partir das 19 horas.</span>

      </div> <!-- end tloterias tfederal -->

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
                $binds = ['fedconc' => 0];
                if(isset($_GET['conc'])){
                  $conc  = $_GET['conc'];
                  $sql = "SELECT * FROM tbfederal WHERE fedconc = $conc";
                } else {
                  $sql = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc) FROM tbfederal)";
                }
                $result = $con->select($sql, $binds);                
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                }

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc) FROM tbfederal)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }
                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->fedconc}";
                  $datalast = "{$itemlast->feddata}";
                  $premiolast = "{$itemlast->fedpremioest}";
                } 

                //define horário para alternar concurso
                $horafixa = strtotime('18:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->feddata}")); 
                  if("{$item->feds01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->fedconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->fedconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->fedconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { //foi sorteado
                    $ultimo = (int)"{$item->fedconc}";
                    $post1 = $ultimo +1;
                  }

                  $sql = "SELECT * FROM tbfederal WHERE fedconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $sqlpost = "SELECT * FROM tbfederal WHERE fedconc = $post1";
                  $resultpost = $con->select($sqlpost, $binds);
                  if($resultpost->rowCount() > 0){
                    $dadospost = $resultpost->fetchAll(PDO::FETCH_OBJ);
                  }

                  foreach($dadospost as $itempost){
                    //grava informações do último concurso gravado no bd, ainda não sorteado (dados do próximo sorteio)
                    $concpost = "{$itempost->fedconc}"; 
                    $datapost = "{$itempost->feddata}";
                    $premiopost = "{$itempost->fedpremioest}";
                  }

                } //end foreach

                foreach($dados as $item){                  
                  $ant1 = $ultimo -1;
                  $sql = "SELECT feddata FROM tbfederal WHERE fedconc = $ant1";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant1 = "{$dt->feddata}";

                      }
                    }

                  $ant2 = $ant1 -1;
                  $sql = "SELECT feddata FROM tbfederal WHERE fedconc = $ant2";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant2 = "{$dt->feddata}";
                      }
                    }
                  $ant3 = $ant2 -1; 
                  $sql = "SELECT feddata FROM tbfederal WHERE fedconc = $ant3";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant3 = "{$dt->feddata}";
                      }
                    }
                  $ant4 = $ant3 -1;
                  $sql = "SELECT feddata FROM tbfederal WHERE fedconc = $ant4";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant4 = "{$dt->feddata}";
                      }
                    }
                  $ant5 = $ant4 -1;
                  $sql = "SELECT feddata FROM tbfederal WHERE fedconc = $ant5";
                    $resultdates = $con->select($sql, $binds);
                    if($resultdates->rowCount() > 0){
                      $dates = $resultdates->fetchAll(PDO::FETCH_OBJ);  
                      foreach($dates as $dt){
                        $dtant5 = "{$dt->feddata}";
                      }
                    }                
                } //end foreach

                $fedpr01 = "{$item->fedpr01}";
                $fedpr02 = "{$item->fedpr02}";
                $fedpr03 = "{$item->fedpr03}";
                $fedpr04 = "{$item->fedpr04}";
                $fedpr05 = "{$item->fedpr05}";
                $fedpremioest = "{$item->fedpremioest}";

                $fedcidgan01 = "{$item->fedcidgan01}";
                $fedcidgan02 = "{$item->fedcidgan02}";
                $fedcidgan03 = "{$item->fedcidgan03}";
                $fedcidgan04 = "{$item->fedcidgan04}";
                $fedcidgan05 = "{$item->fedcidgan05}";

                $dtatual = "{$item->feddata}";
                $s01 = "{$item->feds01}";
                $s02 = "{$item->feds02}";
                $s03 = "{$item->feds03}";
                $s04 = "{$item->feds04}";
                $s05 = "{$item->feds05}";

         ?>

        <div class="content_left">

            <!-- Loteria Federal -->
            <?php echo "<a href='index.php?conc=".$ant1."'>"; ?>
              <div class="title_loteria_left tfederal">            
                <h5><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Loteria Federal
                  <span class="concurso_left"><?php echo $ant1 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant1))?>
              </div>
            </a> 

            <!-- Loteria Federal -->
            <?php echo "<a href='index.php?conc=".$ant2."'>"; ?>
              <div class="title_loteria_left tfederal">            
                <h5><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Loteria Federal
                  <span class="concurso_left"><?php echo $ant2 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant2))?>
              </div>
            </a> 

            <!-- Loteria Federal -->
            <?php echo "<a href='index.php?conc=".$ant3."'>"; ?>
              <div class="title_loteria_left tfederal">            
                <h5><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Loteria Federal
                  <span class="concurso_left"><?php echo $ant3 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant3))?>
              </div>
            </a> 

            <!-- Loteria Federal -->
            <?php echo "<a href='index.php?conc=".$ant4."'>"; ?>
              <div class="title_loteria_left tfederal">            
                <h5><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Loteria Federal
                  <span class="concurso_left"><?php echo $ant4 ?></span></h5>
              </div>    
                   
              <div class="content_loteria_left">
                <?php echo date("d/m/Y", strtotime($dtant4))?>
              </div>
            </a> 

            <!-- Loteria Federal -->
            <?php echo "<a href='index.php?conc=".$ant5."'>"; ?>
              <div class="title_loteria_left tfederal">            
                <h5><span class="icone"><img src="../../img/icon_federal.png" width="20"></span> Loteria Federal
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
        <p>A Loteria Federal foi lançada oficialmente em 15 de setembro de 1962. O sorteios ocorrem às quartas-feiras e aos sábados. São realizados 5 sorteios (denominados 1º prêmio, 2º prêmio, 3º prêmio, 4º prêmio e 5º prêmio). Em cada um dos 5 sorteios, é sorteado um número composto de 5 algarismos, de 00000 a 99999. Ganha quem acertar os 5 algarismos em qualquer um dos sorteios, mas há também os prêmios secundários, derivados dos principais. A premiação para quem acertar o 1º prêmio é de R$ 500 mil.</p><br>

        <p><strong>Abaixo você confere o resultado da Loteria Federal no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
      <div class="top_right_federal">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->feds01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
          ?></strong>
          </div> <!-- end top_right_megasena -->


          <div class="right_rfederal">

            <div class="resultnumbers_federal">

              <?php
                echo "<div class='right_lfederal'>1º Prêmio</div>";                
                  echo "<div class='resultnumberfed tfederal'>";
                    echo "<strong>&nbsp;".$s01."</strong> <span class='text-white-federal'> &nbsp;&nbsp;Prêmio: R$ ".$fedpr01."&nbsp;&nbsp;</span>" ; 
                  echo "</div>";   
                  echo "<br><br><br><br>";              
                
                echo "<div class='right_lfederal'>2º Prêmio</div>";               
                  echo "<div class='resultnumberfed tfederal'>";
                    echo "&nbsp;&nbsp;&nbsp;".$s02."<span class='text-grey-federal'> &nbsp;&nbsp;Prêmio: R$ ".$fedpr02."&nbsp;&nbsp;</span>" ;
                  echo "</div>";
                  echo "<br><br><br><br>";              
               
                echo "<div class='right_lfederal'>3º Prêmio</div>";                
                  echo "<div class='resultnumberfed tfederal'>";
                    echo "&nbsp;&nbsp;&nbsp;".$s03."<span class='text-grey-federal'> &nbsp;&nbsp;Prêmio: R$ ".$fedpr03."&nbsp;&nbsp;</span>" ;
                  echo "</div>";
                  echo "<br><br><br><br>";              
              
                echo "<div class='right_lfederal'>4º Prêmio</div>";                
                  echo "<div class='resultnumberfed tfederal'>";
                    echo "&nbsp;&nbsp;&nbsp;".$s04."<span class='text-grey-federal'> &nbsp;&nbsp;Prêmio: R$ ".$fedpr04."&nbsp;&nbsp;</span>" ;
                  echo "</div>";
                  echo "<br><br><br><br>";              
             
                echo "<div class='right_lfederal'>5º Prêmio</div>";                
                  echo "<div class='resultnumberfed tfederal'>";
                    echo "&nbsp;&nbsp;&nbsp;".$s05."<span class='text-grey-federal'> &nbsp;&nbsp;Prêmio: R$ ".$fedpr05."&nbsp;&nbsp;</span>" ;
                  echo "</div>";
                  echo "<br><br><br><br>";              
              
              ?>

            </div> <!-- end resultnumbers -->        
          
          </div> <!-- end right_rfederal -->

          
      </div> <!-- end right -->
      <div class="right_middle">

<div class="tbl_premiacao">

      <div class="acertos col-md-2 col-sm-2 col-3">
        <div class="title_acertos">Faixa</div>
        <ul class="faixa_premiacao">
          <li>1º Prêmio</li>
          <li>2º Prêmio</li>
          <li>3º Prêmio</li>
          <li>4º Prêmio</li>
          <li>5º Prêmio</li>
        </ul>
      </div> <!-- end acertos col-md2 -->
      <div class="valorpremio col-md-4 col-sm-5 col-5">
      <div class="title_acertos">Prêmio</div>
        <ul class="premiacao">
          <li><?php echo "R$ ".$fedpr01 ?></li>
          <li><?php echo "R$ ".$fedpr02 ?></li>
          <li><?php echo "R$ ".$fedpr03?></li>
          <li><?php echo "R$ ".$fedpr04 ?></li>
          <li><?php echo "R$ ".$fedpr05 ?></li>
        </ul>  
      </div> <!-- end valorpremio col-md3 -->
      
      <div class="cidades col-md-6">
        <div class="title_cidades">Cidades dos ganhadores</div>
        <ul class="cidades">
          <li><?php echo $fedcidgan01 ?></li>
          <li><?php echo $fedcidgan02 ?></li>
          <li><?php echo $fedcidgan03 ?></li>
          <li><?php echo $fedcidgan04 ?></li>
          <li><?php echo $fedcidgan05 ?></li>
        </ul>
      </div> <!-- end cidades col-md5 -->

</div> <!-- end tbl_premiacao -->      

</div> <!-- end right_middle -->
<div class="right_lowmiddle_info tfederal col-12">
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio principal: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
           
</div> <!-- end middle_ads -->

<div class="text_info_federal">
  <h2>Como jogar na Loteria Federal</h2>
  <p>A Loteria Federal é fácil de ganhar e fácil de apostar! Basta você escolher o bilhete exposto na casa lotérica ou adquiri-lo com um ambulante lotérico credenciado. Você escolhe o número impresso no bilhete que quer concorrer, conforme disponibilização no momento da compra.</p>
  <p>Cada bilhete contém 10 frações e pode ser adquirido inteiro ou em partes. O valor do prêmio é proporcional à quantidade de frações que você adquirir.</p>

<h2>Sorteios</h2>
<p>Os sorteios das extrações são realizados às quartas e sábados, com prêmios principais de R$ 500 mil em uma única série. Todo mês, você também pode concorrer a R$ 1,350 milhão no prêmio principal, apostando na Milionária Federal. Em dezembro acontece extração Especial de Natal, com prêmio de R$ 1,350 milhão por série.</p>

<br>
<h2>Premiação</h2>
<p>Você pode receber seu prêmio em qualquer casa lotérica credenciada ou nas agências da CAIXA. Caso o prêmio líquido seja superior a R$ 1.332,78 (bruto de R$ 1.903,98), o pagamento pode ser realizado somente nas agências da CAIXA, mediante apresentação de comprovante de identidade original com CPF e recibo de aposta original e premiado.  Valores iguais ou acima de R$ 10.000,00 são pagos no prazo mínimo de 2 dias a partir de sua apresentação em Agência da CAIXA</p>
<br>

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
