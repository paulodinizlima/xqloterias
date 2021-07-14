<div class='headerpainel'>

	<div class="hp-title">
		PAINEL DE ADMINISTRAÇÃO: XQ LOTERIAS
	</div>
	<div class="hp-user">
		<?php if (isset($_SESSION['id'])) {
			echo "<b><b>Bem-vindo: </b>".$_SESSION['user'] ." &nbsp;|&nbsp; <a href='?m=administrador&t=logoff'>Sair</a>";
		}?>
	</div>

</div>