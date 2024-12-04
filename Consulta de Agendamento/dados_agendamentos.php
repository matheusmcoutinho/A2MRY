<?php
// Incluir o arquivo de conexão com o banco de dados
include 'db.php';

// Número de registros por página
$records_per_page = 5;

// Determina a página atual (se não especificada, começa na página 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Verifica se o botão de busca foi pressionado
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Query para contar o total de registros na tabela 'agendamentos', considerando o filtro de busca
$sql_count = "SELECT COUNT(*) AS total FROM agendamentos WHERE nome LIKE '%$searchTerm%'";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_records = $row_count['total'];

// Ajusta a página para evitar valores fora do intervalo (páginas vazias)
$total_pages = ceil($total_records / $records_per_page);
if ($page > $total_pages) $page = $total_pages;
if ($page < 1) $page = 1;

// Calcula o índice para a cláusula OFFSET
$offset = ($page - 1) * $records_per_page;

// Query para buscar os registros da tabela 'agendamentos' com LIMIT e OFFSET, considerando o filtro de busca
$sql = "SELECT id, nome, email, data_agendamento, horario, telefone, servico 
        FROM agendamentos 
        WHERE nome LIKE '%$searchTerm%' 
        LIMIT $records_per_page OFFSET $offset";

// Executa a consulta
$result = $conn->query($sql);
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
    <!-- Conteúdo Principal -->
    <main class="container-geral">
        <!-- Logo e Botão -->
        <header>
            <div class="header-container">
                <!-- Botão para a nova página -->
                <a href="nova_pagina.php" class="btn-nova-pagina" aria-label="Ir para nova página">Nova Página</a>
                
                <!-- Logo -->
                <div class="logo-container">
                    <img src="a2mryImg.jpeg" alt="Logo da clínica" class="a2mryLogo" aria-label="Logo da Clínica" loading="lazy">
                </div>
            </div>
        </header>

        <section class="container-consultas" aria-labelledby="titulo-consultas">
            <h2 id="titulo-consultas">Consultas Agendadas</h2>

            <!-- Filtro de Pesquisa -->
            <div class="search-container">
                <form action="" method="get">
                    <input 
                        type="text" 
                        id="searchInput" 
                        name="search" 
                        placeholder="Buscar por nome" 
                        value="<?php echo htmlspecialchars($searchTerm); ?>" 
                        aria-label="Buscar por nome">
                    <button type="submit" id="searchButton" aria-label="Buscar tratamento por nome">Buscar</button>
                </form>
            </div>

            <!-- Tabela de Agendamentos -->
            <div class="table-responsive">
                <table id="appointmentTable" class="table" aria-describedby="descricao-tabela">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horário</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verifica se existem registros e exibe os resultados
                        if ($result->num_rows > 0) {
                            // Loop para exibir cada registro
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                                echo "<td>" . htmlspecialchars(date("d/m/Y", strtotime($row["data_agendamento"]))) . "</td>";
                                echo "<td>" . htmlspecialchars($row["horario"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["servico"]) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Nenhum agendamento encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <nav class="pagination" aria-label="Navegação por página" aria-live="polite">
                <!-- Botão Anterior -->
                <a href="?page=<?php echo max(1, $page - 1); ?>&search=<?php echo urlencode($searchTerm); ?>" id="prevPage" aria-label="Página anterior" 
                        <?php if ($page <= 1) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>
                    &laquo; Anterior
                </a>
                <span id="pageInfo">Página <?php echo $page; ?> de <?php echo $total_pages; ?></span>
                <!-- Botão Próxima -->
                <a href="?page=<?php echo min($total_pages, $page + 1); ?>&search=<?php echo urlencode($searchTerm); ?>" id="nextPage" aria-label="Próxima página" 
                        <?php if ($page >= $total_pages) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>
                    Próxima &raquo;
                </a>
            </nav>
        </section>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 Clínica A2MRY. Todos os direitos reservados.</p>
    </footer>
</body>

</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
