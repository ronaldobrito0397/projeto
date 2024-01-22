<?php
include("conexao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['txtnome']) ? $_POST['txtnome'] : '';
    $sexo = isset($_POST['txtsexo']) ? $_POST['txtsexo'] : '';
    $email = isset($_POST['txtemail']) ? $_POST['txtemail'] : '';
    $celular = isset($_POST['txtcelular']) ? $_POST['txtcelular'] : '';
    $exames = isset($_POST['txtexame']) ? $_POST['txtexame'] : '';
    $descricoes = isset($_POST['txtdescricao']) ? $_POST['txtdescricao'] : '';
    $valores = isset($_POST['txtvalor']) ? $_POST['txtvalor'] : '';

    // Chamada da função inserir
    if (inserir($conexao, $nome, $sexo, $email, $celular, $exames, $descricoes, $valores)) {
        echo 'Inserção bem-sucedida!';
    } else {
        echo 'Falha na inserção. Verifique o log de erros para mais informações.';
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo 'Método inválido. Utilize o método POST.';
}
?>