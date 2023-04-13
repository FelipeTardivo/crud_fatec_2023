<?php

ob_start();
// A função ob_start() é chamada para ativar o buffer de saída.

session_start(); 
// A função session_start() é chamada para iniciar a sessão PHP.
//  Isso é necessário para poder armazenar dados de sessão, como 
// informações de login do usuário, por exemplo.

require_once 'config.php';
// usada para incluir o arquivo de configuração do banco de dados, que contém a conexão com o banco de dados.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // é usada para verificar se o formulário foi enviado com o método POST.
    // As variáveis $nome, $email e $senha são inicializadas com os valores enviados pelo formulário.
    $nome = $_POST['nome_cad'];
    $email = $_POST['email_cad'];
    $senha = $_POST['senha_cad'];

    // A variável $query é definida como uma string contendo uma consulta SQL
    //  que verifica se o email já está em uso no banco de dados.
    $query = "SELECT * FROM fatec_admin WHERE email='$email'";
    // A função mysqli_query() é chamada para executar a consulta SQL e 
    // a variável $result armazena o resultado da consulta.
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // é usada para verificar se o resultado da consulta retorna mais de 0 linhas,
        //  o que significa que o email já está em uso no banco de dados.
        echo "<script>alert('Este email já está em uso!');</script>";
    } else {
        $query = "INSERT INTO fatec_admin (nome, email, senha) VALUES ('$nome', '$email', md5('$senha'))";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Usuário cadastrado com sucesso!")</script>';
            header("Location: index.html#paralogin");
        } else {
            echo '<script>alert("Erro ao cadastrar usuário!")</script>';
            header("Location: index.html#paracadastro");
        }
    }
}

ob_end_flush();
// A função ob_end_flush() é chamada para enviar o buffer de saída e encerrar a execução do script.

/*
CREATE TABLE fatec_admin (
id INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
senha VARCHAR(100) NOT NULL,
PRIMARY KEY (id),
UNIQUE KEY email (email)
);
*/


?>