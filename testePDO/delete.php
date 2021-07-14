<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Sistema Crud</title>
    <link rel="stylesheet" href="style.css">
</head>    
<body>
    <div class="crud">
        <h3>Exclusão de Dados</h3>
        
        <?php
            require('../app/DataBase.php');
            $DataBase = new DataBase();
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $binds = ['id' => 2];
            $result = $DataBase->delete($sql, $binds);
            if($result){
                echo "<div class='success'> Usuário excluído com sucesso </div>";
            } else {
                echo "Não foi possível efetuar a exclusão";
            }
        ?>
    </div>
</body>
</html>