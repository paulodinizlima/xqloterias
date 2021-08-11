<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias</title>
    <meta http-equiv="refresh" content="60">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />

	<!--Favicon -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="fontawesome/css/all.css">

	<!-- Google Fonts -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  	<!-- Bootstrap CSS File -->
  	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link rel="stylesheet" type="text/css" href="css/style.css">

  <script data-ad-client="ca-pub-3270290765053134" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
</head>


<body>

	<!--==========================
    Header
  	============================-->

 	<header>
    <h1 class="float-l">
      <img src="img/logo.png">
    </h1>

    
    <input type="checkbox" id="control-nav" />
    <label for="control-nav" class="control-nav"></label>
    <label for="control-nav" class="control-nav-close"></label>

    <nav class="float-r">
      <ul class="list-auto">
        <li class="megasena">          
          <a href="loterias/megasena/" title="Megasena"><span class="icone"><img src="img/icon_megasena.png" width="20"></span> Megasena</a>          
        </li>
        <li class="lotofacil">
          <a href="loterias/lotofacil/" title="Lotofácil"><span class="icone"><img src="img/icon_lotofacil.png" width="20"></span> Lotofácil</a>
        </li>
        <li class="quina">
          <a href="loterias/quina/" title="Quina"><span class="icone"><img src="img/icon_quina.png" width="20"></span> Quina</a>
        </li>
        <li class="lotomania">
          <a href="loterias/lotomania/" title="Lotomania"><span class="icone"><img src="img/icon_lotomania.png" width="20"></span> Lotomania</a>
        </li>
        <li class="timemania">
          <a href="loterias/timemania/" title="Timemania"><span class="icone"><img src="img/icon_timemania.png" width="20"></span> Timemania</a>
        </li>
        <li class="duplasena">
          <a href="loterias/duplasena/" title="Dupla Sena"><span class="icone"><img src="img/icon_duplasena.png" width="20"></span> Dupla Sena</a>
        </li>
        <li class="diadesorte">
          <a href="loterias/diadesorte/" title="Dia de Sorte"><span class="icone"><img src="img/icon_diadesorte.png" width="20"></span> Dia de Sorte</a>
        </li>
        <li class="supersete">
          <a href="loterias/supersete/" title="Super Sete"><span class="icone"><img src="img/icon_supersete.png" width="20"></span> Super Sete</a>
        </li>
        <li class="federal">
          <a href="loterias/federal/" title="Federal"><span class="icone"><img src="img/icon_federal.png" width="20"></span> Federal</a>
        </li>
      </ul>
    </nav>
  </header>

  <?php
    ini_set('default_charset', 'utf-8');
    //define fuso horário
    date_default_timezone_set('America/Sao_Paulo');

    require('paineladm/functions/conection.php');
    $con = new conection();

    //define horário para alternar concurso
    $horafixa = strtotime('19:00');
    $horaatual = strtotime(date('H:i'));
    $dataatual = date('Y-m-d');


     
  ?>

  <div class="containermain">
    
    <div class="main">
      
      <div class="main-left">
          <!-- left -->
          <div class="title_left">

            Últimos Resultados

          </div>  

          <div class="content_left">

            <!-- Megasena -->
            <?php
                $binds = ['msconc' => 0];
                $sql = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc) FROM tbmegasena)";
                $sql2 = "SELECT * FROM tbmegasena WHERE msconc = (SELECT max(msconc)-1 FROM tbmegasena)";
                $result = $con->select($sql, $binds); 
                $result2 = $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
            $msdata = "{$item->msdata}";   
            $mspremio = "{$item->mspremioest}";
            $msacumulado = "";
            echo "<a href='loterias/megasena'>
                  <div class='title_loteria_left tmegasena'>            
                    <h5><span class='icone'><img src='img/icon_megasena.png' width='20'></span> Megasena";
                      $datajogo = date("Y-m-d", strtotime("{$item->msdata}"));
                      if("{$item->msd01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->msconc}</span></h5>";
                      } else if("{$item->msd01}" == 0 && "{$item->msdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->msconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->msd01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->msdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->msdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
                
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->msgan06}" == '0'){
                $msacumulado = "A C U M U L A D O";
              } else if ("{$item2->msgan06}" == '-'){
                $msacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->msgan06}" > 0){
                $msacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Lotofácil -->
            <?php
                $binds = ['lfconc' => 0];
                $sql = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
                $sql2 = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc)-1 FROM tblotofacil)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);
                $lfacumulado = "";                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
              $lfdata = "{$item->lfdata}";   
              $lfpremio = "{$item->lfpremioest}"; 
              echo "<a href='loterias/lotofacil'>
                    <div class='title_loteria_left tlotofacil'>            
                      <h5><span class='icone'><img src='img/icon_lotofacil.png' width='20'></span> Lotofácil";
                        $datajogo = date("Y-m-d", strtotime("{$item->lfdata}"));
                        if("{$item->lfd01}" == 0 && $datajogo == $dataatual){
                          echo "<span class='concurso_left'>&nbsp;{$item->lfconc}</span></h5>";
                        } else if("{$item->lfd01}" == 0 && "{$item->lfdata}" != $dataatual){
                          foreach($dados2 as $item2){
                            echo "<span class='concurso_left'>&nbsp;{$item2->lfconc}</span></h5>";
                          }
                        }
              echo "</div>    
                    <div class='content_loteria_left'>";
                    if("{$item->lfd01}" == 0 && $datajogo == $dataatual){
                      echo date('d/m/Y', strtotime("{$item->lfdata}"))."&nbsp;- Aguardando Sorteio";
                    } else {
                      foreach($dados2 as $item2){
                        echo date('d/m/Y', strtotime("{$item2->lfdata}"));
                      }
                    }
              echo  "</div>
                    </a>";            
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->lfgan15}" == '0'){
                $lfacumulado = "A C U M U L A D O";
              } else if ("{$item2->lfgan15}" == '-'){
                $lfacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->lfgan15}" > 0){
                $lfacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Quina -->  
            <?php
                $binds = ['quiconc' => 0];
                $sql = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc) FROM tbquina)";
                $sql2 = "SELECT * FROM tbquina WHERE quiconc = (SELECT max(quiconc)-1 FROM tbquina)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
            $quidata = "{$item->quidata}";   
            $quipremio = "{$item->quipremioest}";   
            $quiacumulado = "";
            echo "<a href='loterias/quina'>
                  <div class='title_loteria_left tquina'>            
                    <h5><span class='icone'><img src='img/icon_quina.png' width='20'></span> Quina";
                      $datajogo = date("Y-m-d", strtotime("{$item->quidata}"));
                      if("{$item->quid01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->quiconc}</span></h5>";
                      } else if("{$item->quid01}" == 0 && "{$item->quidata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->quiconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->quid01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->quidata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->quidata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->quigan05}" == '0'){
                $quiacumulado = "A C U M U L A D O";
              } else if ("{$item2->quigan05}" == '-'){
                $quiacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->quigan05}" > 0){
                $quiacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Lotomania -->
            <?php
                $binds = ['ltmconc' => 0];
                $sql = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc) FROM tblotomania)";
                $sql2 = "SELECT * FROM tblotomania WHERE ltmconc = (SELECT max(ltmconc)-1 FROM tblotomania)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){   
            $ltmdata = "{$item->ltmdata}";   
            $ltmpremio = "{$item->ltmpremioest}"; 
            $ltmacumulado = "";
            echo "<a href='loterias/lotomania'>
                  <div class='title_loteria_left tlotomania'>            
                    <h5><span class='icone'><img src='img/icon_lotomania.png' width='20'></span> Lotomania";
                      $datajogo = date("Y-m-d", strtotime("{$item->ltmdata}"));
                      if("{$item->ltmd01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->ltmconc}</span></h5>";
                      } else if("{$item->ltmd01}" == 0 && "{$item->ltmdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->ltmconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->ltmd01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->ltmdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->ltmdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->ltmgan20}" == '0'){
                $ltmacumulado = "A C U M U L A D O";
              } else if ("{$item2->ltmgan20}" == '-'){
                $ltmacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->ltmgan20}" > 0){
                $ltmacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Timemania -->
            <?php
                $binds = ['tmmconc' => 0];
                $sql = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc) FROM tbtimemania)";
                $sql2 = "SELECT * FROM tbtimemania WHERE tmmconc = (SELECT max(tmmconc)-1 FROM tbtimemania)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){
            $tmmdata = "{$item->tmmdata}";   
            $tmmpremio = "{$item->tmmpremioest}";  
            $tmmacumulado = "";  
            echo "<a href='loterias/timemania'>
                  <div class='title_loteria_left ttimemania'>            
                    <h5><span class='icone'><img src='img/icon_timemania.png' width='20'></span> Timemania";
                      $datajogo = date("Y-m-d", strtotime("{$item->tmmdata}"));
                      if("{$item->tmmd01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->tmmconc}</span></h5>";
                      } else if("{$item->tmmd01}" == 0 && "{$item->tmmdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->tmmconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->tmmd01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->tmmdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->tmmdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->tmmgan07}" == '0'){
                $tmmacumulado = "A C U M U L A D O";
              } else if ("{$item2->tmmgan07}" == '-'){
                $tmmacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->tmmgan07}" > 0){
                $tmmacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Dupla Sena -->
            <?php
                $binds = ['dsconc' => 0];
                $sql = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc) FROM tbduplasena)";
                $sql2 = "SELECT * FROM tbduplasena WHERE dsconc = (SELECT max(dsconc)-1 FROM tbduplasena)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
            $dsdata = "{$item->dsdata}";   
            $dspremio = "{$item->dspremioest}";  
            $dsacumulado = ""; 
            echo "<a href='loterias/duplasena'>
                  <div class='title_loteria_left tduplasena'>            
                    <h5><span class='icone'><img src='img/icon_duplasena.png' width='20'></span> Dupla Sena";
                      $datajogo = date("Y-m-d", strtotime("{$item->dsdata}"));
                      if("{$item->ds01d01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->dsconc}</span></h5>";
                      } else if("{$item->ds01d01}" == 0 && "{$item->dsdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->dsconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->ds01d01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->dsdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->dsdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->ds01gan06}" == '0'){
                $dsacumulado = "A C U M U L A D O";
              } else if ("{$item2->ds01gan06}" == '-'){
                $dsacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->ds01gan06}" > 0){
                $dsacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Dia de Sorte -->
            <?php
                $binds = ['ddsconc' => 0];
                $sql = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc) FROM tbdiadesorte)";
                $sql2 = "SELECT * FROM tbdiadesorte WHERE ddsconc = (SELECT max(ddsconc)-1 FROM tbdiadesorte)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){
            $ddsdata = "{$item->ddsdata}";   
            $ddspremio = "{$item->ddspremioest}";   
            $ddsacumulado = ""; 
            echo "<a href='loterias/diadesorte'>
                  <div class='title_loteria_left tdiadesorte'>            
                    <h5><span class='icone'><img src='img/icon_diadesorte.png' width='20'></span> Dia de Sorte";
                      $datajogo = date("Y-m-d", strtotime("{$item->ddsdata}"));
                      if("{$item->ddsd01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->ddsconc}</span></h5>";
                      } else if("{$item->ddsd01}" == 0 && "{$item->ddsdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->ddsconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->ddsd01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->ddsdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->ddsdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
             } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->ddsgan07}" == '0'){
                $ddsacumulado = "A C U M U L A D O";
              } else if ("{$item2->ddsgan07}" == '-'){
                $ddsacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->ddsgan07}" > 0){
                $ddsacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Super Sete -->
            <?php
                $binds = ['spsconc' => 0];
                $sql = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc) FROM tbsupersete)";
                $sql2 = "SELECT * FROM tbsupersete WHERE spsconc = (SELECT max(spsconc)-1 FROM tbsupersete)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
            $spsdata = "{$item->spsdata}";   
            $spspremio = "{$item->spspremioest}"; 
            $spsacumulado = "";  
            echo "<a href='loterias/supersete'>
                  <div class='title_loteria_left tsupersete'>            
                    <h5><span class='icone'><img src='img/icon_supersete.png' width='20'></span> Super Sete";
                      $datajogo = date("Y-m-d", strtotime("{$item->spsdata}"));
                      if("{$item->spsd01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->spsconc}</span></h5>";
                      } else if("{$item->spsd01}" == 0 && "{$item->spsdata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->spsconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->spsd01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->spsdata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->spsdata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            } //end foreach
            foreach($dados2 as $item2){
              if("{$item2->spsgan07}" == '0'){
                $spsacumulado = "A C U M U L A D O";
              } else if ("{$item2->spsgan07}" == '-'){
                $spsacumulado = "A G U A R D A N D O";
              } else if ((int)"{$item2->spsgan07}" > 0){
                $spsacumulado = "";
              }  
            } //end foreach
            ?>

            <!-- Federal -->
            <?php
                $binds = ['fedconc' => 0];
                $sql = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc) FROM tbfederal)";
                $sql2 = "SELECT * FROM tbfederal WHERE fedconc = (SELECT max(fedconc)-1 FROM tbfederal)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){ 
            $feddata = "{$item->feddata}";   
            $fedpremio = "{$item->fedpremioest}";   
            echo "<a href='loterias/federal'>
                  <div class='title_loteria_left tfederal'>            
                    <h5><span class='icone'><img src='img/icon_federal.png' width='20'></span> Federal";
                      $datajogo = date("Y-m-d", strtotime("{$item->feddata}"));
                      if("{$item->feds01}" == 0 && $datajogo == $dataatual){
                        echo "<span class='concurso_left'>&nbsp;{$item->fedconc}</span></h5>";
                      } else if("{$item->feds01}" == 0 && "{$item->feddata}" != $dataatual){
                        foreach($dados2 as $item2){
                          echo "<span class='concurso_left'>&nbsp;{$item2->fedconc}</span></h5>";
                        }
                      }
            echo "</div>    
                  <div class='content_loteria_left'>";
                  if("{$item->feds01}" == 0 && $datajogo == $dataatual){
                    echo date('d/m/Y', strtotime("{$item->feddata}"))."&nbsp;- Aguardando Sorteio";
                  } else {
                    foreach($dados2 as $item2){
                      echo date('d/m/Y', strtotime("{$item2->feddata}"));
                    }
                  }
            echo  "</div>
                  </a>";
            }?>

          </div>  <!-- end content_left -->
          
      </div> <!-- end left -->

      <!--ads aqui -->
      
      <div class="main-right">

        <!-- Megasena -->  
        <div class="row">
          <div class="main-loterias tmegasena text-white col-md-3">
          <h2><a href='loterias/megasena'>Megasena</a></h2>
          <?php echo "<span class='text-grey'>".$msacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio:
          <?php 
          $datajogo = date("Y-m-d", strtotime($msdata));
          if($dataatual == $datajogo){
            //echo "<strong>";
            echo "<h3>".date('d/m/Y', strtotime($msdata))."</h3>";
            //echo "</strong>";
          } else {
            echo "<h3>".date('d/m/Y', strtotime($msdata))."</h3>";
          }
          ?>
          </h6>
          <h6><?php echo "às ".date('H:i', strtotime($msdata))."h" ?> </h6>
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 fmegasena">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$mspremio ?></h2></h6>
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Lotofácil -->
        <div class="row"> 
          <div class="main-loterias tlotofacil text-white col-md-3">
          <h2><a href='loterias/lotofacil'>Lotofácil</a></h2>
          <?php echo "<span class='text-grey'>".$lfacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($lfdata)) ?></h3></h6>
          <h6><?php echo "às ".date('H:i', strtotime($lfdata))."h" ?> </h6>
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 flotofacil">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$lfpremio ?></h2></h6>
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Quina --> 
        <div class="row">
          <div class="main-loterias tquina text-white col-md-3">
          <h2><a href='loterias/quina'>Quina</a></h2>
          <?php echo "<span class='text-grey'>".$quiacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($quidata)) ?></h3></h6>  
          <h6><?php echo "às ".date('H:i', strtotime($quidata))."h" ?> </h6>
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 fquina">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$quipremio ?></h2></h6> 
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Lotomania -->  
        <div class="row">
          <div class="main-loterias tlotomania text-white col-md-3">
          <h2><a href='loterias/lotomania'>Lotomania</a></h2>
          <?php echo "<span class='text-grey'>".$ltmacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($ltmdata)) ?></h3></h6> 
          <h6><?php echo "às ".date('H:i', strtotime($ltmdata))."h" ?> </h6>
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 flotomania">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$ltmpremio ?></h2></h6>  
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Timemania --> 
        <div class="row"> 
          <div class="main-loterias ttimemania text-white col-md-3">
          <h2><a href='loterias/timemania'>Timemania</a></h2>
          <?php echo "<span class='text-grey'>".$tmmacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($tmmdata)) ?></h3></h6> 
          <h6><?php echo "às ".date('H:i', strtotime($tmmdata))."h" ?> </h6> 
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 ftimemania">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$tmmpremio ?></h2></h6>
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Dupla Sena --> 
        <div class="row"> 
          <div class="main-loterias tduplasena text-white col-md-3">
          <h2><a href='loterias/duplasena'>Dupla Sena</a></h2>
          <?php echo "<span class='text-grey'>".$dsacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($dsdata)) ?></h3></h6>  
          <h6><?php echo "às ".date('H:i', strtotime($dsdata))."h" ?> </h6>
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 fduplasena">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$dspremio ?></h2></h6>
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Dia de Sorte -->  
        <div class="row">
          <div class="main-loterias tdiadesorte text-white col-md-3">
          <h2><a href='loterias/diadesorte'>Dia de Sorte</a></h2>
          <?php echo "<span class='text-grey'>".$ddsacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($ddsdata)) ?></h3></h6> 
          <h6><?php echo "às ".date('H:i', strtotime($ddsdata))."h" ?> </h6> 
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 fdiadesorte">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$ddspremio ?></h2></h6>
          </div><!-- end main-premios col-md-8 -->
        </div>

        <!-- Super Sete -->  
        <div class="row">
          <div class="main-loterias tsupersete text-white col-md-3">
          <h2><a href='loterias/supersete'>Super Sete</a></h2>
          <?php echo "<span class='text-grey'>".$spsacumulado."</span>"; ?>
          </div><!-- end main-loterias col-md-4 -->
          <div class="main-data-sorteio col-md-2">
          <h6>Próximo Sorteio: <h3><?php echo date('d/m/Y', strtotime($spsdata)) ?></h3></h6> 
          <h6><?php echo "às ".date('H:i', strtotime($spsdata))."h" ?> </h6> 
          </div><!-- end main-data-sorteio col-md-2 -->
          <div class="main-premios col-md-4 fsupersete">
          <h6>Prêmio Estimado: <h2><?php echo "R$ ".$spspremio ?></h2></h6>  
          </div><!-- end main-premios col-md-8 -->
        </div>

      </div> <!-- end right -->


      
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
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/timemania/">Timemania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/supersete/">Super Sete</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/federal/">Federal</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Segunda</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/supersete/">Super Sete</a></li>
            </ul>
            <br><br><br>
            <h4>Terça</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/timemania/">Timemania</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Quarta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/federal/">Federal</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/supersete/">Super Sete</a></li>
            </ul>
            <br><br>
            <h4>Quinta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/timemania/">Timemania</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Sexta</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotomania/">Lotomania</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/supersete/">Super Sete</a></li>
            </ul>
            <br>
            <h4>Sábado</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/diadesorte/">Dia de Sorte</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/duplasena/">Dupla Sena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/federal/">Federal</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/lotofacil/">Lotofácil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/megasena/">Megasena</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/quina/">Quina</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="loterias/timemania/">Timemania</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Fale Conosco</h4>
            <p>
              São Paulo - Brasil<br>
              <strong>Email:</strong> xqloterias@xqloterias.com.br<br>
            </p>
<!--
            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>


          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Newsletter</h4>
            <p>Se quiser ficar antenado em nossas novidades e atualizações, informe seu e-mail e clique em Inscrever, você será notificado sempre que tivermos novidades, promoções ou informativos.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Inscrever">
            </form>
          </div>
-->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>XQ Loterias</strong>. Todos os direitos reservados
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Designed by <a href="http://www.mousegraphics.com.br/">Mousegraphics</a>
      </div>
    </div>
  </footer><!-- #footer -->
    
    
  </div>


</body>
</html>
