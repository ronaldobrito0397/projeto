<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
</head>
<body>
    <style>
        h1 {
            text-align: center;
            color: #3498db; /* Cor azul para o cabeçalho */
            padding: 20px;
        }
        form {
            max-width: 1000px;
            margin: 10px auto;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        input {
            display: block;
            width: 50%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }
        #examesContainer {
            margin-bottom: 20px;
        }

        button {
            background-color: #3498db; /* Cor azul para o botão */
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9; /* Cor azul mais escura no hover */
        }
    
        </style>
    <center>
        <h1>Cadastro de Paciente</h1>
        <!-- Formulário para cadastrar pacientes, com a ação direcionada para verificarCadastro.php via método POST -->
        <form action="verificarCadastro.php" method="post">
            <!-- Campos para inserção de dados pessoais do paciente -->
            Nome Completo: <input type="text" name="txtnome" placeholder="Digite o Nome do Paciente"><br>
            Sexo: <input type="text" name="txtsexo" placeholder="Sexo"><br>
            Email: <input type="text" name="txtemail" placeholder="E-mail"><br>
            Celular: <input type="text" name="txtcelular" placeholder="Celular"><br>

            <!-- Container para os campos relacionados aos exames, permitindo a adição dinâmica de múltiplos exames -->
            <div id="examesContainer">
                Exame: <input type="text" name="txtexame[]" placeholder="Exame">
                Descrição: <input type="text" name="txtdescricao[]" placeholder="Descrição">
                Valor: <input type="text" name="txtvalor[]" placeholder="Valor">
                <button type="button" onclick="adicionarExame()">Adicionar Exame</button><br>
            </div>

            <input type="submit" value="Cadastrar" name="btn"><br>
        </form>

        <!-- Script JavaScript para adicionar e remover dinamicamente campos de exames -->
        <script>
            // Função para adicionar um novo conjunto de campos de exame
            function adicionarExame() {
                var novoExame = '<div>' +
                                    'Exame: <input type="text" name="txtexame[]" placeholder="Exame">' +
                                    'Descrição: <input type="text" name="txtdescricao[]" placeholder="Descrição">' +
                                    'Valor: <input type="text" name="txtvalor[]" placeholder="Valor">' +
                                    '<button type="button" onclick="removerExame(this)">Remover Exame</button>' +
                                '</div>';

                // Adiciona o novo conjunto de campos ao container
                document.getElementById('examesContainer').insertAdjacentHTML('beforeend', novoExame);
            }

            // Função para remover o conjunto de campos de exame quando o botão "Remover Exame" é clicado
            function removerExame(botaoRemover) {
                // Remove o conjunto de campos do DOM
                botaoRemover.parentNode.remove();
            }
        </script>
    </center>    
</body>
</html>

