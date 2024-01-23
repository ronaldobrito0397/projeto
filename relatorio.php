<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>

    <style>
        body {
            display: grid;
            place-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa; 
        }

        #container {
            max-width: 800px;
            padding: 20px;
            border: 1px solid #3498db;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; 
        }

        h1 {
            text-align: center;
            color: #3498db;
            font-family: 'Helvetica', sans-serif;
        }

        label {
            text-align: center;
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #696969;
        }

        input[name="valor_min"],
        input[name="valor_max"],
        input[name="exame_pesquisa"] {
            padding: 10px 15px; 
            width: 100%; 
            font-size: 14px;
            border: 1px solid #696969; 
            border-radius: 5px;
            margin-bottom: 10px; 
        }

        input[name="valor_min"]::placeholder,
        input[name="valor_max"]::placeholder,
        input[name="exame_pesquisa"]::placeholder {
            color: #696969; 
            opacity: 0.7;
        }

        button[name="pesquisar"],
        button[name="pesquisar_exame"] {
        display: block;
        margin: 10px auto;
        background-color: #3498db;
        color: #ffffff;
        padding: 10px 15px;
        font-size: 12px;
        border: none;
        cursor: pointer;
        }

        th {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            text-align: left;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #3498db;
        }

        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <a href="index.html">Voltar a Tela Inicial</a>
</body>
</html>

<?php
include 'conexao.php';
include 'banco_cliente.php';

// Verifica se o formulário de pesquisa foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesquisar'])) {
    $sexoPesquisa = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $valorMin = isset($_POST['valor_min']) ? floatval($_POST['valor_min']) : 0;
    $valorMax = isset($_POST['valor_max']) ? floatval($_POST['valor_max']) : PHP_FLOAT_MAX;

    // Consulta para reuperar registros da tabela cliente baseado no sexo e nos valores de exames selecionados
    $query = "SELECT * FROM cliente WHERE sexo = '$sexoPesquisa' AND valor >= $valorMin AND valor <= $valorMax";
    $resultado = mysqli_query($conexao, $query);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesquisar_exame'])) {
    $examePesquisa = isset($_POST['exame_pesquisa']) ? $_POST['exame_pesquisa'] : '';

    // Consulta para recuperar registros da tabela cliente baseado no exame selecionado
    $query = "SELECT * FROM cliente WHERE exame = '$examePesquisa'";
    $resultado = mysqli_query($conexao, $query);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }
} else {
    // Se o formulário não foi enviado, exibir todos os registros
    $query = "SELECT * FROM cliente";
    $resultado = mysqli_query($conexao, $query);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }
}

// Inicia a saída do relatório
echo "<h1>Relatório de Clientes</h1>";

// Formulário de pesquisa por sexo e valores de exames
echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
echo "<label>Pesquisar por Sexo:</label>";
echo "<input type='radio' name='sexo' value='Feminino'> Feminino";
echo "<input type='radio' name='sexo' value='Masculino'> Masculino";

echo "<br><br>";

echo "<label>Valor Mínimo de Exame:</label>";
echo "<input type='number' name='valor_min' step='0.01' placeholder='0.00'>";

echo "<label>Valor Máximo de Exame:</label>";
echo "<input type='number' name='valor_max' step='0.01'>";

echo "<br><br>";

echo "<button type='submit' name='pesquisar'>Pesquisar por Valores de Exame</button>";

// Adicionar campo de pesquisa por nome de exame
echo "<br><br>";
echo "<label>Pesquisar por Nome de Exame:</label>";
echo "<input type='text' name='exame_pesquisa' placeholder='Nome do Exame'>";
echo "<button type='submit' name='pesquisar_exame'>Pesquisar por Exame</button>";

echo "</form>";

// Exibir a tabela de resultados
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