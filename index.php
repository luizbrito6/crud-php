<?php 

    session_start();
    include_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Lista</title>
</head>
<body>
    <a href="cadastro.php">Cadastrar</a>
    <a href="index.php">Listar</a>

    <h1>Listar usuários</h1>

    <?php 

    
        if (isset($_SESSION['msg'])) {
            echo ($_SESSION['msg']);
            unset($_SESSION['msg']);
        }


        
        // Recebe o código da página
        $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1; 

        // Setar a quantidade de páginas - 
        $qtd_result_pg = 3;

        // Calcular o inicio da vizualização
        $inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg; 

        $result_usuarios = "SELECT * FROM empresa LIMIT $inicio, $qtd_result_pg";
        $resultado_usuarios = mysqli_query($conn, $result_usuarios); 

        while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){

            echo "ID: " , $row_usuario['id'] . "<br>"; 
            echo "Nome: " , $row_usuario['nome'] . "<br>";
            echo "Email: " , $row_usuario['email'] . "<br>";
            echo "<a href='edit_usuario.php?id=" . $row_usuario['id'] . "'>Editar </a><br>"; 
            echo "<a href='proc_apagar_usuario.php?id=" . $row_usuario['id'] . "'> Apagar </a><br><hr>";

        }


        //Paginação - Soma quantidade de usuários: 
        $result_pg = "SELECT count(id) AS num_result FROM empresa"; 
        $resultado_pg = mysqli_query($conn, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);


        $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);

        // Limite os links antes e depois 
        $max_links = 2; 
        echo "<a href='index.php?pagina=1'>Primeira</a>";


        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo "<a href='index.php?pagina=$pag_ant'>$pag_ant</a>";
            }
        }

        echo "$pagina" ; 


        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                echo "<a href='index.php?pagina=$pag_dep'>$pag_dep</a>";

            } 
        }
        

        echo "<a href='index.php?pagina=$quantidade_pg'>Ultima </a>"; 
    
    
    
    ?>


</body>
</html>