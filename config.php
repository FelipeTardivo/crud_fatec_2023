<?php



$host = "localhost"; // nome do servidor MySQL
$user = "id20548536_user_crudevuejs"; // usuário do MySQL
$pass = "Tomate50!!!123"; // senha do MySQL
$dbname = "id20548536_crude_vuejs"; // nome do banco de dados

/* 
A primeira parte do código define as informações necessárias para a 
conexão com o banco de dados, como o nome do servidor, usuário, 
senha e nome do banco de dados.
*/

// Conexão com o banco de dados MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// a função mysqli_connect() é utilizada para estabelecer a conexão com o banco de dados, 
// passando como parâmetros as informações definidas anteriormente.

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

/* A função mysqli_connect_error() verifica se houve erro na conexão. 
Se houver erro, a função die() é chamada para encerrar o script e exibir uma mensagem de erro.
Se a conexão for estabelecida com sucesso, a variável $conn conterá 
a conexão com o banco de dados, permitindo que outras operações sejam executadas, 
como inserção, atualização e consulta de dados. */