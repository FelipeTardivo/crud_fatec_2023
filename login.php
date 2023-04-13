<?php

ob_start();

// Inicia o buffer de saída, que é uma área temporária para armazenar 
// a saída que será enviada ao navegador. Isso é útil para evitar que
// a página seja enviada parcialmente antes de todo o processamento ser concluído

session_start();
// inicia a sessão, que permite armazenar dados do usuário entre várias páginas da mesma aplicação

require_once 'config.php';
// inclui o arquivo de configuração da aplicação, que provavelmente 
// contém informações como dados de acesso ao banco de dados.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // verifica se o método de requisição é POST, ou seja, se o formulário foi submetido.

    $email = $_POST['email_login'];
    $senha = $_POST['senha_login'];
    // atribuem às variáveis $email e $senha os valores submetidos pelo formulário.

    $query = "SELECT id, nome FROM fatec_admin WHERE email='$email' AND senha=md5('$senha')";
    // cria uma consulta SQL para verificar se o email e a senha existem no banco de dados. 
    // A função md5() é usada para criptografar a senha antes de compará-la com a do banco de dados.

    $result = mysqli_query($conn, $query);
    // executa a consulta SQL no banco de dados.

    if (mysqli_num_rows($result) == 1) {

        // verifica se foi encontrado um registro no banco de dados correspondente ao email 
        // e senha fornecidos. Se sim, as informações do usuário são armazenadas na sessão
        // e a página é redirecionada para a página de dashboard. Se não, é exibida uma
        // mensagem de erro e a página é redirecionada para a página de login.
        

        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        header('Location: dashboard.html'); // Redireciona para a página de dashboard
    } else {
        echo '<script>alert("Email ou senha incorretos!")</script>'; 
        header("Location: index.html#paralogin");               
    }
}

ob_end_flush();
// encerra o buffer de saída e envia a saída para o navegador.

?>

