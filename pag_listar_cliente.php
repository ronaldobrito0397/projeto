<?php
// Inclua o arquivo de conexão
include 'conexao.php';
include 'banco_cliente.php';

// Consulta para recuperar todos os registros da tabela cliente
$query = "SELECT * FROM cliente";
$resultado = mysqli_query($conexao, $query);

// Verificar se a consulta foi bem-sucedida
if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

// Exibir os resultados em uma tabela HTML
echo "<h1>Lista de Clientes</h1>";
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Email</th>
        <th>Celular</th>
        <th>Exame</th>
        <th>Descrição</th>
        <th>Valor</th>
      </tr>";

// Loop através dos resultados e exibição na tabela
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($linha as $key => $value) {
        echo "<td>" . htmlspecialchars($value) . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

// Fechar a conexão
mysqli_close($conexao);
?>
