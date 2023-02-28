<?php 
    session_start();

    include_once('conexao.php');


    // Pegar as tags do html porém sem as tags html 
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 

    $comandoSql = "INSERT INTO empresa (nome, email, criado) values ('$nome', '$email', NOW())";
    $resultado_usuario = mysqli_query($conn, $comandoSql); 

    if (mysqli_insert_id($conn)) {
        $_SESSION['msg'] = "<p style='color: green;'>Usuário criado com sucesso.</p>";
        header("location: index.php");  
    } else {
        $_SESSION['msg'] = "<p style='color: red;'>Usuário não foi cadastrado.</p>";
        header("location: cadastro.php");
    }

?>