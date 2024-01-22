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
            echo "Paciente Inserido com Sucesso !<br>";
            echo "<a href='pag_cadastrar_cliente.php'>Adicionar Novo Paciente</a><br>";
            echo "<a href='pag_listar_cliente.php'>Listar Pacientes Cadastrados</a>";
        } else {
            $msg = mysqli_error($conexao);
            echo $msg;
        }
    } else {
        echo "Exame já existe. Não é permitido exame duplicado.";
    }
}
?>