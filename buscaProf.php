<?php



header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20548536_crude_vuejs", "id20548536_user_crudevuejs", "Tomate50!!!123");

$received_data = json_decode(file_get_contents("php://input"));

/* 	
	A variável $received_data é inicializada como um
	objeto PHP que é criado a partir do conteúdo
	JSON da solicitação enviada.
*/

$data = array();
/* 
	A variável $data é inicializada como um array vazio.
 */

if($received_data->query != '')
{
	$query = "
	SELECT * FROM fatec_professores 
	WHERE first_name LIKE '%".$received_data->query."%' 
	OR endereco LIKE '%".$received_data->query."%'
	OR curso LIKE '%".$received_data->query."%'
	OR salario LIKE '%".$received_data->query."%' 


	ORDER BY salario DESC
	";
}
else
{
	$query = "
	SELECT * FROM fatec_professores
	ORDER BY salario DESC
	";
}

/* 
A condicional if-else verifica se a propriedade query do objeto $received_data não está vazia.
Se a propriedade query não estiver vazia, uma consulta SQL é construída para buscar alunos
cujos nomes ou sobrenomes contenham o valor de query (que é uma string). 
Se a propriedade query estiver vazia, outra consulta SQL é construída para buscar todos os alunos na tabela.
 */


$statement = $connect->prepare($query);

$statement->execute();
/* 
O objeto $statement é inicializado com a consulta SQL construída e, em seguida,
executado com o método execute(). 
Os resultados são recuperados da tabela em um loop usando a função fetch() da classe PDO. 
Cada linha de resultado é adicionada ao array $data.
 */

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);
/* 
Por fim, a função json_encode() é usada para codificar o array $data em uma
string JSON, que é enviada como resposta ao cliente.
 */
?>