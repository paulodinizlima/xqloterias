<meta charset="utf-8">
<?php
echo "<link rel='stylesheet' href='../css/style.css'>";

	Class gravado{

		function gravadoOK($tipo){
			echo "<div id='loginform'>";
				echo "<div class='sucesso'>";
				switch ($tipo) {
					case 'Noticia':
						echo "Notícia cadastrada com sucesso!<br><br>";
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarnoticias'>Voltar</a>";
						break;	
					case 'Categoria':
						echo "Cadastro efetuado com sucesso!<br><br>";
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarcategorias'>Voltar</a>";
						break;
                 }
                echo "</div>";
            echo "</div>";
        } //end gravado

        function alteradoOK($tipo){
			echo "<div id='loginform'>";
				echo "<div class='sucesso'>";
				switch ($tipo) {
					case 'Categoria':
						echo "Categoria alterada com sucesso!<br><br>";
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarcategorias'>Voltar</a>";
						break;
					case 'Noticia':
						echo "Notícia alterada com sucesso!<br><br>";
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarnoticias'>Voltar</a>";
						break;	
                }
                echo "</div>";
            echo "</div>";
        } //end alterado

        function excluidoOK($tipo){
			echo "<div id='loginform'>";
				echo "<div class='sucesso'>";
				switch ($tipo) {
					case 'Noticia':
						echo "Notícia excluída com sucesso!<br><br>"; 
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarnoticias'><br>Voltar</a>";
						break;
					case 'Categoria':
						echo "Categoria excluída com sucesso!<br><br>"; 
						echo "<a href='../painel/admpainel.php?m=administrador&t=listarcategorias'><br>Voltar</a>";
						break;
                    }
                    echo "</div>";
            echo "</div>";
        } //end excluido


    } //end class