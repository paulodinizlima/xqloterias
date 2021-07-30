<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias - Loteria Federal</title>
    <meta http-efedv="refresh" content="60">
    <meta http-efedv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-efedv="X-UA-Compatible" content="IE=edge,chrome=1">
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

                //define horário para alternar concurso
                $horafixa = strtotime('18:00');
                $horaatual = strtotime(date('H:i'));
                $dataatual = strtotime(date('Y-m-d'));
                  
                //verifica se o último concurso já foi sorteado
                foreach($dados as $item){  
                  $dataproximo = "{$item->feddata}";                
                  if("{$item->feds01}" == 0){ //não foi sorteado 
                    if($horafixa > $horaatual && $dataproximo == $dataatual){ //ainda não chegou o horario do sorteio (1 hora antes)
                      $ultimo = "{$item->fedconc}"-1; //mostra o último que foi sorteado
                    } else if($horafixa < $horaatual && $dataproximo == $dataatual){ //chegou o horario e dia do sorteio (1 hora antes)
                      $ultimo = "{$item->fedconc}";
                    } else {
                      $ultimo = "{$item->fedconc}"-1;
                    }
                  } else { 
                    $ultimo = (int)"{$item->fedconc}";
                  }
                  $sql = "SELECT * FROM tbfederal WHERE fedconc = $ultimo";                    
                  $result = $con->select($sql, $binds);
                  if($result->rowCount() > 0){
                    $dados = $result->fetchAll(PDO::FETCH_OBJ);
                  }

                  $post1 = $ultimo +1;
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
        <p>Criada no ano de 1962 a Loteria Federal sorteia cinco números no total, a premiação corresponde do primeiro ao quinto prêmio 
          e cada número corresponde de 0001 até 99.999.
          O valor da faixa principal é de R$ 500 mil reais, ocasionalmente a Caixa Econômica Federal realiza sorteios especiais com 
          premiação de maior valor.</p>

        <p><strong>No painel abaixo, você confere o resultado da Loteria Federal no último concurso. Os resultados dos sorteios
            anteriores Loteria Federal você confere nas páginas dos respectivos números dos concursos no menu a esquerda ou utilizando 
            o campo de busca para concursos mais antigos.</strong></p>      
      </div>
      <div class="top_right_federal">
            <strong><span class="text-grey">CONCURSO</span>&nbsp;&nbsp;&nbsp;
              <span class="text-white"><a href='index.php?conc=<?php echo $ant1 ?>'><i class='fas fa-angle-left'></i></a>&nbsp;&nbsp;<?php echo $ultimo."&nbsp;&nbsp;<a href='index.php?conc=".$post1."'><i class='fas fa-angle-right'>&nbsp;&nbsp;</i></a></span>
              <span class='text-grey'><i class='far fa-calendar-alt'></i>&nbsp;".date("d/m/Y", strtotime($dtatual))."</span> &nbsp;&nbsp;
              <span class='text-hour'><i class='far fa-clock'></i>&nbsp;".date("H:i", strtotime($dtatual))."h</span>"; 
            if("{$item->feds01}" == 0){ //não foi sorteado 
              echo " - <span class='text-white'>Prêmio principal: R$ ".$premiopost."</span>";
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
  <span class="text-grey">Próximo Sorteio:</span> <?php echo date("d/m/Y "." - "."H:i", strtotime($datapost))."h"; ?></span>
  <span class="text-grey">Concurso: </span><?php echo $concpost ?></span>
  <h5>Prêmio principal: <strong><?php echo "R$ ".$premiopost ?></strong></h5>
</div> <!-- end right_lowmiddle_info --> 
<div class="middle_ads">
<img src="../../img/ads01.png" width="210"> 
<img src="../../img/ads01.png" width="210">
<img src="../../img/ads01.png" width="210">
<img src="../../img/ads01.png" width="210">               
</div> <!-- end middle_ads -->

<div class="text_info_federal">
<h2>Loteria Federal</h2>
<p></p>
<p>A Loteria Federal &eacute; o concurso mais antigo e tradicional da Caixa Econ&ocirc;mica Federal. Apesar de ter sido oficializada apenas em 1962, a modalidade &eacute; bem mais antiga e se manteve renomada durante anos por conta da suas premia&ccedil;&otilde;es em dinheiro que atra&iacute;am muitos compradores de bilhete.</p>
<p>Atualmente o concurso &eacute; o que tem a maior probabilidade de acertos e, consequentemente, garante as maiores chances de premia&ccedil;&atilde;o aos jogadores dentre todos os outros jogos de loteria.</p>
<p>Para participar dos seus dois sorteios semanais voc&ecirc; s&oacute; precisa adfedrir um &uacute;nico bilhete e acompanhar os n&uacute;meros sorteados e a ordem em que sa&iacute;ram. Al&eacute;m disso, a quantidade de fra&ccedil;&otilde;es adfedridas faz com que o valor da premia&ccedil;&atilde;o possa ser ainda maior - dependendo da sua afedsi&ccedil;&atilde;o.</p>
<p>Confira tudo o que voc&ecirc; precisa saber para come&ccedil;ar a participar da Loteria Federal e, assim como milhares de pessoas, ganhar diversos pr&ecirc;mios em dinheiro com os seus n&uacute;meros da sorte.</p>
<h2>Como surgiu o sorteio da Loteria Federal?</h2>
<p>O sorteio da Loteria Federal foi uma das primeiras modalidades de jogos consolidadas no Brasil. Com influ&ecirc;ncia de loterias similares que j&aacute; existiam na &eacute;poca, a Caixa Econ&ocirc;mica deu in&iacute;cio aos seus sorteios oficiais no dia 15 de setembro de 1962, com o pr&ecirc;mio de R$ 15 Milh&otilde;es de Cruzeiros.</p>
<p>Ao longo dos anos o concurso sofreu ajustes e mudan&ccedil;as para deix&aacute;-lo mais atrativo aos apostadores e distribuir mais pr&ecirc;mios em cada um dos seus sorteios realizados ao longo das semanas. Com isso, foi criado uma estrutura que &eacute; seguida at&eacute; hoje pela modalidade.</p>
<p>Diferente dos outros concursos promovidos pela Caixa, na Loteria Federal o apostador n&atilde;o escolhe os n&uacute;meros que estar&atilde;o em seu bilhete. Ao inv&eacute;s disso, a institui&ccedil;&atilde;o financeira disponibiliza para a compra os bilhetes conhecidos como s&eacute;ries que acompanham alguns n&uacute;meros impressos direto na cartela.</p>
<h2>Como se joga na Loteria Federal?</h2>
<p>Por ter as suas pr&oacute;prias regras tem muitas diferen&ccedil;as dos outros concursos de loterias, entender como jogar na Loteria Federal &eacute; extremamente importante antes de comprar o seu jogo.</p>
<p>Como foi dito anteriormente, para participar dos concursos, o apostador deve comprar ao menos um bilhete referente ao sorteio que pretende participar. As s&eacute;ries s&atilde;o divididas em dez fra&ccedil;&otilde;es que representam a porcentagem do valor que o ganhador vai levar em caso de premia&ccedil;&atilde;o - quase como as cotas dos bol&otilde;es s&atilde;o para as outras loterias, entretanto, sendo proporcional a 1/10 cada.</p>
<p>Todas as fra&ccedil;&otilde;es s&atilde;o compostas por 5 algarismos e podem ir de 01 a 92.000, segundo a Caixa Econ&ocirc;mica Federal.</p>
<p>Assim como as outras modalidades, na Loteria Federal o sorteio &eacute; realizado pela Caixa Econ&ocirc;mica de forma manual, onde algumas bolinhas numeradas de 0 a 9 s&atilde;o despejadas em cinco globos de acr&iacute;lico girat&oacute;rios e, ap&oacute;s serem misturadas durante um certo tempo, sorteia os n&uacute;meros referentes a cada um dos pr&ecirc;mios - sendo no total cinco sorteios com cinco pr&ecirc;mios diferentes.</p>
<p>Para facilitar a identifica&ccedil;&atilde;o e melhorar a seguran&ccedil;a dos sorteios, al&eacute;m de serem enumeradas, as bolinhas tamb&eacute;m t&ecirc;m cores diferentes para cada um dos n&uacute;meros. Confira a rela&ccedil;&atilde;o:</p>
<p>N&uacute;mero 1 - vermelhas<br />N&uacute;mero 2 - amarelas<br />N&uacute;mero 3 - verdes<br />N&uacute;mero 4 - marrons<br />N&uacute;mero 5 - azuis<br />N&uacute;mero 6 - rosas<br />N&uacute;mero 7 - pretas<br />N&uacute;mero 8 - cinzas<br />N&uacute;mero 9 - laranjas<br />Terminadas em 0 - brancas</p>
<p>O n&uacute;mero final &eacute; definido pela ordem que as bolinhas saem no sorteio e, por isso, o resultado da Loteria Federal &eacute; revelado de modo decrescente, ou seja, da dezena de milhar at&eacute; a unidade.</p>
<p>Primeira Bolinha: Dezena de milhar<br />Segunda Bolinha: Unidade de milhar<br />Terceira Bolinha: Centena<br />Quarta bolinha: Dezena<br />quinta bolinha: Unidade</p>
<p>H&aacute; casos em que o sorteio pode ser realizado com apenas quatro globos e situa&ccedil;&otilde;es que pode ser usado apenas um, com dez bolas numeradas de 00 &agrave; 09 (desconsiderando o zero a esquerda). Contudo, al&eacute;m de serem algumas exce&ccedil;&otilde;es, esse tipo de mudan&ccedil;a s&oacute; ocorre mediante aos crit&eacute;rios definidos e aprovados pela Caixa Econ&ocirc;mica.</p>
<p>De qualquer forma, n&atilde;o acontecem altera&ccedil;&otilde;es nos pr&ecirc;mios sorteados e nem nas faixas de premia&ccedil;&atilde;o do concurso.</p>
<h2>Como ganhar na Loteria Federal?</h2>
<p>A Loteria Federal &eacute; a modalidade que oferece as maiores chances de premia&ccedil;&atilde;o dentre todos os concursos ativos da Institui&ccedil;&atilde;o regente. S&atilde;o dois sorteios semanais realizados &agrave;s quartas-feiras e aos s&aacute;bados, com pr&ecirc;mios de R$ 300 mil e R$ 600 mil, respectivamente.</p>
<p>Al&eacute;m disso, mesmo em suas varia&ccedil;&otilde;es de concursos especiais, a probabilidade de se ganhar nunca ultrapassa 1 para 100.000 e, apesar de parecer muita coisa, a estimativa &eacute; a de que um a cada cinco bilhetes seja premiado no sorteio.</p>
<p>Essa facilidade se d&aacute; gra&ccedil;as &agrave;s in&uacute;meras possibilidades do jogador ser premiado em cada um dos sorteios que, no geral, ultrapassam 20 faixas de pr&ecirc;mios em cada evento.</p>
<p>Por&eacute;m, mesmo que a Loteria Federal seja mais f&aacute;cil de ganhar, &eacute; preciso estar atento a suas regras para garantir o resgate do seu valor, caso seja um dos sortudos.</p>
<p>Os crit&eacute;rios de sele&ccedil;&atilde;o dos vencedores s&atilde;o:</p>
<p>Cinco pr&ecirc;mios principais, referentes ao sorteio dos n&uacute;meros e sua ordem;<br />Pr&ecirc;mio para quem acerta a milhar, a centena, e a dezena de qualquer um dos n&uacute;meros sorteados nos cinco pr&ecirc;mios principais;<br />Todos os bilhetes terminados com a dezena do primeiro pr&ecirc;mio e umas das 3 (tr&ecirc;s) dezenas anteriores ou das 3 (tr&ecirc;s) dezenas posteriores<br />Premia&ccedil;&atilde;o do bilhete imediatamente anterior e posterior ao primeiro pr&ecirc;mio;<br />Unidade igual ao do primeiro pr&ecirc;mio.</p>
<p>Cada um que tiver um ou mais acertos em algum dos crit&eacute;rios listados anteriormente garante uma parte do valor pr&ecirc;miado.</p>
<p>Vale lembrar tamb&eacute;m que com apenas um bilhete o apostador tem direito a participar dos cinco sorteios para os pr&ecirc;mios principais e as suas vertentes subsequentes e os seus concursos n&atilde;o acumulam.</p>
<h2>Quais s&atilde;o os concursos especiais da Loteria Federal?</h2>
<p>Assim como outras modalidades de apostas e jogos de loterias, a Loteria Federal conta com concursos especiais feitos de forma regular, todos os anos.</p>
<p>Para tornar esses jogos mais atrativos aos jogadores foram criadas as ?Milion&aacute;rias? - extra&ccedil;&otilde;es com caracter&iacute;sticas particulares e valores de premia&ccedil;&atilde;o maiores.</p>
<p>A principal e mais comum delas &eacute; a Milion&aacute;ria Federal, uma varia&ccedil;&atilde;o do concurso principal, com apostas paralelas aos bilhetes e que faz o sorteio de R$ 1,350 milh&atilde;o uma vez por m&ecirc;s.</p>
<p>Al&eacute;m dela ainda h&aacute; a Milion&aacute;ria Especial, que acontece nos meses de maio, junho, agosto e setembro, a Especial de Natal e a Milion&aacute;ria de Ano Novo. Cada uma conta com uma bonifica&ccedil;&atilde;o na quantia do pr&ecirc;mio e paga de R$1 milh&atilde;o at&eacute; R$1,35 milh&atilde;o em sua faixa principal.</p>
<p>Um detalhe que exige a aten&ccedil;&atilde;o dos jogadores o que de em cada uma dessas modalidades especiais a loteria emite uma quantidade diferente de bilhetes e, consequentemente, afetam as probabilidades de se ganhar.</p>
<h2>Probabilidade de se ganhar na Loteria Federal</h2>
<p>Com a quantidade de varia&ccedil;&otilde;es dos sorteios da Loteria Federal &eacute; muito f&aacute;cil se confundir com as propriedades de cada um dos concursos que acontecem ao longo do ano.</p>
<p>Mesmo que pare&ccedil;a n&atilde;o ter uma grande diferen&ccedil;a entre cada um deles, as probabilidades de se ganhar algum pr&ecirc;mio sofrem grandes altera&ccedil;&otilde;es entre os concursos especiais e at&eacute; mesmo durante a mesma semana.</p>
<p>No final, a rela&ccedil;&atilde;o de concurso e a probabilidade de acertos fica da seguinte forma:</p>
<p>Concurso Valor da Premia&ccedil;&atilde;o Probabilidade Quarta-Feira R$ 350 Mil 1 para 100.000 S&aacute;bado R$ 700 Mil 1 para 100.000 Milion&aacute;ria Federal (Mensal) R$ 1 Milh&atilde;o (acertador das 05 dezenas) 1 para 90.000 Milion&aacute;ria Especial R$ 1,35 Milh&atilde;o 1 para 90.000 Especial de Natal R$ 1,35 Milh&atilde;o 1 para 90.000 Milion&aacute;ria de Ano Novo** R$ 1,35 Milh&atilde;o 1 para 95.000 **Conferir para ver se ainda est&aacute; ativa. N&atilde;o aparece na rela&ccedil;&atilde;o da Caixa Econ&ocirc;mica Federal</p>
<p>A varia&ccedil;&atilde;o na probabilidade dos concurso acontece porque a quantidade de bilhetes emitidos para cada um deles &eacute; diferente - afetando diretamente nas chances que voc&ecirc; tem de ganhar um pr&ecirc;mio da faixa principal.</p>
<p>Por isso, fique atento quando for comprar sua s&eacute;rie ou mesmo realizar uma aposta na Loteria Federal.</p>
<h2>Jogo do Bicho pela Loteria Federal</h2>
<p>A realiza&ccedil;&atilde;o e explora&ccedil;&atilde;o da pr&aacute;tica conhecida como Jogo do Bicho em diversas regi&otilde;es do Brasil &eacute; proibida por lei (Art. 58 da Lei das Contravencoes Penais - Decreto Lei 3688/41) e n&atilde;o existe uma maneira formal de se realizar apostas nessa modalidade conhecida como ?jogo de azar?.</p>
<p>Contudo, a defini&ccedil;&atilde;o da tabela do jogo do bicho segue um padr&atilde;o para todos os sorteios, permitindo que seu conceito adaptado em outros jogos como o da pr&oacute;pria Loteria Federal, por exemplo.</p>
<p>As apostas no Jogo do Bicho s&atilde;o feitas com base nos 25 animais, numerados de 00 a 99 que, que foram definidos pela tabela criada na d&eacute;cada de 1990 e usada pelos bicheiros desde ent&atilde;o.</p>
<p>Na Loteria Federal os apostadores assimilaram os &uacute;ltimos dois d&iacute;gitos do bilhete com as dezenas combinadas em cada um dos animais. Dessa forma, foi poss&iacute;vel criar uma identifica&ccedil;&atilde;o entre a aposta e a loteria.</p>
<p>Apesar da compatibilidade dos n&uacute;meros do concurso com o jogo do bicho, a modalidade n&atilde;o tem liga&ccedil;&atilde;o direta com a Caixa e, por tanto, serve mais para os apostadores se identificarem em seus jogos.</p>
<p>De qualquer forma, &eacute; interessante saber como funciona e qual &eacute; a rela&ccedil;&atilde;o de n&uacute;meros com cada animal representado na tabela que, no final, fica distribu&iacute;do da seguinte forma nos grupos:</p>
<p>- Grupo 1 - dezenas: 01, 02, 03, 04 = Avestruz<br />- Grupo 2 - dezenas: 05, 06, 07, 08 = &Aacute;guia<br />- Grupo 3 - dezenas: 09, 10, 11, 12 = Burro<br />- Grupo 4 - dezenas: 13, 14, 15, 16 = Borboleta<br />- Grupo 5 - dezenas: 17, 18 ,19, 20 = Cachorro<br />- Grupo 6 - dezenas: 21, 22, 23, 24 = Cabra<br />- Grupo 7 - dezenas: 25, 26, 27, 28 = Carneiro<br />- Grupo 8 - dezenas: 29, 30, 31, 32 = Camelo<br />- Grupo 9 - dezenas: 33, 34, 35, 36 = Cobra<br />- Grupo 10 - dezenas: 37, 38, 39, 40 = Coelho<br />- Grupo 11 - dezenas: 41, 42, 43, 44 = Cavalo<br />- Grupo 12 - dezenas: 45, 46, 47, 48 = Elefante<br />- Grupo 13 - dezenas: 49, 50, 51, 52 = Galo<br />- Grupo 14 - dezenas: 53, 54, 55, 56 = Gato<br />- Grupo 15 - dezenas: 57, 58, 59, 60 = Jacar&eacute;<br />- Grupo 16 - dezenas: 61, 62, 63, 64 = Le&atilde;o<br />- Grupo 17 - dezenas: 65, 66, 67, 68 = Macaco<br />- Grupo 18 - dezenas: 69, 70, 71, 72 = Porco<br />- Grupo 19 - dezenas: 73, 74, 75, 76 = Pav&atilde;o<br />- Grupo 20 - dezenas: 77, 78, 79, 80 = Peru<br />- Grupo 21 - dezenas: 81, 82, 83, 84 = Touro<br />- Grupo 22 - dezenas: 85, 86, 87, 88 = Tigre<br />- Grupo 23 - dezenas: 89, 90, 91, 92 = Urso<br />- Grupo 24 - dezenas: 93, 94, 95, 96 = Veado<br />- Grupo 25 - dezenas: 97, 98, 99, 00 = Vaca</p>
<p>Mas vale lembrar que a Loteria Federal n&atilde;o tem liga&ccedil;&atilde;o e nem divulga os resultados do jogo do Bicho, sendo sua associa&ccedil;&atilde;o considerada apenas pelos apostadores.</p>
<p>&nbsp;</p>
<h2>Como conferir o resultado da Loteria Federal?</h2>
<p>Conferir o resultado da Loteria Federal &eacute; muito simples. Basta voc&ecirc; acessar o Portal pelo seu celular ou computador e verificar os n&uacute;meros que foram sorteados - lembrando sempre em se atentar ao n&uacute;mero do concurso e a data em que o sorteio foi realizado para n&atilde;o se confundir.</p>
<p>Em rela&ccedil;&atilde;o ao sorteio em si, &eacute; importante lembrar de estar atento em todas as casas decimais sorteadas (milhar, centena, dezena e unidade). Dessa forma voc&ecirc; consegue conferir se ganhou em alguma faixa da premia&ccedil;&atilde;o, mesmo que n&atilde;o tenha acertado um dos cinco pr&ecirc;mios principais.</p>
<p>Os ganhos na mesma faixa n&atilde;o s&atilde;o cumulativos e, por isso, &eacute; considerado apenas o acerto do maior pr&ecirc;mio Ou seja, caso voc&ecirc; tenha acertado somente somente a centena garante somente o pr&ecirc;mio referente a centena, excluindo o da dezena e unidade.</p>
<p>Portanto, esteja atento na hora de conferir o &uacute;ltimo resultado loteria federal, e se lembre sempre de verificar todas as regras de premia&ccedil;&atilde;o que citamos anteriormente.</p>
<h2>Repasses Sociais</h2>
<p>Semelhante ao que acontece com os outros sorteios de loterias no Brasil, parte do valor arrecadado na compra de bilhetes e apostas feitas na Loteria Federal &eacute; repassado &agrave; Uni&atilde;o (Governo Federal) para ser investido posteriormente em aplica&ccedil;&otilde;es sociais ligadas &agrave; cultura, seguran&ccedil;a, lazer e esporte.</p>
<p>Segundo a tabela divulgada pela Caixa Econ&ocirc;mica federal, a distribui&ccedil;&atilde;o de valores fica da seguinte forma:</p>
<p>Loteria Federal Percentual Pr&ecirc;mio Bruto 55,91% Seguridade Social 17,04% Fundo Nacional da Cultura - FNC 1,50% Fundo Penitenci&aacute;rio Nacional - FUNPEN 0,81% Fundo Nacional de Seguran&ccedil;a P&uacute;blica - FNSP 5% Comit&ecirc; Ol&iacute;mpico Brasileiro - COB 1,48% Comit&ecirc; Paral&iacute;mpico Brasileiro - CPB 0,87% Total 100%</p>
</div><!-- end text_info_megasena -->
</div> <!-- end main -->

</div> <!-- end containermain -->



</body>
</html>
