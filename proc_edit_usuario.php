<?php 
    session_start();
    include_once('conexao.php'); 
    
    $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT); 
    $nome =  htmlspecialchars($_POST['nome']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    $comandoSql = "UPDATE empresa SET nome='$nome', email='$email', modificado=NOW() WHERE id='$id'";
    $resultado_usuario = mysqli_query($conn, $comandoSql); 

    if(mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<p style='color:green;'> Usuário editado com sucesso.</p>";
        header("location: index.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'> Usuário não foi editado.</p>";
        header("location: edit_usuario.php?id=$id");
    }

?>