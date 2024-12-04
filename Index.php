<?php
// Dados do banco de dados
$servername = "127.0.0.1"; // Servidor
$username = "root";        // Usuário
$password = "";            // Senha
$dbname = "a2mry";         // Nome do banco de dados
$port = 2908;              // Porta do MySQL

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Query para buscar os registros da tabela 'agendamentos'
$sql = "SELECT id, nome, email, data_agendamento, horario, telefone, servico FROM agendamentos";

// Executa a consulta
$result = $conn->query($sql);

// Verifica se existem registros e exibe os resultados
if ($result->num_rows > 0) {
    // Cria uma tabela HTML para exibir os dados
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data do Agendamento</th>
                <th>Horário</th>
                <th>Telefone</th>
                <th>Serviço</th>
            </tr>";
    
    // Loop para exibir cada registro
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["nome"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars(date("d/m/Y", strtotime($row["data_agendamento"]))) . "</td>
                <td>" . htmlspecialchars($row["horario"]) . "</td>
                <td>" . htmlspecialchars($row["telefone"]) . "</td>
                <td>" . htmlspecialchars($row["servico"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
