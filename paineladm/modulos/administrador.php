<script>
	function inserir(modulo, tipo){
		location.href='admpainel.php?m='+modulo+'&t='+tipo;
	} 
</script>
<!--<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>-->

<link rel="stylesheet" href="../css/style.css">

<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery-validate.js"></script>
<script type="text/javascript" src="../../js/jquery-validate-messages.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".formcadastro").validate({
            rules:{
            	titulo:{required:true, minlength:3},
                nome:{required:true, minlength:3},
                email:{required:true, email:true},
                senha:{required:true, rangelength:[4,10]},
                arquivo:{required:true},
                resenha:{required:true, equalTo:"#senha"},
				termos:{required:true}
            }
        });
    });
</script>


<?php

	ini_set('default_charset', 'utf-8');
    //define fuso horário
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../functions/funcoes.php";
    require_once "../functions/conection.php";

    $funcoes = new funcoes();
    $con = "../functions/conection.php";

	//session_start();
	/*$sql = "SELECT * FROM administrador WHERE id_administrador = ".(int)$_SESSION['id'];
	$resultado = mysqli_query($con,$sql);
	$dados = mysqli_fetch_array($resultado);
	if($dados){
		$id = $dados['id_administrador'];
	}*/


	$f = new funcoes();
	switch ($tela) {
		/* ##################################################################################################################### */
		case 'consultardados':
			echo "<br><div class='painel-titulo'>Dados do Administrador</div>";
		?>
			<form class="formcadastro" id='formcadastro' accept-charset="utf-8" method="POST" action="#" >
				<fieldset>
					<!-- ********************************************************* -->
					<?php	
					echo "<div class='formlabel'>Nome: </div>";
					echo "<div class='resconsulta'>";
					if($dados) echo utf8_encode($dados['adm_nome'])."</div>"; 
					/*-----------------------------------------------*/
					echo "<div class='formlabel'>Email: </div>";
					echo "<div class='resconsulta'>";
					if($dados) echo $dados['adm_email']."</div>"; 
					/*-----------------------------------------------*/
					echo "<div class='formlabel'>CPF: </div>";
					echo "<div class='resconsulta'>";
					if($dados) echo $dados['adm_cpf']."</div>"; 
					/*-----------------------------------------------*/
					echo "<div class='formlabel'>RG: </div>";
					echo "<div class='resconsulta'>";
					if($dados) echo $dados['adm_rg']."</div>"; 
					/*-----------------------------------------------*/
					?>	
				</fieldset>
               		<input type="button"  class="botao" name="enviar" value="Alterar Meus Dados" onclick="inserir('administrador','alterardados')"/>
               		<input type="button"  class="botao" name="enviar" value="Cadastrar Novo Usuário" onclick="inserir('administrador','inserirusuario')"/>
			</form>
		<?php
			break;
		/* ##################################################################################################################### */
		case 'alterardados':
				echo "<div class='painel-titulo'>Alterar Dados do Usuário / Administrador</div>";

				$sql = "SELECT * FROM administrador WHERE id_administrador = ".(int)$_SESSION['id'];
				$resultado = mysqli_query($con,$sql);
				$dados = mysqli_fetch_array($resultado);
				if($dados){
					$id = $dados['id_administrador'];
				}							
				echo "<form class='formcadastro' method='POST' action='../dados/admdados.php?id=".$id."' />"; ?>	
						<fieldset>
							<div class="formlabel">
							<label for="nome">Nome:</label></div>
							<div class="forminput">
								<?php echo "<input type='text' name='nome' size='40' value='".utf8_encode($dados['adm_nome'])."'></div>"; ?>

							<div class="formlabel">
							<label for="cpf">CPF:</label></div>
							<div class="forminput">
								<?php echo "<input type='text' name='cpf' size='30' value='".$dados['adm_cpf']."'></div>"; ?>

							<div class="formlabel">
							<label for="rg">RG:</label></div>
							<div class="forminput">
								<?php echo "<input type='text' name='rg' size='30' value='".$dados['adm_rg']."'></div>"; ?>

							<div class="formlabel">
							<label for="admin"></label></div>
							<div class="forminput"><br>
								<?php $isadmin = $dados['adm_admin']; 

								if($isadmin == 1){
 									echo "<input type='checkbox' name='admin' value='1' checked=checked>&nbsp;Administrador</div>" ;
 								} ?>
							
							<input type="text" name="status" value="1" hidden="hidden">

						</fieldset>
						<div class="formsubmit">
							<input type="submit" name="enviar" value="Salvar">
						</div>
					</form>
				<?php

			break;
		/* ##################################################################################################################### */
		case 'inserirusuario':
				echo "<div class='painel-titulo'>Cadastrar Usuário/Administrador</div>";
				echo "<br><br>";
				?>
				<form class="formcadastro" method="POST" action="../dados/admdados.php">
				<fieldset>
					<div class="formlabel">
					<label for="nome">Nome:</label></div>
					<div class="forminput">
						<input type="text" name="nome" size="40"></div>

					<div class="formlabel">
					<label for="email">Email:</label></div>
					<div class="forminput">
						<input type="text" name="email" size="40"></div>

					<div class="formlabel">
					<label for="email">Re-digite o Email:</label></div>
					<div class="forminput">
						<input type="text" name="email" size="40"></div>

					<div class="formlabel">
					<label for="cpf">CPF:</label></div>
					<div class="forminput">
						<input type="text" name="cpf" size="30"></div>

					<div class="formlabel">
					<label for="rg">RG:</label></div>
					<div class="forminput">
						<input type="text" name="rg" size="30"></div>

					<div class="formlabel">
					<label for="senha">Senha:</label></div>
					<div class="forminput">
						<input type="password" name="senha" id="senha" size="20"></div>

					<div class="formlabel">
					<label for="resenha">Re-digite a Senha:</label></div>
					<div class="forminput">
						<input type="password" name="resenha" id="resenha" size="20"></div>

					<div class="formlabel">
					<label for="admin"></label></div>
					<div class="forminput"><br>
						<input type="checkbox" name="admin" value="1" >&nbsp;Administrador</div>
					
					<input type="text" name="status" value="1" hidden="hidden">

				</fieldset>
				<div class="formsubmit">
					<input type="submit" name="enviar" value="Cadastrar">
				</div>
			</form>
			<?php


			break;
		/* ##################################################################################################################### */
		case 'alterarsenha':
			echo "<div class='painel-titulo'>Alterar Senha</div>";
			echo "<br><br>";
			?>
			<form class="formcadastro" method="POST" action="../dados/admdados.php">
			<fieldset>

				<div class="formlabel">
				<label for="senha">Nova Senha:</label></div>
				<div class="forminput">
					<input type="password" name="senha" id="senha" size="20"></div>

				<div class="formlabel">
				<label for="resenha">Re-digite a Senha:</label></div>
				<div class="forminput">
					<input type="password" name="resenha" size="20"></div>

			</fieldset>
				<div class="formsubmit">
					<input type="submit" name="enviar" value="Salvar Senha">
				</div>
			</form>
			<?php
			break;
		/* ##################################################################################################################### */
		case 'logoff':
			// remove todas as variaveis
			session_unset();
			// destroy the session
			session_destroy();
			echo "<meta http-equiv='refresh' content='0;URL=../../index.php' />";
			break;
		/* ##################################################################################################################### */
		default:
			# code...
			break;
		/* ##################################################################################################################### */
	}

?>