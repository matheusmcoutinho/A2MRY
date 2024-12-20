<?php
// Configurações do banco de dados
$servername = "127.0.0.1";  
$username = "root";         
$password = "";             
$dbname = "a2mry";          
$port = 2908;               

// Criando a conexão com o banco de dados

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificando se houve erro na conexão

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pegando os dados enviados pelo formulário

    $name = $_POST['name'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $categoria = $_POST['categoria'];

    // Validando se todos os campos foram preenchidos

    if (empty($name) || empty($email) || empty($telefone) || empty($date) || empty($time) || empty($categoria)) {
        die("Todos os campos são obrigatórios.");
    }

    // Convertendo a data para o formato correto (yyyy-mm-dd) para o MySQL

    $date = DateTime::createFromFormat('d/m/Y', $date);
    if ($date) {
        $date = $date->format('Y-m-d'); 
    } else {
        die("Data inválida.");
    }

    // Preparando a query de inserção
    
    $sql = "INSERT INTO agendamentos (nome, email, telefone, data_agendamento, horario, servico)
            VALUES ('$name', '$email', '$telefone', '$date', '$time', '$categoria')";

    // Executando a query
    if ($conn->query($sql) === TRUE) {
        echo "<p>Agendamento realizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao realizar agendamento: " . $conn->error . "</p>";
    }

    // Fechando a conexão
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleCadAgendamento.css">
    <title>Agendamento de Consulta</title>
</head>

<body>
    <header>
        <div class="positionLogo">
        </div>
    </header>

    <main>
        <section class="container agendamento-section">
            <img src="a2mryImg.jpeg" alt="Logo da clínica" class="a2mryLogo" aria-label="Logo da Clínica" loading="lazy">
            <h1>Agendar Tratamento</h1>

            <!-- Formulário de Agendamento -->
            <form id="appointmentForm" action="agendamento.php" method="POST" aria-label="Formulário de Agendamento de Tratamento">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" placeholder="Digite seu nome" required aria-required="true">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required aria-required="true">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" placeholder="Digite seu telefone" required aria-required="true">
                </div>
                <div class="form-group">
                    <label for="date">Data do Agendamento:</label>
                    <input type="text" id="date" name="date" placeholder="dd/mm/yyyy" required aria-required="true" 
                        pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4}$" title="Data no formato dd/mm/yyyy">
                </div>
                <div class="form-group">
                    <label for="time">Horário do Agendamento:</label>
                    <select id="time" name="time" required aria-required="true">
                        <option value="">Selecione o horário</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria">Serviço:</label>
                    <select name="categoria" id="categoria" required aria-required="true">
                        <option value="Limpeza de Pele">Limpeza de Pele</option>
                        <option value="Drenagem">Drenagem</option>
                        <option value="Tratamento de Lesão Corporal">Tratamento de Lesão Corporal</option>
                        <option value="Peeling de Diamante">Peeling de Diamante</option>
                        <option value="Ventosaterapia">Ventosaterapia</option>
                    </select>
                </div>
                <button class="agendar" type="submit">Agendar</button>
            </form>

            <a href="../index.html" class="voltar-home">Voltar para a Página Inicial </a>

        </section>
    </main>

    <footer>
        <p>&copy; 2024 Clínica de Estética - Todos os direitos reservados</p>
    </footer>
</body>

</html>
