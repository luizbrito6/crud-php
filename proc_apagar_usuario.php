<?php 
session_start();
include_once('conexao.php');

// Receber o ID que vem com a URL 
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)) {

    // Realiza o comando SQL
    $comandoSql = "DELETE FROM empresa WHERE id= '$id'";
    $resutado_usuario = mysqli_query($conn, $comandoSql); 

    if(mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<p style='color:green;'>USÚARIO DELETADO COM SUCESSO.</p>";
        header("Location: index.php");
        
    }  else {
        $_SESSION['msg'] = "<p style='color:red;'>ERRO: USUÁRIO NÃO FOI DELETADO</p>";
        header("Location: index.php");

    }

} else {
    $_SESSION['msg'] = "<p style='color: red;'>Selecione um usuário</p>";
    header('Location: index.php');
}

?>