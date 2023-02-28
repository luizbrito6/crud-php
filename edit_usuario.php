<?php 
    session_start();

    include_once('conexao.php'); 
    
    // Filtrando o ID dos valores inseridos na tabela: 
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 
    $comandoSql = "SELECT * from empresa WHERE id = $id";
    $resultado_usuario = mysqli_query($conn, $comandoSql); 
    $row_usuario = mysqli_fetch_assoc($resultado_usuario); 
    

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Editar</title>
</head>
<body>
    <a href="cadastro.php">Cadastrar</a>
    <a href="index.php">Listar</a>
    <H1>Editar dados</H1>
    <?php 
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg']; 
            unset($_SESSION['msg']);
        }
    ?>

    <form action="proc_edit_usuario.php" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">

        <fieldset>
            <legend>Nome</legend>
            <input type="text" name="nome" placeholder="Digite o nome completo:" autofocus required value="<?php echo $row_usuario['nome']; ?>">
        </fieldset>

        <fieldset>
            <legend>Email</legend>
            <input type="text" name="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $row_usuario['email'];?>">
        </fieldset>

        <input type="submit" value="Salvar">

    </form>
</body>
</html>