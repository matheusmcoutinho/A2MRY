<?php
// Incluir o arquivo de conexão com o banco de dados
include 'db.php';

// Configuração de paginação e busca
$records_per_page = 5;
$page = max((int)($_GET['page'] ?? 1), 1);
$searchTerm = $_GET['search'] ?? '';
$searchTermEscaped = $conn->real_escape_string($searchTerm);

// Total de registros
$total_records = $conn->query("SELECT COUNT(*) AS total FROM agendamentos WHERE nome LIKE '%$searchTermEscaped%'")->fetch_assoc()['total'];
$total_pages = max(ceil($total_records / $records_per_page), 1);
$page = min($page, $total_pages);

// Offset e consulta principal
$offset = ($page - 1) * $records_per_page;
$result = $conn->query("SELECT id, nome, email, data_agendamento, horario, telefone, servico 
                        FROM agendamentos 
                        WHERE nome LIKE '%$searchTermEscaped%' 
                        LIMIT $records_per_page OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de consulta de registros de agendamentos de tratamentos estéticos.">
    <meta name="keywords" content="consultas estéticas, tratamentos, agendamentos, beleza">
    <meta name="author" content="Clínica A2MRY">
    <link rel="stylesheet" href="style_consultas.css">
    <title>Consultas Agendadas | Clínica A2MRY</title>
</head>

<body>
    <main class="container-geral">
        <!-- Cabeçalho -->
        <header>
    <div class="logo-container">
        <img src="a2mryImg.jpeg" alt="Logo da clínica" class="a2mryLogo" loading="lazy">
    </div>
       </header>



        <!-- Consultas -->
        <section class="container-consultas">
            <h2>Consultas Agendadas</h2>

            <!-- Filtro de Pesquisa -->
            <form class="search-container" method="get">
                <input type="text" name="search" placeholder="Buscar por nome" value="<?= htmlspecialchars($searchTerm) ?>">
                <button type="submit">Buscar</button>
            </form>

            <!-- Tabela -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nome']) ?></td>
                                    <td><?= htmlspecialchars(date("d/m/Y", strtotime($row['data_agendamento']))) ?></td>
                                    <td><?= htmlspecialchars($row['horario']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['telefone']) ?></td>
                                    <td><?= htmlspecialchars($row['servico']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Nenhum agendamento encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <nav class="pagination">
                <a href="?page=<?= max(1, $page - 1) ?>&search=<?= urlencode($searchTerm) ?>" <?= $page <= 1 ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>&laquo; Anterior</a>
                <span>Página <?= $page ?> de <?= $total_pages ?></span>
                <a href="?page=<?= min($total_pages, $page + 1) ?>&search=<?= urlencode($searchTerm) ?>" <?= $page >= $total_pages ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>Próxima &raquo;</a>
            </nav>

                        <!-- Botão de voltar para a página inicial -->
                        <a href="../index.html" class="voltar-home">Voltar para a Página Inicial </a>
                        
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Clínica A2MRY. Todos os direitos reservados.</p>
    </footer>
</body>

</html>

<?php
// Fecha a conexão com o banco
$conn->close();
?>
