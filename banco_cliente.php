<?php
//função inserir
function exameDuplicado($conexao, $exames, $nome)
{
    foreach ($exames as $exame) {
        $query = "SELECT * FROM cliente WHERE exame = '$exame' AND nome = '$nome'";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            // Verifica se o exame já existe para o paciente
            if (mysqli_num_rows($resultado) > 0) {
                return true; // Exame duplicado
            }
        } else {
            // Trate o erro, se houver
            echo "Erro na consulta: " . mysqli_error($conexao);
            return true; //exame duplicado
        }
    }

    return false; // Nenhum exame duplicado
}

function inserir($conexao, $nome, $sexo, $email, $celular, $exames, $descricoes, $valores)
{
    for ($i = 0; $i < count($exames); $i++) {
        $exame = mysqli_real_escape_string($conexao, $exames[$i]);
        $descricao = mysqli_real_escape_string($conexao, $descricoes[$i]);
        $valor = mysqli_real_escape_string($conexao, $valores[$i]);

        // Verifica se o exame já está associado a este paciente
        if (!exameDuplicado($conexao, [$exame], $nome)) {
            $sql = "INSERT INTO cliente (nome, sexo, email, celular, exame, descricao, valor) VALUES ('$nome', '$sexo', '$email', '$celular', '$exame', '$descricao', '$valor')";
            if (!mysqli_query($conexao, $sql)) {
                // Trata o erro, se houver
                echo "Erro na inserção: " . mysqli_error($conexao);
                return false; // Falha na inserção
            }
        }
    }

    return true; // Inserção bem-sucedida
}
?>
