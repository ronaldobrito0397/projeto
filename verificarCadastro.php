<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
</head>
<body>
    <style>
        h4 {
            text-align: center;
            color: #FF0000; 
            padding: 20px;
            font-family: 'Helvetica', sans-serif;
        }
        h3 {
            text-align: center;
            color: #3CB371; 
            padding: 20px;
            font-family: 'Helvetica', sans-serif;
        }
        .custom-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        }

        .custom-button:hover {
        background-color: #2980b9; 
        }
    </style>
    <a href="index.html">Voltar a Tela Inicial</a>
</body>

<?php
    include("conexao.php");
    include("banco_cliente.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['txtnome'];
        $sexo = $_POST['txtsexo'];
        $email = $_POST['txtemail'];
        $celular = $_POST['txtcelular'];
        $exames = $_POST['txtexame'];
        $descricoes = $_POST['txtdescricao'];
        $valores = $_POST['txtvalor'];

    // Verifica se o exame já existe antes de inserir
    if (!exameDuplicado($conexao, $exames, $nome)) {
        if (inserir($conexao, $nome, $sexo, $email, $celular, $exames, $descricoes, $valores)) {
            // Exibe a mensagem de sucesso com dois links
            echo "<h3>Paciente Inserido com Sucesso !</h3><br>";
            echo "<h3><a href='pag_cadastrar_cliente.php' class='custom-button'>Adicionar Novo Paciente</a><h3><br>";
            echo "<a href='pag_listar_cliente.php' class='custom-button'>Listar Pacientes Cadastrados</a>";
        } else {
            $msg = mysqli_error($conexao);
            echo $msg;
        }
    } else {
        echo "<h4>Exame já existe. Não é permitido exame duplicado.</h4>";
    }
}
?>