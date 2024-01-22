<?php
// Inclua o arquivo de conexão
include 'conexao.php';
include 'banco_cliente.php';

// Se um formulário de exclusão for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
    $nome = isset($_POST['nome_excluir']) ? $_POST['nome_excluir'] : '';
    $exame = isset($_POST['exame_excluir']) ? $_POST['exame_excluir'] : '';

    // Chamada da função para excluir
    if (excluir($conexao, $nome, $exame)) {
        echo 'Exclusão bem-sucedida!';
    } else {
        echo 'Falha na exclusão. Verifique o log de erros para mais informações.';
    }
}

// Consulta para recuperar todos os registros da tabela cliente
$query = "SELECT * FROM cliente";
$resultado = mysqli_query($conexao, $query);

// Verificar se a consulta foi bem-sucedida
if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

// Exibir os resultados em uma tabela HTML
echo "<h1>Lista de Clientes</h1>";
echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
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
        <th>Ação</th>
      </tr>";

// Loop através dos resultados e exibição na tabela
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($linha as $key => $value) {
        echo "<td>" . htmlspecialchars($value) . "</td>";
    }

    // Adiciona um botão de exclusão para cada linha
    echo "<td>
            <button type='submit' name='excluir' onclick='confirmarExclusao(\"{$linha['nome']}\", \"{$linha['exame']}\")'>Excluir</button>
          </td>";

    echo "</tr>";
}

echo "</table>";
echo "<input type='hidden' id='nome_excluir' name='nome_excluir' value=''>";
echo "<input type='hidden' id='exame_excluir' name='exame_excluir' value=''>";
echo "</form>";

// Fechar a conexão
mysqli_close($conexao);
?>

<!-- Script JavaScript para confirmar exclusão -->
<script>
    function confirmarExclusao(nome, exame) {
        if (confirm("Tem certeza que deseja excluir o registro de " + nome + " para o exame " + exame + "?")) {
            document.getElementById('nome_excluir').value = nome;
            document.getElementById('exame_excluir').value = exame;
        }
    }
</script>
