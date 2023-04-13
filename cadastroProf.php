<?php
header('Access-Control-Allow-Origin: *');
// Define que a API pode ser acessada de qualquer origem.

$connect = new PDO("mysql:host=localhost;dbname=id20548536_crude_vuejs", "id20548536_user_crudevuejs", "Tomate50!!!123");
// Define que a API pode ser acessada de qualquer origem.

$received_data = json_decode(file_get_contents("php://input"));
// Recebe os dados enviados na requisição HTTP via POST e converte de JSON para um objeto PHP.

$data = array();
// Define uma variável para armazenar os dados retornados pelo CRUD.

if ($received_data->action == 'fetchall') {
    // Verifica qual ação deve ser executada com base na propriedade "action" do objeto recebido.
    // Neste caso, se a ação for "fetchall", os dados de todos os alunos são retornados
    $query = "
 SELECT * FROM chamadafatec_professores 
 ORDER BY salario DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // Itera sobre os resultados da consulta SQL e adiciona cada linha a um array de dados
        $data[] = $row;
    }
    echo json_encode($data);
    // Retorna os dados em formato JSON.
}
if ($received_data->action == 'insert') {
    // Se a ação for "insert", insere um novo aluno na tabela.
    $data = array(
        ':first_name' => $received_data->firstName,
        ':endereco' => $received_data->endereco,
        ':curso' => $received_data->curso,
        ':salario' => $received_data->salario
    );

    $query = "
 INSERT INTO fatec_alunos 
 (first_name, endereco, curso, salario) 
 VALUES (:first_name, :endereco, :curso, :salario)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Aluno Adicionado'
    );

    echo json_encode($output);
}
if ($received_data->action == 'fetchSingle') {
    // Se a ação for "fetchSingle", retorna os dados de um aluno específico com base no ID fornecido.

    $query = "
 SELECT * FROM fatec_alunos 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data['id'] = $row['id'];
        $data['first_name'] = $row['first_name'];
        $data['endereco'] = $row['endereco'];
        $data['curso'] = $row['curso'];
        $data['salario'] = $row['salario'];


    }

    echo json_encode($data);
}
if ($received_data->action == 'update') {
    // Se a ação for "update", atualiza os dados de um aluno com base no ID fornecido.

    $data = array(
        ':first_name' => $received_data->firstName,
        ':endereco' => $received_data->endereco,
        ':curso' => $received_data->curso,
        ':salario' => $received_data->salario,

        ':id' => $received_data->hiddenId
    );

    $query = "
 UPDATE fatec_alunos 
 SET first_name = :first_name, 
 endereco = :endereco,
 curso = :curso,
 salario = :salario,
 WHERE id = :id
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Aluno Atualizado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'delete') {
    // Se a ação for "delete", exclui um aluno com base no ID fornecido.

    $query = "
 DELETE FROM fatec_alunos 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Aluno Deletado'
    );

    echo json_encode($output);
}

?>