<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>XQ Loterias - Timemania</title>
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

                //sempre pega o último registro da tabela
                $sqllast = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc) FROM tbtimemania)";
                $resultlast = $con->select($sqllast, $binds);                
                if($resultlast->rowCount() > 0){
                  $dadoslast = $resultlast->fetchAll(PDO::FETCH_OBJ);
                }
                foreach($dadoslast as $itemlast){
                  $conclast = "{$itemlast->tmmconc}";
                  $datalast = "{$itemlast->tmmdata}";
                  $premiolast = "{$itemlast->tmmpremioest}";
                }

                //define horário para alternar concurso
                $horafixa = strtotime('19:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = date("Y-m-d", strtotime("today"));

                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = date("Y-m-d", strtotime("{$item->tmmdata}"));                 
                  if("{$item->tmmd01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->tmmconc}"-1; //mostra o último que foi sorteado
                      $post1 = $ultimo +1;
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->tmmconc}";
                      $post1 = $ultimo;
                    } else {
                      $ultimo = "{$item->tmmconc}"-1;
                      $post1 = $ultimo +1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->tmmconc}";
                    $post1 = $ultimo +1;
                  }
                  $sql = "SELECT * FROM tbtimemania WHERE tmmconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

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
          
        </div> <!-- end left_ads -->
        

      </div> <!-- end left -->

      <div class="right">        
      <div class="text_top">
        <p>A Timemania foi lançada em 1º de março de 2008. Com 80 números disponíveis no volante de apostas, de 01 a 80, você deve marcar 10 números e um time de futebol dentre os 80 clubes disponíveis. Ganha quem acertar 7, 6, 5, 4 ou 3 números ou o Time do Coração. O custo de uma aposta é de R$ 3,00. Os sorteios são realizados nas terças-feiras, quintas-feiras e sábados.</p><br>

        <p><strong>Abaixo você confere o resultado da Timemania no último concurso. 
          Os sorteios anteriores você confere nas páginas dos respectivos concursos no menu a esquerda.</strong></p>      
      </div>
          <div class="top_right_timemania">
          <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->tmmd01}" == 0){ //não foi sorteado 
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ ".$premiopost."</em></span>";
            }
            
            if($premiopost == "Aguardando..."){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Prêmio Estimado: R$ "."{$item->tmmpremioest}"."</em></span>";
            } else if ($premiopost != "Aguardando..." && "{$item->tmmgan07}" == 0 && "{$item->tmmpr07}" != ""){
              echo "<span class='text-premio-estimado'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>A C U M U L O U !!!</em></span>";
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
                $ordemnum[0] = $d01;
                $ordemnum[1] = $d02;
                $ordemnum[2] = $d03;                  
                $ordemnum[3] = $d04;
                $ordemnum[4] = $d05;
                $ordemnum[5] = $d06;
                $ordemnum[6] = $d07;
                sort($ordemnum);
              ?>

              <?php
                foreach($dados as $item){
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[0];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[1];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[2];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[3];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[4];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[5];
                  echo "</div>";
                  echo "<div class='resultnumber ttimemania'>";
                      echo $ordemnum[6];
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datalast))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $conclast ?></span>
  <h5>Prêmio estimado: <strong><?php echo "R$ ".$premiolast ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
              
</div> <!-- end middle_ads -->

<div class="text_info_timemania">
  <h2>Como jogar na Timemania</h2>
  <p>A Timemania foi criada para ajudar os clubes participantes a pagarem as suas dívidas com o governo brasileiro. O Volante de apostas contém 80 números de 01 a 80 e 80 Times de Futebol. Em um jogo você deve escolher 10 números e um Time de Futebol ao custo de R$ 3,00 a aposta.</p>


<div class="cb">&nbsp;</div>
<h2>Probabilidades</h2>
<ul>
  <li><strong>07 acertos</strong>: 1 em 26.472.637</li>
  <li><strong>06 acertos</strong>: 1 em 216.103</li>
  <li><strong>05 acertos</strong>: 1 em 5.220</li>
  <li><strong>14 acertos</strong>: 1 em 276</li>
  <li><strong>13 acertos</strong>: 1 em 29</li>
  <li><strong>Time do Coração</strong>: 1 em 80</li>
</ul>

<h2>Premiação</h2>
<p>Do valor arrecadado para cada concurso da Timemania somente <strong>46%</strong> são destinados ao prêmio bruto. Deste percentual ainda são deduzidos imposto de renda. Do prêmio líquido é deduzido o valor total dos prêmios fixos e do valor restante 50% são destinados ao prêmio principal de 7 acertos, <strong>20%</strong> para o prêmio de 6 acertos e <strong>20%</strong> para o prêmio de 4 acertos. Os outros <strong>10%</strong> do valor restante são acumulados dos concursos de final 1, 2, 3 e 4 para o prêmio principal do concurso de final 5 e o mesmo percentual da premiação dos concursos de final 6, 7, 8 e 9 para o prêmio principal do concurso de final 0.</p>
<br>

<div class="bordasimples">
<table class="bordasimples">
  <tr>
    <td>3 acertos:</td>
    <td>R$ 3,00</td>
  </tr>
  <tr>
    <td>4 acertos:</td>
    <td>R$ 9,00</td>
  </tr>
  <tr>
    <td>Time do Coração:</td>
    <td>R$ 7,50</td>
  </tr>
</table>
</div>
<br>
<p><strong>Os prêmios prescrevem 90 dias após a data do sorteio. Após esse prazo, os valores são repassados ao Tesouro Nacional para aplicação no FIES - Fundo de Financiamento Estudantil.</strong></p>
<p><strong>Os 54,00% do valor arrecadado que não fazem parte da premiação são distribuídos da seguinte maneira:</strong></p>
<p><br></p>
<ul>

<li><strong>22%</strong>: Clubes de Futebol</li>
<li><strong>1,26%</strong>: Comitê Olímpico Brasileiro - COB</li>
<li><strong>0,74%</strong>: Comitê Paralímpico Brasileiro - CPB</li>
<li><strong>0,75%</strong>: Ministério do Esporte</li>
<li><strong>1,75%</strong>: Fundo Nacional de Saúde</li>
<li><strong>0,50%</strong>: Fundo Nacional dos Direitos da Criança e do Adolescente - FNCA</li>
<li><strong>5,00%</strong>: Fundo Nacional de Segurança Pública - FNSP</li>
<li><strong>1%</strong>: Fundo Penitenciário Nacional - FUNPEN</li>
<li><strong>1%</strong>: Seguridade Social</li>
<li><strong>20,00%</strong>: Despesas de Custeio e Manutenção de Serviços</li>
Deste percentual 11,00% são de Despesas Operacionais e 9,00% da Comissão dos Lotéricos.
</ul>

<h2>Aos ganhadores da Timemania</h2>
<p>Caso você seja um dos ganhadores da Timemania saiba que pode receber seu prêmio em qualquer casa Lotérica ou agência da Caixa se o valor do prêmio for igual ou inferior a R$ 1.903,98. Para prêmios acima deste valor somente nas agências da Caixa Econômica Federal. Após apresentar o bilhete premiado na rede bancária da Caixa, se o valor do prêmio for superior a R$ 10.000.000 (dez mil reais), é necessário aguardar 2(dois) dias para que o prêmio seja pago.</p>
<p>O bilhete da Timemania é a única forma de comprovar sua aposta e receber o prêmio caso seus números sejam sorteados neste concurso, portanto, guarde-o em um local seguro e não se esqueça de colocar seu nome e o número de seu CPF no verso do bilhete para evitar o saque do prêmio por outra pessoa. Somente você poderá retirar o prêmio apresentando seu CPF.</p>


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
