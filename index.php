<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>XQ Loterias</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />

	<!--Favicon -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  	<!-- Bootstrap CSS File -->
  	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
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
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){    
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
            }?>

            <!-- Lotofácil -->
            <?php
                $binds = ['lfconc' => 0];
                $sql = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc) FROM tblotofacil)";
                $sql2 = "SELECT * FROM tblotofacil WHERE lfconc = (SELECT max(lfconc)-1 FROM tblotofacil)";
                $result = $con->select($sql, $binds); 
                $result2= $con->select($sql2, $binds);                 
                if($result->rowCount() > 0){
                  $dados = $result->fetchAll(PDO::FETCH_OBJ);
                } 
                if($result2->rowCount() > 0){
                  $dados2 = $result2->fetchAll(PDO::FETCH_OBJ);
                }           
            foreach($dados as $item){    
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
            }?>

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
            }?>

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
            }?>

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
            }?>

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
            }?>

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
            }?>

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
            }?>

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
          
          <div class="left_ads">
            <img src="img/ads01.png">
          </div> <!-- end left_ads -->

      </div> <!-- end left -->
      
      <div class="main-right">
          right

      </div> <!-- end right -->

    </div> <!-- end main -->

  </div> <!-- end containermain -->

  <div class="containerfooter">
    <div class="footer">
      footer
    </div> <!-- end footer -->

  </div> <!-- end containerfooter -->





</body>
</html>
